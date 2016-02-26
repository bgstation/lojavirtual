<link href="<?= Yii::app()->request->baseUrl ?>/css/video_responsive.css" rel="stylesheet" />
<div class="modal fade" id="modalVisualizarVideoAula" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" style="color:#000;">Visualizar Vídeo Aula</h5>
            </div>
            <div class="modal-body">
                <div class="videoWrapper">
                    <iframe width="560" height="349" src="" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-default" id="btn_fechar" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
