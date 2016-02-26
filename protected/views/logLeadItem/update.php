<?php
/* @var $this LogLeadItemController */
/* @var $model LogLeadItem */

$this->breadcrumbs=array(
	'Log Lead Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LogLeadItem', 'url'=>array('index')),
	array('label'=>'Create LogLeadItem', 'url'=>array('create')),
	array('label'=>'View LogLeadItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LogLeadItem', 'url'=>array('admin')),
);
?>

<h1>Update LogLeadItem <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>