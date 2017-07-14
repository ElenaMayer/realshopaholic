<?php

namespace app\controllers;

use amilna\blog\models\Category;
use amilna\blog\models\Post;
use amilna\blog\models\Comment;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $posts = Post::find()->where(['status' => 1])->all();
        $categories = Category::find()->all();
        $tags = Post::find()->select(['tags'])->distinct()->all();
        return $this->render('index', [
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
            ]
        );
    }

    /**
     * Displays category page.
     *
     * @return string
     */
    public function actionCategory($id)
    {
        $posts = Post::find()->where(['status' => 1])->all();
        $categories = Category::find()->all();
        $tags = Post::find()->select(['tags'])->distinct()->all();

        $category = Category::findOne($id);
        $postByCategory = [];
        foreach ($category->blogCatPos as $blogCatPos){
            array_push($postByCategory, $blogCatPos->post);
        }
        return $this->render('category', [
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
                'category' => $category,
                'postByCategory' => $postByCategory,
            ]
        );
    }

    /**
     * Displays tag page.
     *
     * @return string
     */
    public function actionTag($tag)
    {
        $posts = Post::find()->where(['status' => 1])->all();
        $categories = Category::find()->all();
        $tags = Post::find()->select(['tags'])->distinct()->all();

        $postsByTag = Post::find()->where(['tags' => $tag, 'status' => 1])->all();
        return $this->render('tag', [
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
                'postsByTag' => $postsByTag,
                'tag' => $tag,
            ]
        );
    }

    /**
     * Displays post page.
     *
     * @return string
     */
    public function actionPost($id)
    {
        $posts = Post::find()->where(['status' => 1])->all();
        $categories = Category::find()->all();
        $tags = Post::find()->select(['tags'])->distinct()->all();

        $post = Post::findOne($id);
        return $this->render('post', [
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
                'post' => $post,
            ]
        );
    }

    public function actionCatalog()
    {
        print_r(222);
    }

    public function actionAddcomment()
    {
        $model = new Comment();
        $model->time = date("Y-m-d H:i:s");
        $model->author_id = Yii::$app->user->id;

        if (Yii::$app->request->post())
        {
            $post = Yii::$app->request->post();
            if (isset($post['post_id']))
            {
                $post_id = $post['post_id'];
                $model->post_id = $post_id;
            }

            if (isset($post['comment']))
            {
                $model->comment = $post['comment'];
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {

                if ($model->save()) {
                    $post = Post::findOne($post_id);
                    $transaction->commit();
                    echo $this->render('_comments', [
                        'comments' => $post->comments,
                    ]);
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
    }
}
