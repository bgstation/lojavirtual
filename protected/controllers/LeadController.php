<?php

class LeadController extends Controller {

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
                'actions' => array('acessar'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'admin', 'delete', 'gerarLink', 'view'),
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
        $oLogLead = LogLead::model()->findAllByAttributes(array(
            'lead_id' => $id,
        ));
        $oUsuarios = Usuario::model()->findAll(array(
            'join' => 'JOIN logs_leads_itens log ON log.item_id = t.id AND log.tipo_item = ' . LogLeadItem::USUARIO
        ));
        $oCarrinho = Carrinho::model()->findAll(array(
            'join' => 'JOIN logs_leads_itens log ON log.item_id = t.id AND log.tipo_item = ' . LogLeadItem::CARRINHO
        ));
        $oPedidos = Pedido::model()->findAll(array(
            'join' => 'JOIN logs_leads_itens log ON log.item_id = t.id AND log.tipo_item = ' . LogLeadItem::PEDIDO
        ));
        $oLogsLeads = LogLead::getDadosCampanha($id);
        
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'oLogLead' => $oLogLead,
            'oUsuarios' => $oUsuarios,
            'oCarrinho' => $oCarrinho,
            'oPedidos' => $oPedidos,
            'oLogsLeads' => $oLogsLeads,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Lead;

        if (isset($_POST['Lead'])) {
            $model->attributes = $_POST['Lead'];
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

        if (isset($_POST['Lead'])) {
            $model->attributes = $_POST['Lead'];
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
        $model = new Lead('search');
        $model->unsetAttributes();
        if (isset($_GET['Lead']))
            $model->attributes = $_GET['Lead'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Lead the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Lead::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Lead $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'lead-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGerarLink($id) {
        $model = $this->loadModel($id);
        
        $oUtmSource = UtmSource::model()->naoExcluido()->findAll();
        $oUtmMedium = UtmMedium::model()->naoExcluido()->findAll();
        
        $this->render('gerar_link', array(
            'model' => $model,
            'oUtmSource' => $oUtmSource,
            'oUtmMedium' => $oUtmMedium,
        ));
    }

    public function actionAcessar() {
        if (empty($_GET['utm_source']) || empty($_GET['utm_medium']) || empty($_GET['utm_campaign'])) {
            $this->redirect(array('site/notFound'));
        }

        $oLead = Lead::model()->findByPk($_GET['utm_campaign']);

        if (empty($oLead)) {
            $this->redirect(array(Yii::app()->defaultController));
        }

        if (date('Y-m-d H:i:s') < $oLead->data_inicio || date('Y-m-d H:i:s') > $oLead->data_fim) {
            header('location:' . $oLead->url_destino);
            exit;
        }
        $oUtmSource = UtmSource::model()->naoExcluido()->findByAttributes(array(
            'titulo' => $_GET['utm_source'],
        ));
        if (empty($oUtmSource)) {
            $this->redirect(array(Yii::app()->defaultController));
        }
        $oUtmMedium = UtmMedium::model()->naoExcluido()->findByAttributes(array(
            'titulo' => $_GET['utm_medium'],
        ));
        if (empty($oUtmMedium)) {
            $this->redirect(array(Yii::app()->defaultController));
        }

        $oLogLead = new LogLead();
        $oLogLead->lead_id = $oLead->id;
        $oLogLead->utm_source_id = $oUtmSource->id;
        $oLogLead->utm_medium_id = $oUtmMedium->id;
        $oLogLead->usuario_id = !Yii::app()->user->isGuest ? Yii::app()->user->getId() : NULL;
        $oLogLead->ip = $_SERVER['REMOTE_ADDR'];

        if ($oLogLead->save()) {
            if (session_id() == '') {
                session_start();
            }
            setcookie('log_lead_id', $oLogLead->id);
            setcookie('lead_id', $oLogLead->lead_id);
            header('location:' . $oLead->url_destino);
            exit;
        } else {
            $this->redirect(array(Yii::app()->defaultController));
        }
    }

}
