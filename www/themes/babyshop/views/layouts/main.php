<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

\www\themes\babyshop\BabyShopAsset::register($this);
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
            <div class="home"><a href="#">Home</a> </div>
        </li>

        <li><a href="grid.html">Fruits‎</a>
            <ul>
                <li><a href="grid.html">Tropical Fruits‎</a>
                    <ul>
                        <li> <a href="grid.html">Coconuts</a> </li>
                        <li> <a href="grid.html">Dragonfruits</a> </li>
                        <li> <a href="grid.html">Pomegranates</a> </li>
                        <li> <a href="grid.html">Passionfruit</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Citrus Fruits‎</a>
                    <ul>
                        <li> <a href="grid.html">Fresh Oranges</a> </li>
                        <li> <a href="grid.html">Grapefruits</a> </li>
                        <li> <a href="grid.html">Organic Limes</a> </li>
                        <li> <a href="grid.html">Yellow Lemons</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Stone Fruits</a>
                    <ul>
                        <li> <a href="grid.html">Sweet Apricots</a> </li>
                        <li> <a href="grid.html">Nectarines</a> </li>
                        <li> <a href="grid.html">Doughnut Peachs</a> </li>
                        <li> <a href="grid.html">Italian Fruits</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Large Fruits</a>
                    <ul>
                        <li> <a href="grid.html">Pineapples</a> </li>
                        <li> <a href="grid.html">Organic Papayas</a> </li>
                        <li> <a href="grid.html">Fresh Melons</a> </li>
                        <li> <a href="grid.html">Grapefruits</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Seasonal Fruits</a>
                    <ul>
                        <li> <a href="grid.html">Black Jamuns</a> </li>
                        <li> <a href="grid.html">Fresh Mangos</a> </li>
                        <li> <a href="grid.html">Organic Litchis</a> </li>
                        <li> <a href="grid.html">Longans</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Berries & Cherries</a>
                    <ul>
                        <li> <a href="grid.html">Strawberries</a> </li>
                        <li> <a href="grid.html">Raspberries</a> </li>
                        <li> <a href="grid.html">Blackberries</a> </li>
                        <li> <a href="grid.html">Cherries</a> </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="grid.html">Salads‎</a>
            <ul>
                <li> <a href="grid.html">Veg Salads</a>
                    <ul>
                        <li> <a href="grid.html">Tomatoes</a> </li>
                        <li> <a href="grid.html">Cucumbers</a> </li>
                        <li> <a href="grid.html">Peppers & Capsicums</a> </li>
                        <li> <a href="grid.html">Avocados</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Dressings Salads</a>
                    <ul>
                        <li> <a href="grid.html">Hellmann's</a> </li>
                        <li> <a href="grid.html">Giuseppe Giusti</a> </li>
                        <li> <a href="grid.html">Unitednature</a> </li>
                        <li> <a href="grid.html">Walden Farms</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Fruits Salads</a>
                    <ul>
                        <li> <a href="grid.html">Pineapples</a> </li>
                        <li> <a href="grid.html">Red Apple</a> </li>
                        <li> <a href="grid.html">Strawberries</a> </li>
                        <li> <a href="grid.html">Row Mangos</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Bagged Salads</a>
                    <ul>
                        <li> <a href="grid.html">Italian Baby Spinach</a> </li>
                        <li> <a href="grid.html">Australia Green Kale</a> </li>
                        <li> <a href="grid.html">Sustenir Fresh Toscano</a> </li>
                        <li> <a href="grid.html">Oro Rocket Salad</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Lettuce Salads</a>
                    <ul>
                        <li> <a href="grid.html">Butterhead</a> </li>
                        <li> <a href="grid.html">Red Coral</a> </li>
                        <li> <a href="grid.html">Rolla Rosa Lettuce</a> </li>
                        <li> <a href="grid.html">Summercrisp</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Bread Salads</a>
                    <ul>
                        <li> <a href="grid.html">Green Goddess</a> </li>
                        <li> <a href="grid.html">Grilled Broccoli</a> </li>
                        <li> <a href="grid.html">Panzanella</a> </li>
                        <li> <a href="grid.html">Green Tomato</a> </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="grid.html">Vegetables</a>
            <ul>
                <li> <a href="grid.html">Leafy Vegetables</a>
                    <ul>
                        <li> <a href="grid.html">Sprouts</a> </li>
                        <li> <a href="grid.html">Lettuce</a> </li>
                        <li> <a href="grid.html">Banana Leaves</a> </li>
                        <li> <a href="grid.html">Microgreens</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Mushrooms</a>
                    <ul>
                        <li> <a href="grid.html">Shimeji Mushroom</a> </li>
                        <li> <a href="grid.html">Portobello Mushroom</a> </li>
                        <li> <a href="grid.html">Oyster Mushroom</a> </li>
                        <li> <a href="grid.html">Shiitake Mushroom</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Baby Vegetables</a>
                    <ul>
                        <li> <a href="grid.html">Cabbage</a> </li>
                        <li> <a href="grid.html">Capsicums</a> </li>
                        <li> <a href="grid.html">Pak Choi</a> </li>
                        <li> <a href="grid.html">Spinach</a> </li>
                    </ul>
                </li>

                <li> <a href="grid.html">Salad Vegetables</a>
                    <ul>
                        <li> <a href="grid.html">Cucumbers</a> </li>
                        <li> <a href="grid.html">Avocados</a> </li>
                        <li> <a href="grid.html">Mustard Leaves</a> </li>
                        <li> <a href="grid.html">Tomatoes</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Asian Vegetables</a>
                    <ul>
                        <li> <a href="grid.html">Spring Onion</a> </li>
                        <li> <a href="grid.html">Lady Fingers</a> </li>
                        <li> <a href="grid.html">Watercress</a> </li>
                        <li> <a href="grid.html">Curry Leaves</a> </li>
                    </ul>
                </li>
                <li> <a href="grid.html">Beans Vegetables</a>
                    <ul>
                        <li> <a href="grid.html">French Beans</a> </li>
                        <li> <a href="grid.html">Sweet Corn</a> </li>
                        <li> <a href="grid.html">Fine Green Beans</a> </li>
                        <li> <a href="grid.html">Petai Beans</a> </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="grid.html">Juices‎</a></li>
        <li><a href="grid.html">Meats‎</a></li>
        <li><a href="#">Pages</a>
            <ul>
                <li><a href="grid.html">Grid</a></li>
                <li> <a href="list.html">List</a></li>
                <li> <a href="product-detail.html">Product Detail</a></li>
                <li> <a href="shopping-cart.html">Shopping Cart</a></li>
                <li><a href="checkout.html">Checkout</a>
                    <ul>
                        <li><a href="checkout-method.html">Checkout Method</a></li>
                        <li><a href="checkout-billing-info.html">Checkout Billing Info</a></li>
                    </ul>
                </li>
                <li> <a href="wishlist.html">Wishlist</a></li>
                <li> <a href="dashboard.html">Dashboard</a></li>
                <li> <a href="multiple-addresses.html">Multiple Addresses</a></li>
                <li> <a href="about-us.html">About us</a></li>
                <li><a href="blog.html">Blog</a>
                    <ul>
                        <li><a href="blog-detail.html">Blog Detail</a></li>
                    </ul>
                </li>
                <li><a href="contact-us.html">Contact us</a></li>
                <li><a href="404error.html">404 Error Page</a></li>
            </ul>
        </li>
        <li><a href="#">Custom‎</a></li>

    </ul>
    <div class="top-links">
        <ul class="links">
            <li><a title="My Account" href="login.html">My Account</a> </li>
            <li><a title="Wishlist" href="wishlist.html">Wishlist</a> </li>
            <li><a title="Checkout" href="checkout.html">Checkout</a> </li>
            <li><a title="Blog" href="blog.html">Blog</a> </li>
            <li class="last"><a title="Login" href="login.html">Login</a> </li>
        </ul>
    </div>
</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
