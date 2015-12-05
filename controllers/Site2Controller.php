<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class Site2Controller extends Controller{
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
		$result1 = mysql_query('SELECT * from item_cat;');
		if (!$result1) {
			die('Ошибка выполнения запроса:' . mysql_error());
		}
		while($row = mysql_fetch_array($result1)) {
			$array1[] = $row;
		}
		$this->render('View2', ['result1'=>$array1]);
	}
}
?>
