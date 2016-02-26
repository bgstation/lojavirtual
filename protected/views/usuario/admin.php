<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Usuários'
    ),
));
?>

<h1>Usuários</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'usuario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'nome',
        'email',
        array(
            'name' => 'tipo_usuario_id',
            'value' => '$data->tipoUsuario->titulo',
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
