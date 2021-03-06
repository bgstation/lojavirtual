<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= $oProduto->titulo ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">Home</a></li>
                    <li><a href='<?= Yii::app()->createUrl('produto/index') ?>'>Produtos</a></li>
                    <li class="active"><?= $oProduto->titulo ?></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9 col-sm-9 single-item">
                <div class="row">

                    <?php if (!empty($oProduto->video_apresentacao) || !empty($oProduto->imagem)) : ?>
                        <div class="col-md-5 col-sm-5">
                            <div id="itemsingle" class="carousel slide clearfix">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <?php if (!empty($oProduto->video_apresentacao)) { ?>
                                            <iframe id="iframe_video_apresentacao" width="300" height="300" src="http://www.youtube.com/embed/<?= $oProduto->video_apresentacao ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                        <?php } else if (!empty($oProduto->imagem)) { ?>
                                            <img src='<?= $oProduto->getImagem() ?>' class='img-responsive' alt="<?= $oProduto->titulo ?>" />
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($oProduto->video_apresentacao) || !empty($oProduto->imagem)) : ?>
                        <div class="col-md-7 col-sm-7">
                        <?php else : ?>
                            <div class="col-md-12 col-sm-12">
                            <?php endif; ?>
                            <h3><?= $oProduto->titulo ?></h3>
                            <p><?= $oProduto->descricao ?></p>
                            <h4>R$ <?= FormatHelper::valorMonetario($oProduto->getPreco()) ?></h4>
                            <p>
                                <a href="<?= Yii::app()->createUrl('carrinho/adicionarProduto', array('produto_id' => $oProduto->id)) ?>" class="btn btn-black btn-large">
                                    <i class="fa fa-shopping-cart"></i> Adicionar ao carinho
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 product-tabs">
                            <ul id="myTab" class="nav nav-tabs">
                                <li class="active"><a href="#info" data-toggle="tab">Mais Informações</a></li>
                                <li class=""><a href="#related" data-toggle="tab">Cursos Relacionados</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="info">
                                    <p>Quantidade de Visualizações: <?= $oProduto->quantidade_visualizacao ?></p>
                                    <p>Tempo de Visualização: <?= $oProduto->periodo_visualizacao ?> dias</p>
                                </div>
                                <div class="tab-pane fade" id="related">
                                    <div class="row">
                                        <?php if (!empty($oProdutos)) : ?>
                                            <ul class="thumbnails list-unstyled">
                                                <?php foreach ($oProdutos as $produto) { ?>
                                                    <li class="col-md-4 col-sm-4">
                                                        <?= $this->renderPartial('/site/_produto', array('produto' => $produto)) ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php else : ?>
                                            <p>Nenhum curso relacionado.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 sidebar-catalogue">
                    <?= $this->renderPartial('/site/_busca_lateral') ?>
                </div>
            </div>
        </div>
    </div>
</div>