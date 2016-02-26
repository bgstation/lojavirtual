<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery-ui.css') ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/views/arquivo.css') ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.form.js') ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.mask.js') ?>

<?php
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Produtos' => Yii::app()->createUrl('produto/admin'),
        empty($model->id) ? 'Cadastrar' : 'Atualizar' => '',
        $model->titulo
    ),
));

$this->widget('fidelize.widgets.wizard.FWizard', array(
    'tabs' => $tabs,
    'activeTab' => $activeTab,
    'params' => !$model->isNewRecord ? array('id' => $model->id) : null,
));
?>

<div class="row-fluid wizard-content">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'arquivos',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('url' => '#', 'class' => 'form-horizontal'),
    ));
    ?>
    <div class="span12">
        <?php
        $this->renderPartial('_arquivos', array(
            'form' => $form,
            'model' => $model,
        ));
        ?>
    </div>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'buttonType' => 'button',
        'label' => 'Novo Arquivo',
        'htmlOptions' => array('id' => 'adicionar_arquivo', 'class' => 'pull-right', 'data-toggle' => 'modal', 'data-target' => '#myModal'),
            )
    );

    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'buttonType' => 'submit',
        'label' => "Finalizar",
        'htmlOptions' => array('class' => 'pull-right', 'id' => 'btn_finalizar'),
            )
    );
    $this->endWidget();
    ?>
</div>


<?php $this->renderPartial('_modalCadastrarVideoAula', array('oModulo' => $oModulo)) ?>
<?php $this->renderPartial('_modalCadastrarArquivo', array('oModulo' => $oModulo, 'aTipoArquivo' => $aTipoArquivo)) ?>
<?php $this->renderPartial('_modalVisualizarVideoAula') ?>

<div id="stack2" class="modal hide fade" tabindex="-1" data-focus-on="input:first" style='width:860px;left:40%;'>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Seleção de arquivo</h3>
    </div>
    <div class="modal-body modal-stack2" style='height:100%;'></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    </div>
</div>

<div id="stack2-arquivos" class="modal hide fade" tabindex="-1" data-focus-on="input:first" style='width:860px;left:40%;'>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Seleção de arquivos</h3>
    </div>
    <div class="modal-body modal-stack2-arquivos" style='height:100%;'></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    </div>
</div>

<script type="text/javascript">
    var nomeArquivoEnviado;
    var arquivoId;
    var acao;
    $(document).ready(function () {
        $('#carga_horaria_arquivo').mask('00:00:00');
        $('#toggle').css('display', 'none');
        $(".novo_arquivo").click(function () {
            $("#toggle").toggle("slow");
        });
    });

    $('#salvar_arquivos_modal').click(function () {
        $('.form-arquivo').each(function () {
            var erro = '';
            if ($(this).find('#titulo_arquivos').val() == '') {
                erro += 'O título de todos os arquivos deve estar preenchido. \n\n';
            }
            if ($(this).find('#caminho_arquivos').val() == '') {
                erro += 'O caminho de todos os arquivos deve estar preenchido. \n\n';
            }
            if (erro != '') {
                alert(erro);
                return false;
            }
        });
        $('#form-adicionar-multi-arquivos').submit();
    });

    // UPLOAD ARQUIVOS INDIVIDUAIS //
    $('[data-dismiss="modal"]').on('click', function () {
        $('#stack2').modal('hide');
    });

    $('#launch-modal').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('alvo');
        $(".modal-stack2").html('<iframe id="iframe_arquivos" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="' + url + '"></iframe>');
    });

    $('#stack2').on('show.bs.modal', function () {
        $(this).find('.modal-dialog').css({
            width: '40%x',
            height: '100%',
            padding: '0'
        });
        $(this).find('.modal-content').css({
            height: '100%',
            'border-radius': '0',
            padding: '0'
        });
        $(this).find('.modal-body').css({
            width: 'auto',
            height: '100%',
            padding: '0'
        });
    });
    // UPLOAD ARQUIVOS INDIVIDUAIS //


    // UPLOAD MULTI ARQUIVOS //
    $('[data-dismiss="modal"]').on('click', function () {
        $('#stack2-arquivos').modal('hide');
    });

    $('#launch-modal-arquivos').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('alvo');
        $(".modal-stack2-arquivos").html('<iframe id="iframe_arquivos" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="' + url + '"></iframe>');
    });

    $('#stack2-arquivos').on('show.bs.modal', function () {
        $(this).find('.modal-dialog').css({
            width: '40%x',
            height: '100%',
            padding: '0'
        });
        $(this).find('.modal-content').css({
            height: '100%',
            'border-radius': '0',
            padding: '0'
        });
        $(this).find('.modal-body').css({
            width: 'auto',
            height: '100%',
            padding: '0'
        });
    });
    // UPLOAD MULTI ARQUIVOS //

    $('#btn_finalizar').click(function () {
        $('#finalizar_cadastro').val('true');
    });

    $('#enviar_arquivo').click(function () {
        var options = {
            beforeSend: function () {
                $("#progress").show();
                $("#bar").width('0%');
                $("#message").html("");
                $("#percent").html("0%");
            },
            uploadProgress: function (event, position, total, percentComplete) {
                $("#bar").width(percentComplete + '%');
                $("#percent").html(percentComplete + '%');
            },
            success: function (data) {
                $("#bar").css('background-color', '#B4F5B4');
                $("#bar").width('100%');
                $("#percent").html('100%');
                nomeArquivoEnviado = data;
            },
            complete: function (response) {
                $("#message").html("<font color='green'>" + response.responseText + "</font>");
            },
            error: function () {
                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");
            }
        };
        $("#myForm").ajaxForm(options);
    });

    function limparFormulario() {
        $('#arquivo_id').val('');
        $('#modulo').val('');
        $('#titulo').val('');
        $('#arquivo').val('');
        $('#tipo_arquivo').val('');
        $('#percent').html('');
        $('#message').html('');
        $('#caminho_arquivo').val('');
        $('#carga_horaria_arquivo').val('');
        $('#bar').css('background-color', 'white');
        $('.arquivo_selecionado').html('');
    }

    function validarFormulario() {
        erro = '';
        var titulo = $('#titulo').val();
        if ($('#modulo').val() == '') {
            erro = 'O módulo deve ser preenchido \n';
        }
        if (titulo == '' || titulo.trim() == '') {
            erro += 'O título deve ser preenchido \n';
        }
        if ($('#tipo_arquivo').val() == '') {
            erro += 'O tipo do arquivo deve ser preenchido \n';
        }
        if (erro != '') {
            alert(erro);
            return false;
        }
        return true;
    }

    function ordenaItens() {
        $(".sortable").sortable({
            placeholder: "ui-state-highlight",
            stop: function (event, ui) {
                var data = "";

                $(this).find('li').each(function (i, el) {
                    var arquivo_id = $(this).attr('arquivo_id');
                    data += arquivo_id + "-" + $(el).index() + ";";
                });

                $.ajax({
                    url: '<?= Yii::app()->createUrl('arquivo/alterarOrdem'); ?>',
                    type: 'POST',
                    data: {
                        ordem: data.slice(0, -1)
                    },
                    success: function (data) {
                    }
                });
            }
        });
        $(".sortable").disableSelection();
    }

    function exibirModalArquivo() {
        limparFormulario();
        verificaExibicaoCamposArquivo();
        $('#toggle').css('display', '');
    }

    $('.editar_arquivo').live("click", function () {
        limparFormulario();
        $.ajax({
            url: '<?= Yii::app()->createUrl('arquivo/getArquivo') ?>',
            type: 'GET',
            data: {
                arquivo_id: $(this).attr('arquivo_id')
            }, success: function (data) {
                var obj = JSON.parse(data);
                $('#arquivo_id').val(obj.id);
                $('#titulo').val(obj.titulo);
                $('#modulo').val(obj.modulo);
                $('#tipo_arquivo').val(obj.tipo_arquivo);
                if (obj.tipo_arquivo == 1) {
                    $('.arquivo_selecionado').html(obj.arquivo);
                } else {
                    $('#caminho_arquivo').val(obj.arquivo);
                    $('#carga_horaria_arquivo').val(obj.carga_horaria);
                }
                verificaExibicaoCamposArquivo();
            }
        });
    });

    var excluirArquivo = function (arquivoId) {
        $.ajax({
            url: '<?= Yii::app()->createUrl('arquivo/delete') ?>',
            type: 'GET',
            data: {
                id: arquivoId
            }, success: function (data) {
                alert('Arquivo excluido com sucesso');
                location.reload();
            }
        });
    }

    $('.excluir_arquivo').live("click", function () {
        arquivoId = $(this).attr('arquivo_id');
        acao = 'excluir';
        excluirArquivo(arquivoId);
        return false;
    });

    $('.adicionar_arquivos').live('click', function () {
        $('#modulo_arquivos').val($(this).attr('modulo_id'));
    });

    $('#adicionar_arquivo').live("click", function () {
        exibirModalArquivo();
    });

    var salvarArquivo = function () {
        $('#salvar_arquivo_modal').attr('disabled', 'disabled');
        var arquivoId;
        var cargaHorariaArquivo = '';
        if ($('#arquivo_id').val() != '') {
            arquivoId = $('#arquivo_id').val();
        }

        if (nomeArquivoEnviado == null && $('#tipo_arquivo').val() != 1) {
            nomeArquivoEnviado = $('#caminho_arquivo').val();
            cargaHorariaArquivo = $('#carga_horaria_arquivo').val();
        }
        $.ajax({
            url: '<?= Yii::app()->createUrl('arquivo/salvarArquivoModal') ?>',
            type: 'POST',
            data: {
                arquivo_id: arquivoId,
                modulo: $('#modulo').val(),
                titulo: $('#titulo').val(),
                arquivo: nomeArquivoEnviado,
                carga_horaria: cargaHorariaArquivo,
                tipo_arquivo: $('#tipo_arquivo').val(),
            }, success: function (data) {
                var obj = JSON.parse(data);
                if (obj.status == 'ok') {
                    alert('Salvo com sucesso');
                    $('#myModal').modal('hide');
                    window.location.reload();
                } else {
                    alert('Erro ao salvar');
                }
                $('#salvar_arquivo_modal').removeAttr('disabled');
            }
        });
    };

    $('#salvar_arquivo_modal').click(function () {
        if (!validarFormulario()) {
            return false;
        }
        arquvioId = $(this).attr('arquivo_id');
        acao = 'salvar';
        salvarArquivo();
        $('#fechar_modal_arquivo').click();
        return false;
    });

    $(function () {
        ordenaItens();
    });

    function verificaExibicaoCamposArquivo() {
        if ($('#tipo_arquivo').val() == '') {
            $('#div_seleciona_arquivos_upload').css('display', 'none');
            $('#arquivo').attr('disabled', 'disabled');
            $('#div_arquivo_selecionado').css('display', 'none');
            $('#div_caminho_arquivo').css('display', 'none');
        }
        // Caso não seja PDF
        else if ($('#tipo_arquivo').val() != 1) {
            $('#div_seleciona_arquivos_upload').css('display', 'none');
            $('#arquivo').attr('disabled', 'disabled');
            $('#div_arquivo_selecionado').css('display', 'none');
            $('#div_caminho_arquivo').css('display', '');
            nomeArquivoEnviado = null;
        } else {
            if ($('.arquivo_selecionado').html() == '') {
                $('#div_arquivo_selecionado').css('display', 'none');
                $('#toggle').css('display', '');
            } else {
                $('#div_arquivo_selecionado').css('display', '');
                $('#toggle').css('display', 'none');
            }

            $('#div_caminho_arquivo').css('display', 'none');
            $('#div_seleciona_arquivos_upload').css('display', '');
            $('#arquivo').removeAttr('disabled');
        }
    }

    $('#tipo_arquivo').change(function () {
        if ($(this).val() == '') {
            $('#div_seleciona_arquivos_upload').css('display', 'none');
            $('#arquivo').attr('disabled', 'disabled');
            $('#div_arquivo_selecionado').css('display', 'none');
            $('#div_caminho_arquivo').css('display', 'none');
        }
        // Caso não seja PDF
        else if ($(this).val() != 1) {
            $('#div_seleciona_arquivos_upload').css('display', 'none');
            $('#arquivo').attr('disabled', 'disabled');
            $('#div_arquivo_selecionado').css('display', 'none');
            $('#div_caminho_arquivo').css('display', '');
            nomeArquivoEnviado = null;
        } else {
            if ($('.arquivo_selecionado').html() == '') {
                $('#div_arquivo_selecionado').css('display', 'none');
                $('#toggle').css('display', '');
            } else {
                $('#div_arquivo_selecionado').css('display', '');
                $('#toggle').css('display', 'none');
            }

            $('#div_caminho_arquivo').css('display', 'none');
            $('#div_seleciona_arquivos_upload').css('display', '');
            $('#arquivo').removeAttr('disabled');
        }
    });

    $('.visualizar_video_aula').click(function () {
        $('#modalVisualizarVideoAula iframe').attr('src', $(this).attr('caminho_arquivo'));
    });

    $('#modalVisualizarVideoAula').on('hidden.bs.modal', function () {
        $('#modalVisualizarVideoAula iframe').attr('src', '');
    });
</script>