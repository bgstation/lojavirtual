<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Meus Pedidos</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">Home</a></li>
                    <li class="active">Meus Pedidos</li>
                </ol>
            </div>
        </div>

        <div class="row meus-pedidos">

            <?php if (!empty($oPedidos)) : ?>
                <?php foreach ($oPedidos as $pedido) : ?>
                    <div class="col-md-6 col-sm-6">
                        <h3>Pedido: <?= $pedido->id ?></h3>
                        <h5>Status: <?= $pedido->aStatus[$pedido->status_pagamento] ?></h5>
                        <h5>Data: <?= FormatHelper::dataHora($pedido->datahora_insercao) ?></h5>
                        <h5>Cupom de Desconto: <?= !empty($pedido->cupomDescontoUsuario) ? $pedido->cupomDescontoUsuario->cupom->titulo : 'Nenhum cupom de desconto utilizado.' ?></h5>
                        <h5>Valor do Pedido: R$ <?= FormatHelper::valorMonetario($pedido->getValorTotal()) ?></h5>
                        <h5>Produtos:</h5>
                        <ul>
                            <?php
                            $aPacotesJaExibidos = array();
                            foreach ($pedido->produtos as $produtoPedido) {
                                if (!empty($produtoPedido->pacote_id) && !in_array($produtoPedido->pacote_id, $aPacotesJaExibidos)) {
                                    $aPacotesJaExibidos[] = $produtoPedido->pacote_id;
                                    echo '<li>' . $produtoPedido->pacote->titulo . ' - R$ ' . FormatHelper::valorMonetario($produtoPedido->getValorPacote());
                                    if (!empty($produtoPedido->data_expiracao)) {
                                        echo ' <br/> Data de expiração: ' . FormatHelper::dataHora($produtoPedido->data_expiracao);
                                    }
                                    echo '</li>';
                                } else if (empty($produtoPedido->pacote_id)) {
                                    echo '<li>' . $produtoPedido->produto->titulo . ' - R$ ' . FormatHelper::valorMonetario($produtoPedido->valor);
                                    if (!empty($produtoPedido->data_expiracao)) {
                                        echo ' <br/> Data de expiração: ' . FormatHelper::dataHora($produtoPedido->data_expiracao);
                                    }
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Você não possui pedidos realizados.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

