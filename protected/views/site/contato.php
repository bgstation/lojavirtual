<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Contato</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">Home</a></li>
                    <li class="active">Contato</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Contato</h3>
            </div>
        </div>
        <div class="row padd20-top-btm">
            <form method="POST">
                <div class="col-md-12 col-sm-12">
                    <input type="text" name="ContactForm[nome]" class="form-control" placeholder="Nome" required>
                    <input type="email" name="ContactForm[email]" class="form-control" placeholder="E-mail" required>
                    <input type="text" name="ContactForm[assunto]" class="form-control" placeholder="Assunto" required>
                    <textarea name="ContactForm[mensagem]" class="form-control" rows="7" placeholder="Mensagem" required></textarea>
                    <input type="submit" name="submit" value="Enviar" class="btn btn-black btn-block btn-lg">
                </div>
            </form>
        </div>
    </div>
</div>