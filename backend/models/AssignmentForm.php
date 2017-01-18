<?php

namespace backend\models;

use Yii;
use budyaga\users\models\forms\AssignmentForm as BudyagaAssignmentForm;

class AssignmentForm extends BudyagaAssignmentForm
{

    public function attributeLabels()
    {
        return [
            'assigned' => Yii::t('app', 'RBAC_ASSIGNED'),
            'unassigned' => Yii::t('app', 'RBAC_UNASSIGNED'),
        ];
    }

    public function noEmpty($attribute, $parameters)
    {
        if ($this->action == $parameters['action']) {
            $items = $this->{$attribute};
            if (!is_array($items) || !count($items)) {
                $this->addError($attribute, Yii::t('app', 'CHOOSE_ITEMS'));
            }
        }
    }
    
}