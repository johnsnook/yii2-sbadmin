<?php

/**
 * @link http://www.snooky.biz/
 * @copyright Copyright (c) 2018 John Snook Consulting
 * @license https://github.com/johnsnook/yii2-sbadmin/blob/master/LICENSE
 */

namespace johnsnook\sbadmin\widgets;

/**
 * \yii\bootstrap\Widget is the base class for all johnsnook bootstrap 4 widgets.
 *
 * @author John Snook <jsnook@gmail.com>
 */
class Widget extends \yii\base\Widget {

    use Bootstrap4WidgetTrait;

    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

}
