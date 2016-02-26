<?php
/* @var $this CupomDescontoController */
/* @var $model CupomDesconto */
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
		<?php echo $form->label($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'percentual'); ?>
		<?php echo $form->textField($model,'percentual',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limitacao'); ?>
		<?php echo $form->textField($model,'limitacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'utilizados'); ?>
		<?php echo $form->textField($model,'utilizados'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_expiracao'); ?>
		<?php echo $form->textField($model,'data_expiracao'); ?>
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