<?php
define('ROOTDIR', __DIR__);
function my_autoloader($class) {
	$file = explode('\\', $class)[0].'/'.explode('\\', $class)[1].'.php';
	if (file_exists($file)){
		include $file;
	}
}
spl_autoload_register('my_autoloader');


if(!isset($_GET['r'])){
	$r = "actionIndex";
	$name = "controller\\SiteController";
} else {
	$r = 'action'.ucfirst(explode('/', $_GET['r'])[1]);
	$name = "controller\\".ucfirst(explode('/', $_GET['r'])[0])."Controller";
}
$scontroller = new $name();
$scontroller->$r();
?>
