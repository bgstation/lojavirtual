<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function () {
        $("#accordion").accordion({
            active: false,
            collapsible: true
        });
    });
</script>

<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><?= $oProduto->titulo ?></h2>
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
                    <li class="active"><?= $oProduto->titulo ?></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class='col-md-12'>
                <div class='col-md-12'>
                    <?php if (empty($oArquivo) || $oArquivo->tipo_arquivo_id == Arquivo::PDF) : ?>
                        <?php if (!empty($oProduto->video_apresentacao)) : ?>
                            <iframe width="600" height="300" src="http://www.youtube.com/embed/<?= $oProduto->video_apresentacao ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        <?php endif; ?>
                    <?php else : ?>
                        <h2><?= $oArquivo->modulo->titulo . ' / ' . $oArquivo->titulo ?></h2>
                        <iframe width="600" height="300" src="http://www.youtube.com/embed/<?= $oArquivo->arquivo ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                    <?php endif; ?>
                </div>
                <div class='col-md-12'>
                    <h2>Aulas</h2>
                    <div id="accordion">
                        <?php foreach ($oModulos as $modulo) : ?>
                            <h3 style='text-align: left;'><?= $modulo->titulo ?></h3>
                            <div>
                                <ul style='list-style-type: none;'>
                                    <?php
                                    $oArquivos = Arquivo::model()->naoExcluido()->orderByOrdem()->findAllByAttributes(array(
                                        'modulo_id' => $modulo->id,
                                    ));
                                    foreach ($oArquivos as $arquivo) {
                                        echo '<li style="text-align: left;">';
                                        if ($arquivo->tipo_arquivo_id == Arquivo::VIDEO) {
                                            echo '<a href="' . Yii::app()->createUrl('produto/acessar', array('id' => $oProduto->id, 'arquivo_id' => $arquivo->id)) . '">';
                                            echo '<span style="margin-right:10px;"><i class="fa fa-video-camera"></i></span>';
                                        } else if ($arquivo->tipo_arquivo_id == Arquivo::PDF) {
                                            echo '<a href="' . Yii::app()->createUrl('produto/acessar', array('id' => $oProduto->id, 'arquivo_id' => $arquivo->id)) . '" target="_blank">';
                                            echo '<span style="margin-right:10px;"><i class="fa fa-download"></i></span>';
                                        }
                                        echo $arquivo->titulo;
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

