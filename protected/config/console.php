<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Loja Virtual',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.extensions.bootstrap.widgets.*',
        'application.extensions.bootstrap.helpers.*',
    ),
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost:8889;dbname=loja_virtual',
            'emulatePrepare' => false,
            'enableProfiling' => false,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);
