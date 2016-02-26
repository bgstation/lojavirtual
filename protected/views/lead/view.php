<?php
/* @var $this LeadController */
/* @var $model Lead */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Leads' => Yii::app()->createUrl('lead/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Lead: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'titulo',
        array(
            'name' => 'data_inicio',
            'value' => FormatHelper::dataHora($model->data_inicio),
        ),
        array(
            'name' => 'data_fim',
            'value' => FormatHelper::dataHora($model->data_fim),
        ),
        array(
            'name' => 'url_destino',
            'type' => 'raw',
            'value' => '<a href="' . $model->url_destino . '" target="_blank">' . $model->url_destino . '</a>'
        ),
        array(
            'name' => 'excluido',
            'value' => $model->excluido ? 'Sim' : 'Não',
        ),
        array(
            'name' => 'datahora_insercao',
            'value' => FormatHelper::dataHora($model->datahora_insercao),
        ),
        array(
            'name' => 'datahora_ultima_atualizacao',
            'value' => FormatHelper::dataHora($model->datahora_ultima_atualizacao),
        ),
    ),
));
?>

<h4>Resultados</h4>
<div class="container">
    <div class="row">
        <div class="col-md-6 resumo-leads">
            <div class="panel with-nav-tabs panel-default" style="font-size:14px;background-color:#fff;border-color:#ddd;border:1px solid transparent;">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-geral" data-toggle="tab">Geral</a></li>
                        <li><a href="#tab-cadastro" data-toggle="tab">Cadastros</a></li>
                        <li><a href="#tab-carrinho" data-toggle="tab">Carrinho</a></li>
                        <li><a href="#tab-pedido" data-toggle="tab">Pedidos</a></li>
                    </ul>
                </div>
                <div class="panel-body" style="margin-bottom:300px;">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-geral">
                            <div class="control-group">
                                <h4>Total de Acessos: <?= count($oLogLead) ?></h4>
                                <div id="chart_div"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-cadastro">
                            <div class="control-group">
                                <div class="controls label-detalhes">
                                    <h4>Usuários Cadastrados</h4>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div id="dt_example" class="example_alt_pagination">
                                    <table class="table table-condensed table-striped table-hover table-bordered pull-left data-table-campanha-resultados">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Data do Cadastro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?= LeadHelper::renderUsuarios($oUsuarios) ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-carrinho">
                            <?= LeadHelper::renderCarrinho($oCarrinho) ?>
                        </div>
                        <div class="tab-pane fade" id="tab-pedido">
                            <h4>Pedidos</h4>
                            <div id="list-pedidos-por-campanha">
                                <?= LeadHelper::renderPedidos($oPedidos) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart', 'timeline']}]}"></script>
<script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart']});
            google.setOnLoadCallback(drawChart);
            function drawChart() {

            var data = new google.visualization.DataTable();
                    data.addColumn('date', 'Time of Day');
                    data.addColumn('number', 'Total de Acessos');
                    data.addRows([<?= $oLogsLeads ?>]);
                    var options = {
                    title: 'Acessos à <?= $model->titulo ?> no período de <?= date('d/m/Y', strtotime($model->data_inicio)) ?> à <?= date('d/m/Y', strtotime($model->data_fim)) ?>',
                            width: 900,
                            height: 500,
                            hAxis: {
                            format: 'd/M/yy',
                                    gridlines: {count: 15}
                            },
                            vAxis: {
                            gridlines: {color: 'none'},
                                    minValue: 0
                            }
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
            }

    $(document).ready(function () {
    $('.link-status-pedido').click(function () {
    var statusPedido = $(this).attr('status_pedido');
            $.ajax({
            url: '<?= Yii::app()->createUrl('pedido/getPedidosPorCampanha') ?>',
                    type: 'GET',
                    data: {
                    id: <?= $model->id ?>,
                            status_pedido: statusPedido,
                            utm_source: '<?= !empty($_GET['utm_source']) ? implode(',', $_GET['utm_source']) : '' ?>',
                            utm_medium: '<?= !empty($_GET['utm_medium']) ? implode(',', $_GET['utm_medium']) : '' ?>'
                    },
                    success: function (data) {
                    $('#list-pedidos-por-campanha').html(data);
                    }
            });
    });
            $('#example').DataTable({
    "bPaginate": false,
            oLanguage: {
            "oPaginate": {
            "sFirst": "Primeiro",
                    "sLast": "Último",
                    "sNext": "Próximo",
                    "sPrevious": "Anterior"
            },
                    "sEmptyTable": "Não foram encontrados registros",
                    "sInfo": "Exibindo _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Exibindo 0 até 0 de 0 registros",
                    "sInfoFiltered": "(filtrando de _MAX_ registros)",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Exibir _MENU_ registros",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sSearch": "Pesquisa:",
                    "sZeroRecords": "Não foram encontrados registros"
            }
    });
            $('.dados-carrinho').css('display', 'none');
            $('.dados-pedidos').css('display', 'none');
            $('.link-cadastros').click(function () {
    $('.dados-pedidos').css('display', 'none');
            $('.dados-carrinho').css('display', 'none');
            $('.dados-cadastros').css('display', '');
    });
            $('.link-carrinho').click(function () {
    $('.dados-pedidos').css('display', 'none');
            $('.dados-cadastros').css('display', 'none');
            $('.dados-carrinho').css('display', '');
    });
            $('.link-pedidos').click(function () {
    $('.dados-cadastros').css('display', 'none');
            $('.dados-carrinho').css('display', 'none');
            $('.dados-pedidos').css('display', '');
    });
    });
            $('.exibe_detalhes_pedido').click(function () {
    if ($(this).attr('pedido_id') == '') {
    alert('Erro ao acessar dados dos pedido.');
            return false;
    }
    $.ajax({
    url: '<?= Yii::app()->createUrl('pedido/getDados') ?>',
            type: 'GET',
            data: {
            id: $(this).attr('pedido_id')
            },
            success: function (data) {
            var obj = JSON.parse(data);
                    var produtos = '';
                    var pedido = '';
                    var usuario = '';
                    $.each(obj.produtos, function (index, value) {
                    produtos += '<li>' + value.titulo + ' - R$ ' + value.valor + '</li>';
                    });
                    $('.pedido_id').html(obj.pedido.id);
                    pedido += '<li>Data: ' + obj.pedido.data_pedido + '</li>';
                    pedido += '<li>Status: ' + obj.pedido.status + '</li>';
                    usuario += '<li>Nome: ' + obj.usuario.nome + '</li>';
                    usuario += '<li>Email: ' + obj.usuario.email + '</li>';
                    usuario += '<li>Telefone: ' + obj.usuario.telefone + '</li>';
                    if (obj.usuario.celular != '') {
            usuario += '<li>Celular: ' + obj.usuario.celular + '</li>';
            }

            $('#dados_pedido').html(pedido);
                    $('#dados_usuario').html(usuario);
                    $('#produtos_pedido').html(produtos);
            }
    });
    });
            $('.exibe_detalhes_carrinho').click(function () {
    if ($(this).attr('carrinho_id') == '') {
    alert('Erro ao acessar dados do carrinho.');
            return false;
    }
    $.ajax({
    url: '<?= Yii::app()->createUrl('carrinhoCompra/getDados') ?>',
            type: 'GET',
            data: {
            id: $(this).attr('carrinho_id')
            },
            success: function (data) {
            var obj = JSON.parse(data);
                    var produtos = '';
                    var carrinho = '';
                    var usuario = '';
                    produtos += '<li>' + obj.produto.titulo + ' - R$ ' + obj.produto.valor + '</li>';
                    carrinho += '<li>Data da Operação: ' + obj.carrinho.data_operacao + '</li>';
                    usuario += '<li>Nome: ' + obj.usuario.nome + '</li>';
                    usuario += '<li>Email: ' + obj.usuario.email + '</li>';
                    usuario += '<li>Telefone: ' + obj.usuario.telefone + '</li>';
                    if (obj.usuario.celular != '') {
            usuario += '<li>Celular: ' + obj.usuario.celular + '</li>';
            }

            $('#carrinho_dados_carrinho').html(carrinho);
                    $('#carrinho_dados_usuario').html(usuario);
                    $('#carrinho_produtos_carrinho').html(produtos);
            }
    });
    });
</script>