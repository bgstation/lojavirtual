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

<style type="text/css">
    div {
        margin-top: 3px;
        padding: 0 10px;
    }

    button {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        cursor: pointer;
        font-weight: 700;
        font-size: 13px;
        padding: 8px 18px 10px;
        line-height: 1;
        color: #fff;
        background: #345;
        border: 0;
        border-radius: 4px;
        margin-left: 0.75em;
    }

    p {
        display: inline-block;
        margin-left: 10px;
    }
</style>

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
                        <script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
                        <iframe id="player1" src="https://player.vimeo.com/video/<?= $oArquivo->arquivo ?>?api=1&player_id=player1" width="630" height="354" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                        <div>
                            <button>Play</button>
                            <button>Pause</button>
                            <p>Status: <span class="status">&hellip;</span></p>
                        </div>
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
<script type="text/javascript">
    $(function () {
        var iframe = $('#player1')[0];
        var player = $f(iframe);
        var status = $('.status');

        // When the player is ready, add listeners for pause, finish, and playProgress
        player.addEvent('ready', function () {
            status.text('ready');

            player.addEvent('pause', onPause);
            player.addEvent('finish', onFinish);
            player.addEvent('playProgress', onPlayProgress);
        });

        // Call the API when a button is pressed
        $('button').bind('click', function () {
            player.api($(this).text().toLowerCase());
        });

        function onPause(id) {
            status.text('paused');
        }

        function onFinish(id) {
            status.text('finished');
        }

        function onPlayProgress(data, id) {
            status.text(data.seconds + 's played');
        }
    });
</script>
