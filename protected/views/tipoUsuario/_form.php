<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */
/* @var $form CActiveForm */
?>

<style type='text/css'>
    .rota_item{
        width: 150px;
    }
    .rota_section{
        max-width: 300px; float: left;
    }
</style>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/aclTipoUsuario/_form.js"></script>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'tipo-usuario-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'titulo') ?>
        <?= $form->textField($model, 'titulo', array('size' => 60, 'maxlength' => 100)) ?>
        <?= $form->error($model, 'titulo') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'excluido') ?>
        <?= $form->checkbox($model, 'excluido') ?>
        <?= $form->error($model, 'excluido') ?>
    </div>

    <hr>

    <h3>Permissões</h3>
    <div class="row">
        <?= RotaHelper::renderRotas($aRotas, $aTipoUsuarioRotas) ?>
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