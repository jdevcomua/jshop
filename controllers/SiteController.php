<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller{
    function actionIndex(){
        $dbhost = "localhost"; // Имя хоста БД
        $dbusername = "root"; // Пользователь БД
        $dbpass = "230263"; // Пароль к базе
        $dbname = "mobidev"; // Имя базы

        $dbconnect = mysql_connect ($dbhost, $dbusername, $dbpass);
        if (!$dbconnect) {
            echo ("Не могу подключиться к серверу базы данных!");
        }

        if(@mysql_select_db($dbname)) {  }
        else die ("Не могу подключиться к базе данных $dbname!");
        if (@$_REQUEST['sub']) {
            mysql_query("SET NAMES 'UTF-8'");
            $title = $_POST['title'];
            $cost = $_POST['cost'];
            $category_id = $_POST['category_id'];
            $result = mysql_query("SELECT id from item_cat where title=\"$category_id\";");
            $row = mysql_fetch_array($result);
            $category_id = $row['id'];
            $sql = "INSERT INTO item(category_id, title, cost) VALUES($category_id, \"$title\", $cost);";
            $_GET['id'] = $row['id'];
            if(!mysql_query($sql)) {
                echo '<center><p><b>Помилка при додаванні даних!</b></p></center>';
            } else {
                echo '<center><p><b></b></p></center>';
            }
        }
        if (@$_REQUEST['del']) {
            $idd = $_POST['idd'];
            $result = mysql_query("SELECT category_id from item where id=$idd;");
            $row = mysql_fetch_array($result);
            $category_id = $row['category_id'];
	        $result = mysql_query("delete from item where id=$idd");
            $_GET['id'] = $category_id;
        }
        $result1 = mysql_query('SELECT * from item_cat;');
        if (!$result1) {
            die('Ошибка выполнения запроса:' . mysql_error());
        }
        while($row = mysql_fetch_array($result1)) {
	        $array1[] = $row;
        }
        if(isset($_GET['id'])){
	        $id = $_GET['id'];
        } else {
            $id = 0;
        }
        if($id == "0"){
            $result2 = mysql_query("SELECT * from item;");
            $category = "all";
        } else if(is_int(+$id)){
            $result2 = mysql_query("SELECT title from item_cat where id=$id;");
            while($row = mysql_fetch_array($result2)) {
                $category = $row['title'];
            }
            $result2 = mysql_query("SELECT * from item where category_id=$id;");
        }
        if (!$result2) {
            die('Ошибка выполнения запроса:' . mysql_error());
        }
        while($row = mysql_fetch_array($result2)) {
	        $array2[] = $row;
        }
		return $this->render('View', ['result1'=>$array1, 'result2'=>$array2, 'category'=>$category, 'count'=>sizeof($array2)]);
	}
}
?>
