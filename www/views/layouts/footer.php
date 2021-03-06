<?php

use yii\helpers\Html;

?>
<footer>
    <!-- BEGIN INFORMATIVE FOOTER -->
    <div class="footer-inner">
        <div class="footer-middle">
            <div class="container">
                <div class="row row-footer">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-column">
                            <h4><?= Yii::t('app','Shopping Guide')?></h4>
                            <ul class="links">
                                <li><?= Html::a(Yii::t('app','FAQs').'?', ['site/faq']) ?></li>
                                <li><a href="payment.html" title="Payment"><?= Yii::t('app','Payment')?></a></li>
                                <li><?= Html::a(Yii::t('app','Where is my order').'?', ['site/where-is-my-order']) ?></li>
                                <li><a href="returnPolicy.html" title="Return policy"><?= Yii::t('app','Return Policy')?></a></li>
                                <li><?= Html::a(Yii::t('app','Contact Us'), ['site/contact-us']) ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-column">
                            <h4><?= Yii::t('app','Style Advisor')?></h4>
                            <ul class="links">
                                <li><a href="login.html" title="Your Account"><?= Yii::t('app','Your Account')?></a></li>
                                <li><a href="discount.html" title="<?= Yii::t('app','Discount')?>"><?= Yii::t('app','Discount')?></a></li>
                                <li><a href="ordersHistory.html" title="Orders History"><?= Yii::t('app','Orders History')?></a></li>
                                <li><a href="aboutUs.html" title="About Us"><?= Yii::t('app','About Us')?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-column">
                            <h4><?= Yii::t('app','Contact Us')?></h4>
                            <div class="contacts-info">
                                <address>
                                    <i class="add-icon"></i>бульвар Шевченко 270а,<br>
                                    Мариуполь
                                </address>
                                <div class="phone-footer"><i class="phone-icon"></i><?= Yii::$app->params['phoneNumber'] ?></div>
                                <div class="email-footer">
                                    <i class="email-icon"></i>
                                    <a href="mailto:<?= Yii::$app->params['supportEmail'] ?>"><?= Yii::$app->params['supportEmail'] ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--container-->
    </div>
    <!--footer-inner-->

    <!--footer-middle-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="social">
                        <ul>
                            <li class="fb"><a href="#"></a></li>
                            <li class="instagram"><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 coppyright">©<span id="year">2019</span> Copyright</div>
                <div class="col-xs-12 col-sm-4">
                </div>
            </div>
        </div>
    </div>
    <!--footer-bottom-->
    <!-- BEGIN SIMPLE FOOTER -->
</footer>