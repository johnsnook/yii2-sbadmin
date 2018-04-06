Yii2 SB Admin 2 Theme
=====================
A Bootstrap 4 admin template theme for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist johnsnook/yii2-sbadmin "*"
```

or add

```
"johnsnook/yii2-sbadmin": "*"
```

to the require section of your `composer.json` file.

Minimum stability should be changed from 'stable' to dev
```
    "minimum-stability": "dev",
```
and

~~yii bootstrap should be changed to the bootstrap 4 version in your composer.json~~
We'll use the bootstrap css & js included with sb-admin/vendor, but we need 
the bootstrap 3 version of yii/bootstrap widgets since the 2.1.0 navbar is behind
the 2.0.8 version
```
    "yiisoft/yii2-bootstrap": "~2.0.8",
```

Usage
-----

The layout files should be copied from @vendor/johnsnook/sbadmin/example-layouts to backend/views/layouts where you can modify them to your hearts content.

Obviously in progress, I started work on 4/3/2018.

To enable the example pages add this to your config/main.php at the top level
```
'controllerMap' => [
        'sbadmin' => 'johnsnook\sbadmin\controllers\SbAdminController',
],
```
