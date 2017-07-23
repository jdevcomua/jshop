<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\themes\babyshop\BabyShopAsset::register($this);
?>
<?php $this->beginPage() ?>
<html>
<head>

    <!-- Basic page needs ================================================== -->
    <meta charset="utf-8">
    <?php echo Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#07785c">

    <!-- font -->
    <link href='https://fonts.googleapis.com/css?family=Signika+Negative:400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lilita+One' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gabriela" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,600,700,500' rel='stylesheet' type='text/css'>

</head>


<body id="big-hero-6" class="template-collection">
<?php $this->beginBody() ?>

<div id="PageContainer" class="is-moved-by-drawer">

    <?= $this->render('header') ?>

    <?php if (Yii::$app->controller->route != 'site/index') : ?>
        <nav class="breadcrumb" role="navigation" aria-label="breadcrumbs">
            <div class="wrapper">
                <div class="inner">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                        'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
                    ]) ?>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <main class="wrapper main-content" role="main">
        <?= $content ?>
    </main>

    <?= $this->render('footer') ?>

</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
