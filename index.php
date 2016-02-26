<?php
require_once __DIR__ . '/protected/config/defines.php';

$yii = CAMINHO_FRAMEWORK_YII . '/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
