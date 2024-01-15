<?php

namespace Aponahmed\Filesystem;

class Router
{
    private static $instance = null;
    public $segments;

    public function __construct()
    {
        $this->routeRequest();
    }

    public static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        } else {
            return self::$instance = new static();
        }
    }


    public function routeRequest()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = parse_url($url, PHP_URL_PATH);
        $url = trim($url, '/');

        $segments = explode('/', $url);
        // URL-decode each segment
        foreach ($segments as &$segment) {
            $segment = urldecode($segment);
        }
        $this->segments = $segments;
    }

    public function getCurrentPath($currentDir)
    {
        unset($this->segments[0]);
        $subDir = implode("/", $this->segments);

        if (!empty($subDir)) {
            $currentDir .= "/" . $subDir;
        }
        $currentDir = preg_replace('/(\/+)/', '/', $currentDir);
        return $currentDir;
    }
}
