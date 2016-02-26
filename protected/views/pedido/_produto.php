<div class="thumbnail">
    <div class="caption-img">
        <a href='<?= Yii::app()->createUrl('produto/acessar', array('id' => $produto->id)) ?>'>
            <img src='<?= $produto->getImagem() ?>' class='img-responsive' alt="<?= $produto->titulo ?>" />
        </a>
    </div>
    <div class="caption-details">
        <a href='<?= Yii::app()->createUrl('produto/acessar', array('id' => $produto->id)) ?>'>
            <h3><?= $produto->titulo ?></h3>
        </a>
    </div>
    <div class="caption-details">
        <a href='<?= Yii::app()->createUrl('produto/acessar', array('id' => $produto->id)) ?>' class='btn-saiba-mais'>
            Acessar
        </a>
    </div>
</div>