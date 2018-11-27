<?php
class Index {
	
	public function LoadView() {
		global $app;
		
		$view = new View();
		
		return $view->render( $app, 'tmpl/index.php');
	}
}
