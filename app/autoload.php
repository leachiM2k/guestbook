<?php
spl_autoload_register(
	function ($class)
	{
		$libraryRoot = realpath(__DIR__ . '/../app/');
		$classFileName = str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $class) . '.php';
		$fileName = realpath($libraryRoot . DIRECTORY_SEPARATOR . $classFileName);

		if (is_readable($fileName))
		{
			include_once($fileName);
		}
	}
);

