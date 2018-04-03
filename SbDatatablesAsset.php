<?php

namespace johnsnook\sbadmin;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SbDatatablesAsset extends AssetBundle {

    public $sourcePath = '@themes/sb-admin';
    public $css = [
        'vendor/datatables/dataTables.bootstrap4.css'
    ];
    public $js = [
        'vendor/datatables/jquery.dataTables.js',
        'vendor/datatables/dataTables.bootstrap4.js',
        'js/sb-admin-datatables.min.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'backend\assets\SbAdminThemeAsset',
    ];

}
