<?php
/* @var $this TipoUsuarioRotaController */
/* @var $model TipoUsuarioRota */

$this->breadcrumbs=array(
	'Tipo Usuario Rotas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoUsuarioRota', 'url'=>array('index')),
	array('label'=>'Create TipoUsuarioRota', 'url'=>array('create')),
	array('label'=>'View TipoUsuarioRota', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TipoUsuarioRota', 'url'=>array('admin')),
);
?>

<h1>Update TipoUsuarioRota <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>