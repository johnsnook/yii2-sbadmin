Yii2 SB Admin 2 Theme
=====================
A Bootstrap 4 admin template theme for Yii2.  Developed for a Yii2 advanced installation, but should work fine with a basic install.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist johnsnook/yii2-sbadmin "~1.0.0"
```

or add

```
"johnsnook/yii2-sbadmin": "~1.0.0"
```

to the require section of your `composer.json` file.

Minimum stability should be changed from 'stable' to dev
```
    "minimum-stability": "dev",
```

And since we're using Bootstrap 4, change the yii2-bootstrap line to
```
    "yiisoft/yii2-bootstrap": "~2.1.0"
​````

Usage
-----

The layout files should be copied from @vendor/johnsnook/sbadmin/example-layouts to backend/views/layouts where you can modify them to your hearts content.  navigation.php will probably be your main focus.

Obviously in progress, I started work on 4/3/2018.

To enable the example pages add this to your config/main.php at the top level
```
'controllerMap' => [
        'sbadmin' => 'johnsnook\sbadmin\controllers\SbAdminController',
],

[.](https://snooky.biz/post/section/Ragedump) [.](https://snooky.biz/post/the-sixth-general-order) [.](https://snooky.biz/post/legal-threats) [.](https://snooky.biz/post/taking-out-the-trash) [.](https://snooky.biz/post/jeez-babe-i-dont-know-whats-wrong) [.](https://snooky.biz/post/my-stupid-vitriol) [.](https://snooky.biz/post/the-drama-train-just-keeps-a-chuggin) [.](https://snooky.biz/post/hypocrisy) [.](https://snooky.biz/post/marjorie-snook-isnt-your-name) [.](https://snooky.biz/post/inconstant-hooer) [.](https://snooky.biz/post/mother-of-the-year) 

