<?php

/**
 * @link http://www.snooky.biz/
 * @copyright Copyright (c) 2018 John Snook Consulting
 * @license http://www.yiiframework.com/license/
 */

namespace johnsnook\sbadmin\widgets;

use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;

/**
 * Description of Nav
 *
 * @author John
 */
class Nav4 extends Nav {

    /**
     * Overriding glyphicon, i should move this to the widget call in layout
     *
     * @var string $iconClassPrefix
     */
    public static $iconClassPrefix = 'fa fa-';

    /**
     * Initializes the widget.
     */
    public function init() {
        parent::init();
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        if ($this->dropDownCaret === null) {
            $this->dropDownCaret = '<span class="caret"></span>';
        }
        Html::removeCssClass($this->options, ['widget' => 'nav']);
        Html::addCssClass($this->options, ['widget' => 'navbar-nav']);
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
            if (!isset($item['icon'])) {
                throw new InvalidConfigException("Either the 'label' or the 'icon' option is required.");
            }
            $label = '';
        } else {
            $item['label'] = ucwords($item['label']);
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        }

        $icon = (isset($item['icon']) ? Html::tag('i', '', ['class' => self::$iconClassPrefix . $item['icon']]) : '');
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
            $items = '';
        } else {
            $linkOptions['data-toggle'] = 'collapse';
            Html::addCssClass($linkOptions, ['widget' => 'nav-link-collapse']);
            if (is_array($items)) {
                $id = 'collapse' . $this::$autoId++;
                $url = $item['url'] = "#$id";
                $linkOptions['aria-controls'] = $id;
                $woptions = ArrayHelper::merge($this->options, ArrayHelper::getValue($item, 'menuOptions', []));
                $childActive = $active;
                $items = $this->isChildActive($items, $childActive);
                if ($childActive) {
                    Html::addCssClass($woptions, 'show');
                } else {
                    Html::addCssClass($linkOptions, 'collapsed');
                }
                $woptions['id'] = $id;
                $woptions['data-parent'] = '#' . $this->options['id'];

                Html::addCssClass($woptions, ['collapse']);
                /** Hey, we're recursing */
                $items = self::widget([
                            'options' => $woptions,
                            'isSubNav' => true,
                            'items' => $items,
                ]);
            }
        }

        Html::addCssClass($options, 'nav-item');
        Html::addCssClass($linkOptions, 'nav-link');

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        $label = !empty($label) ? Html::tag('span', $label, ['class' => 'nav-link-text']) : '';
        return Html::tag('li', Html::a($icon . $label, $url, $linkOptions) . $items, $options);
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     *
     * merged changes from 2.0.8
     * @param array $items @see items
     * @param boolean $active should the parent be active too
     * @return array @see items
     */
    protected function isChildActive($items, &$active) {
        foreach ($items as $i => $child) {
            if (is_array($child) && !ArrayHelper::getValue($child, 'visible', true)) {
                continue;
            }
//            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
//                Html::addCssClass($items[$i]['options'], 'active');
//                if ($this->activateParents) {
//                    $active = true;
//                }
//            }
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                $active = true;
            }
            $childItems = ArrayHelper::getValue($child, 'items');
            if (is_array($childItems)) {
                $activeParent = false;
                $items[$i]['items'] = $this->isChildActive($childItems, $activeParent);
                if ($activeParent) {
                    Html::addCssClass($items[$i]['options'], 'active');
                    $active = true;
                }
            }
        }
        return $items;
    }

}
