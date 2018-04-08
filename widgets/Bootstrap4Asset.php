<?php

/**
 * @link http://www.snooky.biz/
 * @copyright Copyright (c) 2018 John Snook Consulting
 * @license https://github.com/johnsnook/yii2-sbadmin/blob/master/LICENSE
 */

namespace johnsnook\sbadmin\widgets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap 4 css files.
 *
 * @author John Snook <jsnook@gmail.com>
 */
class Bootstrap4Asset extends AssetBundle {

    public $sourcePath = __DIR__ . '/../sb-admin/vendor/bootstrap';
    public $css = [
        'css/bootstrap.css',
    ];

}
