<?php

namespace johnsnook\sbadmin;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SbAdminThemeAsset extends AssetBundle {

    public $sourcePath = __DIR__;
    public $css = [
        'sb-admin/css/sb-admin' . (YII_ENV_DEV ? '' : '.min') . '.css',
        #'assets/css/yii2-sbadmin.css',
        '@vendor/rmrevin/yii2-fontawesome/assets/web-fonts-with-css/css/fa-solid.min.css',
    ];
    public $js = [
        'sb-admin/vendor/bootstrap/js/bootstrap.bundle' . (YII_ENV_DEV ? '' : '.min') . '.js',
        'sb-admin/vendor/jquery-easing/jquery.easing' . (YII_ENV_DEV ? '' : '.min') . '.js',
        'sb-admin/js/sb-admin' . (YII_ENV_DEV ? '' : '.min') . '.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'johnsnook\sbadmin\SbFasAsset'
            #'rmrevin\yii\fontawesome\AssetBundle',
    ];
    public $publishOptions = ['forceCopy' => YII_ENV_DEV ? true : false];

}
