<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace johnsnook\sbadmin;

use Yii;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

/**
 * Description of Nav
 *
 * @author John
 */
class VertNav extends \yii\bootstrap\Nav {

    public $dropdownClass = 'common\components\Subnav';
    private static $autoId = 50;
    public static $iconClassPrefix = 'fa fa-';
    public $isSubNav = false;

    /**
     * Initializes the widget.
     */
    public function init() {
        #parent::init();
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        if (!$this->isSubNav) {
            Html::addCssClass($this->options, ['widget' => 'nav']);
        }
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item) {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $item['label'] = ucwords($item['label']);
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $icon = (isset($item['icon']) ? Html::tag('i', '', ['class' => self::$iconClassPrefix . $item['icon']]) . '&nbsp;' : '');
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', 'javascript:;');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if (empty($items)) {
            #$arrow = '';
            $items = '';
        } else {
            #$arrow = Html::tag('i', '', ['class' => 'fa fa-angle-right float-right']);
            $linkOptions['data-toggle'] = 'collapse';
            $linkOptions['aria-expanded'] = 'false';
            Html::addCssClass($linkOptions, ['widget' => 'nav-link-collapse collapsed']);
            if (is_array($items)) {
                $items = $this->isChildActive($items, $active);
                $id = 'collapse' . $this::$autoId++;
                $url = $item['url'] = "#$id";
                $linkOptions['aria-controls'] = $id;
                $woptions = ArrayHelper::merge($this->options, ArrayHelper::getValue($item, 'menuOptions', []));
                $woptions['id'] = $id;
                $woptions['data-parent'] = '#' . $this->options['id'];
                //$woptions['class'] = 'collapse';
                Html::addCssClass($woptions, ['collapse']);
                $items = VertNav::widget([
                            'options' => $woptions,
                            'isSubNav' => true,
                            'items' => $items,
                ]);
            }
        }

        Html::addCssClass($options, 'nav-item');
        Html::addCssClass($linkOptions, 'nav-link');


        if ($this->activateItems && $active) {
            $linkOptions['aria-selected'] = true;
        }

        $label = Html::tag('span', $label, ['class' => 'nav-link-text']);

        return Html::tag('li', Html::a($icon . $label, $url, $linkOptions) . $items, $options);
    }

}
