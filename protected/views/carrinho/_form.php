<?php
/* @var $this CarrinhoController */
/* @var $model Carrinho */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'carrinho-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'usuario_id') ?>
        <?= $form->textField($model, 'usuario_id') ?>
        <?= $form->error($model, 'usuario_id') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'produto_id') ?>
        <?= $form->textField($model, 'produto_id') ?>
        <?= $form->error($model, 'produto_id') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'pacote_id') ?>
        <?= $form->textField($model, 'pacote_id') ?>
        <?= $form->error($model, 'pacote_id') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'valor') ?>
        <?= $form->textField($model, 'valor', array('size' => 10, 'maxlength' => 10)) ?>
        <?= $form->error($model, 'valor') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'excluido') ?>
        <?= $form->checkbox($model, 'excluido') ?>
        <?= $form->error($model, 'excluido') ?>
    </div>

    <div class="row buttons">
        <?php
        echo CHtml::openTag('div', array('class' => 'form-btns'));
        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'success',
            'size' => 'small',
            'buttonType' => 'submit',
            'label' => $model->isNewRecord ? 'Cadastrar' : 'Atualizar'
                )
        );
        ?>
    </div>

    <?php $this->endWidget() ?>

</div>