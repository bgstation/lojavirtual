<?php
/* @var $this LogLeadItemController */
/* @var $model LogLeadItem */

$this->breadcrumbs=array(
	'Log Lead Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LogLeadItem', 'url'=>array('index')),
	array('label'=>'Create LogLeadItem', 'url'=>array('create')),
	array('label'=>'Update LogLeadItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LogLeadItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LogLeadItem', 'url'=>array('admin')),
);
?>

<h1>View LogLeadItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lead_id',
		'log_lead_id',
		'tipo_item',
		'item_id',
		'datahora_insercao',
		'datahora_ultima_atualizacao',
	),
)); ?>
