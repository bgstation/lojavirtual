<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Clientes'
    ),
));
?>

<h1>Clientes</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'cliente-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'cpf',
        'celular',
        'uf',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("cliente/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("cliente/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("cliente/delete")',
                ),
            ),
        ),
    ),
));
?>
