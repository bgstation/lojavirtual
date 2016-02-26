<?php
/* @var $this CarrinhoController */
/* @var $model Carrinho */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Carrinho' => Yii::app()->createUrl('carrinho/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Carrinho: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'usuario_id',
        'produto_id',
        'pacote_id',
        'valor',
        'excluido',
        'datahora_insercao',
        'datahora_ultima_atualizacao',
    ),
));
?>

<h3><?= Yii::t('site', 'Opções alternativas') ?></h3>
<ul class="nav_alter">
    <?php if (Yii::app()->user->checkAccess('carrinho/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Carrinho') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('carrinho/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Carrinho') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('carrinho/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Carrinho') ?></a></li>
        <?php endif; ?>
</ul>