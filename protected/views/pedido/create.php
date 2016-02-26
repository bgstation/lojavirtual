<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Pedidos' => Yii::app()->createUrl('pedido/admin'),
        'Cadastrar'
    ),
));
?>

<h1>Cadastrar Pedido</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>