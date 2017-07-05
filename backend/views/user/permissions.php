<?php

use yii\helpers\Html;
use budyaga\users\UsersAsset;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $modelForm \backend\models\AssignmentForm */

$this->title = $modelForm->model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelForm->model->username, 'url' => ['/user/admin/view', 'id' => $modelForm->model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Права доступа');

$assets = UsersAsset::register($this);
?>
<div class="users-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <div class="user-rules">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-xs-5">
                        <?= $form->field($modelForm, 'assigned')->dropDownList(
                            ArrayHelper::map(
                                $modelForm->model->assignedRules,
                                function ($data) {
                                    return serialize([$data->name, $data->type]);
                                },
                                'description'
                            ), ['multiple' => 'multiple', 'size' => '20', 'class' => 'col-xs-12']) ?>
                    </div>
                    <div class="col-xs-2 text-center">
                        <button class="btn btn-success" type="submit" name="AssignmentForm[action]" value="assign"><span
                                class="glyphicon glyphicon-arrow-left"></span></button>
                        <button class="btn btn-success" type="submit" name="AssignmentForm[action]" value="revoke"><span
                                class="glyphicon glyphicon-arrow-right"></span></button>
                    </div>
                    <div class="col-xs-5">
                        <?= $form->field($modelForm, 'unassigned')->dropDownList(
                            ArrayHelper::map(
                                $modelForm->model->notAssignedRules,
                                function ($data) {
                                    return serialize([$data->name, $data->type]);
                                },
                                'description'
                            ), ['multiple' => 'multiple', 'size' => '20', 'class' => 'col-xs-12']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
