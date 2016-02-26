<?php

class m160223_164129_criar_tabela_utm_medium extends CDbMigration {

    public function safeUp() {
        $this->createTable('utm_medium', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(200)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160223_164129_criar_tabela_utm_medium does not support migration down.\n";
        return false;
    }

}
