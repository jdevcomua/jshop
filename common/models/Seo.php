<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $url
 * @property string $h1
 * @property string $new_url
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'keywords', 'url','new_url'], 'string', 'max' => 255],
            [['url'], 'unique'],
            [['h1'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'url' => 'Url',
            'h1'=>'H1',
            'new_url'=>'New Url',
        ];

    }
}
