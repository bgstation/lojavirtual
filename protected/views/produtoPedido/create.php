<?php
/* @var $this ProdutoPedidoController */
/* @var $model ProdutoPedido */

$this->breadcrumbs=array(
	'Produto Pedidos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProdutoPedido', 'url'=>array('index')),
	array('label'=>'Manage ProdutoPedido', 'url'=>array('admin')),
);
?>

<h1>Create ProdutoPedido</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>