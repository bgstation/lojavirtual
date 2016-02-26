<?php
/* @var $this ArquivoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Arquivos',
);

$this->menu=array(
	array('label'=>'Create Arquivo', 'url'=>array('create')),
	array('label'=>'Manage Arquivo', 'url'=>array('admin')),
);
?>

<h1>Arquivos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
