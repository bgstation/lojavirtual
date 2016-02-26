<?php
/* @var $this ProdutoPedidoController */
/* @var $model ProdutoPedido */

$this->breadcrumbs = array(
    'Produto Pedidos' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List ProdutoPedido', 'url' => array('index')),
    array('label' => 'Create ProdutoPedido', 'url' => array('create')),
    array('label' => 'Update ProdutoPedido', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete ProdutoPedido', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage ProdutoPedido', 'url' => array('admin')),
);
?>

<h1>View ProdutoPedido #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'pedido_id',
        'produto_id',
        'pacote_id',
        'valor',
        'data_liberacao',
        'data_expiracao',
        'datahora_insercao',
        'datahora_ultima_atualizacao',
    ),
));
?>
