<?php

class m160224_145047_criar_tabela_logs_leads_itens extends CDbMigration {

    public function safeUp() {
        $this->createTable('logs_leads_itens', array(
            'id' => 'pk not null auto_increment',
            'lead_id' => 'integer references leads(id)',
            'log_lead_id' => 'integer references logs_leads(id)',
            'tipo_item' => 'integer',
            'item_id' => 'integer',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160224_145047_criar_tabela_logs_leads_itens does not support migration down.\n";
        return false;
    }

}
