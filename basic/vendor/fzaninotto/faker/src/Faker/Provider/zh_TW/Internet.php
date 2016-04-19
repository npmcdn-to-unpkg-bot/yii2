<?php

namespace Faker\Provider\zh_TW;

class Internet extends \Faker\Provider\Internet
{
    public function login()
    {
        return \Faker\Factory::create('en_US')->login();
    }

    public function domainWord()
    {
        return \Faker\Factory::create('en_US')->domainWord();
    }
}
