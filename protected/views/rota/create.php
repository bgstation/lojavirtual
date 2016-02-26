<?php
/* @var $this RotaController */
/* @var $model Rota */

$this->breadcrumbs=array(
	'Rotas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rota', 'url'=>array('index')),
	array('label'=>'Manage Rota', 'url'=>array('admin')),
);
?>

<h1>Create Rota</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>