<?php
/* @var $this ModuloController */
/* @var $model Modulo */

$this->breadcrumbs = array(
    'Modulos' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Modulo', 'url' => array('index')),
    array('label' => 'Create Modulo', 'url' => array('create')),
    array('label' => 'Update Modulo', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Modulo', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Modulo', 'url' => array('admin')),
);
?>

<h1>View Modulo #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'titulo',
        'produto_id',
        'ordem',
        'excluido',
        'datahora_insercao',
        'datahora_ultima_atualizacao',
    ),
));
?>
