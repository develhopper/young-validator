<?php

include __DIR__."/../vendor/autoload.php";

spl_autoload_register(function ($name) {
	$filename = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', '/', $name) . '.php';
	if (file_exists($filename)) {
		require_once $filename;
	} else {
		if(isset($_SERVER['SERVER_PROTOCOL']))
			header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
		echo "Class '$filename' Not Found";
		exit;
	}
});