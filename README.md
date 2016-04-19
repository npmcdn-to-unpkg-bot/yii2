# yii2
Развернуть проект.

Создать базу yii2.loc
при создании другой  базы или пользователя подкоректировать файл \basic\config\db.php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=Название базы',
    'login' => 'Логин',
    'password' => 'Пароль',
    'charset' => 'utf8',
];
