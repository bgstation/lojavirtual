<?php
/* @var $this CarrinhoController */
/* @var $model Carrinho */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Controle' => '#',
        'Carrinho'
    ),
));
?>

<h1>Carrinho</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'carrinho-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name' => 'usuario_id',
            'value' => '$data->usuario->nome'
        ),
        array(
            'name' => 'produto_id',
            'value' => '$data->produto->titulo'
        ),
        array(
            'name' => 'pacote_id',
            'value' => '!empty($data->pacote) ? $data->pacote->titulo : \'\' '
        ),
        'valor',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("carrinho/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("carrinho/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("carrinho/delete")',
                ),
            ),
        ),
    ),
));
?>
