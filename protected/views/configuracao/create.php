<?php
/* @var $this ConfiguracaoController */
/* @var $model Configuracao */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Configurações' => Yii::app()->createUrl('configuracao/admin'),
        'Cadastrar'
    ),
));
?>

<h1>Cadastrar Configuração</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>