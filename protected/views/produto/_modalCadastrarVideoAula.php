<div id="modalCadastrarVideoAula" class="modal hide fade" tabindex="-1" data-focus-on="input:first" style="left:33%;width:80%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4><?= Yii::t('Site', 'Arquivo'); ?></h4>
    </div>
    <div class="modal-body">
        <form action='<?= Yii::app()->createUrl('arquivo/cadastrarVariosArquivos') ?>' id='form-adicionar-multi-arquivos' method='POST'>
            
            <label for="modulo_arquivos">Módulo<span class="required">*</span></label>
            <?= CHtml::dropDownList('modulo_arquivos', '', CMap::mergeArray(array('' => ''), CHtml::listData($oModulo, 'id', 'titulo')), array('class' => 'span4')) ?>
            
            <button id='launch-modal-arquivos' class="btn" data-toggle="modal" href="#stack2-arquivos" alvo='http://199.193.119.78/getListFiles.html' style="padding:8px 12px;margin-bottom:10px;" title="Selecionar Arquivos">
                <i class="fa fa-folder-open"></i> Selecionar Arquivos
            </button>
            <br/>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" id="salvar_arquivos_modal">Salvar</button>
    </div>
</div>