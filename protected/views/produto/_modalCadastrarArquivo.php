<div id="myModal" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4><?= Yii::t('Site', 'Arquivo'); ?></h4>
    </div>
    <div class="modal-body">
        <form>
            <input type="hidden" id="arquivo_id" />
            
            <label for="modulo">Módulo<span class="required">*</span></label>
            <?= CHtml::dropDownList('modulo', '', CMap::mergeArray(array('' => ''), CHtml::listData($oModulo, 'id', 'titulo')), array('id' => 'modulo', 'class' => 'span4')) ?>
            
            <label for="titulo">Título<span class="required">*</span></label>
            <?= CHtml::textField('titulo', '', array('id' => 'titulo', 'class' => 'span4')) ?>
            
            <label for="tipo_arquivo">Tipo do Arquivo<span class="required">*</span></label>
            <?= CHtml::dropDownList('tipo_arquivo', '', CMap::mergeArray(array('' => ''), $aTipoArquivo), array('id' => 'tipo_arquivo', 'class' => 'span4')) ?>
            
            <br/>
            <?= '<div id="div_arquivo_selecionado"><b>Arquivo: <span class="arquivo_selecionado"></span></b></div>'; ?>
        </form>

        <div id="div_seleciona_arquivos_upload">
            <button type="button" class="btn btn-link novo_arquivo">Novo Arquivo</button>
            <div id="toggle">
                <form id="myForm" action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="arquivo" id="arquivo" accept="application/pdf" />
                    <br/>
                    <input type="submit" value="Enviar Arquivo" id="enviar_arquivo">
                </form>
                <div id="progress">
                    <div id="bar"></div>
                    <div id="percent">0%</div >
                </div>
            </div>
        </div>

        <div id="div_caminho_arquivo">
            <label for='arquivo'>Arquivo</label>
            <?= CHtml::textField('arquivo', '', array('id' => 'caminho_arquivo', 'class' => 'span5')) ?>
            
            <label for='carga_horaria'>Carga Horária</label>
            <?= CHtml::textField('carga_horaria', '', array('id' => 'carga_horaria_arquivo', 'class' => 'span2')) ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" id="fechar_modal_arquivo" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" id="salvar_arquivo_modal">Salvar</button>
    </div>
</div>