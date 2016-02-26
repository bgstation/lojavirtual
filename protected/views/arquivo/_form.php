<?php
/* @var $this ArquivoController */
/* @var $model Arquivo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'arquivo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'arquivo'); ?>
		<?php echo $form->textField($model,'arquivo',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'arquivo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modulo_id'); ?>
		<?php echo $form->textField($model,'modulo_id'); ?>
		<?php echo $form->error($model,'modulo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_arquivo_id'); ?>
		<?php echo $form->textField($model,'tipo_arquivo_id'); ?>
		<?php echo $form->error($model,'tipo_arquivo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'carga_horaria'); ?>
		<?php echo $form->textField($model,'carga_horaria',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'carga_horaria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ordem'); ?>
		<?php echo $form->textField($model,'ordem'); ?>
		<?php echo $form->error($model,'ordem'); ?>
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