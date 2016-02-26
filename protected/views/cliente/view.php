<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Clientes' => Yii::app()->createUrl('cliente/admin'),
        $model->id
    ),
));
?>

<h1>Atualizar Cliente: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'cpf',
        'telefone',
        'celular',
        array(
            'name' => 'sexo',
            'value' => $model->aSexo[$model->sexo]
        ),
        'uf',
        'cidade',
        'cep',
        'numero',
        'complemento',
        'bairro',
        'endereco',
        array(
            'name' => 'data_nascimento',
            'value' => FormatHelper::data($model->data_nascimento),
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
    <?php if (Yii::app()->user->checkAccess('cliente/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Clientes') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('cliente/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Cliente') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('cliente/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Cliente') ?></a></li>
        <?php endif; ?>
</ul>