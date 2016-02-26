<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Pedidos' => Yii::app()->createUrl('pedido/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Pedido: <?= $model->id ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>