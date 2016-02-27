<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php Yii::app()->bootstrap->register(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/site.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/js/select2-3.5.1/select2.css" />
        <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/css/font-awesome/css/font-awesome.min.css" />

        <link id="favicon" rel="icon" type="image/png" sizes="64x64" href="<?= Yii::app()->request->baseUrl ?>/img/<?= Yii::app()->params['favicon'] ?>" />

        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/jquery-1.9.0.js"></script>

        <?php
        Yii::app()->clientScript->registerCssFile(
                Yii::app()->clientScript->getCoreScriptUrl() .
                '/jui/css/base/jquery-ui.css'
        );

        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
        ?>
        <title><?= CHtml::encode($this->pageTitle) ?></title>
    </head>
    <body>
        <div class="container" id="page">
            <div id="header">
                <div id="logo">
                    <?= CHtml::image(Yii::app()->request->baseUrl . '/img/logo.png', '', array('style' => 'max-height:40px')) ?>
                </div>
                <div id="mainmenu">
                    <?php
                    $this->widget('bootstrap.widgets.TbMenu', array(
                        'type' => 'tabs',
                        'stacked' => false,
                        'items' => array(
                            array('label' => 'Site', 'url' => array('site/index'), 'visible' => !Yii::app()->user->isGuest,),
                            array('label' => 'Home', 'url' => array('administrador/index'), 'visible' => Yii::app()->user->checkAccess('administrador/index')),
                            array('label' => 'Cadastro', 'items' => array(
                                    array('label' => 'Banners', 'url' => array('banner/admin'), 'visible' => Yii::app()->user->checkAccess('banner/admin')),
                                    array('label' => 'Clientes', 'url' => array('cliente/admin'), 'visible' => Yii::app()->user->checkAccess('cliente/admin')),
                                    array('label' => 'Cupons de Desconto', 'url' => array('cupomDesconto/admin'), 'visible' => Yii::app()->user->checkAccess('cupomDesconto/admin')),
                                    array('label' => 'Matérias', 'url' => array('materia/admin'), 'visible' => Yii::app()->user->checkAccess('materia/admin')),
                                    array('label' => 'Pacotes', 'url' => array('pacote/admin'), 'visible' => Yii::app()->user->checkAccess('pacote/admin')),
                                    array('label' => 'Produtos', 'url' => array('produto/admin'), 'visible' => Yii::app()->user->checkAccess('produto/admin')),
                                    array('label' => 'Tipos de Usuários', 'url' => array('tipoUsuario/admin'), 'visible' => Yii::app()->user->checkAccess('tipoUsuario/admin')),
                                    array('label' => 'Usuários', 'url' => array('usuario/admin'), 'visible' => Yii::app()->user->checkAccess('usuario/admin')),
                                ), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Controle', 'items' => array(
                                    array('label' => 'Carrinho', 'url' => array('carrinho/admin'), 'visible' => Yii::app()->user->checkAccess('carrinho/admin')),
                                    array('label' => 'Configurações', 'url' => array('configuracao/admin'), 'visible' => Yii::app()->user->checkAccess('configuracao/admin')),
                                    array('label' => 'Pedidos', 'url' => array('pedido/admin'), 'visible' => Yii::app()->user->checkAccess('pedido/admin')),
                                ), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Leads', 'items' => array(
                                    array('label' => 'Leads', 'url' => array('lead/admin'), 'visible' => Yii::app()->user->checkAccess('lead/admin')),
                                    array('label' => 'UTM Source', 'url' => array('utmSource/admin'), 'visible' => Yii::app()->user->checkAccess('utmSource/admin')),
                                    array('label' => 'UTM Medium', 'url' => array('utmMedium/admin'), 'visible' => Yii::app()->user->checkAccess('utmMedium/admin')),
                                ), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Relatórios', 'items' => array(
                                    array('label' => 'Vendas', 'url' => array('financeiro/admin'), 'visible' => Yii::app()->user->checkAccess('financeiro/admin')),
                                ), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('site/logout'), 'visible' => !Yii::app()->user->isGuest, 'itemOptions' => array('style' => 'float:right;'))
                        ),
                    ));
                    ?>
                </div>
            </div>

            <?= $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?= date('Y') ?> by BG Station. Todos os direitos reservados.
            </div>
        </div>
    </body>
</html>