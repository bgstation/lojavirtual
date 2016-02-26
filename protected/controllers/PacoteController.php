<?php

class PacoteController extends Controller {

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
                'actions' => array('index', 'detalhes'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('acessar'),
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
    
    public function actionIndex() {
        $this->layout = '//layouts/layout';

        $oPacotes = Pacote::model()->naoExcluido()->findAll();

        $this->render('index', array(
            'oPacotes' => $oPacotes
        ));
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
        $model = new Pacote;

        if (isset($_POST['Pacote'])) {
            $model->attributes = $_POST['Pacote'];

            if (!empty($_FILES['Pacote']['name']['imagem'])) {
                $model->imagem = CUploadedFile::getInstance($model, 'imagem');
                $imagem = date('Ymdhis') . '_' . FormatHelper::tratarNomeImagem($model->imagem);
                $diretorioUpload = Yii::getPathOfAlias('webroot') . Yii::app()->params['diretorioImagensPacotes'];
                
                if (!is_dir($diretorioUpload)) {
                    mkdir($diretorioUpload, 0755);
                }
                chmod($diretorioUpload, 0755);
                $model->imagem->saveAs($diretorioUpload . $imagem);
                $model->imagem = $imagem;
            } else {
                $model->imagem = '';
            }

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

        if (isset($_POST['Pacote'])) {
            $model->attributes = $_POST['Pacote'];
            if (!empty($_FILES['Pacote']['name']['imagem'])) {
                $model->imagem = CUploadedFile::getInstance($model, 'imagem');
                $imagem = date('Ymdhis') . '_' . FormatHelper::tratarNomeImagem($model->imagem);
                $diretorioUpload = Yii::getPathOfAlias('webroot') . Yii::app()->params['diretorioImagensPacotes'];
                
                if (!is_dir($diretorioUpload)) {
                    mkdir($diretorioUpload, 0755);
                }
                chmod($diretorioUpload, 0755);
                $model->imagem->saveAs($diretorioUpload . $imagem);
                $model->imagem = $imagem;
            } else {
                $model->imagem = '';
            }

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
        $model = new Pacote('search');
        $model->unsetAttributes();
        if (isset($_GET['Pacote']))
            $model->attributes = $_GET['Pacote'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pacote the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Pacote::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pacote $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pacote-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionDetalhes($url_amigavel) {
        $this->layout = '//layouts/layout';
        
        $oPacote = Pacote::model()->naoExcluido()->findByAttributes(array(
            'url_amigavel' => $url_amigavel,
        ));
        
        if (empty($oPacote)) {
            $this->redirect(array('site/notFound'));
        }
        
        $oProdutos = Produto::model()->naoExcluido()->exibeTres()->findAll();
        
        $this->render('detalhes', array(
            'oPacote' => $oPacote,
            'oProdutos' => $oProdutos,
        ));
    }
    
    public function actionAcessar($id) {
        $this->layout = '//layouts/layout';
        
        $oPacote = Pacote::model()->findByPk($id);
        
        $this->render('acessar', array(
            'oPacote' => $oPacote,
            'oPacoteItens' => $oPacote->produtos,
        ));
    }

}
