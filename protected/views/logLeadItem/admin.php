<?php
/* @var $this LogLeadItemController */
/* @var $model LogLeadItem */

$this->breadcrumbs=array(
	'Log Lead Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LogLeadItem', 'url'=>array('index')),
	array('label'=>'Create LogLeadItem', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#log-lead-item-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Log Lead Items</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'log-lead-item-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'lead_id',
		'log_lead_id',
		'tipo_item',
		'item_id',
		'datahora_insercao',
		/*
		'datahora_ultima_atualizacao',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
