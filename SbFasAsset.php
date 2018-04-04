<?php

namespace johnsnook\sbadmin;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SbFasAsset extends AssetBundle {

    public $sourcePath = '@vendor/rmrevin/yii2-fontawesome/assets/web-fonts-with-css';
    public $css = ['css/fontawesome.min.css'];
    public $publishOptions = [
        'only' => [
            "css",
            "webfonts",
        ],
        'except' => [
            "less",
            "scss",
        ],
    ];

}
