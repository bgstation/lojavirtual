<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Tipos de Usuários'
    ),
));
?>

<h1>Tipos de Usuários</h1>

<?php
if (Yii::app()->user->checkAccess('tipoUsuario/create')) {
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'label' => 'Cadastrar',
        'url' => Yii::app()->createUrl('tipoUsuario/create'),
            )
    );
}
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'tipo-usuario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'titulo',
        array(
            'name' => 'excluido',
            'value' => '$data->excluido ? \'Sim\' : \'Não\'',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("tipoUsuario/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("tipoUsuario/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("tipoUsuario/delete")',
                ),
            ),
        ),
    ),
));
?>
