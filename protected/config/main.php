<?php

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
Yii::setPathOfAlias('fidelize', CAMINHO_EXTENSOES_YII);

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '.',
    'defaultController' => 'site/index',
    'preload' => array('log'),
    'language' => 'pt_br',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.extensions.bootstrap.widgets.*',
        'application.extensions.bootstrap.helpers.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'root',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    'components' => array(
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'authManager' => array(
            'class' => 'application.components.UserRole',
        ),
        'user' => array(
            'class' => 'application.components.WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
        ),
//        'urlManager' => array(
//            'urlFormat' => 'path',
//            'showScriptName' => false,
//            'rules' => array(
//                'leads/<utm_source>/<utm_medium>/<utm_campaign>' => 'lead/acessar',
//
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//            ),
//        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=loja_virtual',
            'emulatePrepare' => false,
            'enableProfiling' => false,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8'
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
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
    'params' => array(
        'diretorioImagens' => 'images/',
        'adminEmail' => 'pedrojordaorezende@gmail.com',
        'emailTecnico' => 'pedrojordaorezende@gmail.com',
        'diretorioImagensBanners' => '/images/banner/',
        'diretorioImagensPacotes' => '/images/pacote/',
        'diretorioImagensProdutos' => '/images/produto/',
        'diretorioArquivosPdf' => '/uploads/',
        'email_pagseguro' => '',
        'token_pagseguro' => '',
        'projeto' => 'lojavirtual'
    ),
);
