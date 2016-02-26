<?php
/* @var $this UtmSourceController */
/* @var $model UtmSource */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'UTM Source'
    ),
));
?>

<h1>Utm Source</h1>

<?php
if (Yii::app()->user->checkAccess('utmSource/create')) {
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'label' => 'Cadastrar',
        'url' => Yii::app()->createUrl('utmSource/create'),
            )
    );
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'utm-source-grid',
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
                    'visible' => 'Yii::app()->user->checkAccess("utmSource/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("utmSource/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("utmSource/delete")',
                ),
            ),
        ),
    ),
));
?>
