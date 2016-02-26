<?php

class m160217_160800_criar_tabela_tipos_usuarios extends CDbMigration {

    public function safeUp() {
        $this->createTable('tipos_usuarios', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(100)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_160800_criar_tabela_tipos_usuarios does not support migration down.\n";
        return false;
    }

}
