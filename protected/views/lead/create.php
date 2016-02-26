<?php
/* @var $this LeadController */
/* @var $model Lead */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Lead' => Yii::app()->createUrl('lead/admin'),
        'Cadastrar'
    ),
));
?>

<h1>Cadastrar Lead</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>