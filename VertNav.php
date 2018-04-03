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
        $icon = Html::tag('i', '', ['class' => self::$iconClassPrefix . (isset($item['icon']) ? $item['icon'] : 'dot-circle')]) . '&nbsp;';
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        if (isset($linkOptions['aria-selected'])) {
            $active = $linkOptions['aria-selected'];
        } else {
            $active = $this->isItemActive($item);
        }

        if (empty($items)) {
            $arrow = '';
            $items = '';
        } else {
            $arrow = Html::tag('i', '', ['class' => 'fa fa-angle-right float-right']);
            $linkOptions['data-toggle'] = 'collapse';
            $linkOptions['aria-expanded'] = 'false';
            Html::addCssClass($linkOptions, ['widget' => 'nav-link-collapse collapsed']);
            if (is_array($items)) {
                $items = $this->isChildActive($items, $active);
                $id = 'collapse' . $this::$autoId++;
                $url = $item['url'] = "#$id";
                $linkOptions['aria-controls'] = $id;
                $woptions = $this->options;
                $woptions['id'] = $id;
                $woptions['data-parent'] = '#' . $this->options['id'];
                $woptions['class'] = 'collapse';
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

        return Html::tag('li', Html::a($icon . $label . $arrow, $url, $linkOptions) . $items, $options);
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     * @param array $items @see items
     * @param boolean $active should the parent be active too
     * @return array @see items
     */
    protected function isChildActive($items, &$active) {
        foreach ($items as $i => $child) {
            if ($this->isItemActive($child)) {
                ArrayHelper::setValue($child, 'linkOptions', ['aria-selected' => true]);
                if ($this->activateParents) {
                    $active = true;
                }
            }
        }
        return $items;
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item) {
        if (!$this->activateItems) {
            return false;
        }
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            die($this->route . ' = ' . $route);
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }

}
