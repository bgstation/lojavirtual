<?php
/* @var $this RotaController */
/* @var $model Rota */

$this->breadcrumbs=array(
	'Rotas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Rota', 'url'=>array('index')),
	array('label'=>'Create Rota', 'url'=>array('create')),
	array('label'=>'Update Rota', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Rota', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rota', 'url'=>array('admin')),
);
?>

<h1>View Rota #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'titulo',
		'controller',
		'action',
		'categoria',
		'descricao',
		'excluido',
		'rota_id',
		'datahora_insercao',
		'datahora_ultima_atualizacao',
	),
)); ?>
