<?php
/* @var $this FinanceiroController */
/* @var $model Financeiro */
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
		<?php echo $form->label($model,'valor_item'); ?>
		<?php echo $form->textField($model,'valor_item',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valor_cupom'); ?>
		<?php echo $form->textField($model,'valor_cupom',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valor_liquido'); ?>
		<?php echo $form->textField($model,'valor_liquido',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cupom_desconto_id'); ?>
		<?php echo $form->textField($model,'cupom_desconto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'produto_pedido_id'); ?>
		<?php echo $form->textField($model,'produto_pedido_id'); ?>
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