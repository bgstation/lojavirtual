<?php
/* @var $this LogLeadItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Log Lead Items',
);

$this->menu=array(
	array('label'=>'Create LogLeadItem', 'url'=>array('create')),
	array('label'=>'Manage LogLeadItem', 'url'=>array('admin')),
);
?>

<h1>Log Lead Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
