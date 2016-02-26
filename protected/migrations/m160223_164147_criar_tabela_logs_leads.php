<?php

class m160223_164147_criar_tabela_logs_leads extends CDbMigration {

    public function safeUp() {
        $this->createTable('logs_leads', array(
            'id' => 'pk not null auto_increment',
            'lead_id' => 'integer references leads(id)',
            'utm_source_id' => 'integer references utm_source(id)',
            'utm_medium_id' => 'integer references utm_medium(id)',
            'usuario_id' => 'integer references usuarios(id)',
            'ip' => 'varchar(20)',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160223_164147_criar_tabela_logs_leads does not support migration down.\n";
        return false;
    }

}
