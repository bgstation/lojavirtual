<?php
/* @var $this TipoUsuarioRotaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Usuario Rotas',
);

$this->menu=array(
	array('label'=>'Create TipoUsuarioRota', 'url'=>array('create')),
	array('label'=>'Manage TipoUsuarioRota', 'url'=>array('admin')),
);
?>

<h1>Tipo Usuario Rotas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
