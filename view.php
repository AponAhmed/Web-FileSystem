<?php

use Aponahmed\Filesystem\FileIcon;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Explorer</title>
    <link rel="stylesheet" href="<?php echo _ASSET_URI  ?>/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400&display=swap" rel="stylesheet">
</head>

<body>
    <div class="file-explorer-wrap">
        <div class="side-controller">
            <?php $fileSystem->controller() ?>
        </div>
        <div class='files-world'>
            <div class="fs-nav-outer">
                <?php $fileSystem->nav() ?>
            </div>
            <div class="file-exp-outer">
                <?php $fileSystem->getFileExp() ?>
            </div>
        </div>
    </div>
</body>

</html>