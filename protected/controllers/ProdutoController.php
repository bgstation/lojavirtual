<?php

class ProdutoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $wizardTabs = array(
        0 => array(
            'desc' => 'Produto',
            'url' => 'produto/create',
            'move' => false,
            'scenario' => 'produto'
        ),
        1 => array(
            'desc' => 'Módulos',
            'url' => 'produto/modulos',
            'move' => true,
            'scenario' => 'modulos'
        ),
        2 => array(
            'desc' => 'Arquivos',
            'url' => 'produto/arquivos',
            'move' => true,
            'scenario' => 'arquivos'
        ),
    );

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
                'actions' => array('index', 'apostilas', 'detalhes'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('acessar'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'admin', 'view', 'delete', 'modulos', 'arquivos'),
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
    public function actionCreate($id = null, $duplicado = null) {
        $wizardStep = 0;
        $this->setPageTitle($this->wizardTabs[$wizardStep]['desc']);
        $model = $id ? Produto::model()->findByPk($id) : new Produto();
        $model->setScenario($this->wizardTabs[$wizardStep]['scenario']);

        if (isset($_POST) && $_POST) {
            if ($model->setDadosGerais($_POST, $_FILES)) {
                if ($model->finalizar_cadastro == 'true') {
                    $this->redirect(array('view', 'id' => $model->id));
                }
                $this->redirect(Yii::app()->createAbsoluteUrl($this->wizardTabs[$wizardStep + 1]['url'], array('id' => $model->id)));
                Yii::app()->end();
            } else {
                if (count($model->getErrors()) > 0)
                    foreach ($model->getErrors() as $error) {
                        Yii::app()->user->setFlash('error', $error[0]);
                    }
            }
        }

        if ($model->id) {
            $this->wizardTabs[$wizardStep]['move'] = true;
        }

        $oMateria = Materia::model()->naoExcluido()->findAll();

        $this->render('create', array(
            'model' => $model,
            'tabs' => $this->wizardTabs,
            'activeTab' => $wizardStep,
            'oMateria' => $oMateria,
            'backUrl' => Yii::app()->createAbsoluteUrl('produto/admin'),
            'duplicado' => $duplicado,
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

    public function actionIndex() {
        $this->layout = '//layouts/layout';

        $oProdutos = Produto::model()->videoAula()->naoExcluido()->findAll();

        $this->render('index', array(
            'oProdutos' => $oProdutos
        ));
    }

    public function actionApostilas() {
        $this->layout = '//layouts/layout';

        $oProdutos = Produto::model()->apostila()->naoExcluido()->findAll();

        $this->render('apostila', array(
            'oProdutos' => $oProdutos
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Produto('search');
        $model->unsetAttributes();
        if (isset($_GET['Produto']))
            $model->attributes = $_GET['Produto'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Produto the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Produto::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Produto $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'produto-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionModulos($id) {
        $wizardStep = 1;

        $this->setPageTitle($this->wizardTabs[$wizardStep]['desc']);

        $modulo = new Modulo;

        $model = Produto::model()->findByPk($id);
        $model->setScenario($this->wizardTabs[$wizardStep]['scenario']);

        if (isset($_POST) && $_POST) {
            if ($_POST['Produto']['finalizar_cadastro'] == 'true') {
                $this->redirect(array('view', 'id' => $model->id));
            }
            $this->redirect(Yii::app()->createAbsoluteUrl($this->wizardTabs[$wizardStep + 1]['url'], array('id' => $model->id)));
            Yii::app()->end();
            if (count($model->getErrors()) > 0) {
                foreach ($model->getErrors() as $error) {
                    Yii::app()->user->setFlash('error', $error[0]);
                }
            }
        }

        if ($model->id) {
            $this->wizardTabs[$wizardStep]['move'] = true;
        }

        $this->render('modulos', array(
            'model' => $model,
            'tabs' => $this->wizardTabs,
            'activeTab' => $wizardStep,
            'modulo' => $modulo,
            'backUrl' => Yii::app()->createAbsoluteUrl('produto/admin'),
        ));
    }

    public function actionArquivos($id) {
        $wizardStep = 2;
        $erros_para_flash = array();

        $this->setPageTitle($this->wizardTabs[$wizardStep]['desc']);

        $oArquivo = new Arquivo();
        $model = Produto::model()->findByPk($id);
        $model->setScenario($this->wizardTabs[$wizardStep]['scenario']);

        if (isset($_POST) && $_POST) {
            if ($_POST['Produto']['finalizar_cadastro'] == 'true') {
                $this->redirect(array('view', 'id' => $model->id));
                Yii::app()->end();
            } else {
                $this->redirect(Yii::app()->createAbsoluteUrl($this->wizardTabs[$wizardStep + 1]['url'], array('id' => $model->id)));
            }
        }
        if ($model->id) {
            $this->wizardTabs[$wizardStep]['move'] = true;
        }
        if (count($erros_para_flash) > 0) {
            Yii::app()->user->setFlash('error', implode('<br />', $erros_para_flash));
        }
        $oModulo = Modulo::model()->naoExcluido()->findAllByAttributes(array(
            'produto_id' => $model->id,
        ));

        $this->render('arquivos', array(
            'model' => $model,
            'tabs' => $this->wizardTabs,
            'activeTab' => $wizardStep,
            'oModulo' => $oModulo,
            'aTipoArquivo' => $oArquivo->aTipoArquivo,
            'backUrl' => Yii::app()->createAbsoluteUrl('produto/admin'),
        ));
    }

    public function actionDetalhes($url_amigavel) {
        $this->layout = '//layouts/layout';

        $oProduto = Produto::model()->naoExcluido()->findByAttributes(array(
            'url_amigavel' => $url_amigavel,
        ));

        if (empty($oProduto)) {
            $this->redirect(array('site/notFound'));
        }

        $oProdutos = Produto::model()->naoExcluido()->exibeTres()->findAll();

        $this->render('detalhes', array(
            'oProduto' => $oProduto,
            'oProdutos' => $oProdutos,
        ));
    }

    public function actionAcessar($id, $arquivo_id = null) {
        $this->layout = '//layouts/layout';

        $oProduto = Produto::model()->findByPk($id);
        $oModulos = Modulo::model()->naoExcluido()->orderByOrdem()->findAllByAttributes(array(
            'produto_id' => $oProduto->id,
        ));

        $oArquivo = array();
        if (!empty($arquivo_id)) {
            $oArquivo = Arquivo::model()->naoExcluido()->findByPk($arquivo_id);
            if ($oArquivo->tipo_arquivo_id == Arquivo::PDF) {
                $arquivo = Yii::getPathOfAlias('webroot') . Yii::app()->params['diretorioArquivosPdf'] . $oArquivo->arquivo;
                header('Content-Disposition:inline;filename="' . basename($oArquivo->arquivo) . '";');
                header("content-type:application/pdf");
                header('Cache-Control: public, must-revalidate, max-age=0');
                header('Pragma: public');
                readfile($arquivo);
            }
        }

        $this->render('acessar', array(
            'oProduto' => $oProduto,
            'oModulos' => $oModulos,
            'oArquivo' => $oArquivo,
        ));
    }

}
