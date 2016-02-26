<?php
/* @var $this ProdutoPedidoController */
/* @var $data ProdutoPedido */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pedido_id')); ?>:</b>
	<?php echo CHtml::encode($data->pedido_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('produto_id')); ?>:</b>
	<?php echo CHtml::encode($data->produto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pacote_id')); ?>:</b>
	<?php echo CHtml::encode($data->pacote_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_liberacao')); ?>:</b>
	<?php echo CHtml::encode($data->data_liberacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_expiracao')); ?>:</b>
	<?php echo CHtml::encode($data->data_expiracao); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_insercao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_insercao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_ultima_atualizacao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_ultima_atualizacao); ?>
	<br />

	*/ ?>

</div>