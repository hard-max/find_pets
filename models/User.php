<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $additional_contact
 * @property string $date_created
 * @property integer $deleted
 *
 * @property Animal[] $animals
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $authKey;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'name', 'phone'], 'required'],
            [['additional_contact'], 'string'],
            [['date_created'], 'safe'],
            [['deleted'], 'integer'],
            [['email', 'name'], 'string', 'max' => 60],
            [['email'], 'unique', 'message' => 'This email already present in database'],
            [['password'], 'string', 'max' => 160],
            [['password'], 'match', 'pattern' => '/^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', 
                'message' => 'Password must contain at least 8 characters, 1 upper case (A-Z), 1 lower case (a-z) and 1 symbol (like !#@*)'
            ],
            [['password_repeat'], 'required', 'on'=>['register',]],
            [['password_repeat'], 'compare', 'compareAttribute'=>'password', 'message'=>'Passwords don\'t match', 'on' => ['register'] ],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone Number'),
            'additional_contact' => Yii::t('app', 'Additional Contact'),
            'date_created' => Yii::t('app', 'Date Created'),
            'deleted' => Yii::t('app', 'Deleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animal::className(), ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    //     // return static::findOne(['access_token' => $token]);
    }

    public static function findIdentityByEmail($email)
    {
        $user = static::findOne(['email' => $email]); 
        return $user;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = \Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        } 
        else {
            return false;
        }
    }
}
