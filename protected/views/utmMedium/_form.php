<?php
/* @var $this UtmMediumController */
/* @var $model UtmMedium */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'utm-medium-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'titulo') ?>
        <?= $form->textField($model, 'titulo', array('size' => 60, 'maxlength' => 200)) ?>
        <?= $form->error($model, 'titulo') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'excluido') ?>
        <?= $form->checkBox($model, 'excluido') ?>
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