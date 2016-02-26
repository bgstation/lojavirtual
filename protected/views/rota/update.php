<?php
/* @var $this RotaController */
/* @var $model Rota */

$this->breadcrumbs=array(
	'Rotas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rota', 'url'=>array('index')),
	array('label'=>'Create Rota', 'url'=>array('create')),
	array('label'=>'View Rota', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Rota', 'url'=>array('admin')),
);
?>

<h1>Update Rota <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>