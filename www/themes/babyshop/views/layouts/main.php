<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
\www\themes\babyshop\CustomAssets::register($this);
\www\themes\babyshop\BabyShopAsset::register($this);
\www\themes\babyshop\QuickViewAsset::register($this);
?>
<!DOCTYPE html>
<?php $this->beginPage() ?>
<html lang="en">
<head>

    <!-- Basic page needs ================================================== -->
    <meta charset="utf-8">
    <?php echo Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="theme-color" content="#07785c">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Default Description">
    <meta name="keywords" content="fashion, store, E-commerce">
    <link rel="icon" href="#" type="image/x-icon">
    <link rel="shortcut icon" href="#" type="image/x-icon">

    <!-- CSS Style -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i,900" rel="stylesheet">

</head>

<body>
<?php $this->beginBody() ?>

    <div id="page">
        <?= $this->render('header') ?>
        <!--container-->

        <?= $content ?>

        <div class="container">
            <div class="row our-features-box">
                <ul>
                    <li>
                        <div class="feature-box">
                            <div class="icon-truck"></div>
                            <div class="content">FREE SHIPPING on order over $99</div>
                        </div>
                    </li>
                    <li>
                        <div class="feature-box">
                            <div class="icon-support"></div>
                            <div class="content">Have a question?<br>
                                +1 800 789 0000</div>
                        </div>
                    </li>
                    <li>
                        <div class="feature-box">
                            <div class="icon-money"></div>
                            <div class="content">100% Money Back Guarantee</div>
                        </div>
                    </li>
                    <li>
                        <div class="feature-box">
                            <div class="icon-return"></div>
                            <div class="content">30 days return Service</div>
                        </div>
                    </li>
                    <li class="last">
                        <div class="feature-box"> <a href="#"><i class="fa fa-apple"></i> download</a> <a href="#"><i class="fa fa-android"></i> download</a> </div>
                    </li>
                </ul>
            </div>
        </div>

        <?= $this->render('footer') ?>
        <!-- End For version 1,2,3,4,6 -->

    </div>
    <!--page-->

<!-- Mobile Menu-->
<div id="mobile-menu">
    <ul>
        <li>
            <div class="mm-search">
                <form id="search1" name="search">
                    <div class="input-group">

                        <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li>
            <div class="home"><a href="<?= Url::home() ?>">Home</a> </div>
        </li>

        <?= \www\widgets\category\CategoriesView::widget(['view' => 'mob-menu']) ?>

    </ul>
    <div class="top-links">
        <ul class="links">
            <!--                                    <li><a href="dashboard.html" title="My Account">My Account</a></li>-->
            <li><a href="<?= Url::toRoute('user/wishlist') ?>" title="Wishlist">Wishlist</a></li>
            <li><a href="<?= Url::toRoute('cart/index') ?>" title="Cart">Cart</a></li>
            <!--                                    <li><a href="blog.html" title="Blog"><span>Blog</span></a></li>-->
            <li ><a href="<?= Url::toRoute('user/login') ?>" title="Login"><span>Login</span></a></li>
            <li class="last"><a href="<?= Url::toRoute('user/register') ?>" title="Registration"><span>Registration</span></a></li>
        </ul>
    </div>
</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
