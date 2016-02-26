<tr class="CartProduct">
    <td>
        <div class="CartDescription">
            <h4>
                <a href="<?= Yii::app()->createUrl('pacote/detalhes', array('url_amigavel' => $oPacote->url_amigavel)) ?>" target="_blank">
                    <?= $oPacote->titulo ?>
                </a>
            </h4>
        </div>
    </td>
    <?php if (Yii::app()->user->isGuest) : ?>
        <td class="price">R$ <?= FormatHelper::valorMonetario(Carrinho::getValorPacoteSession($oPacote->id)) ?></td>
        <td class="delete">
            <a href="<?= Yii::app()->createUrl('carrinho/deletarPacoteSession', array('id' => $pacoteSessionId)) ?>" title="Excluir curso">
                <i class="glyphicon glyphicon-trash"></i>
            </a>
        </td>
    <?php else : ?>
        <td class="price">R$ <?= FormatHelper::valorMonetario($carrinho->getValorPacote()) ?></td>
        <td class="delete">
            <a href="<?= Yii::app()->createUrl('carrinho/delete', array('id' => $carrinho->id)) ?>" title="Excluir curso">
                <i class="glyphicon glyphicon-trash"></i>
            </a>
        </td>
    <?php endif; ?>
</tr>