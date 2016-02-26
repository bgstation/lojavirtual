<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Esqueci minha senha</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="<?= Yii::app()->createUrl(Yii::app()->defaultController) ?>">Home</a></li>
                    <li class="active">Esqueci minha senha</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="login_form">		
                    <form id="sky-form" class="sky-form">
                        <header>Esqueci minha senha</header>

                        <fieldset>					
                            <section>
                                <div class="row">
                                    <label class="label col col-4">E-mail</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append icon-user"></i>
                                            <input type="email" name="email">
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
                                            <input type="password" name="password">
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
        </div>

    </div>
</div>