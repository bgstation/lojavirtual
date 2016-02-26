<?php
/* @var $this PacoteItemController */
/* @var $model PacoteItem */

$this->breadcrumbs = array(
    'Pacote Items' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List PacoteItem', 'url' => array('index')),
    array('label' => 'Create PacoteItem', 'url' => array('create')),
    array('label' => 'Update PacoteItem', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete PacoteItem', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage PacoteItem', 'url' => array('admin')),
);
?>

<h1>View PacoteItem #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'pacote_id',
        'produto_id',
        'excluido',
        'datahora_insercao',
        'datahora_ultima_atualizacao',
    ),
));
?>
