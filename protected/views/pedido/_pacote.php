<div class="thumbnail">
    <div class="caption-img">
        <a href='<?= Yii::app()->createUrl('pacote/acessar', array('id' => $pacote->id)) ?>'>
            <img src='<?= $pacote->getImagem() ?>' class='img-responsive' alt="<?= $pacote->titulo ?>" />
        </a>
    </div>
    <div class="caption-details">
        <a href='<?= Yii::app()->createUrl('pacote/acessar', array('id' => $pacote->id)) ?>'>
            <h3><?= $pacote->titulo ?></h3>
        </a>
    </div>
    <div class="caption-details">
        <a href='<?= Yii::app()->createUrl('pacote/acessar', array('id' => $pacote->id)) ?>' class='btn-saiba-mais'>
            Acessar
        </a>
    </div>
</div>