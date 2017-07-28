<?php

namespace amilna\blog\models;

use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "blog_comment".
 *
 * @property integer $id
 * @property string $comment
 * @property integer $post_id
 * @property integer $author_id
 * @property integer $parent_id
 * @property string $time
 *
 * @property array $replays
 *
 * @property User $author
 * @property Comment $parent
 * @property Comment[] $comments
 * @property BlogPost $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment', 'post_id'], 'required'],
            [['post_id', 'author_id', 'parent_id'], 'integer'],
            [['time'], 'safe'],
            [['comment'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'post_id' => 'Post ID',
            'author_id' => 'Author ID',
            'parent_id' => 'Parent ID',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id'])->orderBy(['time'=>SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(BlogPost::className(), ['id' => 'post_id']);
    }

    public function getTimeString(){
        $res = date("d ", strtotime($this->time));
        $month = date("n", strtotime($this->time));
        switch ($month){
            case 1: $res.='января';break;
            case 2: $res.='февраля';break;
            case 3: $res.='марта';break;
            case 4: $res.='апреля';break;
            case 5: $res.='мая';break;
            case 6: $res.='июня';break;
            case 7: $res.='июля';break;
            case 8: $res.='августа';break;
            case 9: $res.='сентября';break;
            case 10: $res.='октября';break;
            case 11: $res.='ноября';break;
            case 12: $res.='декабря';break;
        }
        $res .= date(" Y H:i", strtotime($this->time));
        return $res;
    }
}
