<?php
/* @var $this PacoteController */
/* @var $model Pacote */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Pacotes' => Yii::app()->createUrl('pacote/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Pacote: <?= $model->id ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>