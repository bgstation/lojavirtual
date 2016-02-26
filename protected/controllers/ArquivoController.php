<?php

class ArquivoController extends Controller {

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
                'actions' => array('delete', 'salvarArquivoModal', 'getArquivo', 'alterarOrdem'),
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
     * @return Arquivo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Arquivo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Arquivo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'arquivo-form') {
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

    public function actionSalvarArquivoModal() {
        $aRetorno = array();
        $arquivo = !empty($_POST['arquivo_id']) ? $this->loadModel($_POST['arquivo_id']) : new Arquivo;
        $aRetorno['new_record'] = !empty($_POST['arquivo_id']) ? 'false' : 'true';
        $aRetorno['mudar_modulo'] = 'false';
        if ($aRetorno['new_record'] == 'false') {
            if ($arquivo->modulo_id != $_POST['modulo']) {
                $arquivo->ordem = Arquivo::getUltimaPosicaoOrdemDoArquivoNoModulo($arquivo->modulo_id);
                $aRetorno['mudar_modulo'] = 'true';
            }
        } else {
            $arquivo->ordem = Arquivo::getUltimaPosicaoOrdemDoArquivoNoModulo($_POST['modulo']);
        }
        $arquivo->modulo_id = $_POST['modulo'];
        $arquivo->titulo = $_POST['titulo'];
        $arquivo->carga_horaria = $_POST['carga_horaria'];
        $arquivo->arquivo = !empty($_POST['arquivo']) ? $_POST['arquivo'] : NULL;
        $arquivo->tipo_arquivo_id = $_POST['tipo_arquivo'];
        $oModulo = Modulo::model()->findByPk($arquivo->modulo_id);

        $aRetorno['titulo'] = $arquivo->titulo;
        $aRetorno['modulo'] = $arquivo->modulo_id;
        $aRetorno['titulo_tipo_arquivo'] = $arquivo->aTipoArquivo[$arquivo->tipo_arquivo_id];
        $aRetorno['titulo_modulo'] = $oModulo->titulo;
        $aRetorno['carga_horaria'] = $arquivo->carga_horaria;

        if ($arquivo->save()) {
            $aRetorno['id'] = $arquivo->id;
            $aRetorno['status'] = 'ok';
        } else {
            $aRetorno['status'] = 'erro';
        }
        echo json_encode($aRetorno);
    }

    public function actionGetArquivo() {
        $arquivoId = $_GET['arquivo_id'];
        $aArquivo = array();
        $oArquivo = Arquivo::model()->findByPk($arquivoId);
        $aArquivo['id'] = $oArquivo->id;
        $aArquivo['titulo'] = $oArquivo->titulo;
        $aArquivo['modulo'] = $oArquivo->modulo_id;
        $aArquivo['tipo_arquivo'] = $oArquivo->tipo_arquivo_id;
        $aArquivo['titulo_tipo_arquivo'] = $oArquivo->aTipoArquivo[$oArquivo->tipo_arquivo_id];
        $aArquivo['arquivo'] = $oArquivo->arquivo;
        $aArquivo['carga_horaria'] = $oArquivo->carga_horaria;
        echo json_encode($aArquivo);
    }

    public function actionAlterarOrdem() {
        $ordemArquivos = explode(';', $_POST['ordem']);
        foreach ($ordemArquivos as $arquivos) {
            $aArquivo = explode('-', $arquivos);
            $oArquivo = Arquivo::model()->findByPk($aArquivo[0]);
            $oArquivo->ordem = $aArquivo[1] + 1;
            if ($oArquivo->save()) {
                print_r($oArquivo->getErrors());
            }
        }
    }

}
