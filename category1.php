<html>
	<head>
		<title>Items</title>
		<link rel="stylesheet" type="text/css" href="style4.css" />
		<link rel="stylesheet" type="text/css" href="print.css" media="print" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style>.menu ul {margin: 0;list-style: none;padding-left: 20px;display: none;}li {color: #ffffff;text-decoration: none;}.menu .title {cursor: pointer;color: #ffffff;}.menu .title::before {content: '+';font-size: 80%;color: #00baff;}.menu.open .title::before {content: '- ';}.menu.open ul {display: table-row;background-image: url(nav.jpg);}
.menu2 ul {margin: 0;list-style: none;padding-left: 20px;display: none;}li {color: #ffffff;text-decoration: none;}.menu2 .title2 {cursor: pointer;color: #ffffff;}.menu2 .title2::before {content: '+';font-size: 80%;color: #00baff;}.menu2.open .title2::before {content: '- ';}.menu2.open ul {display: table-row;background-image: url(nav.jpg);}</style>
	</head>
	<body>
	<div id="logo">
		<h1>...</h1>
	</div>

<div id="content">

	<?php
		$dbhost = "localhost"; // Имя хоста БД
		$dbusername = "root"; // Пользователь БД
		$dbpass = "230263"; // Пароль к базе
		$dbname = "mobidev"; // Имя базы

		$dbconnect = mysql_connect ($dbhost, $dbusername, $dbpass);
		if (!$dbconnect) { echo ("Не могу подключиться к серверу базы данных!"); }

		if(@mysql_select_db($dbname)) {  }
		else die ("Не могу подключиться к базе данных $dbname!");

		if (@$_REQUEST['sub']) {
			mysql_query("SET NAMES 'UTF-8'");
 			$title = $_POST['title'];
 			$cost = $_POST['cost'];
 			$sql = "INSERT INTO item(category_id, title, cost) VALUES(4, \"$title\", $cost);";
 			if(!mysql_query($sql)){
				echo '<center><p><b>Помилка при додаванні даних!</b></p></center>';
			} else {
				echo '<center><p><b></b></p></center>';
			}
		}
		if (@$_REQUEST['del']) {
    		$idd = $_POST['idd'];
			$result = mysql_query("delete from item where id=$idd");
 		}
 		$result = mysql_query('SELECT item_cat.title as "cat", item.title as "item", item.cost FROM mobidev.item inner join mobidev.item_cat on item.category_id=item_cat.id');
		if (!$result) {
    		die('Ошибка выполнения запроса:' . mysql_error());
		}
		?>
		<H4>Items</H4><br>
		<table id="table111" border="1" cellpadding="5" style="border-width: 1px;width: 100%;" >
			<tr><td>category</td><td>name</td><td>cost</td></tr>
			<?php
			while($row = mysql_fetch_array($result)) {
				echo "<tr>";
				echo "<td>";
				echo $row['cat'];
				echo "</td>";
				echo "<td>";
				echo $row['item'];
				echo "</td>";
				echo "<td>";
				echo $row['cost'];
				echo "</td>";
				echo "<td>";
				echo "<form action=\"category1.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"idd\" value=\"";
				echo $row['id'];
				echo "\">";
				echo "<input class=\"del\" id=\"del\" type=\"submit\" name=\"del\" value=\"Delete\">";
				echo "</form>";
				echo "</td>";
				echo "</tr>";
			}
			?>
		</table>
		<br><H4 id="h41">Add</H4><br>
		<form action="category1.php" method="post" name="appl">
			<table width="65%" border="0" cellpadding="5" class="tb1">
				<tr><td width="38%"><div align="right">title</div></td>
					<td width="62%"><input name="title" type="text" required /></td>
				</tr>
				<tr><td><div align="right">cost</div></td>
					<td><input name="cost" type="number" required /></td>
				</tr>
				<tr><td></td><td><input id="add" name="sub" type="submit" value="save" /></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="footer"></div>
</body>
</html>
