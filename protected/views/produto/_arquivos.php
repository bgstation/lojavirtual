<div class="well" id="div_exibe_arquivos">
    <h2>Arquivos</h2>
    <?= ArquivoHelper::renderArquivos($model) ?>
    <?php echo $form->hiddenField($model, 'finalizar_cadastro', array('id' => 'finalizar_cadastro')); ?>
</div>