<!doctype html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->getPageTitle(); ?></title>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/images/common.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl . '/statics/css/pager.css'?>"/>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/statics/js/jquery.js'?>"></script>
    <body>
        <div class="main">
            <div class="moduleContainer">
                <?php echo $content; ?>
            </div>
        </div>

    </body>
</html>
