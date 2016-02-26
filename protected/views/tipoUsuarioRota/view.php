<?php
/* @var $this TipoUsuarioRotaController */
/* @var $model TipoUsuarioRota */

$this->breadcrumbs=array(
	'Tipo Usuario Rotas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoUsuarioRota', 'url'=>array('index')),
	array('label'=>'Create TipoUsuarioRota', 'url'=>array('create')),
	array('label'=>'Update TipoUsuarioRota', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoUsuarioRota', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoUsuarioRota', 'url'=>array('admin')),
);
?>

<h1>View TipoUsuarioRota #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tipo_usuario_id',
		'rota_id',
		'excluido',
		'datahora_insercao',
		'datahora_ultima_atualizacao',
	),
)); ?>
