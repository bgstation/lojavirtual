<tr class="CartProduct">
    <td>
        <div class="CartDescription">
            <h4>
                <a href="<?= Yii::app()->createUrl('produto/detalhes', array('url_amigavel' => $oProduto->url_amigavel)) ?>" target="_blank">
                    <?= $oProduto->titulo ?>
                </a>
            </h4>
        </div>
    </td>
    <?php if (Yii::app()->user->isGuest) : ?>
        <td class="price">R$ <?= FormatHelper::valorMonetario($valor) ?></td>
        <td class="delete">
            <a href="<?= Yii::app()->createUrl('carrinho/deletarProdutoSession', array('id' => $produtoSessionId)) ?>" title="Excluir curso">
                <i class="glyphicon glyphicon-trash"></i>
            </a>
        </td>
    <?php else : ?>
        <td class="price">R$ <?= FormatHelper::valorMonetario($carrinho->valor) ?></td>
        <td class="delete">
            <a href="<?= Yii::app()->createUrl('carrinho/delete', array('id' => $carrinho->id)) ?>" title="Excluir curso">
                <i class="glyphicon glyphicon-trash"></i>
            </a>
        </td>
    <?php endif; ?>
</tr>