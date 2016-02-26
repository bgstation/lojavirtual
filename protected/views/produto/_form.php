<p class="note">Os campos com <span class="required">*</span> são obrigatórios.</p>

<div class="well">

    <?= $form->errorSummary($model) ?>

    <?= $form->labelEx($model, 'titulo', array('id' => 'lbl_titulo')) ?>
    <?= $form->textField($model, 'titulo', array('class' => 'span7')) ?>
    <?= $form->error($model, 'titulo') ?>
    
    <?= $form->labelEx($model, 'url_amigavel', array('id' => 'lbl_url_amigavel')) ?>
    <?= $form->textField($model, 'url_amigavel', array('class' => 'span7')) ?>
    <?= $form->error($model, 'url_amigavel') ?>

    <?= $form->labelEx($model, 'descricao') ?>
    <?= $form->textArea($model, 'descricao', array('rows' => 6, 'class' => 'span7')) ?>
    <?= $form->error($model, 'descricao') ?>

    <?= $form->labelEx($model, 'video_apresentacao') ?>
    <?= $form->textField($model, 'video_apresentacao', array('class' => 'span7')) ?>
    <?= $form->error($model, 'video_apresentacao') ?>

    <?= $form->labelEx($model, 'quantidade_visualizacao') ?>
    <?= $form->textField($model, 'quantidade_visualizacao', array('class' => 'span2')) ?>
    <?= $form->error($model, 'quantidade_visualizacao') ?>

    <?= $form->labelEx($model, 'periodo_visualizacao') ?>
    <?= $form->textField($model, 'periodo_visualizacao', array('class' => 'span2')) ?>
    <?= $form->error($model, 'periodo_visualizacao') ?>

    <?= $form->labelEx($model, 'carga_horaria') ?>
    <?= $form->textField($model, 'carga_horaria', array('class' => 'span2')) ?>
    <?= $form->error($model, 'carga_horaria') ?>
    
    <?= $form->labelEx($model, 'valor') ?>
    <?= $form->textField($model, 'valor', array('class' => 'span2')) ?>
    <?= $form->error($model, 'valor') ?>
    
    <?= $form->labelEx($model, 'desconto') ?>
    <?= $form->textField($model, 'desconto', array('class' => 'span2')) ?>
    <?= $form->error($model, 'desconto') ?>

    <?= $form->labelEx($model, 'excluido') ?>
    <?= $form->checkBox($model, 'excluido') ?>
    <?= $form->error($model, 'excluido') ?>

    <?= $form->labelEx($model, 'tipo_produto') ?>
    <?= $form->dropDownList($model, 'tipo_produto', CMap::mergeArray(array('' => ''), $model->aTipoProduto)) ?>
    <?= $form->error($model, 'tipo_produto') ?>

    <?= $form->labelEx($model, 'materia_id') ?>
    <?= $form->dropDownList($model, 'materia_id', CMap::mergeArray(array('' => ''), CHtml::listData($oMateria, 'id', 'titulo'))) ?>
    <?= $form->error($model, 'materia_id') ?>

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

    <?= $form->hiddenField($model, 'finalizar_cadastro', array('id' => 'finalizar_cadastro')) ?>
</div>
<script type='text/javascript'>
    $(document).ready(function () {
        $('#select2_materia_id').css('width', '300px');
        $('#select2_tipo_produto').css('width', '300px');
        $('#Produto_valor').mask('R$ ####0,00', {reverse: true});
    });

    $('.removeImagem').click(function () {
        $('#' + $(this).attr('campo')).css('display', 'none');
        $('#imagem_excluida').val('true');
    });

    $('#Produto_titulo').change(function () {
        var texto = tratarString(this.value);
        $('#Produto_url_amigavel').val(texto);
    });

    function tratarString(str) {
        var rep = '-';
        str = str.toLowerCase().replace(/\s+/g, rep);

        var from = 'àáäâãèéëêìíïîõòóöôùúüûñç';
        var to = 'aaaaaeeeeiiiiooooouuuunc';
        for (var i = 0, l = from.length; i < l; i++) {
            str = str.replace(
                    new RegExp(from.charAt(i), 'g'),
                    to.charAt(i)
                    );
        }
        str = str.replace(/\+/g, '-');
        str = str.replace(/---/g, '-');
        str = str.replace('/', '-');
        str = str.replace(',', '');
        return str;
    }
</script>