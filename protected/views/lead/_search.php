<?php
/* @var $this LeadController */
/* @var $model Lead */
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
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_inicio'); ?>
		<?php echo $form->textField($model,'data_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_fim'); ?>
		<?php echo $form->textField($model,'data_fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url_destino'); ?>
		<?php echo $form->textField($model,'url_destino',array('size'=>60,'maxlength'=>200)); ?>
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