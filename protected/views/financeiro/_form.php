<?php
/* @var $this FinanceiroController */
/* @var $model Financeiro */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'financeiro-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'valor_item'); ?>
		<?php echo $form->textField($model,'valor_item',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valor_item'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor_cupom'); ?>
		<?php echo $form->textField($model,'valor_cupom',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valor_cupom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor_liquido'); ?>
		<?php echo $form->textField($model,'valor_liquido',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valor_liquido'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cupom_desconto_id'); ?>
		<?php echo $form->textField($model,'cupom_desconto_id'); ?>
		<?php echo $form->error($model,'cupom_desconto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'produto_pedido_id'); ?>
		<?php echo $form->textField($model,'produto_pedido_id'); ?>
		<?php echo $form->error($model,'produto_pedido_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datahora_insercao'); ?>
		<?php echo $form->textField($model,'datahora_insercao'); ?>
		<?php echo $form->error($model,'datahora_insercao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datahora_ultima_atualizacao'); ?>
		<?php echo $form->textField($model,'datahora_ultima_atualizacao'); ?>
		<?php echo $form->error($model,'datahora_ultima_atualizacao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->