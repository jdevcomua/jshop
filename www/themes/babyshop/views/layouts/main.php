<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\Pjax;

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

        <?php Pjax::begin(['id'=>'quick-view-modal','enablePushState' => false]);?>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLable" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="width: 720px">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup1" style="display: block;">

                            <?php if (Yii::$app->session->get('lastQuickView')) {


                                $modalModel = \common\models\Item::findOne(Yii::$app->session->get('lastQuickView'));
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
                                                    <div class="product-full"> <img id="product-zoom" src="<?= ($modalModel->images) ? $modalModel->getOneImageUrl() : '/images/product_no_image.jpg' ?>" data-zoom-image="<?= ($modalModel->images) ? $modalModel->getOneImageUrl() : '/images/product_no_image.jpg' ?>" alt="product-image"/> </div>
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
                                                    <p class="rating-links"><a data-pjax="0" href="<?=$modalModel->getUrl()?>"><?= $modalModel->getAvgRating()['count']?> Review(s)</a>  </p>
                                                </div>
                                                <div class="price-block">
                                                    <div class="price-box">
                                                        <?php if($discount  = $modalModel->existDiscount())
                                                            echo '<p class="availability in-stock"><span>In Stock</span></p>
                                <p class="special-price"><span class="price">Special Price</span> <span id="product-price-48" class="price">' . number_format((float)$modalModel->getNewPrice(), 2, '.', '') . '</span> </p>';
                                                        else echo ' <p class="price"> <span class="price-label">Price</span> <span id="product-price-48" class="price"> ' . number_format((float)$modalModel->cost, 2, '.', '') . ' </span> </p>'?>
                                                    </div>
                                                </div>
                                                <div class="add-to-box">
                                                    <div class="add-to-cart">
                                                        <div class="pull-left">
                                                            <div class="custom pull-left">
                                                                <button data-pjax="0" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                                                                <input data-pjax="0" type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                                                                <button data-pjax="0" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                                                            </div>
                                                        </div>
                                                        <button data-pjax="0" onclick="addToCart(<?= $modalModel->id ?>)" class="button btn-cart" title="Add to Cart" type="button">Add to Cart</button>
                                                    </div>

                                                </div>
                                                <div class="short-description">
                                                    <?php
                                                    $text = $modalModel->description;
                                                    $max_lengh = 300;

                                                    if(mb_strlen($text, "UTF-8") > $max_lengh) {
                                                        $text_cut = mb_substr($text, 0, $max_lengh, "UTF-8");
                                                        $text_explode = explode(" ", $text_cut);

                                                        unset($text_explode[count($text_explode) - 1]);

                                                        $text_implode = implode(" ", $text_explode);

                                                        echo $text_implode.'... <a class="link-learn" title="Learn More" data-pjax="0" href="'.$modalModel->getUrl().'">Learn More</a>';
                                                    } else {
                                                        echo $text;
                                                    }
                                                    ?>
                                                </div>
                                                <div class="email-addto-box">
                                                    <ul class="add-to-links">
                                                        <li> <a class="link-wishlist" href="#"><span>Add to Wishlist</span></a></li>
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

    </div>

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