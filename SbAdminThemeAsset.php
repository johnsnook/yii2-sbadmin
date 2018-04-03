<?php

namespace johnsnook\sbadmin;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SbAdminThemeAsset extends AssetBundle {

    public $sourcePath = 'sb-admin';
    public $css = [
        'css/sb-admin' . (YII_ENV_DEV ? '' : '.min') . '.css',
    ];
    public $js = [
        'vendor/bootstrap/js/bootstrap.bundle' . (YII_ENV_DEV ? '' : '.min') . '.js',
        'vendor/jquery-easing/jquery.easing' . (YII_ENV_DEV ? '' : '.min') . '.js',
        'js/sb-admin' . (YII_ENV_DEV ? '' : '.min') . '.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
    public $publishOptions = ['forceCopy' => YII_ENV_DEV ? true : false];

}
