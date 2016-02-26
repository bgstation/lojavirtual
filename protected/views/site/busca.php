<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Busca</h2>
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
                    <li class="active">Busca</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <h2>Busca</h2>
            <?php if ($totalRegistros > 0) : ?>
                <h3><?= $totalRegistros == 1 ? 'Foi encontrado ' . $totalRegistros . ' item para o termo buscado.' : 'Foram encontrados ' . $totalRegistros . ' itens para o termo buscado.' ?></h3>
            <?php else : ?>
                <h3>Não foi encontrado nenhum curso com o conteúdo buscado.</h3>
            <?php endif; ?>
            <div class="col-md-9">
                <div class="col-md-12">
                    <?php if (!empty($oPacotes) || !empty($oProdutos)) : ?>
                        <ul class="thumbnails">
                            <?php foreach ($oPacotes as $pacote) { ?>
                                <li class="col-md-4 col-sm-4">
                                    <?= $this->renderPartial('/site/_pacote', array('pacote' => $pacote)) ?>
                                </li>
                            <?php } ?>
                            <?php foreach ($oProdutos as $produto) { ?>
                                <li class="col-md-4 col-sm-4">
                                    <?= $this->renderPartial('/site/_produto', array('produto' => $produto)) ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 sidebar-catalogue">
                <?= $this->renderPartial('/site/_busca_lateral', array('termoBuscado' => $termoBuscado)) ?>
            </div>
        </div>
    </div>
</div>