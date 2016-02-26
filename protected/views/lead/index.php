<?php
/* @var $this LeadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Leads',
);

$this->menu=array(
	array('label'=>'Create Lead', 'url'=>array('create')),
	array('label'=>'Manage Lead', 'url'=>array('admin')),
);
?>

<h1>Leads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
