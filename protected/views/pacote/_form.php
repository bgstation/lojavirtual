<script src="<?= Yii::app()->request->baseUrl ?>/js/jquery.mask.js" type="text/javascript"></script>
<script src="<?= Yii::app()->request->baseUrl ?>/js/funcoes_uteis.js" type="text/javascript"></script>
<?php
/* @var $this PacoteController */
/* @var $model Pacote */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pacote-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('url' => '#', 'enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <?= $form->labelEx($model, 'titulo') ?>
        <?= $form->textField($model, 'titulo', array('class' => 'span7')) ?>
        <?= $form->error($model, 'titulo') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'url_amigavel') ?>
        <?= $form->textField($model, 'url_amigavel', array('class' => 'span7')) ?>
        <?= $form->error($model, 'url_amigavel') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'descricao') ?>
        <?= $form->textArea($model, 'descricao', array('rows' => 6, 'cols' => 50, 'class' => 'span5')) ?>
        <?= $form->error($model, 'descricao') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'desconto') ?>
        <?= $form->textField($model, 'desconto', array('size' => 10, 'maxlength' => 10)) ?>
        <?= $form->error($model, 'desconto') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'video_apresentacao') ?>
        <?= $form->textField($model, 'video_apresentacao', array('size' => 60, 'maxlength' => 100)) ?>
        <?= $form->error($model, 'video_apresentacao') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'imagem') ?>
        <?php
        if (!empty($model->imagem)) {
            echo "<div id='imagem'>";
            echo CHtml::image(Yii::app()->request->baseUrl . Yii::app()->params['diretorioImagensProdutos'] . $model->imagem);
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
        <?= $form->labelEx($model, 'quantidade_visualizacao') ?>
        <?= $form->textField($model, 'quantidade_visualizacao') ?>
        <?= $form->error($model, 'quantidade_visualizacao') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'periodo_visualizacao') ?>
        <?= $form->textField($model, 'periodo_visualizacao') ?>
        <?= $form->error($model, 'periodo_visualizacao') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'destaque') ?>
        <?= $form->checkBox($model, 'destaque') ?>
        <?= $form->error($model, 'destaque') ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'excluido') ?>
        <?= $form->checkBox($model, 'excluido') ?>
        <?= $form->error($model, 'excluido') ?>
    </div>

    <div class="row buttons">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'success',
            'size' => 'medium',
            'buttonType' => 'submit',
            'label' => $model->isNewRecord ? 'Cadastrar' : 'Atualizar',
            'htmlOptions' => array(
                'id' => 'btn_cadastrar_pacote'
            ),
                )
        );
        ?>
    </div>
    <?php $this->endWidget() ?>
</div>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#Pacote_desconto').mask('##0,00%', {reverse: true});
    });

    $('.removeImagem').click(function () {
        $('#' + $(this).attr('campo')).css('display', 'none');
        $('#imagem_excluida').val('true');
    });

    $('#Pacote_titulo').change(function () {
        var texto = tratarString(this.value);
        $('#Pacote_url_amigavel').val(texto);
    });
</script>