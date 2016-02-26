<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Usuários' => Yii::app()->createUrl('usuario/admin'),
        'Atualizar'
    ),
));
?>

<h1>Atualizar Usuário: <?= $model->id ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'oTipoUsuario'=>$oTipoUsuario,)); ?>