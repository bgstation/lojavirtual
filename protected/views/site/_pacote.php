<div class="thumbnail">
    <div class="caption-img">
        <a href='<?= Yii::app()->createUrl('pacote/detalhes', array('url_amigavel' => $pacote->url_amigavel)) ?>'>
            <img src='<?= $pacote->getImagem() ?>' class='img-responsive' alt="<?= $pacote->titulo ?>" />
        </a>
    </div>
    <div class="caption-details">
        <a href='<?= Yii::app()->createUrl('pacote/detalhes', array('url_amigavel' => $pacote->url_amigavel)) ?>'>
            <h3><?= $pacote->titulo ?></h3>
        </a>
        <h3>R$ <?= FormatHelper::valorMonetario($pacote->getPreco()) ?></h3>
    </div>
    <div class="caption-details">
        <a href='<?= Yii::app()->createUrl('pacote/detalhes', array('url_amigavel' => $pacote->url_amigavel)) ?>' class='btn-saiba-mais'>
            Saiba Mais
        </a>
    </div>
</div>