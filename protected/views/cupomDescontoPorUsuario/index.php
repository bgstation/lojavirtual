<?php
/* @var $this CupomDescontoPorUsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cupons Desconto Por Usuarios',
);

$this->menu=array(
	array('label'=>'Create CupomDescontoPorUsuario', 'url'=>array('create')),
	array('label'=>'Manage CupomDescontoPorUsuario', 'url'=>array('admin')),
);
?>

<h1>Cupons Desconto Por Usuarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
