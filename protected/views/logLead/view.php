<?php
/* @var $this LogLeadController */
/* @var $model LogLead */

$this->breadcrumbs=array(
	'Log Leads'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LogLead', 'url'=>array('index')),
	array('label'=>'Create LogLead', 'url'=>array('create')),
	array('label'=>'Update LogLead', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LogLead', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LogLead', 'url'=>array('admin')),
);
?>

<h1>View LogLead #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lead_id',
		'utm_source_id',
		'utm_medium_id',
		'usuario_id',
		'ip',
		'datahora_insercao',
		'datahora_ultima_atualizacao',
	),
)); ?>
