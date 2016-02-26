<script src="<?= Yii::app()->request->baseUrl ?>/js/jquery.mask.js" type="text/javascript"></script>
<style>
    #navegacao_passos {
        position: static; left: 0; width: 100%; margin-bottom: 1em;
    }
    #btn_finalizar{
        margin-right: 10px;
    }
</style>
<?php
$nomeTela = empty($model->id) ? 'Cadastrar' : 'Atualizar';
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Produtos' => Yii::app()->createUrl('produto/admin'),
        'Cadastrar'
    ),
));

$this->widget('fidelize.widgets.wizard.FWizard', array(
    'tabs' => $tabs,
    'params' => !$model->isNewRecord ? array('id' => $model->id) : null,
));
?>

<div class="row-fluid wizard-content">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'wizard-processo-alvo-filtro',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('url' => '#', 'enctype' => 'multipart/form-data'),
    ));
    ?>
    <div class="span12">
        <?php
        $this->renderPartial('_form', array(
            'form' => $form,
            'model' => $model,
            'oMateria' => $oMateria,
        ));
        ?>
    </div>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'success',
        'size' => 'medium',
        'buttonType' => 'submit',
        'label' => 'Próximo',
        'htmlOptions' => array('class' => 'pull-right', 'id' => 'btn_proximo'),
            )
    );
    if (isset($model->id)) {
        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'success',
            'size' => 'medium',
            'buttonType' => 'submit',
            'label' => 'Finalizar',
            'htmlOptions' => array('class' => 'pull-right', 'id' => 'btn_finalizar'),
                )
        );
    }
    $this->endWidget();
    ?>
</div>