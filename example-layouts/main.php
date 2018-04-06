<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use johnsnook\sbadmin\SbAdminThemeAsset;

SbAdminThemeAsset::register($this);
\Yii::$app->view->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Administration for <?= Html::encode($this->title) ?>">
        <meta name="author" content="John Snook<jsnook@gmail.com>">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top" cz-shortcut-listen="true">
        <?php $this->beginBody() ?>
        <?= $this->render('navigation.php') ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <?php
                echo Breadcrumbs::widget([
                    'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                    'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>',
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]);
                echo Alert::widget();
                ?>
                <?= $content ?>
            </div>
        </div>
        <?php
        echo $this->render('footer.php');
        $this->endBody();
        ?>

    </body>
</html>
<?php $this->endPage() ?>
