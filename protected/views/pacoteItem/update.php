<?php
/* @var $this PacoteItemController */
/* @var $model PacoteItem */

$this->breadcrumbs=array(
	'Pacote Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PacoteItem', 'url'=>array('index')),
	array('label'=>'Create PacoteItem', 'url'=>array('create')),
	array('label'=>'View PacoteItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PacoteItem', 'url'=>array('admin')),
);
?>

<h1>Update PacoteItem <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>