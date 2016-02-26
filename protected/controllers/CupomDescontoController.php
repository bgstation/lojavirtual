<?php

class CupomDescontoController extends Controller {

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
                'actions' => array('utilizar'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'admin', 'delete', 'view'),
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
        $model = new CupomDesconto;

        if (isset($_POST['CupomDesconto'])) {
            $model->attributes = $_POST['CupomDesconto'];
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

        if (isset($_POST['CupomDesconto'])) {
            $model->attributes = $_POST['CupomDesconto'];
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
        $this->loadModel($id)->marcarComoExcluido();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new CupomDesconto('search');
        $model->unsetAttributes();
        if (isset($_GET['CupomDesconto']))
            $model->attributes = $_GET['CupomDesconto'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CupomDesconto the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = CupomDesconto::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CupomDesconto $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cupom-desconto-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionUtilizar() {
        if (!Yii::app()->user->isGuest) {
            $oCupomDesconto = CupomDesconto::model()->findByAttributes(array(
                'titulo' => $_POST['cupom_desconto']
            ));
            if (!empty($oCupomDesconto)) {
                if (($oCupomDesconto->utilizados == $oCupomDesconto->limitacao) || ($oCupomDesconto->data_expiracao < date('Y-m-d H:i:s'))) {
                    Yii::app()->user->setFlash('error', 'Cupom de desconto indisponível.');
                } else {

                    if (Yii::app()->user->isGuest) {
                        ob_start();
                        if (empty($_SESSION['cupom_desconto'])) {
                            $_SESSION['cupom_desconto'] = array();
                        }
                        $_SESSION['cupom_desconto']['id'] = $oCupomDesconto->id;
                        $_SESSION['cupom_desconto']['data_utilizacao'] = date('Y-m-d H:i:s');
                        Yii::app()->user->setFlash('success', 'Cupom de desconto atribuído com sucesso.');
                    } else {
                        $oCupomDescontoPorUsuario = new CupomDescontoPorUsuario;
                        $oCupomDescontoPorUsuario->cupom_desconto_id = $oCupomDesconto->id;
                        $oCupomDescontoPorUsuario->pedido_id = Pedido::getPedido();

                        if ($oCupomDescontoPorUsuario->save()) {
                            $oCupomDesconto->utilizados += 1;
                            $oCupomDesconto->save();
                            Yii::app()->user->setFlash('success', 'Cupom de desconto atribuído com sucesso.');
                        } else {
                            Yii::app()->user->setFlash('error', 'Ocorreu um erro ao utilizar o cupom, por favor, tente novamente.');
                        }
                    }
                }
            } else {
                Yii::app()->user->setFlash('error', 'Cupom de desconto inexistente.');
            }
        } else {
            Yii::app()->user->setFlash('error', 'Você deve se logar para utilizar um cupom de desconto.');
        }

        $this->redirect(array('carrinho/index'));
    }

}
