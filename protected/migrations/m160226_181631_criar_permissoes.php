<?php

class m160226_181631_criar_permissoes extends CDbMigration {

    public function safeUp() {

        /* ADMINISTRADOR */

        $this->insert('rotas', array(
            'titulo' => 'Home',
            'controller' => 'administrador',
            'action' => 'index',
            'categoria' => 'Administrador',
        ));

        /* ADMINISTRADOR */

        /* BANNER */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'banner',
            'action' => 'admin',
            'categoria' => 'Banner',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'banner',
            'action' => 'create',
            'categoria' => 'Banner',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'banner',
            'action' => 'view',
            'categoria' => 'Banner',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'banner',
            'action' => 'update',
            'categoria' => 'Banner',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'banner',
            'action' => 'delete',
            'categoria' => 'Banner',
        ));

        /* BANNER */

        /* CLIENTE */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'cliente',
            'action' => 'admin',
            'categoria' => 'Cliente',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'cliente',
            'action' => 'create',
            'categoria' => 'Cliente',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'cliente',
            'action' => 'view',
            'categoria' => 'Cliente',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'cliente',
            'action' => 'update',
            'categoria' => 'Cliente',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'cliente',
            'action' => 'delete',
            'categoria' => 'Cliente',
        ));

        /* CLIENTE */

        /* CUPOM DE DESCONTO */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'cupomDesconto',
            'action' => 'admin',
            'categoria' => 'Cupom de Desconto',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'cupomDesconto',
            'action' => 'create',
            'categoria' => 'Cupom de Desconto',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'cupomDesconto',
            'action' => 'view',
            'categoria' => 'Cupom de Desconto',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'cupomDesconto',
            'action' => 'update',
            'categoria' => 'Cupom de Desconto',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'cupomDesconto',
            'action' => 'delete',
            'categoria' => 'Cupom de Desconto',
        ));

        /* CUPOM DE DESCONTO */

        /* MATÉRIA */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'materia',
            'action' => 'admin',
            'categoria' => 'Matérias',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'materia',
            'action' => 'create',
            'categoria' => 'Matérias',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'materia',
            'action' => 'view',
            'categoria' => 'Matérias',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'materia',
            'action' => 'update',
            'categoria' => 'Matérias',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'materia',
            'action' => 'delete',
            'categoria' => 'Matérias',
        ));

        /* MATÉRIA */

        /* PACOTE */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'pacote',
            'action' => 'admin',
            'categoria' => 'Pacote',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'pacote',
            'action' => 'create',
            'categoria' => 'Pacote',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'pacote',
            'action' => 'view',
            'categoria' => 'Pacote',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'pacote',
            'action' => 'update',
            'categoria' => 'Pacote',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'pacote',
            'action' => 'delete',
            'categoria' => 'Pacote',
        ));

        /* PACOTE */

        /* PRODUTO */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'produto',
            'action' => 'admin',
            'categoria' => 'Produto',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'produto',
            'action' => 'create',
            'categoria' => 'Produto',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'produto',
            'action' => 'view',
            'categoria' => 'Produto',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'produto',
            'action' => 'delete',
            'categoria' => 'Produto',
        ));

        /* PRODUTO */

        /* MÓDULOS */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'produto',
            'action' => 'modulos',
            'categoria' => 'Módulo',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'modulo',
            'action' => 'salvarModuloModal',
            'categoria' => 'Módulo',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Alterar Ordem',
            'controller' => 'modulo',
            'action' => 'alterarOrdem',
            'categoria' => 'Módulo',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'modulo',
            'action' => 'delete',
            'categoria' => 'Módulo',
        ));

        /* MÓDULOS */

        /* ARQUIVOS */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'produto',
            'action' => 'arquivos',
            'categoria' => 'Arquivo',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'arquivo',
            'action' => 'salvarArquivoModal',
            'categoria' => 'Arquivo',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Alterar Ordem',
            'controller' => 'arquivo',
            'action' => 'alterarOrdem',
            'categoria' => 'Arquivo',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'arquivo',
            'action' => 'delete',
            'categoria' => 'Arquivo',
        ));

        /* ARQUIVOS */

        /* TIPO DE USUÁRIO */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'tipoUsuario',
            'action' => 'admin',
            'categoria' => 'Tipo de Usuário',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'tipoUsuario',
            'action' => 'create',
            'categoria' => 'Tipo de Usuário',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'tipoUsuario',
            'action' => 'view',
            'categoria' => 'Tipo de Usuário',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'tipoUsuario',
            'action' => 'update',
            'categoria' => 'Tipo de Usuário ',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'tipoUsuario',
            'action' => 'delete',
            'categoria' => 'Tipo de Usuário ',
        ));

        /* TIPO DE USUÁRIO */

        /* USUÁRIO */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'usuario',
            'action' => 'admin',
            'categoria' => 'Usuário',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'usuario',
            'action' => 'create',
            'categoria' => 'Usuário',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'usuario',
            'action' => 'view',
            'categoria' => 'Usuário',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'usuario',
            'action' => 'update',
            'categoria' => 'Usuário',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'usuario',
            'action' => 'delete',
            'categoria' => 'Usuário',
        ));

        /* USUÁRIO */

        /* PEDIDO */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'pedido',
            'action' => 'admin',
            'categoria' => 'Pedido',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'pedido',
            'action' => 'create',
            'categoria' => 'Pedido',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'pedido',
            'action' => 'view',
            'categoria' => 'Pedido',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'pedido',
            'action' => 'update',
            'categoria' => 'Pedido',
        ));

        /* PEDIDO */

        /* CARRINHO */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'carrinho',
            'action' => 'admin',
            'categoria' => 'Carrinho',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'carrinho',
            'action' => 'create',
            'categoria' => 'Carrinho',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'carrinho',
            'action' => 'view',
            'categoria' => 'Carrinho',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'carrinho',
            'action' => 'update',
            'categoria' => 'Carrinho',
        ));

        /* CARRINHO */

        /* LEAD */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'lead',
            'action' => 'admin',
            'categoria' => 'Lead',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'lead',
            'action' => 'create',
            'categoria' => 'Lead',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'lead',
            'action' => 'view',
            'categoria' => 'Lead',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'lead',
            'action' => 'update',
            'categoria' => 'Lead',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'lead',
            'action' => 'delete',
            'categoria' => 'Lead',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Gerar Link',
            'controller' => 'lead',
            'action' => 'gerarLink',
            'categoria' => 'Lead',
        ));

        /* LEAD */

        /* UTM MEDIUM */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'utmMedium',
            'action' => 'admin',
            'categoria' => 'UTM Medium',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'utmMedium',
            'action' => 'create',
            'categoria' => 'UTM Medium',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'utmMedium',
            'action' => 'view',
            'categoria' => 'UTM Medium',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'utmMedium',
            'action' => 'update',
            'categoria' => 'UTM Medium',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'utmMedium',
            'action' => 'delete',
            'categoria' => 'UTM Medium',
        ));

        /* UTM MEDIUM */

        /* UTM SOURCE */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'utmSource',
            'action' => 'admin',
            'categoria' => 'UTM Source',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Cadastrar',
            'controller' => 'utmSource',
            'action' => 'create',
            'categoria' => 'UTM Source',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'utmSource',
            'action' => 'view',
            'categoria' => 'UTM Source',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'utmSource',
            'action' => 'update',
            'categoria' => 'UTM Source',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Excluir',
            'controller' => 'utmSource',
            'action' => 'delete',
            'categoria' => 'UTM Source',
        ));

        /* UTM SOURCE */

        /* FINANCEIRO */

        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'financeiro',
            'action' => 'admin',
            'categoria' => 'Financeiro',
        ));

        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'financeiro',
            'action' => 'view',
            'categoria' => 'Financeiro',
        ));

        /* FINANCEIRO */
    }

    public function safeDown() {
        echo "m160226_181631_criar_permissoes does not support migration down.\n";
        return false;
    }

}
