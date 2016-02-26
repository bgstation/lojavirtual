<?php
/* @var $this CupomDescontoPorUsuarioController */
/* @var $model CupomDescontoPorUsuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cupons-desconto-por-usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cupom_desconto_id'); ?>
		<?php echo $form->textField($model,'cupom_desconto_id'); ?>
		<?php echo $form->error($model,'cupom_desconto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pedido_id'); ?>
		<?php echo $form->textField($model,'pedido_id'); ?>
		<?php echo $form->error($model,'pedido_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'utilizando'); ?>
		<?php echo $form->textField($model,'utilizando'); ?>
		<?php echo $form->error($model,'utilizando'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'excluido'); ?>
		<?php echo $form->textField($model,'excluido'); ?>
		<?php echo $form->error($model,'excluido'); ?>
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