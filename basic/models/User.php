<?php

namespace app\models;



use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password_hash
 * @property integer $status
 * @property string $id_usertype

 *
 * @property Profile $profile
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 10;

    public $password;
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
            [['login', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['login', 'email', 'status'], 'required'],
            ['email', 'email'],
            ['login', 'string', 'min' => 2, 'max' => 255],
            ['password', 'required', 'on' => 'create'],
            ['login', 'unique', 'message' => 'Это имя занято.'],
            ['email', 'unique', 'message' => 'Эта почта уже зарегистрирована.'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'status' => 'Status',
            'id_usertype' => 'Type'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    public static function findByLogin($login)
    {
        return static::findOne([
            'login' => $login
        ]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function findByEmail($email)
    {
        return static::findOne([
            'email' => $email
        ]);
    }

    public static function findBySecretKey($key)
    {
        if (!static::isSecretKeyExpire($key))
        {
            return null;
        }
        return static::findOne([
            'secret_key' => $key,
        ]);
    }

    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString().'_'.time();
    }

    public function removeSecretKey()
    {
        $this->secret_key = null;
    }

    public static function isSecretKeyExpire($key)
    {
        if (empty($key))
        {
            return false;
        }
        $expire = Yii::$app->params['secretKeyExpire'];
        $parts = explode('_', $key);
        $timestamp = (int) end($parts);

        return $timestamp + $expire >= time();
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    }
