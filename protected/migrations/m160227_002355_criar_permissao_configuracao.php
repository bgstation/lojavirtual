<?php

class m160227_002355_criar_permissao_configuracao extends CDbMigration {

    public function safeUp() {
        $this->insert('rotas', array(
            'titulo' => 'Visualizar',
            'controller' => 'configuracao',
            'action' => 'admin',
            'categoria' => 'Configurações',
        ));
        $this->insert('rotas', array(
            'titulo' => 'Atualizar',
            'controller' => 'configuracao',
            'action' => 'update',
            'categoria' => 'Configurações',
        ));
        $this->insert('rotas', array(
            'titulo' => 'Detalhes',
            'controller' => 'configuracao',
            'action' => 'view',
            'categoria' => 'Configurações',
        ));
    }

    public function safeDown() {
        echo "m160227_002355_criar_permissao_configuracao does not support migration down.\n";
        return false;
    }

}
