<?php
/* @var $this PedidoController */
/* @var $model Pedido */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pedido-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'status_pagamento') ?>
        <?= $form->textField($model, 'status_pagamento') ?>
        <?= $form->error($model, 'status_pagamento') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'usuario_id') ?>
        <?= $form->textField($model, 'usuario_id') ?>
        <?= $form->error($model, 'usuario_id') ?>
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