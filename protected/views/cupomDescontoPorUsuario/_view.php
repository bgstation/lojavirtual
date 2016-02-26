<?php
/* @var $this CupomDescontoPorUsuarioController */
/* @var $data CupomDescontoPorUsuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cupom_desconto_id')); ?>:</b>
	<?php echo CHtml::encode($data->cupom_desconto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pedido_id')); ?>:</b>
	<?php echo CHtml::encode($data->pedido_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utilizando')); ?>:</b>
	<?php echo CHtml::encode($data->utilizando); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('excluido')); ?>:</b>
	<?php echo CHtml::encode($data->excluido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_insercao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_insercao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_ultima_atualizacao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_ultima_atualizacao); ?>
	<br />


</div>