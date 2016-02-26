<?php

class AdministradorController extends Controller {
    
    public $layout = '//layouts/main';

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index'),
                'expression' => 'Yii::app()->controller->checkPermission()',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->render('index');
    }
    
    

}
