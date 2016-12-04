<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $type_id
 * @property integer $location_id
 * @property integer $user_id
 * @property string $date
 * @property string $gender
 * @property string $age
 * @property string $height
 * @property string $name_animal
 * @property string $description
 * @property string $date_created
 * @property integer $status
 *
 * @property Category $category
 * @property Type $type
 * @property User $user
 * @property AnimalToImage[] $animalToImages
 */
class Animal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'animal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'type_id', 'location_id', 'user_id'], 'required'],
            [['category_id', 'type_id', 'location_id', 'user_id', 'status'], 'integer'],
            [['date', 'date_created'], 'safe'],
            [['description'], 'string'],
            [['gender'], 'string', 'max' => 15],
            [['age', 'height', 'name_animal'], 'string', 'max' => 60],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'type_id' => 'Type',
            'location_id' => 'Location',
            'user_id' => 'User ID',
            'date' => 'Date',
            'gender' => 'Gender',
            'age' => 'Age',
            'height' => 'Height',
            'name_animal' => 'Name Animal',
            'description' => 'Description',
            'date_created' => 'Date Created',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalToImages()
    {
        return $this->hasMany(AnimalToImage::className(), ['id_animal' => 'id']);
    }
}
