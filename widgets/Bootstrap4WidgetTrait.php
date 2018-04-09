<?php

/**
 * @link http://www.snooky.biz/
 * @copyright Copyright (c) 2018 John Snook Consulting
 * @license https://raw.githubusercontent.com/johnsnook/yii2-sbadmin/master/LICENSE
 */

namespace johnsnook\sbadmin\widgets;

use yii\helpers\Json;

/**
 *
 * @author John Snook <jsnook@gmail.com>
 */
trait Bootstrap4WidgetTrait {

    use \yii\bootstrap\BootstrapWidgetTrait;

    /**
     * Registers a specific Bootstrap plugin and the related events
     * @param string $name the name of the Bootstrap plugin
     */
    protected function registerPlugin($name) {
        $view = $this->getView();

        Bootstrap4PluginAsset::register($view);

        $id = $this->options['id'];

        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "jQuery('#$id').$name($options);";
            $view->registerJs($js);
        }

        $this->registerClientEvents();
    }

}
