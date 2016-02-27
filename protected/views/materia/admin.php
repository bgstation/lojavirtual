<?php
/* @var $this MateriaController */
/* @var $model Materia */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Matérias'
    ),
));
?>

<h1>Matérias</h1>

<?php
if (Yii::app()->user->checkAccess('materia/create')) {
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'label' => 'Cadastrar',
        'url' => Yii::app()->createUrl('materia/create'),
            )
    );
}
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'materia-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'titulo',
        'url_amigavel',
        array(
            'name' => 'excluido',
            'value' => '$data->excluido ? \'Sim\' : \'Não\'',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("materia/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("materia/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("materia/delete")',
                ),
            ),
        ),
    ),
));
?>
