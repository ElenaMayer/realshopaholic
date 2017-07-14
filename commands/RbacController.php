<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $updatePost = $auth->createPermission('adminBlog');
        $updatePost->description = 'Admin blog';
        $auth->add($updatePost);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);

        $auth->assign($admin, 1);
    }
}