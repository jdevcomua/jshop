<?php
namespace core;

class Controller{

public $layout = 'layout/layout.php';

	function render($view, $params = []){
		foreach($params as $key => $value){
			$$key = $value;
		}
		ob_start();
		include ROOTDIR.'/view/'.$view.'.php';
		$content = ob_get_contents();
		ob_clean();
		include ROOTDIR.'/view/'.$this->layout;
	}
}
?>
