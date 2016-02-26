<?php

class m160226_174121_criar_tabela_rotas_e_tipos_usuarios_rotas extends CDbMigration {

    public function safeUp() {
        $this->createTable('rotas', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(200)',
            'controller' => 'varchar(50)',
            'action' => 'varchar(50)',
            'categoria' => 'varchar(50)',
            'descricao' => 'text',
            'excluido' => 'boolean default false',
            'rota_id' => 'integer',
            'exibir' => 'boolean default true',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));

        $this->createTable('tipos_usuarios_rotas', array(
            'id' => 'pk not null auto_increment',
            'tipo_usuario_id' => 'integer references tipos_usuarios(id)',
            'rota_id' => 'integer references rotas(id)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160226_174121_criar_tabela_rotas_e_tipos_usuarios_rotas does not support migration down.\n";
        return false;
    }
}
