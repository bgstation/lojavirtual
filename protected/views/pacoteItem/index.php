<?php
/* @var $this PacoteItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pacote Items',
);

$this->menu=array(
	array('label'=>'Create PacoteItem', 'url'=>array('create')),
	array('label'=>'Manage PacoteItem', 'url'=>array('admin')),
);
?>

<h1>Pacote Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
