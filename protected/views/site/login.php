<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Login / Cadastro</h2>
            </div>
        </div>
    </div>
</div>

<?= SiteHelper::renderFlashMessage() ?>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">Home</a></li>
                    <li class="active">Login / Cadastro</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class='col-md-6'>
                <div class="login_form">		
                    <form id="sky-form" class="sky-form" method="POST">
                        <header>Login</header>

                        <fieldset>					
                            <section>
                                <div class="row">
                                    <label class="label col col-4">E-mail</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append icon-user"></i>
                                            <input type="text" name="LoginForm[username]" />
                                        </label>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="row">
                                    <label class="label col col-4">Senha</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append icon-lock"></i>
                                            <input type="password" name="LoginForm[password]">
                                        </label>
                                        <div class="note"><a href="<?= Yii::app()->createUrl('site/esqueciMinhaSenha') ?>">Esqueci minha senha</a></div>
                                    </div>
                                </div>
                            </section>
                        </fieldset>
                        <footer>
                            <div class="fleft">
                                <button type="submit" class="button">Login</button>
                            </div>
                        </footer>
                    </form>			
                </div>
            </div>
            <div class="col-md-6">
                <div class="reg_form">
                    <form id="sky-form" class="sky-form" method='POST'>
                        <header>Cadastro</header>
                        <fieldset>					
                            <section>
                                <label class="input">
                                    <i class="icon-append icon-user"></i>
                                    <input type="text" name="Usuario[nome]" placeholder="Nome">
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="email" name="Usuario[email]" placeholder="Email">
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-lock"></i>
                                    <input type="password" name="Usuario[senha]" placeholder="Senha" id="senha">
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-lock"></i>
                                    <input type="password" name="Usuario[confirmar_senha]" placeholder="Confirmação de Senha">
                                </label>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="button">Cadastrar</button>
                        </footer>
                    </form>			
                </div>
            </div>
        </div>
    </div>
</div>