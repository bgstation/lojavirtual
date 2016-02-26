<?php
/* @var $this ArquivoController */
/* @var $model Arquivo */

$this->breadcrumbs = array(
    'Arquivos' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Arquivo', 'url' => array('index')),
    array('label' => 'Create Arquivo', 'url' => array('create')),
    array('label' => 'Update Arquivo', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Arquivo', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Arquivo', 'url' => array('admin')),
);
?>

<h1>View Arquivo #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'titulo',
        'arquivo',
        'modulo_id',
        'tipo_arquivo_id',
        'carga_horaria',
        'ordem',
        'excluido',
        'datahora_insercao',
        'datahora_ultima_atualizacao',
    ),
));
?>
