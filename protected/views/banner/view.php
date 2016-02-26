<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Banners' => Yii::app()->createUrl('banner/admin'),
        $model->titulo
    ),
));
?>

<h1>Atualizar Banner: <?= $model->id ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array(
            'name' => 'imagem',
            'type' => 'raw',
            'value' => !empty($model->imagem) ? CHtml::image(Yii::app()->request->baseUrl . '/' . Yii::app()->params['diretorioImagensBanners'] . $model->imagem) : 'Não Configurado',
        ),
        'link',
        'ordem',
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
    <?php if (Yii::app()->user->checkAccess('banner/admin')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('admin') ?>"><?= Yii::t('site', 'Exibir Banners') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('banner/update')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('update', array('id' => $model->id)) ?>"><?= Yii::t('site', 'Editar Banner') ?></a></li>
    <?php endif; ?>
    <?php if (Yii::app()->user->checkAccess('banner/create')) : ?>
        <li><a class="btn" href="<?= $this->createUrl('create') ?>"><?= Yii::t('site', 'Cadastrar Banner') ?></a></li>
        <?php endif; ?>
</ul>