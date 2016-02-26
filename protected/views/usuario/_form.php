<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'usuario-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'nome') ?>
        <?= $form->textField($model, 'nome', array('size' => 60, 'maxlength' => 250)) ?>
        <?= $form->error($model, 'nome') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'email') ?>
        <?= $form->textField($model, 'email', array('size' => 60, 'maxlength' => 250)) ?>
        <?= $form->error($model, 'email') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'senha') ?>
        <?= $form->passwordField($model, 'senha', array('size' => 60, 'maxlength' => 100)) ?>
        <?= $form->error($model, 'senha') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'tipo_usuario_id') ?>
        <?= $form->dropDownList($model, 'tipo_usuario_id', CMap::mergeArray(array('' => ''), CHtml::listData($oTipoUsuario, 'id', 'titulo'))) ?>
        <?= $form->error($model, 'tipo_usuario_id') ?>
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