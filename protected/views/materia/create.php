<?php
/* @var $this MateriaController */
/* @var $model Materia */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Matérias' => Yii::app()->createUrl('materia/admin'),
        'Cadastrar'
    ),
));
?>

<h1>Cadastrar Matéria</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>