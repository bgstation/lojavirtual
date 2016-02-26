<?php
/* @var $this MateriaController */
/* @var $model Materia */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Matérias' => Yii::app()->createUrl('materia/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Matéria: <?= $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'titulo',
        'url_amigavel',
        array(
            'name' => 'excluido',
            'value' => $model->excluido ? 'Sim' : 'Não',
        ),
        array(
            'name' => 'datahora_insercao',
            'value' => FormatHelper::dataHora($model->datahora_insercao),
        ),
        array(
            'name' => 'datahora_ultima_atualizacao',
            'value' => FormatHelper::dataHora($model->datahora_ultima_atualizacao),
        ),
    ),
));
?>

<h3><?= Yii::t('site', 'Opções alternativas') ?></h3>
<ul class="nav_alter">
    <?php if (Yii::app()->user->checkAccess('materia/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Matérias') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('materia/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Matéria') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('materia/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Matéria') ?></a></li>
        <?php endif; ?>
</ul>