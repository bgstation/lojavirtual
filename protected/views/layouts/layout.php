<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Loja Virtual</title>

        <link href="<?= Yii::app()->request->baseUrl ?>/css/site/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?= Yii::app()->request->baseUrl ?>/css/site/style.css" rel="stylesheet">
        <link href="<?= Yii::app()->request->baseUrl ?>/css/site/responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?= Yii::app()->request->baseUrl ?>/js/site/html5shiv.js"></script>
          <script src="<?= Yii::app()->request->baseUrl ?>/js/site/respond.min.js"></script>
        <![endif]-->
        <script src="<?= Yii::app()->request->baseUrl ?>/js/site/jquery.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container container-topo">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand visible-xs" href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">
                        <img src="<?= Yii::app()->request->baseUrl ?>/images/logo.jpg" />
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>" class='logo hidden-xs' style='float:left;'>
                        <img src="<?= Yii::app()->request->baseUrl ?>/images/logo.jpg" />
                    </a>
                    <ul class="nav navbar-nav nav-left">
                        <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">Home</a></li>
                        <li><a href="<?= Yii::app()->createUrl('site/sobre') ?>">Sobre</a></li>
                        <li><a href="<?= Yii::app()->createUrl('produto/index') ?>">Cursos</a></li>
                        <li><a href="<?= Yii::app()->createUrl('pacote/index') ?>">Combos</a></li>
                        <li><a href="<?= Yii::app()->createUrl('produto/apostilas') ?>">Apostilas</a></li>
                        <li><a href="<?= Yii::app()->createUrl('carrinho/index') ?>">Carrinho</a></li>
                    </ul>
                    <ul class="nav navbar-nav nav-right">
                        <?php if (Yii::app()->user->isGuest) : ?>
                            <li class="active"><a href="<?= Yii::app()->createUrl('site/login') ?>">Login / Cadastro</a></li>
                        <?php else : ?>
                            <?php if (Yii::app()->user->checkAccess(base64_encode('visualizaAdministrador'))) : ?>
                                <li class="active"><a href="<?= Yii::app()->createUrl('administrador/index') ?>">Administrador</a></li>
                            <?php else : ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Área do Aluno <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= Yii::app()->createUrl('pedido/meusCursos') ?>">Meus Cursos</a></li>
                                        <li><a href="<?= Yii::app()->createUrl('usuario/meusDados') ?>">Meus Dados</a></li>
                                        <li><a href="<?= Yii::app()->createUrl('pedido/meusPedidos') ?>">Meus Pedidos</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <li><a href="<?= Yii::app()->createUrl('site/logout') ?>">Sair</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?= $content ?>

        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Siga-nos</h3>
                        <ul class="list-unstyled social-icon">
                            <li><a href="http://www.facebook.com" target='_blank' rel="tooltip" title="Facebook" class="icon-facebook"><span><i class="fa fa-facebook-square"></i></span></a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Formas de Pagamento</h3>
                        <ul class="list-unstyled social-icon">
                            <li><img src='<?= Yii::app()->request->baseUrl ?>/images/formas_pagamento_2.png' class='img-responsive' /></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Central de Atendimento</h3>
                        <ul class="list-unstyled links">
                            <li><a href='<?= Yii::app()->createUrl('site/contato') ?>'> Entre em contato</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        Copyright &copy; <?= date('Y') ?> <a href='http://www.bgstation.com.br' target='_blank'>BG Station</a> Todos os direitos reservados.
                    </div>
                    <div class='col-md-6 sitemap'>
                        <ul>
                            <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">HOME</a></li>
                            <li><a href="<?= Yii::app()->createUrl('site/sobre') ?>">SOBRE</a></li>
                            <li><a href="<?= Yii::app()->createUrl('site/contato') ?>">CONTATO</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= Yii::app()->request->baseUrl ?>/js/site/bootstrap.js"></script>
        <script src="<?= Yii::app()->request->baseUrl ?>/js/site/script.js"></script>
    </body>
</html>