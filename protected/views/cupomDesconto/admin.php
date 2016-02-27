<?php
/* @var $this CupomDescontoController */
/* @var $model CupomDesconto */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Cupons de Desconto'
    ),
));
?>

<h1>Cupons de Desconto</h1>

<?php
if (Yii::app()->user->checkAccess('cupomDesconto/create')) {
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'label' => 'Cadastrar',
        'url' => Yii::app()->createUrl('cupomDesconto/create'),
            )
    );
}
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'cupom-desconto-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'titulo',
        'percentual',
        array(
            'name' => 'data_expiracao',
            'value' => 'FormatHelper::dataHora($data->data_expiracao)',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("cupomDesconto/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("cupomDesconto/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("cupomDesconto/delete")',
                ),
            ),
        ),
    ),
));
?>
