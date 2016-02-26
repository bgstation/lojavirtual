<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Cursos</h2>
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
                    <li class="active">Cursos</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Cursos</h2>
                <div class="col-md-12">
                    <?php if (!empty($oProdutos)) : ?>
                        <ul class="thumbnails">
                            <?php foreach ($oProdutos as $produto) { ?>
                                <li class="col-md-3 col-sm-3">
                                    <?= $this->renderPartial('/site/_produto', array('produto' => $produto)) ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php else : ?>
                        <p>Nenhum produto cadastrado.</p>
                    <?php endif; ?>

                </div>
                <!--<div class="col-md-12">
                        <ul class="pagination">
                            <li class="disabled"><a href="#">Page 1 of 2</a></li>
                            <li class="disabled"><a href="#">&laquo;</a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>-->
            </div>
        </div>
    </div>
</div>