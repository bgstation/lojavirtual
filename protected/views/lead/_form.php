<?php
/* @var $this LeadController */
/* @var $model Lead */
/* @var $form CActiveForm */

Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'lead-form',
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
        <?= $form->labelEx($model, 'data_inicio') ?>
        <?php
        $this->widget('CJuiDateTimePicker', array(
            'model' => $model,
            'language' => 'pt',
            'attribute' => 'data_inicio',
            'mode' => 'datetime',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
                'changeMonth' => 'true',
                'changeYear' => 'true',
                'constrainInput' => 'false',
                'showSecond' => true,
            ),
            'htmlOptions' => array(
                'class' => 'span2'
            ),
        ));
        ?>
        <?= $form->error($model, 'data_inicio') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'data_fim') ?>
        <?php
        $this->widget('CJuiDateTimePicker', array(
            'model' => $model,
            'language' => 'pt',
            'attribute' => 'data_fim',
            'mode' => 'datetime',
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
                'changeMonth' => 'true',
                'changeYear' => 'true',
                'constrainInput' => 'false',
                'showSecond' => true,
            ),
            'htmlOptions' => array(
                'class' => 'span2'
            ),
        ));
        ?>
        <?= $form->error($model, 'data_fim') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'url_destino') ?>
        <?= $form->textField($model, 'url_destino', array('size' => 60, 'maxlength' => 200)) ?>
        <?= $form->error($model, 'url_destino') ?>
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