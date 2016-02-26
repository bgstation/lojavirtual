<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Clientes' => Yii::app()->createUrl('cliente/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Cliente: <?= $model->id ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>