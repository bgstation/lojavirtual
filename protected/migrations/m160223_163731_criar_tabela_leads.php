<?php

class m160223_163731_criar_tabela_leads extends CDbMigration {

    public function safeUp() {
        $this->createTable('leads', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(200)',
            'data_inicio' => 'datetime',
            'data_fim' => 'datetime',
            'url_destino' => 'varchar(200)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160223_163731_criar_tabela_leads does not support migration down.\n";
        return false;
    }

}
