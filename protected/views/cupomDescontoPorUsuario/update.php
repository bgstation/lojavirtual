<?php
/* @var $this CupomDescontoPorUsuarioController */
/* @var $model CupomDescontoPorUsuario */

$this->breadcrumbs=array(
	'Cupons Desconto Por Usuarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CupomDescontoPorUsuario', 'url'=>array('index')),
	array('label'=>'Create CupomDescontoPorUsuario', 'url'=>array('create')),
	array('label'=>'View CupomDescontoPorUsuario', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CupomDescontoPorUsuario', 'url'=>array('admin')),
);
?>

<h1>Update CupomDescontoPorUsuario <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>