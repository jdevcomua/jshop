<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('www', dirname(dirname(__DIR__)) . '/www');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('rest', dirname(dirname(__DIR__)) . '/rest');

function dg($var, $isDie = true) {
    \yii\helpers\VarDumper::dump($var, 10, 0);
    if ($isDie) {
        die;
    }
}