<?php

namespace Aponahmed\Filesystem;

class FileIcon
{

    static function get($fileType)
    {
        return "<div class='fileTypeIcon folder $fileType' style=\"background-image: url('" . _ASSET_URI . "icons/$fileType.png')\"></div>";
    }

    static function fileTypeIcon($extension)
    {
        return "<div class='fileTypeIcon $extension' style=\"background-image: url('" . _ASSET_URI . "icons/files/$extension.png')\"></div>";
    }
}
