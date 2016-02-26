<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Banners' => Yii::app()->createUrl('banner/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Banner: <?= $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>