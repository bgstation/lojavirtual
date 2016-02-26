<?php
/* @var $this TipoUsuarioRotaController */
/* @var $model TipoUsuarioRota */

$this->breadcrumbs=array(
	'Tipo Usuario Rotas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoUsuarioRota', 'url'=>array('index')),
	array('label'=>'Manage TipoUsuarioRota', 'url'=>array('admin')),
);
?>

<h1>Create TipoUsuarioRota</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>