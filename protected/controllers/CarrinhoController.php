<?php

class CarrinhoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'adicionarProduto', 'adicionarPacote', 'deletarProdutoSession', 'deletarPacoteSession'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('delete'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'admin', 'view'),
                'expression' => 'Yii::app()->controller->checkPermission()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Carrinho;

        if (isset($_POST['Carrinho'])) {
            $model->attributes = $_POST['Carrinho'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Carrinho'])) {
            $model->attributes = $_POST['Carrinho'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $oCarrinho = $this->loadModel($id);
        if (!empty($oCarrinho->pacote_id)) {
            $oCarrinhos = Carrinho::model()->findAllByAttributes(array(
                'usuario_id' => Yii::app()->user->getId(),
                'pacote_id' => $oCarrinho->pacote_id,
            ));
            foreach ($oCarrinhos as $carrinho) {
                $carrinho->excluido = true;
                $carrinho->save();
            }
        } else {
            $oCarrinho->excluido = true;
            $oCarrinho->save();
        }
        $this->redirect(array('carrinho/index'));
    }

    public function actionIndex() {
        $this->layout = '//layouts/layout';

        $oUsuario = array();
        $oCarrinho = array();
        $oCupomDesconto = array();
        if (!Yii::app()->user->isGuest) {
            $oUsuario = Usuario::model()->findByPk(Yii::app()->user->getId());
            $oCarrinho = Carrinho::model()->naoExcluido()->findAllByAttributes(array(
                'usuario_id' => $oUsuario->id,
            ));
            $oCupomDesconto = CupomDescontoPorUsuario::model()->utilizando()->naoExcluido()->find(array(
                'join' => 'JOIN pedidos p ON p.id = t.pedido_id',
                'condition' => 'p.usuario_id = ' . $oUsuario->id,
            ));
        }

        $finalizarCompra = Yii::app()->user->getState('finalizar_compra');

        $this->render('index', array(
            'oUsuario' => $oUsuario,
            'oCarrinho' => $oCarrinho,
            'oCupomDesconto' => $oCupomDesconto,
            'finalizarCompra' => $finalizarCompra,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Carrinho('search');
        $model->unsetAttributes();
        if (isset($_GET['Carrinho']))
            $model->attributes = $_GET['Carrinho'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Carrinho the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Carrinho::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Carrinho $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'carrinho-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAdicionarProduto() {
        if (empty($_GET['produto_id'])) {
            $this->redirect(array('site/notFound'));
        }
        $oProduto = Produto::model()->findByPk($_GET['produto_id']);

        if (Yii::app()->user->isGuest) {
            if (empty($_SESSION['prod_carrinho'])) {
                $_SESSION['prod_carrinho'] = array();
                $_SESSION['prod_carrinho'][0]['id'] = $oProduto->id;
                $_SESSION['prod_carrinho'][0]['valor'] = $oProduto->getPreco();
                $_SESSION['prod_carrinho'][0]['datahora_insercao'] = date('Y-m-d H:i:s');
            } else {
                $ultimoIndice = max(array_keys($_SESSION['prod_carrinho']));
                $adicionado = false;
                foreach ($_SESSION['prod_carrinho'] as $index => $value) {
                    if ($value['id'] == $oProduto->id) {
                        $adicionado = true;
                    }
                }
                if (!$adicionado) {
                    $_SESSION['prod_carrinho'][$ultimoIndice + 1]['id'] = $oProduto->id;
                    $_SESSION['prod_carrinho'][$ultimoIndice + 1]['valor'] = $oProduto->getPreco();
                    $_SESSION['prod_carrinho'][$ultimoIndice + 1]['datahora_insercao'] = date('Y-m-d H:i:s');
                }
            }
        } else {
            $carrinho = new Carrinho();
            $carrinho->produto_id = $oProduto->id;
            $carrinho->usuario_id = Yii::app()->user->getId();
            $carrinho->valor = $oProduto->getPreco();
            $carrinho->save();
        }
        $this->redirect(array('carrinho/index'));
    }

    public function actionAdicionarPacote() {
        if (empty($_GET['pacote_id'])) {
            $this->redirect(array('site/notFound'));
        }
        $oPacoteItens = PacoteItem::model()->findAllByAttributes(array(
            'pacote_id' => $_GET['pacote_id']
        ));

        if (Yii::app()->user->isGuest) {
            $cont = 0;
            foreach ($oPacoteItens as $item) {
                if (empty($_SESSION['pacote_carrinho'])) {
                    $_SESSION['pacote_carrinho'] = array();
                    $_SESSION['pacote_carrinho'][$cont]['id'] = $item->pacote_id;
                    $_SESSION['pacote_carrinho'][$cont]['produto_id'] = $item->produto_id;
                    $_SESSION['pacote_carrinho'][$cont]['valor'] = $item->getValorProduto();
                    $_SESSION['pacote_carrinho'][$cont]['datahora_insercao'] = date('Y-m-d H:i:s');
                } else {
                    $ultimoIndice = max(array_keys($_SESSION['pacote_carrinho']));
                    $adicionado = false;
                    foreach ($_SESSION['pacote_carrinho'] as $index => $value) {
                        if (($value['id'] == $item->pacote_id) && ($value['produto_id'] == $item->produto_id)) {
                            $adicionado = true;
                        }
                    }
                    if (!$adicionado) {
                        $_SESSION['pacote_carrinho'][$ultimoIndice + 1]['id'] = $item->pacote_id;
                        $_SESSION['pacote_carrinho'][$ultimoIndice + 1]['produto_id'] = $item->produto_id;
                        $_SESSION['pacote_carrinho'][$ultimoIndice + 1]['valor'] = $item->getValorProduto();
                        $_SESSION['pacote_carrinho'][$ultimoIndice + 1]['datahora_insercao'] = date('Y-m-d H:i:s');
                    }
                }
            }
        } else {
            foreach ($oPacoteItens as $item) {
                $carrinho = new Carrinho();
                $carrinho->usuario_id = Yii::app()->user->getId();
                $carrinho->produto_id = $item->produto_id;
                $carrinho->pacote_id = $item->pacote_id;
                $carrinho->valor = $item->getValorProduto();
                $carrinho->save();
            }
        }
        $this->redirect(array('carrinho/index'));
    }
    
    public function actionDeletarProdutoSession($id) {
        foreach ($_SESSION['prod_carrinho'] as $index => $produto) {
            if ($produto['id'] == $id) {
                unset($_SESSION['prod_carrinho'][$index]);
            }
        }
        $this->redirect(array('carrinho/index'));
    }

    public function actionDeletarPacoteSession($id) {
        foreach ($_SESSION['pacote_carrinho'] as $index => $pacote) {
            if ($pacote['id'] == $id) {
                unset($_SESSION['pacote_carrinho'][$index]);
            }
        }
        $this->redirect(array('carrinho/index'));
    }

}
