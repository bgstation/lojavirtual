<?php
/* @var $this CarrinhoController */
/* @var $model Carrinho */
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
		<?php echo $form->label($model,'usuario_id'); ?>
		<?php echo $form->textField($model,'usuario_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'produto_id'); ?>
		<?php echo $form->textField($model,'produto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pacote_id'); ?>
		<?php echo $form->textField($model,'pacote_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>10,'maxlength'=>10)); ?>
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