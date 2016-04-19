# yii2
Развернуть проект. В любую папку.

Создать базу yii2.loc
при создании другой  базы или пользователя подкоректировать файл \basic\config\db.php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=Название базы',
    'login' => 'Логин',
    'password' => 'Пароль',
    'charset' => 'utf8',
];


перейти по адресу URL/basic/web/index.php
