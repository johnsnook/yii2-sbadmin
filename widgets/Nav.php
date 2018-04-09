<?php

/**
 * @link http://www.snooky.biz/
 * @copyright Copyright (c) 2018 John Snook Consulting
 * @license https://raw.githubusercontent.com/johnsnook/yii2-sbadmin/master/LICENSE
 */

namespace johnsnook\sbadmin\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Nav renders a nav HTML component.
 *
 * For example:
 *
 * ```php
 * echo Nav::widget([
 *     'items' => [
 *         [
 *             'label' => 'Home',
 *             'url' => ['site/index'],
 *             'linkOptions' => [...],
 *         ],
 *         [
 *             'label' => 'Dropdown',
 *             'items' => [
 *                  ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
 *                  '<li class="divider"></li>',
 *                  '<li class="dropdown-header">Dropdown Header</li>',
 *                  ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
 *             ],
 *         ],
 *         [
 *             'label' => 'Login',
 *             'url' => ['site/login'],
 *             'visible' => Yii::$app->user->isGuest
 *         ],
 *     ],
 *     'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
 * ]);
 * ```
 *
 * Note: Multilevel dropdowns beyond Level 1 are not supported in Bootstrap 3.
 *
 * @see http://getbootstrap.com/components/#dropdowns
 * @see http://getbootstrap.com/components/#nav
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author John Snook <jsnook@gmail.com>
 * @since 2.0
 */
class Nav extends Widget {

    const MENU_TYPE_DROPDOWN = 0;
    const MENU_TYPE_ACCORDION = 1;

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
    public static $iconClassPrefix = 'fa fa-fw fa-';

    /**
     * Is this widget calling itself recursively? this allows us to keep
     * track of where we are so we don't class the <ul> container as navbar-nav
     *
     * @var bool $isSubNav
     */
    public $isSubNav = false;

    /**
     * for unique ids for recursive sub navs
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: bool, optional, whether the item should be on active state or not.
     * - dropDownOptions: array, optional, the HTML options that will passed to the [[Dropdown]] widget.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     * - encode: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for only this item.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $items = [];

    /**
     * @var bool whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = true;

    /**
     * @var bool whether to automatically activate items according to whether their route setting
     * matches the currently requested route.
     * @see isItemActive
     */
    public $activateItems = true;

    /**
     * @var bool whether to activate parent menu items when one of the corresponding child menu items is active.
     */
    public $activateParents = false;

    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $route;

    /**
     * @var array the parameters used to determine if a menu item is active or not.
     * If not set, it will use `$_GET`.
     * @see route
     * @see isItemActive
     */
    public $params;

    /**
     * @var string name of a class to use for rendering dropdowns within this widget. Defaults to [[Dropdown]].
     * @since 2.0.7
     */
    public $dropdownClass = 'johnsnook\sbadmin\widgets\Dropdown';

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
        if (!$this->isSubNav) {
            Html::addCssClass($this->options, ['widget ' => 'navbar-nav']);
        }
    }

    /**
     * Renders the widget.
     */
    public function run() {
        Bootstrap4Asset::register($this->getView());
        return $this->renderItems();
    }

    /**
     * Renders widget items.
     */
    public function renderItems() {
        $items = [];
        foreach ($this->items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $items[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
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
        if (!isset($item['label']
                ) && !isset($item['icon'])) {
            throw new InvalidConfigException("Either the 'label' or 'icon' options must be set.");
        }
        $label = '';
        if (isset($item['label'])) {
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $item['label'];
            if ($encodeLabel) {
                $label = ucfirst($label);
                $label = $encodeLabel ? Html::encode($label) : $label;
                $label = Html::tag('span', $label, ['class' => 'nav-link-text']);
            }
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
            /**
             * We have subitems!  Let's check to see what type.  If not defined,
             * then we'll assume the old dropdown default.
             */
            $menuType = ArrayHelper::getValue($item['menuOptions'], 'type', self::MENU_TYPE_DROPDOWN);
            if ($menuType === self::MENU_TYPE_DROPDOWN) {
                $linkOptions['data-toggle'] = 'dropdown';
                $linkOptions['aria-haspopup'] = true;
                $linkOptions['aria-expanded'] = false;
                Html::addCssClass($options, ['widget' => 'dropdown']);
                Html::addCssClass($linkOptions, ['widget' => 'dropdown-toggle']);
                if (is_array($items)) {
                    $items = $this->isChildActive($items, $active);
                    $items = $this->renderDropdown($items, $item);
                }
            } elseif ($menuType === self::MENU_TYPE_ACCORDION) {
                $linkOptions['data-toggle'] = 'collapse';
                Html::addCssClass($linkOptions, ['widget' => 'nav-link-collapse']);
                if (is_array($items)) {
                    $id = 'collapse' . $this::$autoId++;
                    $url = $item['url'] = "#$id";
                    $linkOptions['aria-controls'] = $id;

                    $woptions = ArrayHelper::getValue($item, 'menuOptions', []);
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
        }
        Html::addCssClass($options, 'nav-item');
        Html::addCssClass($linkOptions, 'nav-link');

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        return Html::tag('li', Html::a($icon . $label, $url, $linkOptions) . $items, $options);
    }

    /**
     * Renders the given items as a dropdown.
     * This method is called to create sub-menus.
     * @param array $items the given items. Please refer to [[Dropdown::items]] for the array structure.
     * @param array $parentItem the parent item information. Please refer to [[items]] for the structure of this array.
     * @return string the rendering result.
     * @since 2.0.1
     */
    protected function renderDropdown($items, $parentItem) {
        /** @var Widget $dropdownClass */
        $dropdownClass = $this->dropdownClass;
        return $dropdownClass::widget([
                    'options' => ArrayHelper::getValue($parentItem, 'dropDownOptions', []),
                    'items' => $items,
                    'encodeLabels' => $this->encodeLabels,
                    'clientOptions' => false,
                    'view' => $this->getView(),
        ]);
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     * @param array $items @see items
     * @param bool $active should the parent be active too
     * @return array @see items
     */
    protected function isChildActive($items, &$active) {
        foreach ($items as $i => $child) {
            if (is_array($child) && !ArrayHelper::getValue($child, 'visible', true)) {
                continue;
            }
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                if ($this->activateParents) {
                    $active = true;
                }
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

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return bool whether the menu item is active
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
            unset($item['url']['javascript:']);
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
