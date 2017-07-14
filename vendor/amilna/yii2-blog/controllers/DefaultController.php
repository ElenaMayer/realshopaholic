<?php

namespace amilna\blog\controllers;

use Yii;
use yii\web\Controller;
use vova07\imperavi\actions\UploadAction;
use vova07\imperavi\actions\GetAction;
use yii\filters\AccessControl;

class DefaultController extends Controller
{

    public $layout = 'blog';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {        
        return $this->render('index');
    }
    
    public function actions()
	{
		$module = Yii::$app->getModule('blog');
		$url = Yii::getAlias($module->uploadURL);
		$path = Yii::getAlias($module->uploadDir);		
		
		return [
			'image-upload' => [
				'class' => 'vova07\imperavi\actions\UploadAction',
				'url' => $url.'/images', // Directory URL address, where files are stored.
				'path' => $path.'/images' // Or absolute path to directory where files are stored.
			],
			'images-get' => [
				'class' => 'vova07\imperavi\actions\GetAction',
				'url' => $url.'/images', // Directory URL address, where files are stored.
				'path' => $path.'/images', // Or absolute path to directory where files are stored.
				'type' => GetAction::TYPE_IMAGES,
			],
			'file-upload' => [
				'class' => 'vova07\imperavi\actions\UploadAction',
				'url' => $url.'/files', // Directory URL address, where files are stored.
				'path' => $path.'/files' // Or absolute path to directory where files are stored.
			],
			'files-get' => [
				'class' => 'vova07\imperavi\actions\GetAction',
				'url' => $url.'/files', // Directory URL address, where files are stored.
				'path' => $path.'/files', // Or absolute path to directory where files are stored.
				'type' => GetAction::TYPE_FILES,
			],
			
		];
	}
}
