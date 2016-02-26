<?php
/* @var $this UtmSourceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Utm Sources',
);

$this->menu=array(
	array('label'=>'Create UtmSource', 'url'=>array('create')),
	array('label'=>'Manage UtmSource', 'url'=>array('admin')),
);
?>

<h1>Utm Sources</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
