<?php
/* @var $this ClienteController */
/* @var $model Cliente */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cliente-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'cpf') ?>
        <?= $form->textField($model, 'cpf', array('size' => 20, 'maxlength' => 20)) ?>
        <?= $form->error($model, 'cpf') ?>
    </div>
    
    <div class="row">
        <?= $form->labelEx($model, 'celular') ?>
        <?= $form->textField($model, 'celular', array('size' => 50, 'maxlength' => 50)) ?>
        <?= $form->error($model, 'celular') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'telefone') ?>
        <?= $form->textField($model, 'telefone', array('size' => 50, 'maxlength' => 50)) ?>
        <?= $form->error($model, 'telefone') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'sexo') ?>
        <?= $form->dropDownList($model, 'sexo', CMap::mergeArray(array('' => ''), $model->aSexo)) ?>
        <?= $form->error($model, 'sexo') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'uf') ?>
        <?= $form->textField($model, 'uf', array('size' => 2, 'maxlength' => 2)) ?>
        <?= $form->error($model, 'uf') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'cidade') ?>
        <?= $form->textField($model, 'cidade', array('size' => 60, 'maxlength' => 150)) ?>
        <?= $form->error($model, 'cidade') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'cep') ?>
        <?= $form->textField($model, 'cep', array('size' => 30, 'maxlength' => 30)) ?>
        <?= $form->error($model, 'cep') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'numero') ?>
        <?= $form->textField($model, 'numero', array('size' => 30, 'maxlength' => 30)) ?>
        <?= $form->error($model, 'numero') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'complemento') ?>
        <?= $form->textField($model, 'complemento', array('size' => 60, 'maxlength' => 250)) ?>
        <?= $form->error($model, 'complemento') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'bairro') ?>
        <?= $form->textField($model, 'bairro', array('size' => 60, 'maxlength' => 250)) ?>
        <?= $form->error($model, 'bairro') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'endereco') ?>
        <?= $form->textField($model, 'endereco', array('size' => 60, 'maxlength' => 250)) ?>
        <?= $form->error($model, 'endereco') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'data_nascimento') ?>
        <?= $form->textField($model, 'data_nascimento') ?>
        <?= $form->error($model, 'data_nascimento') ?>
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