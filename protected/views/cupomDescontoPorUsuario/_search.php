<?php
/* @var $this CupomDescontoPorUsuarioController */
/* @var $model CupomDescontoPorUsuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cupom_desconto_id'); ?>
		<?php echo $form->textField($model,'cupom_desconto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pedido_id'); ?>
		<?php echo $form->textField($model,'pedido_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'utilizando'); ?>
		<?php echo $form->textField($model,'utilizando'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'excluido'); ?>
		<?php echo $form->textField($model,'excluido'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datahora_insercao'); ?>
		<?php echo $form->textField($model,'datahora_insercao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datahora_ultima_atualizacao'); ?>
		<?php echo $form->textField($model,'datahora_ultima_atualizacao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->