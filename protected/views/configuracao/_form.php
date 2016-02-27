<?php
/* @var $this ConfiguracaoController */
/* @var $model Configuracao */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'configuracao-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'codigo') ?>
        <?= $form->textField($model, 'codigo', array('size' => 50, 'maxlength' => 50, 'disabled' => 'disabled')) ?>
        <?= $form->error($model, 'codigo') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'valor') ?>
        <?= $form->textField($model, 'valor') ?>
        <?= $form->error($model, 'valor') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'descricao') ?>
        <?= $form->textArea($model, 'descricao', array('rows' => 6, 'cols' => 50, 'disabled' => 'disabled')) ?>
        <?= $form->error($model, 'descricao') ?>
    </div>

    <div class="row buttons">
        <?php
        echo CHtml::openTag('div', array('class' => 'form-btns'));
        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'success',
            'size' => 'small',
            'buttonType' => 'submit',
            'label' => 'Atualizar'
                )
        );
        ?>
    </div>

    <?php $this->endWidget() ?>

</div>