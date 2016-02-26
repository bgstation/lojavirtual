<?php
/* @var $this LogLeadController */
/* @var $model LogLead */

$this->breadcrumbs=array(
	'Log Leads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LogLead', 'url'=>array('index')),
	array('label'=>'Create LogLead', 'url'=>array('create')),
	array('label'=>'View LogLead', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LogLead', 'url'=>array('admin')),
);
?>

<h1>Update LogLead <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>