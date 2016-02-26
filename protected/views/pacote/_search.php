<?php
/* @var $this PacoteController */
/* @var $model Pacote */
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
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url_amigavel'); ?>
		<?php echo $form->textField($model,'url_amigavel',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desconto'); ?>
		<?php echo $form->textField($model,'desconto',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'video_apresentacao'); ?>
		<?php echo $form->textField($model,'video_apresentacao',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imagem'); ?>
		<?php echo $form->textField($model,'imagem',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destaque'); ?>
		<?php echo $form->textField($model,'destaque'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantidade_visualizacao'); ?>
		<?php echo $form->textField($model,'quantidade_visualizacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'periodo_visualizacao'); ?>
		<?php echo $form->textField($model,'periodo_visualizacao'); ?>
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