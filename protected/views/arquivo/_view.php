<?php
/* @var $this ArquivoController */
/* @var $data Arquivo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arquivo')); ?>:</b>
	<?php echo CHtml::encode($data->arquivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modulo_id')); ?>:</b>
	<?php echo CHtml::encode($data->modulo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_arquivo_id')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_arquivo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carga_horaria')); ?>:</b>
	<?php echo CHtml::encode($data->carga_horaria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ordem')); ?>:</b>
	<?php echo CHtml::encode($data->ordem); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('excluido')); ?>:</b>
	<?php echo CHtml::encode($data->excluido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_insercao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_insercao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datahora_ultima_atualizacao')); ?>:</b>
	<?php echo CHtml::encode($data->datahora_ultima_atualizacao); ?>
	<br />

	*/ ?>

</div>