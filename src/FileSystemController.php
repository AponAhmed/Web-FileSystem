<?php

namespace Aponahmed\Filesystem;


class FileSystemController
{
    private $fs;
    private $router;

    function __construct($fs)
    {
        $this->fs = $fs;
        $this->router = Router::getInstance();
    }

    function currentDirNav()
    {
        $itemsC = count($this->router->segments);
        if ($itemsC == 1) {
            return "";
        }
        $html = "<ul class='fs-nav'>";
        $c = 0;
        foreach ($this->router->segments as $i => $step) {
            $c++;
            $url = implode('/', array_slice($this->router->segments, 0, $i + 1));

            $label = $step;
            if ($i == 0) {
                $label = "<img src=\"" . _ASSET_URI . "icons/home.png\">";
                $url = implode('/', array_slice($this->router->segments, 0, 1));
            }
            if ($c == $itemsC) {
                $html .= "<li>$label</li>";
            } else {
                $html .= "<li><a href='/$url'>$label</a></li>";
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
