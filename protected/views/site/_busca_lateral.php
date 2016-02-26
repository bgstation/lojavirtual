<?= $termoBuscado = !empty($termoBuscado) ? $termoBuscado : '' ?>
<div class="row sidebar">
    <div class="col-md-12">
        <h3>Buscar</h3>
        <div class="quick-search">
            <form method='POST' action='<?= Yii::app()->createUrl('site/busca') ?>'>
                <h5>Digite a busca</h5>
                <input type='text' name='busca' class='form-control' value='<?= $termoBuscado ?>' />
                <input type="submit" class="btn btn-black btn-block" name="submit" value="Buscar" />
            </form>
        </div>
    </div>
</div>