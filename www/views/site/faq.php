
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <div class="col-main col-sm-9 wow bounceInUp animated animated animated" style="visibility: visible;">
                <div class="static-contain">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <h4>Общие вопросы</h4>
                        <div>
                            <h5>
                                <a class="xhr" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                    Какой у вас график работы?
                                </a>
                            </h5>
                            <div id="collapse1" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <b>Мы работаем по следующему графику:</b><br>
                                <?= Yii::$app->params['workDay'] ?>: <?= Yii::$app->params['workTime'] ?><br>
                                бех перерыва и выходных
                            </div>
                        </div>
                        <div>
                            <h5>
                                <a class="xhr" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapseOne">
                                    Можно ли заказать по телефону?
                                </a>
                            </h5>
                            <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                Да, можно. Телефон по которому можно сделать заказ: <?= Yii::$app->params['phoneNumber'] ?>
                            </div>
                        </div>
                        <div>
                            <h5>
                                <a class="xhr" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapseOne">
                                    Когда я получу свой заказ?
                                </a>
                            </h5>
                            <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                Если заказ был сделан до 12 часов дня, то вы получите в тот же день, если после 12, то заказ привезут на следующий день
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <aside class="col-right sidebar col-sm-3 wow bounceInUp animated animated animated" style="visibility: visible;">
                <div class="block block-company">
                    <div class="block-title">Company</div>
                    <div class="block-content">
                        <ol id="recently-viewed-items">
                            <li class="item odd"><a href="about-us.html">About Us</a></li>
                            <li class="item even"><a href="#">Sitemap</a></li>
                            <li class="item  odd"><a href="#">Terms of Service</a></li>
                            <li class="item last"><a href="#">Search Terms</a></li>
                            <li class="item last"><a href="contact-us.html"><strong>Contact Us</strong></a></li>
                        </ol>
                    </div>
                </div>
            </aside>
            <!--col-right sidebar-->
        </div>
        <!--row-->
    </div>
    <!--main-container-inner-->
</div>

