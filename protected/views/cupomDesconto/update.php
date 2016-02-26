<?php
/* @var $this CupomDescontoController */
/* @var $model CupomDesconto */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Cupons de Desconto' => Yii::app()->createUrl('cupomDesconto/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Cupom de Desconto: <?= $model->id ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>