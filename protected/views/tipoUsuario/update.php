<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Tipos de Usuários' => Yii::app()->createUrl('tipoUsuario/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Tipo de Usuario: <?= $model->id ?></h1>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'aRotas' => $aRotas,
    'aTipoUsuarioRotas' => $aTipoUsuarioRotas,
));
?>