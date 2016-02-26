<?php

class LeadHelper {

    public static function renderUsuarios($oUsuarios) {
        $return = '';
        foreach ($oUsuarios as $usuario) {
            $return .= '<tr>
                            <td>
                                ' . $usuario->nome . '
                            </td>
                            <td>
                                ' . $usuario->email . '
                            </td>
                            <td>
                                ' . $usuario->cliente->telefone . '
                            </td>
                            <td>
                                ' . date('d/m/Y H:i:s', strtotime($usuario->data_cadastro)) . '
                            </td>
                            <!--<td class="hidden-phone">
                                <div class="btn-group" id="acoes">
                                  <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                                    Ações 
                                    <span class="caret">
                                    </span>
                                  </button>
                                  <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="#">
                                          Detalhes
                                        </a>
                                    </li>
                                    <li>
                                      <a href="#">
                                        Editar
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                            </td>-->
                        </tr>';
        }
        return $return;
    }

    public static function renderCarrinho($oCarrinho) {
        $return = '<div class="row-fluid" style="margin-bottom: 40px">
                        <div class="control-group">
                            <div class="controls label-detalhes">
                                <h4>Cursos não finalizados no carrinho</h4>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div id="dt_example" class="example_alt_pagination">
                                <table class="table table-condensed table-striped table-hover table-bordered pull-left data-table-campanha-resultados">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Valor Item</th>
                                            <th>Usuário</th>
                                            <th>Data Operação</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
        foreach ($oCarrinho as $carrinho) {
            if (empty($carrinho->id)) {
                continue;
            }
            if (!empty($carrinho->pacote_id)) {
                $item = $carrinho->pacote->titulo;
            } else {
                $item = !empty($carrinho->produto->titulo) ? $carrinho->produto->titulo : $carrinho->produto->biblioteca->titulo;
            }
            $return .= '<tr>
                            <td>
                                ' . $item . '
                            </td>
                            <td>
                                R$ ' . number_format($carrinho->valor_item, 2, ',', '.') . '
                            </td>
                            <td>
                                ' . $carrinho->usuario->nome . '
                            </td>
                            <td>
                                ' . date('d/m/Y H:i:s', strtotime($carrinho->data_operacao)) . '
                            </td>
                            <td class="hidden-phone">
                                <div class="btn-group" id="acoes">
                                  <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                                    Ações 
                                    <span class="caret">
                                    </span>
                                  </button>
                                  <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="#" class="exibe_detalhes_carrinho" data-toggle="modal" data-target="#modalDetalhesCarrinho" carrinho_id="' . $carrinho->id . '">
                                          Detalhes
                                        </a>
                                    </li>
                                  </ul>
                                </div>
                            </td>
                        </tr>';
        }
        $return .= '</tbody>
                    </table>
                </div>
            </div>
        </div>';
        return $return;
    }

    public static function renderPedidos($oPedidos, $titulo = null, $pedidoGratuito = false) {
        $return = '<div id="div-pedidos-por-campanha" class="row-fluid" style="margin-bottom: 40px">
                        <div class="control-group">
                            <div class="controls label-detalhes">
                                <b>' . $titulo . '</b>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div id="dt_example" class="example_alt_pagination">
                                <table class="table table-condensed table-striped table-hover table-bordered pull-left">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Usuário</th>';
        if (!$pedidoGratuito) {
            $return .= '<th>Valor</th>
                        <th>Status</th>';
        }
        $return .= '<th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($oPedidos as $pedido) {
            $oTipoStatus = TipoStatusPagamento::model()->findByPk($pedido->tipo_status_pagamento_id);
            $status = '<span class="label label label-warning label_status_pedido">Não Finalizado</span>';
            if (!empty($oTipoStatus)) {
                if (in_array($oTipoStatus->id, array(1, 2))) {
                    $status = '<span class="label label label-info label_status_pedido">' . $oTipoStatus->titulo . '</span>';
                } else if ($oTipoStatus->id == 3) {
                    $status = '<span class="label label label-success label_status_pedido">Paga</span>';
                } else if ($oTipoStatus->id == 7) {
                    $status = '<span class="label label label-important label_status_pedido">Cancelado</span>';
                }
            }
            $statusPedido = 'status-pedido-' . 0;
            if (!empty($oTipoStatus->id)) {
                $statusPedido = 'status-pedido-' . $oTipoStatus->id;
            }
            $return .= '<tr>
                            <td>
                                ' . $pedido->id . '
                            </td>
                            <td>
                                ' . $pedido->usuario->nome . '
                            </td>';
            if (!$pedidoGratuito) {
                $return .= '<td>
                                ' . number_format(ProdutoPedido::getValorTotalPedidoComDesconto($pedido->id), 2, ',', '.') . '
                            </td>
                            <td>
                                ' . $status . '
                            </td>';
            }
            $return .= '<td>
                            ' . date('d/m/Y H:i:s', strtotime($pedido->data_pedido)) . '
                        </td>
                        <td class="hidden-phone">
                            <div class="btn-group" id="acoes">
                              <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                                Ações 
                                <span class="caret">
                                </span>
                              </button>
                              <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="#" class="exibe_detalhes_pedido" data-toggle="modal" data-target="#modalDetalhesPedido" pedido_id="' . $pedido->id . '">
                                      Detalhes
                                    </a>
                                </li>
                              </ul>
                            </div>
                        </td>
                    </tr>';
        }
        $return .='</tbody>
                </table>
            </div>
        </div>
    </div>';

        return $return;
    }

}
