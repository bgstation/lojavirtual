<?php
/* @var $this CupomDescontoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cupom Descontos',
);

$this->menu=array(
	array('label'=>'Create CupomDesconto', 'url'=>array('create')),
	array('label'=>'Manage CupomDesconto', 'url'=>array('admin')),
);
?>

<h1>Cupom Descontos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
