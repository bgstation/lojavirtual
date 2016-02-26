<?php
/* @var $this BannerController */
/* @var $model Banner */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'banner-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('url' => '#', 'enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'imagem') ?>
        <?php
        if (!empty($model->imagem)) {
            echo "<div id='imagem'>";
            echo CHtml::image(Yii::app()->request->baseUrl . Yii::app()->params['diretorioImagensBanners'] . $model->imagem);
            echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/img/remove.png', 'Remover Imagem'), 'javascript:void(0)', array('id' => $model->id, 'campo' => 'imagem', 'class' => 'removeImagem'));
            echo "</div>";
        }
        ?>
        <?= $form->fileField($model, 'imagem', array('accept' => "image/*")) ?>
        <?= $form->error($model, 'imagem') ?>
        <?= $form->hiddenField($model, 'imagem') ?>
        <?= $form->hiddenField($model, 'imagem_excluida', array('id' => 'imagem_excluida')) ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'link') ?>
        <?= $form->textField($model, 'link', array('size' => 60, 'maxlength' => 200)) ?>
        <?= $form->error($model, 'link') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'ordem') ?>
        <?= $form->textField($model, 'ordem') ?>
        <?= $form->error($model, 'ordem') ?>
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
    $('.removeImagem').click(function () {
        $('#' + $(this).attr('campo')).css('display', 'none');
        $('#imagem_excluida').val('true');
    });
</script>