<?php
/* @var $this CupomDescontoController */
/* @var $model CupomDesconto */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Cupons de Desconto' => Yii::app()->createUrl('cupomDesconto/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Cupom de Desconto: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'titulo',
        'percentual',
        'limitacao',
        'utilizados',
        array(
            'name' => 'data_expiracao',
            'value' => FormatHelper::dataHora($model->data_expiracao),
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
    <?php if (Yii::app()->user->checkAccess('cupomDesconto/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Cupons de Desconto') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('cupomDesconto/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Cupom de Desconto') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('cupomDesconto/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Cupom de Desconto') ?></a></li>
        <?php endif; ?>
</ul>