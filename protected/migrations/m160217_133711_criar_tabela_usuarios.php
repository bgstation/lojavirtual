<?php

class m160217_133711_criar_tabela_usuarios extends CDbMigration {

    public function safeUp() {
        $this->createTable('usuarios', array(
            'id' => 'pk not null auto_increment',
            'nome' => 'varchar(250)',
            'email' => 'varchar(250)',
            'senha' => 'varchar(100)',
            'tipo_usuario_id' => 'integer',
            'role_id' => 'integer',
            'facebook_id' => 'varchar(50)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133711_criar_tabela_usuarios does not support migration down.\n";
        return false;
    }

}
