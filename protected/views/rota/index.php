<?php
/* @var $this RotaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rotas',
);

$this->menu=array(
	array('label'=>'Create Rota', 'url'=>array('create')),
	array('label'=>'Manage Rota', 'url'=>array('admin')),
);
?>

<h1>Rotas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
