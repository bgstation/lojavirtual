<?php
/* @var $this TipoUsuarioController */
/* @var $model TipoUsuario */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Tipos de Usuários' => Yii::app()->createUrl('tipoUsuario/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Tipo de Usuário: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'titulo',
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
    <?php if (Yii::app()->user->checkAccess('tipoUsuario/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Tipos de Usuários') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('tipoUsuario/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Tipo de Usuário') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('tipoUsuario/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Tipo de Usuário') ?></a></li>
        <?php endif; ?>
</ul>