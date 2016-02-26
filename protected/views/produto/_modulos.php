<div class="well"  id="div_exibe_modulos_produto">
    <h2>Módulos</h2>
    <?= ModuloHelper::renderModulos($model) ?>
    <br><br>
    <?php echo $form->hiddenField($model, 'finalizar_cadastro', array('id' => 'finalizar_cadastro')); ?>
</div>