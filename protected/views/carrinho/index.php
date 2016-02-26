<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Carrinho</h2>
            </div>
        </div>
    </div>
</div>

<?= SiteHelper::renderFlashMessage() ?>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">Home</a></li>
                    <li class="active">Carrinho</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-7">
                <div class="row userInfo">
                    <div class="col-xs-12 col-sm-12">
                        <div class="cartContent w100">
                            <table class="cartTable table-responsive" style="width:100%">
                                <tbody>
                                    <tr class="CartProduct cartTableHeader">
                                        <td style="width:40%">Curso</td>
                                        <td style="width:15%">Valor</td>
                                        <td style="width:10%" class="delete">&nbsp;</td>
                                    </tr>
                                    <?php
                                    $aPacotesExibidos = array();
                                    $valorTotal = 0;
                                    ?>
                                    <?php if (Yii::app()->user->isGuest) : ?>
                                        <?php
                                        if (!empty($_SESSION['pacote_carrinho'])) {
                                            foreach ($_SESSION['pacote_carrinho'] as $index => $value) {
                                                $valorTotal += $value['valor'];
                                                if (!in_array($value['id'], $aPacotesExibidos)) {
                                                    $aPacotesExibidos[] = $value['id'];
                                                    $oPacote = Pacote::model()->findByPk($value['id']);
                                                    $this->renderPartial('_pacote', array(
                                                        'oPacote' => $oPacote,
                                                        'pacoteSessionId' => $value['id'],
                                                    ));
                                                }
                                            }
                                        }
                                        if (!empty($_SESSION['prod_carrinho'])) {
                                            foreach ($_SESSION['prod_carrinho'] as $index => $value) {
                                                $valorTotal += $value['valor'];
                                                $oProduto = Produto::model()->findByPk($value['id']);
                                                $this->renderPartial('_produto', array(
                                                    'oProduto' => $oProduto,
                                                    'valor' => $value['valor'],
                                                    'produtoSessionId' => $value['id'],
                                                ));
                                            }
                                        }
                                        ?>
                                    <?php else : ?>
                                        <?php foreach ($oCarrinho as $carrinho) : ?>
                                            <?php
                                            $valorTotal += $carrinho->valor;
                                            if (!empty($carrinho->pacote_id)) {
                                                if (!in_array($carrinho->pacote_id, $aPacotesExibidos)) {
                                                    $aPacotesExibidos[] = $carrinho->pacote_id;
                                                    $oPacote = $carrinho->pacote;
                                                    $this->renderPartial('_pacote', array(
                                                        'oPacote' => $oPacote,
                                                        'carrinho' => $carrinho,
                                                    ));
                                                }
                                            } else {
                                                $oProduto = $carrinho->produto;
                                                $this->renderPartial('_produto', array(
                                                    'oProduto' => $oProduto,
                                                    'carrinho' => $carrinho,
                                                ));
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="cartFooter w100">
                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="<?= Yii::app()->createUrl('site/index') ?>" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i> &nbsp; Continuar Comprando
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $valorComDesconto = $valorTotal;
            if (!empty($oCupomDesconto)) {
                $valorComDesconto = $valorTotal * (1 - ($oCupomDesconto->cupom->percentual / 100));
            }
            ?>
            <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar">
                <div class="contentBox">
                    <div class="w100 costDetails">
                        <div class="table-block" id="order-detail-content">
                            <a href="#" class="btn btn-primary btn-lg btn-block" id='btn-finalizar' title="checkout" style="margin-bottom:20px"> 
                                Finalizar Compra &nbsp; <i class="fa fa-arrow-right"></i>
                            </a>
                            <div class="w100 cartMiniTable">
                                <table id="cart-summary" class="std table">
                                    <tbody>
                                        <tr>
                                            <td>Valor Cursos</td>
                                            <td class="price">R$ <?= FormatHelper::valorMonetario($valorTotal) ?></td>
                                        </tr>
                                        <tr class="cart-total-price ">
                                            <td>Desconto</td>
                                            <td class="price"><?= !empty($oCupomDesconto) ? $oCupomDesconto->cupom->percentual . ' %' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td class=" site-color" id="total-price">R$ <?= FormatHelper::valorMonetario($valorComDesconto) ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="input-append couponForm">
                                                    <form method="POST" action="<?= Yii::app()->createUrl('cupomDesconto/utilizar') ?>">
                                                        <input class="col-lg-8" name="cupom_desconto" id="appendedInputButton" type="text" placeholder="<?= !empty($oCupomDesconto) ? $oCupomDesconto->cupom->titulo : 'Cupom de Desconto' ?>" <?= !empty($oCupomDesconto) ? 'disabled' : '' ?> />
                                                        <button class="col-lg-4 btn btn-success" type="submit" <?= !empty($oCupomDesconto) ? 'disabled' : '' ?>>Aplicar!</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        if ('<?= $finalizarCompra ?>' == '1') {
            $('#btn-finalizar').click();
        }
    });
    $('#btn-finalizar').click(function () {
        if ('<?= Yii::app()->user->isGuest ?>' == 1) {
            window.location.href = '<?= Yii::app()->createUrl('site/login', array('finalizar_compra' => true)) ?>';
            return false;
        }
        if (!'<?= !empty($oUsuario) && $oUsuario->verificarCadastroCompleto() ? true : false ?>') {
            window.location.href = '<?= Yii::app()->createUrl('usuario/meusDados', array('finalizar_compra' => true)) ?>';
            return false;
        }
        $.ajax({
            url: '<?= Yii::app()->createUrl('pedido/finalizar') ?>',
            beforeSend: function () {
                $('#btn-finalizar').attr('disabled', 'disabled');
            },
            error: function (data) {
                alert('Ocorreu um erro ao finalizar o seu pedido.');
                window.location.href = '<?= Yii::app()->createUrl('pedido/meusPedidos') ?>';
            },
            success: function (data) {
                alert(data);
                return false;
                if (data == 'error') {
                    window.location.href = '<?= Yii::app()->createUrl('site/error') ?>';
                } else if (data == 'unauthorized') {
                    window.location.href = '<?= Yii::app()->createUrl('site/forbidden') ?>';
                } else if (data == 'acesso_negado') {
                    window.location.href = '<?= Yii::app()->createUrl('site/forbidden') ?>';
                } else {
                    $('#btn-finalizar').removeAttr('disabled');
                    dados = data.split('|||');
                    isOpenLightbox = PagSeguroLightbox({
                        code: dados[0]
                    }, {
                        success: function (transactionCode) {
                            alert('Pedido finalizado com sucesso!');
                            window.location.href = '<?= Yii::app()->createUrl('pedido/compraFinalizada') ?>';
                        }
                    });
                    if (!isOpenLightbox) {
                        location.href = "https://pagseguro.uol.com.br/v2/checkout/payment.html?code=" + dados[0];
                    }
                }
            }
        });
    });
</script>