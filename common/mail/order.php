<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 29.01.16
 * Time: 2:33
 *
 * @var $user \common\models\User
 * @var $order \common\models\Orders
 */
?>

<div class="mailsub" style="width:640px;margin:0 auto">
    <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:640px">
        <tbody>
        <tr>
            <td style="text-align:center;padding:7px 0 10px;">
                <span style="font-size:11px;color:#999999;line-height:18px">Ваша заявка принята</span>
            </td>
        </tr>
        <tr>
            <td style="width:640px;vertical-align:top">
                <table cellpadding="0" cellspacing="0"
                       style="border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-top:3px solid #74d46b;border-collapse:collapse;width:100%">
                    <tbody>
                    <tr>
                        <td style="padding:25px 30px 32px 27px;vertical-align:top;border-bottom:1px solid #cccccc;">
                            <h1 style="font-size:28px;line-height:32px;padding-bottom:15px;font-weight:normal;margin:0"><?php echo $order->name;?>, спасибо за ваш заказ!</h1>
                            <p style="font-size:15px;padding-bottom:22px;line-height:24px;margin:0">
                                Ваша заявка принята.
                                Мы свяжемся с вами в ближайшее время для подтверждения заказа №<?php echo $order->id; ?>
                                .
                            </p>
                            <p style="font-size:15px;line-height:24px;margin:0">Вы можете отследить статус своего заказа
                                в
                                <a href="<?= Yii::$app->request->hostInfo . Yii::$app->urlHelper->to(['user/dashboard']); ?>"
                                   target="_blank" style="text-decoration:none;color:#3e77aa">личном кабинете</a>.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">
                            <table cellpadding="0" cellspacing="0"
                                   style="border-bottom:1px solid #cccccc;border-collapse:collapse;width:100%">
                                <tbody>
                                <tr>
                                    <td style="padding:0 30px 0 27px;vertical-align:top">
                                        <table cellpadding="0" cellspacing="0"
                                               style="border:0;border-collapse:collapse;line-height:24px;width:580px">
                                            <tbody>
                                            <tr>
                                                <td colspan="2" style="vertical-align:baseline">
                                                    <h2 style="font-size:26px;margin:0;font-weight:normal;padding:20px 0 10px 0">
                                                        Заказ №<?php echo $order->id; ?></h2>
                                                </td>
                                                <td style="vertical-align:baseline;text-align:right;font-size:15px"><?php echo $order->timestamp; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:13px;padding-bottom:5px;width:280px;vertical-align:top;color:#999999">
                                                    Название и цена товара
                                                </td>
                                                <td style="font-size:13px;padding-bottom:5px;width:100px;vertical-align:top;color:#999999">
                                                    Кол-во
                                                </td>
                                                <td style="font-size:13px;padding-bottom:5px;width:200px;text-align:right;vertical-align:top;color:#999999">
                                                    Сумма
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="border-top:1px solid #f0f0f0;vertical-align:top">
                                                    <?php foreach ($order->orderItems as $orderItem) {
                                                    /* @var $orderItem \common\models\OrderItem*/
                                                    ?>
                                                        <table cellpadding="0" cellspacing="0"
                                                               style="border:0;border-collapse:collapse;margin-top:10px;margin-bottom:10px;width:100%">
                                                            <tbody>
                                                            <tr>
                                                                <td align="center"
                                                                    style="padding-left:20px;padding-right:20px;padding-top:5px;padding-bottom:5px;width:100px;vertical-align:middle">
                                                                    <a href="<?= $orderItem->item->getUrl() ?>"
                                                                       target="_blank"
                                                                       style="text-decoration:none;line-height:0;">
                                                                        <img border="0"
                                                                             style="display:block;background-color:#ffffff;max-width: 80px; max-height: 55px;"
                                                                             src="<?= $orderItem->item->getOneImageUrl(); ?>">
                                                                    </a>
                                                                </td>
                                                                <td style="padding-top:5px;padding-bottom:5px;vertical-align:top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                           style="border:0;border-collapse:collapse;width:100%">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td colspan="3"
                                                                                style="padding:0 0 3px 0;line-height:20px">
                                                                                <a href="<?= $orderItem->item->getUrl() ?>"
                                                                                   target="_blank"
                                                                                   style="color:#3e77aa;font-size:15px;text-decoration:none;">
                                                                                    <?= $orderItem->item->title; ?>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="font-size:15px;width:140px;vertical-align:top;padding-top:5px">
                                                                                <?= $orderItem->sum / $orderItem->count ?> грн
                                                                            </td>
                                                                            <td style="font-size:15px;width:100px;vertical-align:top;padding-top:5px">
                                                                                <?= $orderItem->count ?> шт.
                                                                            </td>
                                                                            <td style="font-size:18px;width:200px;vertical-align:top;text-align:right;color:#333333;padding-top:5px">
                                                                                <?= $orderItem->sum ?> грн
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="border-top:1px solid #f0f0f0;padding-top:17px;padding-bottom:17px">
                                                    <table cellpadding="0" cellspacing="0"
                                                           style="border:0;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width:140px;vertical-align:top;padding:0">
                                                                Доставка
                                                            </td>
                                                            <td style="width:260px;vertical-align:top;padding:0">
                                                                <?= $order->delivery; ?>
                                                            </td>
                                                            <td style="width:180px;text-align:right;vertical-align:top;padding:0">
                                                                <span
                                                                    style="font-size:15px;font-style:italic"></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"
                                                                style="font-size:13px;padding:10px 30px 5px 30px;vertical-align:top;width:190px;text-align:justify;">
                                                                <div
                                                                    style="border:1px solid #e3e3e3;padding:15px;line-height:21px">
                                                                    Сроки оговариваются при оформлении. Резерв товара в
                                                                    магазине – 2 дня.
                                                                    При получении обязательно проверяйте целостность
                                                                    товара, комплектацию.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="border-top:1px solid #f0f0f0;padding-top:17px;padding-bottom:17px">
                                                    <table cellpadding="0" cellspacing="0"
                                                           style="border:0;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-size:15px;vertical-align:top;width:140px">
                                                                Оплата
                                                            </td>
                                                            <td style="font-size:15px;vertical-align:top;">
                                                                <?= $order->payment; ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="border-top:1px solid #f0f0f0;padding-top:17px;padding-bottom:17px">
                                                    <table cellpadding="0" cellspacing="0"
                                                           style="border:0;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-size:15px;vertical-align:top;width:140px">
                                                                Телефон
                                                            </td>
                                                            <td style="font-size:15px;vertical-align:top;">
                                                                <?= $order->phone; ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="border-top:1px solid #f0f0f0;padding-top:17px;padding-bottom:17px">
                                                    <table cellpadding="0" cellspacing="0"
                                                           style="border:0;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-size:15px;vertical-align:top;width:140px">
                                                                Адрес
                                                            </td>
                                                            <td style="font-size:15px;vertical-align:top;">
                                                                <?= $order->address; ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="border-top:1px solid #f0f0f0;padding-top:17px;padding-bottom:17px">
                                                    <table cellpadding="0" cellspacing="0"
                                                           style="border:0;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-size:15px;vertical-align:top;width:140px">
                                                                Покупатель
                                                            </td>
                                                            <td style="font-size:15px;vertical-align:top;">
                                                                <?= $order->name; ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="border-top:1px solid #f0f0f0;padding-top:22px;padding-bottom:22px">
                                                    <table cellpadding="0" cellspacing="0"
                                                           style="border:0;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="font-size:18px;vertical-align:baseline">К
                                                                оплате
                                                            </td>
                                                            <td style="font-size:26px;text-align:right;vertical-align:baseline">
                                                                <?= $order->sum; ?> грн
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="border-top:1px solid #f0f0f0;padding-top:22px;padding-bottom:22px">
                                                    <table cellpadding="0" cellspacing="0"
                                                           style="border:0;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                        <tr>
                                                            <td style="width:68px;vertical-align:middle">
                                                                <img alt="Телефон" width="48" height="48"
                                                                     style="border-width:0;display:block"
                                                                     src="http://i.rozetka.ua/design/letters/neworder/phone-icon.png">
                                                            </td>
                                                            <td style="vertical-align:middle">
                                                                <p style="margin:0;font-size:15px;line-height:24px">
                                                                    Будем рады ответить на Ваши вопросы:</p>
                                                                <p style="margin:0;padding:0;font-size:15px;line-height:24px">
                                                                    (044) 537-02-22, (044) 503-80-80, 0 800 503-808</p>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0 14px">
                            <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:100%">
                                <tbody>
                                <tr>
                                    <td style="vertical-align:middle;border-right:1px solid #cccccc;width:290px;padding-left:20px;">
										<span style="color:#666666;font-size:12px">Интернет-магазин <?=\Yii::$app->name?><br> 04080,
											<a href=""
                                               style="color:#3e77aa" target="_blank">Киев, ул. Ярославская, 57</a>
										</span>
                                    </td>
                                    <td style="vertical-align:middle;text-align:center">
										<span style="color:#666666;font-size:12px">
											<strong>(044) 537-02-22</strong><br> 0 800 503-808<br> (044) 503-80-80
</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="font-size:0;vertical-align:top">
                <img width="640" height="6" style="border:0;display:block"
                     src="http://i.rozetka.ua/design/letters/neworder/border-bottom.png">
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" style="border:0;border-collapse:collapse;width:100%">
                    <tbody>
                    <tr>
                        <td style="text-align:right;vertical-align:bottom;padding-top:10px">
                            <a href="" title="Facebook" target="_blank"
                               style="text-decoration:none">
                                <img width="36" height="36" alt="Facebook" style="border:0;line-height:0;outline:0"
                                     src="<?=Yii::$app->getRequest()->getHostInfo().'/images/facebook.png'?>">
                            </a>
                            <a href="" title="Instagram" target="_blank"
                               style="text-decoration:none">
                                <img width="36" height="36" alt="Instagram" style="border:0;line-height:0;outline:0"
                                     src="<?=Yii::$app->getRequest()->getHostInfo().'/images/instagram.png'?>">
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>