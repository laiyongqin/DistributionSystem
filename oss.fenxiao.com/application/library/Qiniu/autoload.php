<?php

$path = __DIR__ . DIRECTORY_SEPARATOR;
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
spl_autoload_extensions('.php');
spl_autoload_register();

require_once 'functions.php';