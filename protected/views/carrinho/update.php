<?php
/* @var $this CarrinhoController */
/* @var $model Carrinho */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Carrinho' => Yii::app()->createUrl('carrinho/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Carrinho: <?= $model->id ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>