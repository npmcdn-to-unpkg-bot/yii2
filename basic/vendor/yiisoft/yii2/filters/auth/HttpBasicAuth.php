<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\filters\auth;

/**
 * HttpBasicAuth is an action filter that supports the HTTP Basic authentication method.
 *
 * You may use HttpBasicAuth by attaching it as a behavior to a controller or module, like the following:
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         'basicAuth' => [
 *             'class' => \yii\filters\auth\HttpBasicAuth::className(),
 *         ],
 *     ];
 * }
 * ```
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HttpBasicAuth extends AuthMethod
{
    /**
     * @var string the HTTP authentication realm
     */
    public $realm = 'api';
    /**
     * @var callable a PHP callable that will authenticate the user with the HTTP basic auth information.
     * The callable receives a login and a password as its parameters. It should return an identity object
     * that matches the login and password. Null should be returned if there is no such identity.
     *
     * The following code is a typical implementation of this callable:
     *
     * ```php
     * function ($login, $password) {
     *     return \app\models\User::findOne([
     *         'login' => $login,
     *         'password' => $password,
     *     ]);
     * }
     * ```
     *
     * If this property is not set, the login information will be considered as an access token
     * while the password information will be ignored. The [[\yii\web\User::loginByAccessToken()]]
     * method will be called to authenticate and login the user.
     */
    public $auth;


    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $login = $request->getAuthUser();
        $password = $request->getAuthPassword();

        if ($this->auth) {
            if ($login !== null || $password !== null) {
                $identity = call_user_func($this->auth, $login, $password);
                if ($identity !== null) {
                    $user->switchIdentity($identity);
                } else {
                    $this->handleFailure($response);
                }
                return $identity;
            }
        } elseif ($login !== null) {
            $identity = $user->loginByAccessToken($login, get_class($this));
            if ($identity === null) {
                $this->handleFailure($response);
            }
            return $identity;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function challenge($response)
    {
        $response->getHeaders()->set('WWW-Authenticate', "Basic realm=\"{$this->realm}\"");
    }
}
