<?php

class m160217_132749_criar_tabela_materias extends CDbMigration {

    public function safeUp() {
        $this->createTable('materias', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(250)',
            'url_amigavel' => 'varchar(250)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_132749_criar_tabela_materias does not support migration down.\n";
        return false;
    }

}
