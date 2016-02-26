<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Pedidos' => Yii::app()->createUrl('pedido/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Pedido: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array(
            'name' => 'status_pagamento',
            'value' => $model->aStatus[$model->status_pagamento]
        ),
        array(
            'name' => 'usuario_id',
            'value' => $model->usuario->nome
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
    <?php if (Yii::app()->user->checkAccess('pedido/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Pedidos') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('pedido/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Pedido') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('pedido/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Pedido') ?></a></li>
        <?php endif; ?>
</ul>