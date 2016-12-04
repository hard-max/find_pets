<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "locality".
 *
 * @property string $id
 * @property string $title
 * @property string $abbreviations
 * @property string $parent_id
 * @property string $number
 * @property string $type
 */
class Locality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locality';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'number'], 'integer'],
            [['type'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['abbreviations'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'abbreviations' => 'Abbreviations',
            'parent_id' => 'Parent ID',
            'number' => 'Number',
            'type' => 'Type',
        ];
    }
}
