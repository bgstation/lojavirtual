<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Banners'
    ),
));
?>

<h1>Banners</h1>

<?php
if (Yii::app()->user->checkAccess('banner/create')) {
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'label' => 'Cadastrar',
        'url' => Yii::app()->createUrl('banner/create'),
            )
    );
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'banner-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'imagem',
        'link',
        'ordem',
        array(
            'name' => 'excluido',
            'value' => '$data->excluido ? \'Sim\' : \'Não\'',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("banner/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("banner/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("banner/delete")',
                ),
            ),
        ),
    ),
));
?>
