<?php

class m160223_164125_criar_tabela_utm_source extends CDbMigration {

    public function safeUp() {
        $this->createTable('utm_source', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(200)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160223_164125_criar_tabela_utm_source does not support migration down.\n";
        return false;
    }

}
