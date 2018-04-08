<?php

/**
 * @link http://www.snooky.biz/
 * @copyright Copyright (c) 2018 John Snook Consulting
 * @license https://github.com/johnsnook/yii2-sbadmin/blob/master/LICENSE
 */

namespace johnsnook\sbadmin\widgets;

#use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap 4 javascript files.
 *
 * @author John Snook <jsnook@gmail.com>
 */
class Bootstrap4PluginAsset extends Bootstrap4Asset {

    public $js = [
        'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'johnsnook\sbadmin\widgets\BootstrapAsset4',
    ];

}
