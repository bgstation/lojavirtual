<?php
/* @var $this LogLeadItemController */
/* @var $data LogLeadItem */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lead_id')); ?>:</b>
	<?php echo CHtml::encode($data->lead_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_lead_id')); ?>:</b>
	<?php echo CHtml::encode($data->log_lead_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_item')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_insercao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_insercao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_ultima_atualizacao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_ultima_atualizacao); ?>
	<br />


</div>