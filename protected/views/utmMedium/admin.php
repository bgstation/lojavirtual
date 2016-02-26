<?php
/* @var $this UtmMediumController */
/* @var $model UtmMedium */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'UTM Medium'
    ),
));
?>

<h1>UTM Medium</h1>

<?php
if (Yii::app()->user->checkAccess('utmMedium/create')) {
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'label' => 'Cadastrar',
        'url' => Yii::app()->createUrl('utmMedium/create'),
            )
    );
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'utm-medium-grid',
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
                    'visible' => 'Yii::app()->user->checkAccess("utmMedium/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("utmMedium/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("utmMedium/delete")',
                ),
            ),
        ),
    ),
));
?>
