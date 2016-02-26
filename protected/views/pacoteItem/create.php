<?php
/* @var $this PacoteItemController */
/* @var $model PacoteItem */

$this->breadcrumbs=array(
	'Pacote Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PacoteItem', 'url'=>array('index')),
	array('label'=>'Manage PacoteItem', 'url'=>array('admin')),
);
?>

<h1>Create PacoteItem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>