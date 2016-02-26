<script src="<?= Yii::app()->request->baseUrl ?>/js/jquery.mask.js" type="text/javascript"></script>
<?php
/* @var $this CupomDescontoController */
/* @var $model CupomDesconto */
/* @var $form CActiveForm */

Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cupom-desconto-form',
        'enableAjaxValidation' => false,
            ))
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'titulo') ?>
        <?= $form->textField($model, 'titulo', array('size' => 60, 'maxlength' => 100)) ?>
        <?= $form->error($model, 'titulo') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'percentual') ?>
        <?= $form->textField($model, 'percentual', array('size' => 10, 'maxlength' => 10)) ?>
        <?= $form->error($model, 'percentual') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'limitacao') ?>
        <?= $form->textField($model, 'limitacao') ?>
        <?= $form->error($model, 'limitacao') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'data_expiracao') ?>
        <?php
        $this->widget('CJuiDateTimePicker', array(
            'model' => $model,
            'language' => 'pt',
            'attribute' => 'data_expiracao',
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
        <?= $form->error($model, 'data_expiracao') ?>
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
    $(document).ready(function () {
        $('#CupomDesconto_percentual').mask('##0,00%', {reverse: true});
    });
</script>