<?php
/* @var $this UtmMediumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Utm Media',
);

$this->menu=array(
	array('label'=>'Create UtmMedium', 'url'=>array('create')),
	array('label'=>'Manage UtmMedium', 'url'=>array('admin')),
);
?>

<h1>Utm Media</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
