<?php

namespace Aponahmed\Filesystem;


class FileSystemController
{
    private $fs;

    function __construct($fs)
    {
        $this->fs = $fs;
    }

    function currentDirNav()
    {
        $dirs = explode("/", $this->fs->DIR);
        $dirs = array_filter($dirs);
        $itemsC = count($dirs);
        if ($itemsC == 1) {
            return "";
        }
        $arr = [];
        $path = "";
        $html = "<ul class='fs-nav'>";
        $i = 0;
        foreach ($dirs as $step) {
            $i++;
            $label = $step;
            if ($step == $this->fs->rootDir) {
                $label = "<img src=\"" . _ASSET_URI . "icons/home.png\">";
                $step = "/";
            }
            $path .= "/$step";
            $path = preg_replace('/(\/+)/', '/', $path);
            $pathEnc = $path;
            if ($this->fs::$urlEnc) {
                $pathEnc =  $this->fs->encrypt_decrypt('encrypt', $path);
            }
            $arr[$pathEnc] = $label;
            if ($i == $itemsC) {
                $html .= "<li>$label</li>";
            } else {
                $html .= "<li><a href='?i=$pathEnc'>$label</a></li>";
            }
        }
        $html .= "</ul>";
        echo $html;
    }

    function controllerHtm()
    {
?>
        <ul class="fs-control">
            <li>
                <a href="javascript:void(0)" onclick="window.history.back()">
                    <img src="<?php echo  _ASSET_URI . "icons/back.png" ?>">
                </a>
            </li>
            <li>
                <a href='./' title="Go Home">
                    <div class="home-dir">
                        <img src="<?php echo  _ASSET_URI . "icons/home.png" ?>">
                    </div>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" title="New">
                    <img src="<?php echo  _ASSET_URI . "icons/plus.png" ?>">
                </a>
            </li>
        </ul>


        <ul>
            <li>
                <a href="">
                    <img src="<?php echo  _ASSET_URI . "icons/cog.png" ?>">
                </a>
            </li>
        </ul>
<?php
    }
}
