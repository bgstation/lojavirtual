<?php
/* @var $this ProdutoPedidoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Produto Pedidos',
);

$this->menu=array(
	array('label'=>'Create ProdutoPedido', 'url'=>array('create')),
	array('label'=>'Manage ProdutoPedido', 'url'=>array('admin')),
);
?>

<h1>Produto Pedidos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
