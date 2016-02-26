<?php

class m160217_140126_criar_tabela_modulos extends CDbMigration {

    public function safeUp() {
        $this->createTable('modulos', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(200)',
            'produto_id' => 'integer references produtos(id)',
            'ordem' => 'integer',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_140126_criar_tabela_modulos does not support migration down.\n";
        return false;
    }

}
