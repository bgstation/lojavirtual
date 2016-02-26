<?php
/* @var $this FinanceiroController */
/* @var $data Financeiro */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_item')); ?>:</b>
	<?php echo CHtml::encode($data->valor_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_cupom')); ?>:</b>
	<?php echo CHtml::encode($data->valor_cupom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_liquido')); ?>:</b>
	<?php echo CHtml::encode($data->valor_liquido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cupom_desconto_id')); ?>:</b>
	<?php echo CHtml::encode($data->cupom_desconto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('produto_pedido_id')); ?>:</b>
	<?php echo CHtml::encode($data->produto_pedido_id); ?>
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