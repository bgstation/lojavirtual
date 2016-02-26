<?php

class SiteController extends Controller {

    public $layout = '//layouts/layout';

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'sobre', 'error', 'notFound', 'contato', 'login', 'sobre', 'esqueciMinhaSenha', 'busca', 'forbidden'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('logout'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $oBanners = Banner::model()->naoExcluido()->ordenados()->findAll();
        $oProdutos = Produto::model()->destaque()->naoExcluido()->findAll();
        $oPacotes = Pacote::model()->destaque()->naoExcluido()->findAll();

        $this->render('index', array(
            'oProdutos' => $oProdutos,
            'oPacotes' => $oPacotes,
            'oBanners' => $oBanners,
        ));
    }

    public function actionError() {
        $this->layout = '//layouts/layout';
        $this->render('500');
    }

    public function actionNotFound() {
        $this->layout = '//layouts/layout';
        $this->render('404');
    }

    public function actionForbidden() {
        $this->layout = '//layouts/layout';
        $this->render('403');
    }

    public function actionContato() {
        $model = new ContactForm;
        if (!empty($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->nome) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->assunto) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";
                mail(Yii::app()->params['adminEmail'], $subject, $model->mensagem, $headers);
                Yii::app()->user->setFlash('contact', 'Obrigado pelo seu contato. Nós iremos entrar em contato assim que possível.');
                $this->refresh();
            }
        }
        $this->render('contato', array(
            'model' => $model
        ));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;
        $aErros = array();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (!empty($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $finalizarCompra = Yii::app()->user->getState('finalizar_compra');
                Carrinho::adicionarPacoteFromSession();
                Carrinho::adicionarProdutosFromSession();
                if ($finalizarCompra) {
                    $this->redirect(array('carrinho/index'));
                } else {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            } else {
                Yii::app()->user->setFlash('error', 'Login ou senha inválidos.');
            }
        } else if (!empty($_POST['Usuario'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $oCliente = new Cliente();
            $oCliente->scenario = 'cadastro_simplificado';
            if ($oCliente->save()) {
                $oUsuario = new Usuario();
                $oUsuario->scenario = 'cadastro_simplificado';
                $oUsuario->attributes = $_POST['Usuario'];
                $oUsuario->tipo_usuario_id = Usuario::CLIENTE;
                $oUsuario->role_id = $oCliente->id;
                if ($oUsuario->save()) {
                    $transaction->commit();
                    $model->username = $oUsuario->email;
                    $model->password = $_POST['Usuario']['senha'];
                    if ($model->validate() && $model->login()) {
                        $finalizarCompra = Yii::app()->user->getState('finalizar_compra');
                        Carrinho::adicionarPacoteFromSession();
                        Carrinho::adicionarProdutosFromSession();
                        if ($finalizarCompra) {
                            $this->redirect(array('carrinho/index'));
                        } else {
                            $this->redirect(array(Yii::app()->defaultController));
                        }
                    }
                } else {
                    $aErros = $oUsuario->getErrors();
                }
            } else {
                $aErros = $oCliente->getErrors();
            }

            if (!empty($aErros)) {
                if (!$oCliente->isNewRecord) {
                    $oCliente->delete();
                }
                $transaction->rollback();
            }
        }

        if (!empty($aErros)) {
            foreach ($aErros as $erro) {
                Yii::app()->user->setFlash('error', $erro);
            }
        }

        if (!empty($_GET['finalizar_compra'])) {
            Yii::app()->user->setFlash('error', 'Você deve fazer o seu login ou se cadastrar para finalizar a compra.');
            Yii::app()->user->setState('finalizar_compra', true);
        }

        $this->render('login', array(
            'model' => $model,
        ));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        $oCarrinhoProdutos = Carrinho::model()->naoExcluido()->itemProduto()->findAllByAttributes(array(
            'usuario_id' => Yii::app()->user->getId(),
        ));
        $oCarrinhoPacotes = Carrinho::model()->naoExcluido()->itemPacote()->findAllByAttributes(array(
            'usuario_id' => Yii::app()->user->getId(),
        ));

        Yii::app()->user->logout(false);

        $cont = 0;
        $_SESSION['prod_carrinho'] = array();
        foreach ($oCarrinhoProdutos as $carrinho) {
            $_SESSION['prod_carrinho'][$cont]['id'] = $carrinho->produto_id;
            $_SESSION['prod_carrinho'][$cont]['valor'] = $carrinho->valor;
            $_SESSION['prod_carrinho'][$cont]['datahora_insercao'] = $carrinho->datahora_insercao;
            $cont++;
        }
        $cont = 0;
        $_SESSION['pacote_carrinho'] = array();
        foreach ($oCarrinhoPacotes as $carrinho) {
            $_SESSION['pacote_carrinho'][$cont]['id'] = $carrinho->pacote_id;
            $_SESSION['pacote_carrinho'][$cont]['produto_id'] = $carrinho->produto_id;
            $_SESSION['pacote_carrinho'][$cont]['valor'] = $carrinho->valor;
            $_SESSION['pacote_carrinho'][$cont]['datahora_insercao'] = $carrinho->datahora_insercao;
            $cont++;
        }

        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionSobre() {
        $this->render('sobre');
    }

    public function actionEsqueciMinhaSenha() {
        $this->render('esqueci_minha_senha');
    }

    public function actionBusca() {
        $oPacotes = array();
        $oProdutos = array();
        $totalRegistros = 0;
        $termoBuscado = $_POST['busca'];
        if (!empty($termoBuscado)) {
            $oPacotes = Pacote::model()->naoExcluido()->findAll(array(
                'condition' => 'titulo like "%' . $termoBuscado . '%"'
            ));
            $oProdutos = Produto::model()->naoExcluido()->findAll(array(
                'condition' => 'titulo like "%' . $termoBuscado . '%"'
            ));
            $totalRegistros = count($oPacotes) + count($oProdutos);
        }
        $this->render('busca', array(
            'oPacotes' => $oPacotes,
            'oProdutos' => $oProdutos,
            'totalRegistros' => $totalRegistros,
            'termoBuscado' => $termoBuscado,
        ));
    }

}
