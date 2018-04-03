<?php

namespace johnsnook\sbadmin;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SbChartAsset extends AssetBundle {

    public $sourcePath = '@themes/sb-admin';
    public $css = [];
    public $js = [
        'vendor/chart.js/Chart.min.js',
        'vendor/chart.js/Chart.bundle.min.js',
        'js/sb-admin-charts.min.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'backend\assets\SbAdminThemeAsset',
    ];

}
