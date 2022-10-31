<?php

use Aponahmed\Filesystem\FileSystem;
//Autoload 
require_once 'vendor/autoload.php';

define('_APP_URL', 'http://192.168.0.12/FileSystem/');
define('_ASSET_URI', _APP_URL . "assets/");

$fileSystem = new FileSystem(
    [
        'root' => dirname(__FILE__)
    ]
);


include 'view.php';

