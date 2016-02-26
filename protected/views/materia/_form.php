<script src="<?= Yii::app()->request->baseUrl ?>/js/funcoes_uteis.js" type="text/javascript"></script>
<?php
/* @var $this MateriaController */
/* @var $model Materia */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'materia-form',
        'enableAjaxValidation' => false,
            ))
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'titulo') ?>
        <?= $form->textField($model, 'titulo', array('size' => 60, 'maxlength' => 250)) ?>
        <?= $form->error($model, 'titulo') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'url_amigavel') ?>
        <?= $form->textField($model, 'url_amigavel', array('size' => 60, 'maxlength' => 250)) ?>
        <?= $form->error($model, 'url_amigavel') ?>
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
<script type='text/javascript'>
    $('#Materia_titulo').change(function () {
        var texto = tratarString(this.value);
        $('#Materia_url_amigavel').val(texto);
    });
</script>