<?php

namespace Aponahmed\Filesystem;

use Aponahmed\Filesystem\FileIcon;
use Aponahmed\Filesystem\FileSystemController;

class FileSystem
{
    /**
     * Directory to Retrive
     */
    public string  $DIR;

    public static $urlEnc = true;
    /**
     * Number of Step
     */
    public int $step = 3;
    /**
     * Root Directory for Base directory
     */
    public string $rootDir;
    public  static $subDir = false;
    /**
     * Current Folder Data
     */
    private array $data;
    /**
     * File Icon Object 
     */
    private object $FileIcon;

    function __construct($options)
    {
        $this->rootDir = $options['root'];
        if (isset($_GET['i']) && !empty($_GET['i'])) {
            $ss = $_GET['i'];
            if (self::$urlEnc) {
                $ss = $this->encrypt_decrypt('decrypt', $ss);
            }
            self::$subDir = $ss;
        }
        if (isset($options['dir']) && !empty($options['dir'])) {
            $this->DIR = $options['dir'];
        } else {
            $this->DIR = $options['root'];
            if (self::$subDir) {
                $this->DIR .= "/" . self::$subDir;
            }
        }
        $this->DIR = preg_replace('/(\/+)/', '/', $this->DIR);

        $this->step = (int) isset($options['step']) ? $options['step'] : $this->step;
        $PathInfo = pathinfo($this->DIR);
        //$this->rootDir = $PathInfo['basename'];
        $this->FileIcon = new FileIcon();
        $this->getFileData();
        $this->controller = new FileSystemController($this);
    }

    function getFileData()
    {
        $this->data = self::folderData($this->DIR, $this->step, self::$subDir);
        return $this->data;
    }


    function controller()
    {
        $this->controller->controllerHtm();
    }

    function nav()
    {
        $this->controller->currentDirNav();
    }

    function getFileExp()
    {
        $htm = "<div class='file-exp'>";
        if ($this->data) {
            foreach ($this->data as $k => $file) {
                $htm .= "<div class='single-file' title='{$file['name']}'>";
                if ($file['type'] == 'dir') {
                    $kEnc = $file['path'];
                    if (self::$urlEnc) {
                        $kEnc = $this->encrypt_decrypt('encrypt', $kEnc);
                    }
                    $htm .= "<a href='?i=$kEnc'>" . $this->fuleBuild($file) . "</a>";
                } else {
                    $htm .= $this->fuleBuild($file);
                }
                $htm .= "</div>";
            }
        } else {
            echo "<div class='fs-empty'>Nothing Found !</div>";
        }

        $htm .= "</div>";
        echo $htm;
    }

    private function fuleBuild($fileInfo)
    {
        $icon = "";
        if ($fileInfo['type'] == 'dir') {
            if (isset($fileInfo['child']) && is_array($fileInfo['child']) && count($fileInfo['child']) > 0) {
                //Folder With Something
                $icon = $this->FileIcon::get('folder');
            } else {
                //Empty Folder
                $icon = $this->FileIcon::get('folder-empty');
            }
        } else {
            //File
            $icon = $this->FileIcon::fileTypeIcon($fileInfo['ext']);
        }

        $htm = "<div class='file-icon'>$icon</div><label class='file-name'>{$fileInfo['name']}</label>";
        return $htm;
    }


    /**
     * 
     * @param string $dir
     * @param string $relDir 
     * @param int $step Maximum Stem recursion
     * @return object 
     */
    static function folderData($dir, $step, $cRoot)
    {
        $step--;
        $folders = [];
        if ($step > 0) {
            foreach (new \DirectoryIterator($dir) as $fileInfo) {
                if ($fileInfo->isDot())
                    continue;

                if ($cRoot) {
                    $cDir = $cRoot . "/" . $fileInfo->getFilename();
                } else {
                    $cDir = "/" . $fileInfo->getFilename();
                }
                if ($fileInfo->isDir()) {
                    $folder = [
                        'path' => $cDir,
                        'name' => $fileInfo->getFilename(),
                        'parent' => $dir,
                        'child' => self::folderData($dir . "/" . $fileInfo->getFilename(), $step, $cDir),
                        'type' => 'dir',
                        'order' => 0,
                    ];
                } else {
                    $folder = [
                        'name' => $fileInfo->getFilename(),
                        'parent' => $dir,
                        'type' => 'file',
                        'ext' => $fileInfo->getExtension(),
                        'order' => 1,
                    ];
                }
                $folders[$cDir] = $folder;
            }
        }

        usort($folders,  function ($a, $b) {
            return $a['order'] - $b['order'];
        });
        return $folders;
    }
    public function encrypt_decrypt($action, $string)
    {
        //return $string;
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'fsk';
        $secret_iv = 'fsiv';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}
