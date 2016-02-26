<?php
/* @var $this ProdutoPedidoController */
/* @var $model ProdutoPedido */

$this->breadcrumbs=array(
	'Produto Pedidos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProdutoPedido', 'url'=>array('index')),
	array('label'=>'Create ProdutoPedido', 'url'=>array('create')),
	array('label'=>'View ProdutoPedido', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProdutoPedido', 'url'=>array('admin')),
);
?>

<h1>Update ProdutoPedido <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>