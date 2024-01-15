<?php

use Aponahmed\Filesystem\FileSystem;
//Autoload 
require_once 'vendor/autoload.php';

define('_APP_URL', 'http://192.168.0.50/FileSystem/');
define('_ASSET_URI', _APP_URL . "assets/");

$fileSystem = new FileSystem(
    [
        'app_directory' => "filesystem",
        'root' => dirname(__FILE__),
        'dir' => 'public',
    ]
);


include 'view.php';
