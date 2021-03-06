<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $content string */
\www\assets\CustomAssets::register($this);
\www\assets\BabyShopAsset::register($this);
\www\assets\QuickViewAsset::register($this);
?>
<!DOCTYPE html>
<?php $this->beginPage() ?>
<html lang="<?php echo Yii::$app->language ?>">
<head>

    <!-- Basic page needs ================================================== -->
    <meta charset="utf-8">
    <?php echo Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <meta name="theme-color" content="#07785c">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS Style -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i,900" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta name="description" content="<?= Yii::$app->controller->seo->description ?>">
    <meta name="keywords" content="<?= Yii::$app->controller->seo->keywords ?>">
    <meta property="og:title" content="<?= Yii::$app->controller->seo->title ?>"/>
    <meta property="og:description" content="<?= Yii::$app->controller->seo->description ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="<?= Url::base(true)?>/images/sdelivery-cover-300.png"/>
    <meta property="og:url" content= "<?= Url::current() ?>"/>
    <title><?= Yii::$app->controller->seo->title ?></title>


</head>
<body>
<?php $this->beginBody() ?>
<div class="page_footer">
    <div id="page">
        <?= $this->render('header')  ?>
        <!--container-->

        <?= $content ?>

        <?php Pjax::begin(['id'=>'quick-view-modal','enablePushState' => false]);?>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLable" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="width: 720px">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup1" style="display: block;">

                            <?php if (Yii::$app->session->get('modalId')) {


                                $modalModel = \common\models\Item::findOne(Yii::$app->session->get('modalId'));
                                ?>

                                <div class="quick-view-box">
                                    <!--                        <img src="/images/close-icon.png" alt="close" class="x">-->
                                    <div class="product-view product-essential container">
                                        <div class="row">
                                            <!--End For version 1, 2, 6 -->
                                            <!-- For version 3 -->
                                            <div class="product-img-box col-lg-5 col-sm-5 col-xs-12">
                                                <!--                <div class="new-label new-top-left">Hot</div>-->
                                                <?php if($discount = $modalModel->getMaxDiscount()) echo  ($discount->type == 1)
                                                    ? '<div class="sale-label sale-top-left"> -' .$discount->value .'%</div>':
                                                    '<div class="sale-label sale-top-left">' .'Sale'. '</div>' ?>
                                                <div class="product-image">
                                                    <div class="product-full"> <img id="product-zoom" src="<?=$modalModel->getOneImageUrl()?>" data-zoom-image="<?=$modalModel->getOneImageUrl()?>" alt="product-image"/> </div>
                                                    <div class="more-views">

                                                    </div>
                                                </div>
                                                <!-- end: more-images -->
                                            </div>

                                            <!--End For version 1,2,6-->
                                            <!-- For version 3 -->
                                            <div class="product-shop col-lg- col-sm-7 col-xs-12">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                <div class="product-name">
                                                    <h1><?= $modalModel->title ?></h1>
                                                </div>
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <div class="rating" style="width:<?= (int) $modalModel->getAvgRating()['avg'] / 5 * 100?>%"></div>
                                                    </div>
                                                    <p class="rating-links"><a data-pjax="0" href="<?=$modalModel->getUrl()?>"><?= $modalModel->getAvgRating()['count']?> <?= Yii::t('app','Review(s)')?></a>  </p>
                                                </div>
                                                <div class="price-block">
                                                    <div class="price-box">
                                                        <?php if($discount  = $modalModel->existDiscount()):?>
                                                            <p class="availability in-stock"><span><?= Yii::t('app','In Stock')?></span></p>
                                                            <p class="special-price">
                                                                <span class="price"><?= Yii::t('app','Special Price')?></span>
                                                                <span id="product-price-48" class="price"><?= number_format((float)$modalModel->getNewPrice(), 2, '.', '') ?></span>
                                                            </p>
                                                        <?php else: ?> <p class="price"> <span class="price-label"><?= Yii::t('app','Price')?></span> <span id="product-price-48" class="price"> <?=number_format((float)$modalModel->cost, 2, '.', '')?> </span> </p>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                                <div class="add-to-box">
                                                    <div class="add-to-cart">
                                                        <div class="pull-left">
                                                            <div class="custom pull-left">
                                                                <button data-pjax="0" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                                                                <input data-pjax="0" type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty"> <?=$modalModel->getMetricTitle() ?>
                                                                <button data-pjax="0" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                                                            </div>
                                                        </div>
                                                        <button data-pjax="0" onclick="addToCart(<?= $modalModel->id ?>)" class="button btn-cart" title="Add to Cart" type="button"><?= Yii::t('app','Add to Cart')?></button>
                                                    </div>

                                                </div>
                                                <div class="short-description">
                                                    <?php
                                                    $text = $modalModel->description;
                                                    $max_lengh = 300;

                                                    if(mb_strlen($text, "UTF-8") > $max_lengh) :
                                                        $text_cut = mb_substr($text, 0, $max_lengh, "UTF-8");
                                                        $text_explode = explode(" ", $text_cut);

                                                        unset($text_explode[count($text_explode) - 1]);

                                                        $text_implode = implode(" ", $text_explode);
                                                        ?>
                                                        <?= $text_implode?>...<a class="link-learn" title="Learn More" data-pjax="0" href="<?=$modalModel->getUrl()?>"><?= Yii::t('app','Learn More')?></a>;
                                                    <?php else:?>
                                                        <?=$text?>
                                                    <?php endif;?>
                                                </div>
                                                <div class="email-addto-box">
                                                    <ul class="add-to-links">
                                                        <li> <a class="link-wishlist" href="#"><span><?= Yii::t('app','Add to Wishlist')?></span></a></li>
                                                    </ul>
                                                    <!--                    <p class="email-friend"><a href="#" class=""><span>Email to a Friend</span></a></p>-->
                                                </div>
                                            </div>

                                            <!--product-shop-->
                                            <!--Detail page static block for version 3-->
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php Pjax::end() ?>
        <div class="down"></div>
    </div>



    <?= $this->render('footer') ?>
</div>

<!-- End For version 1,2,3,4,6 -->
    <!--page-->

<!-- Mobile Menu-->
<div id="mobile-menu">
    <ul>
        <li>
            <div class="mm-search">
                <form role="search" method="get" action="search">
                    <div class="input-group">

                        <input type="text" class="form-control simple" placeholder="<?=Yii::t('app','Search')?>..." name="search" id="search">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li>
            <div class="home"><a href="<?= Url::home() ?>"><?= Yii::t('app','Home')?></a> </div>
        </li>

        <?= \www\widgets\category\LeftTop10::widget(['view' => 'mob-menu']) ?>

    </ul>
    <div class="top-links">
        <ul class="links">
            <?php if (Yii::$app->user->isGuest) { ?>
                <li><a href="<?= Url::toRoute('cart/index') ?>" title="Cart"><?= Yii::t('app','Cart')?></a></li>
                <li ><a href="<?= Url::toRoute('user/login') ?>" title="Login"><span><?= Yii::t('app','Login')?></span></a></li>
                <li class="last"><a href="<?= Url::toRoute('user/register') ?>" title="Registration"><span><?= Yii::t('app','Registration')?></span></a></li>
            <?php } else { ?>
                <li><a href="<?= Url::toRoute('cart/index') ?>" title="Cart"><?= Yii::t('app','Cart')?></a></li>
                <li><a href="<?= Url::toRoute('user/dashboard') ?>" title="<?= Yii::t('app','Dashboard')?>"><?= Yii::t('app','Dashboard')?></a></li>
                <li><a href="<?= Url::toRoute('user/wishlist') ?>" title="<?= Yii::t('app','Wishlist')?>"><?= Yii::t('app','Wishlist')?></a></li>
                <li ><a href="<?= Url::toRoute('user/logout') ?>" title="Logout"><span><?= Yii::t('app','Logout')?></span></a></li>
            <?php } ?>
        </ul>
    </div>
</div>

<?php $this->endBody() ?>

<?php if (YII_ENV === 'prod'):?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142414740-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-142414740-1');
    </script>
<?php endif; ?>
</body>
</html>
<?php $this->endPage() ?>
