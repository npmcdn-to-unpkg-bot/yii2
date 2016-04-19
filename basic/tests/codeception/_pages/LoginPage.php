<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class LoginPage extends BasePage
{
    public $route = 'site/login';

    /**
     * @param string $login
     * @param string $password
     */
    public function login($login, $password)
    {
        $this->actor->fillField('input[name="LoginForm[login]"]', $login);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }
}
