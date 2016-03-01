<?php

class UsuarioController extends Controller {

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
                'actions' => array(),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('meusDados'),
                'users' => array('@'),
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
        $model = new Usuario;

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $oTipoUsuario = TipoUsuario::model()->naoExcluido()->findAll();

        $this->render('create', array(
            'model' => $model,
            'oTipoUsuario' => $oTipoUsuario,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $oTipoUsuario = TipoUsuario::model()->naoExcluido()->findAll();

        $this->render('update', array(
            'model' => $model,
            'oTipoUsuario' => $oTipoUsuario,
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
        $model = new Usuario('search');
        $model->unsetAttributes();
        if (isset($_GET['Usuario']))
            $model->attributes = $_GET['Usuario'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Usuario the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Usuario::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Usuario $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionMeusDados() {
        $this->layout = '//layouts/layout';
        $oUsuario = Usuario::model()->findByPk(Yii::app()->user->getId());
        $oCliente = $oUsuario->cliente;
        
        $senhaOriginal = $oUsuario->senha;
        $oUsuario->senha = null;
        
        $aErros = array();

        if (!empty($_POST['Usuario'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $oCliente->attributes = $_POST['Cliente'];
            $oCliente->data_nascimento = $oCliente->tratarDataNascimento();
            if ($oCliente->save()) {
                $oUsuario->attributes = $_POST['Usuario'];
                if (!$oUsuario->senha) {
                    $oUsuario->senha = $senhaOriginal;
                }
                if ($oUsuario->save()) {
                    $transaction->commit();
                    $finalizarCompra = Yii::app()->user->getState('finalizar_compra');
                    Yii::app()->user->setFlash('success', 'Seus dados foram atualizados com sucesso.');

                    if ($finalizarCompra) {
                        $this->redirect(array('carrinho/index'));
                    } else {
                        $this->redirect(array(Yii::app()->defaultController));
                    }
                } else {
                    $aErros = $oUsuario->getErrors();
                }
            } else {
                $aErros = $oCliente->getErrors();
            }
            if (!empty($aErros)) {
                $transaction->rollback();
            }
        }

        if (!empty($aErros)) {
            $errors = '';
            foreach ($aErros as $key => $error) {
                $errors .= implode('<br/>', $error);
            }
            Yii::app()->user->setFlash('error', $errors);
        } else if (!empty($_GET['finalizar_compra'])) {
            Yii::app()->user->setFlash('error', 'Você precisa finalizar o seu cadastro para efetuar a compra.');
            Yii::app()->user->setState('finalizar_compra', true);
        }

        $this->render('meus_dados', array(
            'oUsuario' => $oUsuario,
            'oCliente' => $oCliente,
        ));
    }

}
