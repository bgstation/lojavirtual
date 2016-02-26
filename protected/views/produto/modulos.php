<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/jquery-ui.css"/>
<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
    #sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
    html>body #sortable li { height: 1.5em; line-height: 1.2em; }
    .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
    #navegacao_passos {
        position: static; left: 0; width: 100%; margin-bottom: 1em;
    }
    #adicionar_modulo{
        margin-right: 10px;
    }
</style>

<?php
$nomeTela = empty($model->id) ? 'Cadastrar' : 'Atualizar';
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Produtos' => Yii::app()->createUrl('produto/admin'),
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
        'id' => 'wizard-processo-alvo-filtro',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('url' => '#'),
    ));
    ?>
    <div class="span12">
        <?php
        $this->renderPartial('_modulos', array(
            'form' => $form,
            'model' => $model,
            'modulo' => $modulo,
        ));
        ?>
    </div>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'buttonType' => 'submit',
        'label' => 'Próximo',
        'htmlOptions' => array('class' => 'pull-right',),
            )
    );

    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'buttonType' => 'button',
        'label' => 'Novo Módulo',
        'htmlOptions' => array('id' => 'adicionar_modulo', 'class' => 'pull-right', 'data-toggle' => 'modal', 'data-target' => "#myModal"),
            )
    );

    if (isset($model->id)) {
        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'success',
            'size' => 'medium',
            'buttonType' => 'submit',
            'label' => 'Finalizar',
            'htmlOptions' => array('class' => 'pull-right', 'id' => 'btn_finalizar'),
                )
        );
    }
    $this->endWidget();
    ?>
</div>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')) ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4><?= Yii::t('Site', 'Editar Módulo') ?></h4>
</div>
<div class="modal-body">
    <form>
        <input type="hidden" id="modulo_id" />    
        <label for="titulo">Título<span class="required">*</span></label>
        <?= CHtml::textField('titulo', '', array('id' => 'titulo', 'class' => 'span4')) ?>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" id="fechar_modal_modulo" data-dismiss="modal">Fechar</button>
    <button type="button" class="btn btn-success" id="salvar_modulo_modal">Salvar</button>
</div>
<?php $this->endWidget() ?>
<script type="text/javascript">
    var moduloId;
    function limparFormulario() {
        $('#modulo_id').val('');
        $('#titulo').val('');
    }

    function validarFormulario() {
        erro = '';
        var titulo = $('#titulo').val();
        if (titulo == '' || titulo.trim() == '') {
            erro = 'O título deve ser preenchido \n';
        }
        if (erro != '') {
            alert(erro);
            return false;
        }
        return true;
    }

    var ordernar = function () {
        var data = "";

        $("#sortable li").each(function (i, el) {
            var modulo_id = $(this).attr('modulo_id');
            data += modulo_id + "-" + $(el).index() + ";";
        });
        
        $.ajax({
            url: '<?= Yii::app()->createUrl('modulo/alterarOrdem') ?>',
            type: 'POST',
            data: {
                ordem: data.slice(0, -1),
            },
            success: function (data) {
            }
        });
    }

    function ordenaItens() {
        $("#sortable").sortable({
            placeholder: "ui-state-highlight",
            stop: function (event, ui) {
                ordernar();
            }
        });
        $("#sortable").disableSelection();
    }

    $('.editar_modulo').live("click", function () {
        limparFormulario();
        $.ajax({
            url: '<?= Yii::app()->createUrl('modulo/getModulo') ?>',
            type: 'GET',
            data: {
                modulo_id: $(this).attr('modulo_id')
            }, success: function (data) {
                var obj = JSON.parse(data);
                $('#modulo_id').val(obj.id);
                $('#titulo').val(obj.titulo);
            }
        });
    });

    var excluirModulo = function (moduloId) {
        $.ajax({
            url: '<?= Yii::app()->createUrl('modulo/delete') ?>',
            type: 'GET',
            data: {
                id: moduloId
            }, success: function (data) {
                alert('Módulo excluido com sucesso');
                location.reload();
            }
        });
    };

    $('.excluir_modulo').live("click", function () {
        excluirModulo($(this).attr('modulo_id'));
        return false;
    });

    $('#adicionar_modulo').on("click", function () {
        limparFormulario();
    });

    $('#salvar_modulo_modal').click(function () {
        if (!validarFormulario()) {
            return false;
        }
        moduloId = $(this).attr('modulo_id');
        salvarModulo();
        $('#fechar_modal_modulo').click();
        return false;
    });

    var salvarModulo = function () {
        $('#salvar_modulo_modal').attr('disabled', 'disabled');
        var moduloId;
        if ($('#modulo_id').val() != '') {
            moduloId = $('#modulo_id').val();
        }
        $.ajax({
            url: '<?= Yii::app()->createUrl('modulo/salvarModuloModal') ?>',
            type: 'POST',
            data: {
                modulo_id: moduloId,
                titulo: $('#titulo').val(),
                produto_id: '<?= $model->id ?>'
            }, success: function (data) {
                var obj = JSON.parse(data);
                if (obj.status == 'ok') {
                    alert('Salvo com sucesso');
                    $('#myModal').modal('hide');
                    window.location.reload();
                } else {
                    alert('Erro ao salvar');
                }
                $('#salvar_modulo_modal').removeAttr('disabled');
            }
        });
    };

    $(function () {
        ordenaItens();
    });

    $('#btn_finalizar').click(function () {
        $('#finalizar_cadastro').val('true');
    });
</script>