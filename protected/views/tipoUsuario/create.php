<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Tipos de Usuários' => Yii::app()->createUrl('tipoUsuario/admin'),
        'Cadastrar'
    ),
));
?>

<h1>Cadastrar Tipo de Usuário</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>