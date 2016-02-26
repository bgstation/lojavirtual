<?php
/* @var $this LogLeadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Log Leads',
);

$this->menu=array(
	array('label'=>'Create LogLead', 'url'=>array('create')),
	array('label'=>'Manage LogLead', 'url'=>array('admin')),
);
?>

<h1>Log Leads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
