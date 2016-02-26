<?php
/* @var $this CupomDescontoPorUsuarioController */
/* @var $model CupomDescontoPorUsuario */

$this->breadcrumbs = array(
    'Cupons Desconto Por Usuarios' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List CupomDescontoPorUsuario', 'url' => array('index')),
    array('label' => 'Create CupomDescontoPorUsuario', 'url' => array('create')),
    array('label' => 'Update CupomDescontoPorUsuario', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete CupomDescontoPorUsuario', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage CupomDescontoPorUsuario', 'url' => array('admin')),
);
?>

<h1>View CupomDescontoPorUsuario #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'cupom_desconto_id',
        'pedido_id',
        'utilizando',
        'excluido',
        'datahora_insercao',
        'datahora_ultima_atualizacao',
    ),
));
?>
