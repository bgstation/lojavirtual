<?php

/**
 * @property Usuario $model Atalho para Yii::app()->user->getModel(): Yii::app()->user->model
 */
class WebUser extends CWebUser {

    /**
     * @var Usuario
     */
    protected $modelObject;

    /**
     * @return Usuario
     */
    public function getModel() {
        if ($this->modelObject === null) {
            $this->modelObject = Usuario::model()->findByPk($this->id);
        }
        return $this->modelObject;
    }

    /**
     * Performs access check for this user.
     * @param string $operation the name of the operation that need access check.
     * @param array $params name-value pairs that would be passed to business rules associated
     * with the tasks and roles assigned to the user.
     * @param boolean $allowCaching whether to allow caching the result of access check.
     * This parameter has been available since version 1.0.5. When this parameter
     * is true (default), if the access check of an operation was performed before,
     * its result will be directly returned when calling this method to check the same operation.
     * If this parameter is false, this method will always call {@link CAuthManager::checkAccess}
     * to obtain the up-to-date access result. Note that this caching is effective
     * only within the same request.
     * @return boolean whether the operations can be performed by this user.
     */
    public function checkAccess($operation, $params = array(), $allowCaching = true) {
        if ($this->isGuest) {
            return false;
        }

        $operations = (array) $operation;

        $oUsuario = Usuario::model()->findByPk(Yii::app()->user->getId());

        foreach ($operations as $operation) {

            $rolesDesignadas = Yii::app()->authManager->getRoles(Yii::app()->user->id);

            if (empty($rolesDesignadas)) {
                Yii::app()->authManager->assign(
                        $oUsuario->tipoUsuario->titulo, $this->id
                );
            }

            if (Yii::app()->authManager->isAssigned($operation, $this->id)) {
                return true;
            }

            $ret = $this->roleHasChild($oUsuario->tipoUsuario->titulo, $operation);

            if ($ret) {
                return true;
            }
        }
        return false;
    }

    protected function roleHasChild($role, $child) {
        foreach (Yii::app()->authManager->getItemChildren($role) as $role) {

            if ($role->name == $child || $this->roleHasChild($role->name, $child)) {
                return true;
            }
        }

        return false;
    }

}
