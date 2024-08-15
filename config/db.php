<?php

return [
    'class' => 'yii\db\Connection',
    'driverName' => 'sqlsrv',
    'dsn' => 'sqlsrv:server=' . getenv('DB_SERVER') . ';database=' . getenv('DB_NAME'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
    // Schema cache options (for production getenvironment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

