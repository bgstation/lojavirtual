<?php
/* @var $this ConfiguracaoController */
/* @var $model Configuracao */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Configurações'
    ),
));
?>

<h1>Configurações</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'configuracao-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'codigo',
        'valor',
        'descricao',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("configuracao/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("configuracao/update")',
                ),
            ),
        ),
    ),
));
?>
