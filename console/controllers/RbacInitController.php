<?php
namespace console\controllers;

use yii\console\Controller;
use Yii;

class RbacInitController extends Controller
{
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;

        // Remove all existing roles and permissions
        $auth->removeAll();

        // Create "loginToAdmin" permission
        $loginToAdmin = $auth->createPermission('loginToAdmin');
        $loginToAdmin->description = 'Login to admin panel';
        $auth->add($loginToAdmin);

        // Create roles
        $superadmin = $auth->createRole('superadmin');
        $auth->add($superadmin);
        $auth->addChild($superadmin, $loginToAdmin); // Allow superadmin to login to admin

        $developer = $auth->createRole('developer');
        $auth->add($developer);
        // Optionally, add specific permissions for developer

        $root = $auth->createRole('root');
        $auth->add($root);
        // Optionally, add specific permissions for root

//         Assign roles to users (use actual user IDs from your "user" table)
         $auth->assign($superadmin, 1); // 1 is the user ID
    }
}

