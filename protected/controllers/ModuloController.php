<?php

class ModuloController extends Controller {

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
                'actions' => array('delete', 'alterarOrdem', 'salvarModuloModal', 'getModulo'),
                'expression' => 'Yii::app()->controller->checkPermission()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Modulo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Modulo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Modulo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'modulo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
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

    public function actionSalvarModuloModal() {
        $aRetorno = array();
        $aRetorno['new_record'] = !empty($_POST['modulo_id']) ? 'false' : 'true';
        $modulo = !empty($_POST['modulo_id']) ? $this->loadModel($_POST['modulo_id']) : new Modulo;
        $modulo->titulo = $_POST['titulo'];
        if ($aRetorno['new_record'] == 'true') {
            $modulo->ordem = Modulo::getUltimaPosicaoOrdem($_POST['produto_id']);
        }
        $modulo->produto_id = $_POST['produto_id'];
        $aRetorno['titulo'] = $modulo->titulo;
        if ($modulo->save()) {
            $aRetorno['id'] = $modulo->id;
            $aRetorno['status'] = 'ok';
        } else {
            print_r($modulo->getErrors());
            $aRetorno['status'] = 'erro';
        }
        echo json_encode($aRetorno);
    }

    public function actionGetModulo() {
        $moduloId = $_GET['modulo_id'];
        $aModulo = array();
        $oModulo = Modulo::model()->findByPk($moduloId);
        $aModulo['id'] = $oModulo->id;
        $aModulo['titulo'] = $oModulo->titulo;
        echo json_encode($aModulo);
    }

    public function actionAlterarOrdem() {
        $ordemModulos = explode(';', $_POST['ordem']);
        foreach ($ordemModulos as $modulos) {
            $aModulo = explode('-', $modulos);
            $oModulo = Modulo::model()->findByPk($aModulo[0]);
            $oModulo->ordem = $aModulo[1] + 1;
            if (!$oModulo->save()) {
                print_r($modulo->getErrors());
            }
        }
    }

}
