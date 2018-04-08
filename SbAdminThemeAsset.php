<?php

namespace johnsnook\sbadmin;

/**
 * Main frontend application asset bundle.
 *
 * @author John Snook <jsnook@gmail.com>
 */
class SbAdminThemeAsset extends \yii\web\AssetBundle {

    public $sourcePath = __DIR__;
    public $css = [
        'sb-admin/vendor/font-awesome/css/font-awesome' . (YII_ENV_DEV ? '' : '.min') . '.css',
        'sb-admin/vendor/bootstrap/css/bootstrap' . (YII_ENV_DEV ? '' : '.min') . '.css',
        'sb-admin/css/sb-admin' . (YII_ENV_DEV ? '' : '.min') . '.css',
            #'assets/css/yii2-sbadmin.css',
    ];
    public $js = [
        'sb-admin/vendor/bootstrap/js/bootstrap.bundle' . (YII_ENV_DEV ? '' : '.min') . '.js',
        'sb-admin/vendor/jquery-easing/jquery.easing' . (YII_ENV_DEV ? '' : '.min') . '.js',
        'sb-admin/js/sb-admin' . (YII_ENV_DEV ? '' : '.min') . '.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\JqueryAsset',
            #'yii\bootstrap\BootstrapAsset',
            #'johnsnook\sbadmin\SbFasAsset'
            #'rmrevin\yii\fontawesome\AssetBundle',
    ];
    public $publishOptions = ['forceCopy' => YII_ENV_DEV ? true : false];

    /**
     * We're overriding this function to add some css and js files for pages
     * which use charts and tables
     */
    public function init() {
        parent::init();
        if (\Yii::$app->controller->route === 'sbadmin/pages') {
            $jsFiles = [];
            $cssFiles = [];

            switch (\Yii::$app->controller->actionParams['name']) {
                case 'index':
                    $jsFiles = [
                        'sb-admin/vendor/chart.js/Chart.min.js',
                        'sb-admin/vendor/chart.js/Chart.bundle.min.js',
                        'sb-admin/js/sb-admin-charts.min.js',
                        'sb-admin/vendor/datatables/jquery.dataTables.js',
                        'sb-admin/vendor/datatables/dataTables.bootstrap4.js',
                        'sb-admin/js/sb-admin-datatables.min.js'
                    ];
                    $cssFiles = ['sb-admin/vendor/datatables/dataTables.bootstrap4.css'];
                    break;
                case 'charts':
                    $jsFiles = [
                        'sb-admin/vendor/chart.js/Chart.min.js',
                        'sb-admin/vendor/chart.js/Chart.bundle.min.js',
                        'sb-admin/js/sb-admin-charts.min.js'
                    ];
                    break;
                case 'tables':
                    $jsFiles = [
                        'sb-admin/vendor/datatables/jquery.dataTables.js',
                        'sb-admin/vendor/datatables/dataTables.bootstrap4.js',
                        'sb-admin/js/sb-admin-datatables.min.js'
                    ];
                    $cssFiles = ['sb-admin/vendor/datatables/dataTables.bootstrap4.css'];
                    break;
                case 'navbar':
                    $jsFiles = [
                        'assets/js/navbar.js'
                    ];
                    break;
                default:
            }
            $this->css = \yii\helpers\ArrayHelper::merge($this->css, $cssFiles);
            $this->js = \yii\helpers\ArrayHelper::merge($this->js, $jsFiles);
        }
    }

}
