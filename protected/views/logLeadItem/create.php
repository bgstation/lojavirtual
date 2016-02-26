<?php
/* @var $this LogLeadItemController */
/* @var $model LogLeadItem */

$this->breadcrumbs=array(
	'Log Lead Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LogLeadItem', 'url'=>array('index')),
	array('label'=>'Manage LogLeadItem', 'url'=>array('admin')),
);
?>

<h1>Create LogLeadItem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>