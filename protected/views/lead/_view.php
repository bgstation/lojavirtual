<?php
/* @var $this LeadController */
/* @var $data Lead */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->data_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_fim')); ?>:</b>
	<?php echo CHtml::encode($data->data_fim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_destino')); ?>:</b>
	<?php echo CHtml::encode($data->url_destino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('excluido')); ?>:</b>
	<?php echo CHtml::encode($data->excluido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_insercao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_insercao); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_ultima_atualizacao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_ultima_atualizacao); ?>
	<br />

	*/ ?>

</div>