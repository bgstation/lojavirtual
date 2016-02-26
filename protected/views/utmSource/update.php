<?php
/* @var $this UtmSourceController */
/* @var $model UtmSource */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'UTM Source' => Yii::app()->createUrl('utmSource/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar UTM Source <?= $model->id ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>