<?php
/* @var $this UtmMediumController */
/* @var $model UtmMedium */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'UTM Medium' => Yii::app()->createUrl('utmMedium/admin'),
        'Cadastrar'
    ),
));
?>

<h1>Cadastrar UTM Medium</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>