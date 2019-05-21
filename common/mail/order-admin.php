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
                <span style="font-size:11px;color:#999999;line-height:18px">Новый заказ</span>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;padding:5px 0 20px">
                <a href= "<?=Url::to(['order/view','id'=>$order->id]) ?>">Ссылка</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>