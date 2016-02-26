<?php
/* @var $this FinanceiroController */
/* @var $model Financeiro */

$this->breadcrumbs = array(
    'Financeiros' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Financeiro', 'url' => array('index')),
    array('label' => 'Create Financeiro', 'url' => array('create')),
    array('label' => 'Update Financeiro', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Financeiro', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Financeiro', 'url' => array('admin')),
);
?>

<h1>View Financeiro #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'valor_item',
        'valor_cupom',
        'valor_liquido',
        'cupom_desconto_id',
        'produto_pedido_id',
        'datahora_insercao',
        'datahora_ultima_atualizacao',
    ),
));
?>
