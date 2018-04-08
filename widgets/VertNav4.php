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
class VertNav4 extends Nav {

    /**
     * for unique ids for recursive sub navs
     *
     * @todo see if still necessary
     * @var integer $autoId
     */
    private static $autoId = 50;

    /**
     * Overriding glyphicon, i should move this to the widget call in layout
     *
     * @var string $iconClassPrefix
     */
    public static $iconClassPrefix = 'fa fa-';

    /**
     * Subnav are this widget calling itself recursively, this allows us to keep
     * track of where we are
     *
     * @var bool $isSubNav
     */
    public $isSubNav = false;

    /**
     * Initializes the widget.
     */
    public function init() {
//        parent::init();
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        if (!$this->isSubNav) {
            Html::addCssClass($this->options, ['widget' => 'navbar-nav']);
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

        $label = Html::tag('span', $label, ['class' => 'nav-link-text']);
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
