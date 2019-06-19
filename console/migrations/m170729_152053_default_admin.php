<?php

use common\models\User;
use yii\db\Migration;
use yii\rbac\Role;

class m170729_152053_default_admin extends Migration
{
    
    const EMAIL = 'litvinova.a95@gmail.com';
    
    public function safeUp()
    {
        //var_dump(Yii::$app->security->generatePasswordHash('123456'));die;
        $user = new User([
            'mail' => static::EMAIL,
        ]);
        $user->setPassword('123456');
        $user->save(false);
        $auth = Yii::$app->authManager;
        $role = new Role([
            'name' => 'admin',
            'description' => 'Администратор',
        ]);
        $auth->add($role);
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $user->id);
    }

    public function safeDown()
    {
        $user = User::findOne(['email' => static::EMAIL]);
        if ($user) {
            $user->delete();
        }
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->remove($authorRole);
    }
    
}
