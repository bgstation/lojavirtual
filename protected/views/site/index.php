<?php
if (!empty($oBanners)) {
    echo $this->renderPartial('_banners', array(
        'oBanners' => $oBanners
    ));
}
?>

<?= SiteHelper::renderFlashMessage() ?>

<div id="catalogue">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-title">
                    <h2>Cursos em Destaque</h2>
                </div>	
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <?php foreach ($oPacotes as $pacote) { ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <?= $this->renderPartial('/site/_pacote', array('pacote' => $pacote)) ?>
                    </div>
                <?php } ?>
                <?php foreach ($oProdutos as $produto) { ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <?= $this->renderPartial('/site/_produto', array('produto' => $produto)) ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3 col-sm-3 sidebar-catalogue">
                <?= $this->renderPartial('/site/_busca_lateral', array('termoBuscado' => '')) ?>
            </div>
        </div>
    </div>
</div>