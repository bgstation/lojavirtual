<?php
/* @var $this ConfiguracaoController */
/* @var $model Configuracao */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Configurações' => Yii::app()->createUrl('configuracao/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Configuração: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'codigo',
        'valor',
        'descricao',
        array(
            'name' => 'exibir',
            'value' => $model->exibir ? 'Sim' : 'Não',
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
    <?php if (Yii::app()->user->checkAccess('configuracao/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Configurações') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('configuracao/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Configuração') ?></a></li>
    <?php endif; ?>
</ul>