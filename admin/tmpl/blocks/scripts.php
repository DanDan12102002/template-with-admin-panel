<?php 
	defined('_JEXEC') or die;
	
	global $app;

	# Подключаем Js файлы
	echo $app->scripts->jsHtml;
?>