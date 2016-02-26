<?php
/* @var $this UtmSourceController */
/* @var $model UtmSource */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'UTM Source' => Yii::app()->createUrl('utmSource/admin'),
        'Cadastrar'
    ),
));
?>

<h1>Cadastrar UTM Source</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>