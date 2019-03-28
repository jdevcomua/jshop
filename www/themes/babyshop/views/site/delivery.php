<?php
/* @var $this \yii\web\View */
/* @var $page \common\models\StaticPage */
?>
<div class="grid">
<div class="grid__item large--two-thirds push--large--one-sixth">

    <h1 class="page_name text-center"><?= $page->title ?></h1>
    <div class="rte">
        <?= $page->content ?>
    </div>

</div>
</div>
