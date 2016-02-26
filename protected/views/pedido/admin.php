<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Controle' => '#',
        'Pedidos'
    ),
));
?>

<h1>Pedidos</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'pedido-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name' => 'usuario_id',
            'value' => '$data->usuario->nome'
        ),
        array(
            'name' => 'status_pagamento',
            'value' => '$data->aStatus[$data->status_pagamento]'
        ),
        array(
            'name' => 'valor_total',
            'value' => '\'R$ \' . FormatHelper::valorMonetario($data->getValorTotal())',
        ),
        array(
            'name' => 'datahora_insercao',
            'value' => 'FormatHelper::dataHora($data->datahora_insercao)'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("pedido/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("pedido/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("pedido/delete")',
                ),
            ),
        ),
    ),
));
?>
