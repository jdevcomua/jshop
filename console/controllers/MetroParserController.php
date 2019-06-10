<?php

namespace console\controllers;


use common\models\Afisha;
use common\models\Business;
use common\models\City;
use common\models\ParseKarabas;
use common\models\SystemLog;
use console\controllers\Parser\karabas\CategoryParser;
use console\controllers\Parser\karabas\SubCategoryParse;
use console\controllers\Parser\karabas\ImageParser;
use DateTimeZone;
use Yii;
use yii\console\Controller;

class MetroParserController extends Controller
{
    const TIMEOUT = 60;

    private $afishaTypes = [
        'newyear',
        'concerts',
        'theatres',
        'circus',
        'clubs',
        'excursions',
        'festivals',
        'child',
        'sport',
        'exhibitions',
        'poetry',
        'seminars',
        'quest',
    ];
    private $response;
    public $active_cities;

    public function init()
    {
        $this->response = [
            'success' => [
                'HTTP/1.1 200 OK',
                'HTTP/1.0 200 OK',
                'HTTP/1.1 301 Moved Permanently',
            ],
        ];

        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * Парсит список городов и добавляет в кеш
     */
    public function actionParseCategory(){
        $link = new CategoryParser('https://metro.zakaz.ua/ru/', self::TIMEOUT);
        $link->downloadContent()->parseData();

    }

    /**
     * Удаляет список пропаршеных городов с кеша
     */
    public function actionDeleteCityCache(){
        if (Yii::$app->cache->exists(self::CITY_CACHE)){
            Yii::$app->cache->delete(self::CITY_CACHE);
            echo 'Кеш городов удален', PHP_EOL;
        }
    }

    /**
     * @param $phpArray integer[] массив предприятий
     * @return string
     */
    public function php_to_postgres_array($phpArray)
    {
        return '{' . join(',', $phpArray) . '}';
    }

    /**
     * Парсит список концертов и добавляет в афишу если нет
     */
    public function actionParseConcert(){
        $current_language = Yii::$app->language;
        Yii::$app->language = 'ru-RU';

        foreach ($this->afishaTypes as $afishaType){
            $link = new CategoryParser('https://karabas.com/' . $afishaType . '/', self::TIMEOUT);
            $link->downloadContent()->parseData();
            $cities = $link->getData();

            if ($cities) {
                $this->parseAfishaTypeFromKarabas($cities);
            }
        }

        Yii::$app->language = $current_language;
    }

    /**
     * Метод добавляет в системные логи инфу $description
     *
     * @param $searchMessage string текст для поиска похожего лога что б избежать дублирование логов
     * при повторном запуске парсера в течении дня
     * @param $description array массив с информацией о логе
     */
    private function addMessageToLog($searchMessage, $description){
        $date = new \DateTime('now');

        //ищем такой же лог(что б избежать дублирования)
        $systemLog = SystemLog::find()
            ->where(['like', 'description', $searchMessage])
            ->andWhere(['date("dateCreate")' => $date->format('Y-m-d')])
            ->one();

        //если нету такого лога, то добавляем в бд
        if (!$systemLog) {
            $systemLog = new SystemLog(['description' => $description]);
            $systemLog->status = SystemLog::STATUS_WARNING;

            $systemLog->save();
        }
    }

    /**
     * Метод добавляет афишу в бд если такой нету или обновляет информацию о старой
     *
     * @param $idsCompany integer ид комании
     * @param $concert array массив а данными об концерте
     * @return int к-во добавленых афиш
     */
    private function addConcert($idsCompany, $concert){
        $count = 0;
        $date = new \DateTime($concert['date']);
        $date = $date->format('Y-m-d H:i:s');

        $date_end = new \DateTime($concert['date_end']);
        $date_end->setTime(23, 59, 59);
        $date_end = $date_end->format('Y-m-d H:i:s');

        /** @var $afisha Afisha*/
        $afisha = Afisha::find()
            ->where(['<=', 'dateStart', $date])
            ->andWhere(['&&', 'idsCompany', $this->php_to_postgres_array(array($idsCompany))])
            ->andWhere(['ilike', 'title', $concert['title']])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        //если нету такой афиши, то добавляем в бд
        if (!$afisha) {
            $model = new Afisha();
            $model->isFilm = self::IS_FILM;
            $model->idsCompany = array($idsCompany);
            $model->title = $concert['title'];
            $model->idCategory = self::AFISHA_CATEGORY_ID;
            $model->times = $concert['time'];
            $model->price = $concert['price'];
            $model->dateStart = $date;
            $model->dateEnd = $date_end;
            $model->isChecked = self::IS_CHECKED;

            //Получаем ссылку на большую картинку
            if(!empty($concert['link_concert'])) {
                $image_link = new ImageParser($concert['link_concert']);
                $image_link->downloadContent()->parseData();

                $model->description = $image_link->description;

                $img = $this->getImageInVar($image_link->image);
                if ($img['mimeType'] === 'image/jpeg' || $img['mimeType'] === 'image/png') {
                    Yii::$app->files->uploadFromUrl($model, 'image', $img);
                }
                if (file_exists($img['file'])) {
                    unlink($img['file']);
                }
            }

            if ($model->validate()) {
                if ($model->save()) {
                    $count++;
                }
            }
        } else {
            //если дата окончания афиши отличается, то создаем новую
            if ($afisha->dateEnd < $date_end) {
                //$afisha->dateEnd = $date_end;
                //$afisha->isChecked = self::IS_CHECKED;
                //$afisha->times = $concert['time'];

//                if ($afisha->update()) {
//
//                }
                $model = new Afisha();
                $model->isFilm = self::IS_FILM;
                $model->idsCompany = array($idsCompany);
                $model->title = $concert['title'];
                $model->idCategory = self::AFISHA_CATEGORY_ID;
                $model->times = $concert['time'];
                $model->price = $concert['price'];
                $model->dateStart = $date;
                $model->dateEnd = $date_end;
                $model->isChecked = self::IS_CHECKED;

                //Получаем ссылку на большую картинку
                if(!empty($concert['link_concert'])) {
                    $image_link = new ImageParser($concert['link_concert']);
                    $image_link->downloadContent()->parseData();

                    $model->description = $image_link->description;

                    $img = $this->getImageInVar($image_link->image);
                    if ($img['mimeType'] === 'image/jpeg' || $img['mimeType'] === 'image/png') {
                        Yii::$app->files->uploadFromUrl($model, 'image', $img);
                    }
                    if (file_exists($img['file'])) {
                        unlink($img['file']);
                    }
                }

                if ($model->validate()) {
                    if ($model->save()) {
                        $count++;
                    }
                }

            }
        }

        return $count;
    }

    /**
     * Получает id предприятия с ссылки
     *
     * @param $link string
     * @return mixed
     */
    private function getIdBusinessFromLink($link)
    {
        $matchCount = preg_match("/hall\/(.*?)\//", $link, $matches);

        if ($matchCount == 1) {
            return $matches[1];
        } else {
            return false;
        }
    }

    /**
     * Метод загружает картинку с сайта
     *
     * @param $url string на картинку на другом сервере
     * @return array|null
     */
    private function getImageInVar($url)
    {
        $return = null;
        $file = basename($url);

        $file_headers = @get_headers($url);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            return $return;
        }

        $head = get_headers($url, true);
        $doesExist = in_array($head[0], $this->response['success'], true);
        if ($doesExist and ($content = file_get_contents($url))) {
            $f = fopen("$file", "w");
            if (fwrite($f, $content) === false) {
            } else {
                $fileSize = filesize($file);
                $mimeType = mime_content_type($file);
                fclose($f);
                $return = ['file' => $file, 'filesize' => $fileSize, 'mimeType' => $mimeType];
            }
        }

        return $return;
    }

    private function parseAfishaTypeFromKarabas($cities){
        $count = 0;
        //цикл по списку пропаршеных городов
        foreach ($cities as $city){
            foreach ($this->active_cities as $city_in_db){
                if ($city['name'] == 'Днепропетровск'){
                    $city['name'] = 'Днепр';
                }

                //если город активный и пропаршен
                if ($city_in_db->title == $city['name']){
                    //парсим список концертов
                    $link = new SubCategoryParse($city['link'], self::TIMEOUT);
                    $link->downloadContent()->parseData();
                    $concerts = $link->getData();
                    if (!isset($concerts)){
//                        $description = [
//                            'Сообщение' => 'failed to open stream ' . $city['name'],
//                        ];
//
//                        $this->addMessageToLog('failed to open stream ' . $city['name'], $description);
                        var_dump("empty concert array");
                        continue;
                    }

                    foreach ($concerts as $concert){
                        //если нету название продолжаем цикл
                        if ($concert['title'] == ''){
                            continue;
                        }

                        $count += $this->processConcert($concert, $city['name']);
                    }
                }
            }
        }

        var_dump('Добавлено ' . $count . ' концертов');
    }

    /**
     * Метод находит ассоциацию предприятия с карабасом
     *
     * @param $business_remote_id string - url предприятия с карабаса
     * @return array|null|\yii\db\ActiveRecord|ParseKarabas
     */
    private function getBusinessLocalId($business_remote_id){
        $business_local_id = ParseKarabas::find()
            ->where(['remote_business_id' => $business_remote_id])
            ->one();

        if (!$business_local_id) {
            $business_local_id = ParseKarabas::find()
                ->where(['like', 'remote_business_id', $business_remote_id])
                ->one();
        }

        return $business_local_id;
    }

    /**
     * Метод ищет кассоциацию с предприятиями карабаса в  бд, если есть,
     * то добавляет концерт,
     * иначе пишет в SystemLog ошибку с  url предприятия с карабаса
     *
     * @param $concert array масиф с инфой об одном концерте
     * @param $cityName string города, где происходит концерт
     * @return int к-во добавленых концертов
     */
    private function processConcert($concert, $cityName){
        $count = 0;
        //если ссылка предприятия нужного формата
        if ($business_remote_id = $this->getIdBusinessFromLink($concert['link_bussines'])){
            $business_local_id = $this->getBusinessLocalId($business_remote_id);

            //есть ассоциация с предприятием находим id предприятие, либо пишем в логи ошибку
            if ($business_local_id){
                $idsCompany = $business_local_id->local_business_id;

                $count += $this->addConcert($idsCompany, $concert);
            } else {
                $description = [
                    'Сообщение' => 'Нету ассоциации в базе данных для предприятия',
                    'Ссылка' => $concert['link_bussines'],
                ];

                $this->addMessageToLog($concert['link_bussines'], $description);
            }
        } else{
            //если ссылка на предприятие битая создаем лог с варнингом
            $msg = 'Кривая ссылка для концерта:' . $concert['title'] . ' Город:' . $cityName;
            $description = [
                'Сообщение' => $msg,
            ];

            $this->addMessageToLog($msg, $description);
        }

        return $count;
    }
}