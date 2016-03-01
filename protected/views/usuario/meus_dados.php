<script src="<?= Yii::app()->request->baseUrl ?>/js/jquery.mask.js" type="text/javascript"></script>

<div class="heads">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Meus Dados</h2>
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
                    <li class="active">Meus Dados</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="reg_form">
                    <form id="sky-form" class="sky-form" method="POST">
                        <fieldset>					
                            <section>
                                <label class="input">
                                    <i class="icon-append icon-user"></i>
                                    <input type="text" name="Usuario[nome]" placeholder="Nome" value='<?= $oUsuario->nome ?>' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="text" name="Usuario[email]" placeholder="E-mail" value='<?= $oUsuario->email ?>' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="text" id='Cliente_cpf' name="Cliente[cpf]" placeholder="CPF" value='<?= $oCliente->cpf ?>' />
                                </label>
                            </section>

                            <div class='row'>
                                <section class="col col-6">
                                    <label class="select">
                                        <?= CHtml::dropDownList('Cliente[sexo]', $oCliente->sexo, CMap::mergeArray(['' => 'Sexo'], $oCliente->aSexo), array('id' => 'Cliente_sexo')) ?>
                                        <i></i>
                                    </label>
                                </section>

                                <section class="col col-6">
                                    <label class="input">
                                        <input type="text" id='Cliente_data_nascimento' name="Cliente[data_nascimento]" placeholder="Data de nascimento" value='<?= ClienteHelper::renderDataNascimento($oCliente->data_nascimento) ?>' />
                                    </label>
                                </section>
                            </div>

                            <div class="row">
                                <section class="col col-6">
                                    <label class="input">
                                        <input type="text" id='Cliente_celular' name="Cliente[celular]" placeholder="Celular" value='<?= $oCliente->celular ?>' />
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="input">
                                        <input type="text" id='Cliente_telefone' name="Cliente[telefone]" placeholder="Telefone" value='<?= $oCliente->telefone ?>' />
                                    </label>
                                </section>
                            </div>

                        </fieldset>

                        <fieldset>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-user"></i>
                                    <input type="text" id='Cliente_cep' name="Cliente[cep]" placeholder="CEP" value='<?= $oCliente->cep ?>' />
                                    <img src='<?= Yii::app()->request->baseUrl ?>/images/loading.gif' class='loading' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="text" id='Cliente_endereco' name="Cliente[endereco]" placeholder="Endereço" value='<?= $oCliente->endereco ?>' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="text" id='Cliente_numero' name="Cliente[numero]" placeholder="Número" value='<?= $oCliente->numero ?>' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="text" id='Cliente_complemento' name="Cliente[complemento]" placeholder="Complemento" value='<?= $oCliente->complemento ?>' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="text" id='Cliente_bairro' name="Cliente[bairro]" placeholder="Bairro" value='<?= $oCliente->bairro ?>' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="text" id='Cliente_cidade' name="Cliente[cidade]" placeholder="Cidade" value='<?= $oCliente->cidade ?>' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-envelope-alt"></i>
                                    <input type="text" id='Cliente_uf' name="Cliente[uf]" placeholder="UF" value='<?= $oCliente->uf ?>' />
                                </label>
                            </section>

                        </fieldset>

                        <fieldset>
                            <section>
                                <label class="input">
                                    <i class="icon-append icon-lock"></i>
                                    <input type="password" name="Usuario[senha]" placeholder="Senha" value='<?= $oUsuario->senha ?>' />
                                </label>
                            </section>

                            <section>
                                <label class="input">
                                    <i class="icon-append icon-lock"></i>
                                    <input type="password" name="Usuario[confirmar_senha]" placeholder="Confirmação de Senha" value='<?= $oUsuario->confirmar_senha ?>' />
                                </label>
                            </section>
                        </fieldset>

                        <footer>
                            <button type="submit" class="button">Atualizar</button>
                        </footer>
                    </form>			
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#Cliente_telefone').mask('(00)0000-0000');
        $('#Cliente_celular').mask('(00)00000-0000');
        $('#Cliente_data_nascimento').mask('00/00/0000');
        $('#Cliente_cep').mask('99999-999');
        $('#Cliente_cpf').mask('999.999.999-99');
        $('.loading').css('display', 'none');
    });

    $('#Cliente_cep').change(function () {
        buscarCep($(this).val());
    });

    function buscarCep(cep) {
        $.ajax({
            url: '<?= Yii::app()->createUrl('cliente/buscarCep') ?>',
            type: 'GET',
            data: {
                cep: cep
            },
            beforeSend: function () {
                $(".loading").show();
            },
            success: function (data) {
                $('.loading').hide();
                var obj = $.parseJSON(data);
                if (obj.resultado == 0) {
                    alert('CEP não encontrado.');
                }
                var logradouro = obj.logradouro.split(' - de ');
                $('#Cliente_endereco').val(obj.tipo_logradouro + ' ' + logradouro[0]);
                $('#Cliente_bairro').val(obj.bairro);
                $('#Cliente_cidade').val(obj.cidade);
                $('#Cliente_uf').val(obj.uf);
            }
        });
    }
</script>