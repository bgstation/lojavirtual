<?php
/* @var $this FinanceiroController */
/* @var $model Financeiro */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Relatórios' => '#',
        'Vendas'
    ),
));
?>

<h1>Relatório de Vendas</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(  
    'id' => 'financeiro-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'usuario_id',
            'value' => '$data->produtoPedido->pedido->usuario->nome'
        ),
        array(
            'name' => 'pedido_id',
            'value' => '$data->produtoPedido->pedido_id'
        ),
        array(
            'name' => 'produto_pedido_id',
            'value' => '$data->produtoPedido->produto->titulo'
        ),
        array(
            'name' => 'cupom_desconto_id',
            'value' => '$data->cupomDesconto->titulo'
        ),
        'valor_item',
        'valor_cupom',
        'valor_liquido',
    ),
));
?>
