<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Meus Cursos</h2>
            </div>
        </div>
    </div>
</div>

<div id='catalogue' style='padding-top: 20px;'>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">Home</a></li>
                    <li class="active">Meus Cursos</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class='col-md-12'>
                <?php if (!empty($oProdutoPedido)) : ?>
                    <ul class="thumbnails">
                        <?php
                        $aPacotesJaExibidos = array();
                        foreach ($oProdutoPedido as $produtoPedido) :
                            if (!empty($produtoPedido->pacote_id) && !in_array($produtoPedido->pacote_id, $aPacotesJaExibidos)) {
                                echo '<li class="col-md-4 col-sm-4">';
                                echo $this->renderPartial('/pedido/_pacote', array('pacote' => $produtoPedido->pacote));
                                echo '</li>';
                            } else if (empty($produtoPedido->pacote_id)) {
                                echo '<li class="col-md-4 col-sm-4">';
                                echo $this->renderPartial('/pedido/_produto', array('produto' => $produtoPedido->produto));
                                echo '</li>';
                            }
                        endforeach;
                        ?>
                    </ul>
                <?php else : ?>
                    <p>Você não possui cursos disponíveis.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

