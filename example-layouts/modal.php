<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap4\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use johnsnook\sbadmin\SbAdminThemeAsset;

SbAdminThemeAsset::register($this);
\Yii::$app->view->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']);
?>
<?php $this->beginPage() ?>
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
    <body class="bg-dark">
        <?php $this->beginBody() ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <div class="container justify-content-center">
            <?= Html::a('<i class="fa fa-left-arrow"></i>Back to dashboard', ['/sbadmin/pages', 'name' => 'index'], ['class' => 'btn btn-block btn-success']) ?>
        </div>

        <?php
//echo $this->render('footer.php');
        $this->endBody();
        ?>

    </body>
</html>
<?php $this->endPage() ?>
