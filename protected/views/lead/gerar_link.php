<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'homeLink' => '<a href="' . Yii::app()->createUrl('administrador/index') . '">Home</a>',
    'links' => array(
        'Leads' => Yii::app()->createUrl('cliente/admin'),
        'Gerar Link'
    ),
));
?>

<h1>Gerar Link Lead: <?= $model->id ?></h1>

<div class="form">
    <div class="modal-body">
        <input type="hidden" name="lead_id" id="lead-id" value="<?= $model->id ?>"/>
        <div class="control-group">
            <div class="controls controls-row">
                <label>UTM Source</label>
                <?= CHtml::dropDownList('utm_source', null, CMap::mergeArray(array('' => ''), CHtml::listData($oUtmSource, 'id', 'titulo'))) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <label>UTM Medium</label>
                <?= CHtml::dropDownList('utm_medium', null, CMap::mergeArray(array('' => ''), CHtml::listData($oUtmMedium, 'id', 'titulo'))) ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <a class="btn btn-info pull-left gerar-link-lead">Gerar Link</a>
            </div>
        </div>
        <div class="control-group">
            <div class="controls controls-row">
                <label>Link para divulgação:</label>
                <?= CHtml::textField('link_lead', '', array('class' => 'span6', 'id' => 'link_lead')) ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.gerar-link-lead').click(function () {
        if ($('#utm_source').val() == '' || $('#utm_medium').val() == '') {
            alert('Você deve preencher o UTM Source e o UTM Medium para gerar o link do lead.');
            return false;
        }

        var linkLead = '<?= $_SERVER['HTTP_HOST'] ?>/leads';
        linkLead += '/' + $('#utm_source option:selected').text();
        linkLead += '/' + $('#utm_medium option:selected').text();
        linkLead += '/' + $('#lead-id').val();
        $('#link_lead').val(linkLead);
        return false;
    });
</script>