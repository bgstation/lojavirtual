<?php
/* @var $this PacoteController */
/* @var $data Pacote */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_amigavel')); ?>:</b>
	<?php echo CHtml::encode($data->url_amigavel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desconto')); ?>:</b>
	<?php echo CHtml::encode($data->desconto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('video_apresentacao')); ?>:</b>
	<?php echo CHtml::encode($data->video_apresentacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imagem')); ?>:</b>
	<?php echo CHtml::encode($data->imagem); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('destaque')); ?>:</b>
	<?php echo CHtml::encode($data->destaque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantidade_visualizacao')); ?>:</b>
	<?php echo CHtml::encode($data->quantidade_visualizacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('periodo_visualizacao')); ?>:</b>
	<?php echo CHtml::encode($data->periodo_visualizacao); ?>
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

	*/ ?>

</div>