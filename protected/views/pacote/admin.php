<?php
/* @var $this PacoteController */
/* @var $model Pacote */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Cadastro' => '#',
        'Pacotes'
    ),
));
?>

<h1>Pacotes</h1>

<?php
if (Yii::app()->user->checkAccess('pacote/create')) {
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'label' => 'Cadastrar',
        'url' => Yii::app()->createUrl('pacote/create'),
            )
    );
}
$this->widget('bootstrap.widgets.TbGridView', array(    
    'id' => 'pacote-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'titulo',
        'desconto',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'visible' => 'Yii::app()->user->checkAccess("pacote/view")',
                ),
                'update' => array(
                    'visible' => 'Yii::app()->user->checkAccess("pacote/update")',
                ),
                'delete' => array(
                    'visible' => 'Yii::app()->user->checkAccess("pacote/delete")',
                ),
            ),
        ),
    ),
));
?>
