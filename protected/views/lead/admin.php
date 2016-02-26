<?php
/* @var $this LeadController */
/* @var $model Lead */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Leads'
    ),
));
?>

<h1>Leads</h1>

<?php
if (Yii::app()->user->checkAccess('lead/create')) {
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'label' => 'Cadastrar',
        'url' => Yii::app()->createUrl('lead/create'),
            )
    );
}
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'lead-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'titulo',
        'data_inicio',
        'data_fim',
        'url_destino',
        array(
            'name' => 'excluido',
            'value' => '$data->excluido ? \'Sim\' : \'Não\'',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}{gerarLink}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("lead/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("lead/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("lead/delete")',
                ),
                'gerarLink' => array(
                    'label'=>'<i class="fa fa-plus-circle"></i>',
                    'visible' => 'Yii::app()->user->checkAccess("lead/gerarLink")',
                    'url' => '$this->grid->controller->createUrl("lead/gerarLink", array("id" => $data->primaryKey))',
                ),
            ),
        ),
    ),
));
?>
