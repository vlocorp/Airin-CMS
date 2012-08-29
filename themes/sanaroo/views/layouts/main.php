<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div id="top-banner"></div>
        <div id="wrap">
            <div id="header">
                <h1><a href="#">Sanaroo</a></h1>
                <h2>Front Page</h2>
                <div style="clear: both"></div>
<!--                <div id="nav">-->
                   <?php $this->widget('ext.vlo.menu.Vmenu');?>
<!--                </div>-->
            </div>
            <!--end header-->

            <div id="main">
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
                <?php endif ?>

                <?php echo $content; ?>
            </div>
            <!--end main-->
            <div class="line"></div>
            <div id="footer">
                <p class="copyright">Copyright &copy; <a href="#">vLocorp</a> - All Rights Reserved / Design By <a target="_blank" href="http://www.vlocorp.com/">vLocorp</a></p>
                <p class="social"><a href="#">Follow Me :</a></p>
            </div>
            <!--end footer-->
        </div>
        <!--end wrap-->
    </body>
</html>