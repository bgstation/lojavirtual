<?php
/* @var $this LogLeadController */
/* @var $model LogLead */

$this->breadcrumbs=array(
	'Log Leads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LogLead', 'url'=>array('index')),
	array('label'=>'Manage LogLead', 'url'=>array('admin')),
);
?>

<h1>Create LogLead</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>