<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= $oPacote->titulo ?></h2>
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
                    <li><a href="<?= Yii::app()->createUrl('pedido/meusCursos') ?>">Meus Cursos</a></li>
                    <li class="active"><?= $oPacote->titulo ?></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class='col-md-12'>
                <ul class="thumbnails">
                    <?php foreach ($oPacoteItens as $pacoteItem) : ?>
                        <li class="col-md-4 col-sm-4">
                            <?= $this->renderPartial('/pedido/_produto', array('produto' => $pacoteItem->produto)) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

