<?php
/* @var $this PacoteController */
/* @var $model Pacote */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Pacotes' => Yii::app()->createUrl('pacote/admin'),
        $model->titulo
    ),
));
?>

<h1>Pacote #<?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'titulo',
        'descricao',
        'url_amigavel',
        'desconto',
        'video_apresentacao',
        array(
            'name' => 'imagem',
            'type' => 'raw',
            'value' => !empty($model->imagem) ? CHtml::image(Yii::app()->request->baseUrl . '/' . Yii::app()->params['diretorioImagensPacotes'] . $model->imagem) : 'Não Configurado',
        ),
        'quantidade_visualizacao',
        'periodo_visualizacao',
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
    <?php if (Yii::app()->user->checkAccess('pacote/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Pacotes') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('pacote/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Pacote') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('pacote/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Pacote') ?></a></li>
        <?php endif; ?>
</ul>