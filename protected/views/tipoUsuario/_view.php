<?php
/* @var $this TipoUsuarioController */
/* @var $data TipoUsuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
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