<?php
use common\components\CartElement;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $models CartElement[] */
/* @var $sum double */

$this->title =  Yii::t('app','Basket');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-container col1-layout wow bounceInUp animated">

    <div class="main">
        <div class="container">
            <div class="row">
                <?= \common\widgets\Alert::widget(['options' => ['class'=>'visible']]) ?>
            </div>
        </div>
        <div class="cart wow bounceInUp animated">

            <div class="table-responsive shopping-cart-tbl  container">
                <fieldset>
                    <?php Pjax::begin(['id' => 'cart_cat']) ?>
                        <table id="shopping-cart-table" class="data-table cart-table table-striped">
                            <colgroup><col width="1">
                                <col>
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">
                                <col width="1">

                            </colgroup><thead>
                            <tr class="first last">
                                <th rowspan="1">&nbsp;</th>
                                <th rowspan="1"><span class="nobr"><?=Yii::t('app','Product Name')?></span></th>
                                <th rowspan="1"></th>
                                <th class="a-center" colspan="1"><span class="nobr"><?=Yii::t('app','Unit Price')?></span></th>
                                <th rowspan="1" class="a-center"><?=Yii::t('app','Qty')?></th>
                                <th class="a-center" colspan="1"><?=Yii::t('app','Subtotal')?></th>
                                <th rowspan="1" class="a-center">&nbsp;</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="first last">
                                <td colspan="50" class="a-right last">
                                    <button type="button" title="Continue Shopping" class="button btn-continue" onclick="window.location.replace('<?=\yii\helpers\Url::home()?>');"><span><span><?=Yii::t('app','Continue Shopping')?></span></span></button>
                                    <button type="submit" name="update_cart_action" value="update_qty" title="Update Cart" class="button btn-update" id="update_cart_button"><span><span><?=Yii::t('app','Update Cart')?></span></span></button>
                                    <button type="submit" name="update_cart_action" value="empty_cart" title="Clear Cart" class="button btn-empty" id="empty_cart_button"><span><span><?=Yii::t('app','Clear Cart')?></span></span></button>

                                </td>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach ($models as $model) {?>
                            <tr class="odd">
                                <td class="image hidden-table"><a href="<?= $model->model->getUrl()?>" title="<?= $model->model->title?>" class="product-image">
                                        <img src="<?=$model->model->getOneImageUrl()?>" width="75" alt="<?= $model->model->title?>"></a></td>
                                <td>
                                    <h2 class="product-name">
                                        <a href="<?= $model->model->getUrl()?>"><?= $model->model->title?></a>
                                    </h2>
                                </td>
                                <td class="a-center hidden-table">
                                </td>
                                <td class="a-right hidden-table">
                                    <span class="cart-price">
                                        <span class="price"><?= number_format((float)$model->model->getNewPrice(), 2, '.', '') ?></span>
                                    </span>
                                </td>
                                <td class="a-center movewishlist count-of-item">
                                    <input id="qty" name="qty" data-id="<?= $model->model->getId(); ?>" data-type="<?= $model->model->getType(); ?>" value="<?=$model->count?>" size="4" title="Qty" class="input-text qty js-qty__num" maxlength="6">
                                    <?=$model->model->getMetricTitle()?>
                                </td>
                                <td class="a-right movewishlist">
                                    <span class="cart-price">
                                        <span class="price"><?= number_format((float)$model->model->getNewPrice() * $model->count, 2, '.', '') ?></span>
                                    </span>
                                </td>
                                <td class="a-center last">

                                    <a href="" title="Remove item"  data-id="<?= $model->model->getId(); ?>" data-type="<?= $model->model->getType(); ?>" data-pjax="true" class="button cart__remove remove-item"><span><span><?=Yii::t('app','Remove item')?></span></span></a></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php Pjax::end() ?>
                </fieldset>
            </div>

            <!-- BEGIN CART COLLATERALS -->


            <div class="cart-collaterals container">
                <!-- BEGIN COL2 SEL COL 1 -->
                <div class="row">

                    <!-- BEGIN TOTALS COL 2 -->

                    <div class="col-sm-4">

                        <div class="discount">
<!--                            <h3>Discount Codes</h3>-->
<!--                            <form id="discount-coupon-form" action="" method="post">-->
<!--                                <label for="coupon_code">Enter your coupon code if you have one.</label>-->
<!--                                <input type="hidden" name="remove" id="remove-coupone" value="0">-->
<!--                                <input class="input-text fullwidth" type="text" id="coupon_code" name="coupon_code" value="">-->
<!--                                <button type="button" title="Apply Coupon" class="button coupon " onClick="discountForm.submit(false)" value="Apply Coupon"><span>Apply Coupon</span></button>-->
<!---->
<!--                            </form>-->

                        </div> <!--discount-->
                    </div> <!--col-sm-4-->

                    <div class="col-sm-4">

                        <div class="discount">
                            <!--                            <h3>Discount Codes</h3>-->
                            <!--                            <form id="discount-coupon-form" action="" method="post">-->
                            <!--                                <label for="coupon_code">Enter your coupon code if you have one.</label>-->
                            <!--                                <input type="hidden" name="remove" id="remove-coupone" value="0">-->
                            <!--                                <input class="input-text fullwidth" type="text" id="coupon_code" name="coupon_code" value="">-->
                            <!--                                <button type="button" title="Apply Coupon" class="button coupon " onClick="discountForm.submit(false)" value="Apply Coupon"><span>Apply Coupon</span></button>-->
                            <!---->
                            <!--                            </form>-->

                        </div> <!--discount-->
                    </div> <!--col-sm-4-->

                    <div class="col-sm-4">
                        <div class="totals">
                            <h3><?=Yii::t('app','Shopping Cart Total')?></h3>
                            <div class="inner">
                                <?php Pjax::begin(['id' => 'total_sum']) ?>
                                <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                                    <colgroup><col>
                                        <col width="1">
                                    </colgroup><tfoot>
                                    <tr>
                                        <td style="" class="a-left" colspan="1">
                                            <strong><?=Yii::t('app','Grand Total')?></strong>
                                        </td>
                                        <td style="" class="a-right">
                                            <strong><span class="price"><?=number_format((float)$sum, 2, '.', '')?></span></strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr>
                                        <td style="" class="a-left" colspan="1">
                                            <?=Yii::t('app','Subtotal')?>
                                                </td>
                                        <td style="" class="a-right">
                                            <span class="price"><?=number_format((float)$sum, 2, '.', '')?></span>    </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php Pjax::end() ?>
                                <ul class="checkout">
                                    <li>
                                        <form action="<?=\yii\helpers\Url::toRoute('cart/order')?>" >
                                            <button type="submit" title="Proceed to Checkout" class="button btn-proceed-checkout" onClick="orderCheck(<?php if($sum==0){echo 0;}else{echo 1;}?>,event)"><span><?=Yii::t('app','Proceed to Checkout')?></span></button>
                                        </form>
                                    </li>
                                </ul>
                            </div><!--inner-->
                        </div><!--totals-->
                    </div> <!--col-sm-4-->


                </div> <!--cart-collaterals-->


            </div>
        </div>  <!--cart-->

    </div><!--main-container-->

</div> <!--col1-layout-->