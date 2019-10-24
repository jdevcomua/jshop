<?php
/* @var $model \common\models\Vote */
?>
<li class="comment">
    <div>
        <img alt="" src="<?=$model->user->getImageUrl()?>" class="avatar avatar-60 photo">
        <div class="comment-text">
            <div class="ratings">
                <div class="rating-box">
                    <div class="rating" style="width:<?= (int) $model->rating / 5 * 100?>%"></div>
                </div>
            </div>
            <p class="meta">
                <strong><?= ($model->user) ? $model->user->name : 'Anonymous' ?></strong>
                <span>–</span> <?= Yii::$app->formatter->asDatetime($model->timestamp,'dd/MM/yy HH:mm') ?>
            </p>
            <div class="description">
                <?= $model->text ?>
            </div>
        </div>
    </div>
</li><!-- #comment-## -->