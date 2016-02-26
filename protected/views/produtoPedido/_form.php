<?php
/* @var $this ProdutoPedidoController */
/* @var $model ProdutoPedido */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'produto-pedido-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pedido_id'); ?>
		<?php echo $form->textField($model,'pedido_id'); ?>
		<?php echo $form->error($model,'pedido_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'produto_id'); ?>
		<?php echo $form->textField($model,'produto_id'); ?>
		<?php echo $form->error($model,'produto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pacote_id'); ?>
		<?php echo $form->textField($model,'pacote_id'); ?>
		<?php echo $form->error($model,'pacote_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_liberacao'); ?>
		<?php echo $form->textField($model,'data_liberacao'); ?>
		<?php echo $form->error($model,'data_liberacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_expiracao'); ?>
		<?php echo $form->textField($model,'data_expiracao'); ?>
		<?php echo $form->error($model,'data_expiracao'); ?>
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