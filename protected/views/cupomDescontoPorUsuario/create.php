<?php
/* @var $this CupomDescontoPorUsuarioController */
/* @var $model CupomDescontoPorUsuario */

$this->breadcrumbs=array(
	'Cupons Desconto Por Usuarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CupomDescontoPorUsuario', 'url'=>array('index')),
	array('label'=>'Manage CupomDescontoPorUsuario', 'url'=>array('admin')),
);
?>

<h1>Create CupomDescontoPorUsuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>