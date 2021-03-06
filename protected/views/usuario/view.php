<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Usuários' => Yii::app()->createUrl('usuario/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Usuário: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'nome',
        'email',
        array(
            'name' => 'tipo_usuario_id',
            'value' => $model->tipoUsuario->titulo,
        ),
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
    <?php if (Yii::app()->user->checkAccess('usuario/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Usuários') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('usuario/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Usuário') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('usuario/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Usuário') ?></a></li>
        <?php endif; ?>
</ul>