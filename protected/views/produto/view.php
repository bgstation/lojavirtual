<?php
/* @var $this ProdutoController */
/* @var $model Produto */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Produtos' => Yii::app()->createUrl('produto/admin'),
        $model->titulo
    ),
));
?>

<h1>Produto #<?= $model->titulo ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'titulo',
        'descricao',
        'url_amigavel',
        array(
            'name' => 'imagem',
            'type' => 'raw',
            'value' => !empty($model->imagem) ? CHtml::image(Yii::app()->request->baseUrl . '/' . Yii::app()->params['diretorioImagensProdutos'] . $model->imagem) : 'Não Configurado',
        ),
        'video_apresentacao',
        'valor',
        'desconto',
        'carga_horaria',
        'quantidade_visualizacao',
        'periodo_visualizacao',
        array(
            'name' => 'materia_id',
            'value' => $model->materia->titulo,
        ),
        array(
            'name' => 'destaque',
            'value' => $model->destaque ? 'Sim' : 'Não',
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
    <?php if (Yii::app()->user->checkAccess('produto/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Produtos') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('produto/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Produto') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('produto/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Produto') ?></a></li>
        <?php endif; ?>
</ul>
