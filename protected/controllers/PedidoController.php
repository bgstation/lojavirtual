<?php

class PedidoController extends Controller {

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
            'postOnly + delete',
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
                'actions' => array('compraFinalizada'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('meusPedidos', 'meusCursos', 'finalizar'),
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
        $model = new Pedido;

        if (isset($_POST['Pedido'])) {
            $model->attributes = $_POST['Pedido'];
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

        if (isset($_POST['Pedido'])) {
            $model->attributes = $_POST['Pedido'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Pedido('search');
        $model->unsetAttributes();
        if (isset($_GET['Pedido']))
            $model->attributes = $_GET['Pedido'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pedido the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Pedido::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pedido $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pedido-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionMeusPedidos() {
        $this->layout = '//layouts/layout';

        $oPedidos = Pedido::model()->findAllByAttributes(array(
            'usuario_id' => Yii::app()->user->getId(),
        ));

        $this->render('meus_pedidos', array(
            'oPedidos' => $oPedidos
        ));
    }
    
    public function actionMeusCursos() {
        $this->layout = '//layouts/layout';
        
        $oProdutoPedido = ProdutoPedido::model()->naoExpirado()->findAll(array(
            'join' => 'JOIN pedidos p ON p.id = t.pedido_id',
            'condition' => 'p.usuario_id = ' . Yii::app()->user->getId()
        ));

        $this->render('meus_cursos', array(
            'oProdutoPedido' => $oProdutoPedido,
        ));
    }

    public function actionFinalizar() {
        Yii::app()->user->setState('finalizar_compra', null);
        $pedidoExistente = false;
        $pedidoId = !empty($_POST['pedido_id']) ? $_POST['pedido_id'] : null;
        if (!empty($_POST['finalizar_pedido']) && $_POST['finalizar_pedido'] == 'true') {
            $pedidoExistente = true;
        }
        echo Carrinho::finalizar($pedidoId, $pedidoExistente);
    }

    public function actionCompraFinalizada() {
        $this->layout = '//layouts/layout';
        $this->render('compra_finalizada');
    }

}
