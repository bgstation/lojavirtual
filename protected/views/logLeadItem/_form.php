<?php
/* @var $this LogLeadItemController */
/* @var $model LogLeadItem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'log-lead-item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lead_id'); ?>
		<?php echo $form->textField($model,'lead_id'); ?>
		<?php echo $form->error($model,'lead_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'log_lead_id'); ?>
		<?php echo $form->textField($model,'log_lead_id'); ?>
		<?php echo $form->error($model,'log_lead_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_item'); ?>
		<?php echo $form->textField($model,'tipo_item'); ?>
		<?php echo $form->error($model,'tipo_item'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_id'); ?>
		<?php echo $form->textField($model,'item_id'); ?>
		<?php echo $form->error($model,'item_id'); ?>
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