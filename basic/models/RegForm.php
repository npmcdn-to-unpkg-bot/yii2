<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 02.05.2015
 * Time: 18:17
 */
namespace app\models;

use yii\base\Model;
use Yii;

class RegForm extends Model
{
    public $login;
    public $email;
    public $password;
    public $status;

    public function rules()
    {
        return [
            [['login', 'email', 'password'],'filter', 'filter' => 'trim'],
            [['login', 'email', 'password'],'required'],
            ['login', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 5, 'max' => 255],
            ['login', 'unique',
                'targetClass' => User::className(),
                'message' => 'Это имя уже занято.'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже занята.'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE
            ]],
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Login',
            'email' => 'E-mail',
            'password' => 'Password'
        ];
    }

    public function reg()
    {
        $user = new User();
        $user->login = $this->login;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);

        $user->id_usertype = 'Менеджер';


        return $user->save() ? $user : null;
    }

    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->login.' (отправлено роботом).'])
            ->setTo($this->email)
            ->setSubject('Активация для '.Yii::$app->logine)
            ->send();
    }
}