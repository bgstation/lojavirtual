<?php
/* @var $this LeadController */
/* @var $model Lead */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Leads' => Yii::app()->createUrl('lead/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Lead <?= $model->id ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>