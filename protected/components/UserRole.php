<?php

class UserRole extends CPhpAuthManager {

    /**
     * Carrega a hierarquia de roles
     */
    public function init() {
        $return = parent::init();

        $oUsuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        $role = $this->createRole($oUsuario->tipoUsuario->titulo);

        if (empty($_SESSION[base64_encode(Yii::app()->params['projeto'] . '_PermissoesAcesso')][base64_encode('PermissoesAcessoUsuario')])) {
            $_aPermissoes = Yii::app()->user->getState('__' . base64_encode(Yii::app()->params['projeto'] . '_PermissoesAcessoUsuario'));
            if(!empty($_aPermissoes)) {
                $aPermissoes = $_aPermissoes[base64_encode(Yii::app()->params['projeto'] . '_PermissoesAcesso')][base64_encode('PermissoesAcessoUsuario')];
            }
        } else {
            $aPermissoes = $_SESSION[base64_encode(Yii::app()->params['projeto'] . '_PermissoesAcesso')][base64_encode('PermissoesAcessoUsuario')];
        }

        if (!empty($aPermissoes)) {
            $this->createOperation(base64_encode('visualizaAdministrador'));
            $role->addChild(base64_encode('visualizaAdministrador'));
            foreach ($aPermissoes as $controller => $actions) {
                foreach ($actions[base64_encode('actions')] as $action) {
                    $dController = base64_decode($controller);
                    $dAction = base64_decode($action);
                    $this->createOperation($dController . '/' . $dAction);
                    $role->addChild($dController . '/' . $dAction);
                }
            }
        }
        return $return;
    }

}
