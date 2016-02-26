<div class="thumbnail">
    <div class="caption-img">
        <a href='<?= Yii::app()->createUrl('produto/detalhes', array('url_amigavel' => $produto->url_amigavel)) ?>'>
            <img src='<?= $produto->getImagem() ?>' class='img-responsive' alt="<?= $produto->titulo ?>" />
        </a>
    </div>
    <div class="caption-details">
        <a href='<?= Yii::app()->createUrl('produto/detalhes', array('url_amigavel' => $produto->url_amigavel)) ?>'>
            <h3><?= $produto->titulo ?></h3>
        </a>
        <h3>R$ <?= FormatHelper::valorMonetario($produto->getPreco()) ?></h3>
    </div>
    <div class="caption-details">
        <a href='<?= Yii::app()->createUrl('produto/detalhes', array('url_amigavel' => $produto->url_amigavel)) ?>' class='btn-saiba-mais'>
            Saiba Mais
        </a>
    </div>
</div>