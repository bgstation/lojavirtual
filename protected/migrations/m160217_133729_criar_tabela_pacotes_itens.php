<?php

class m160217_133729_criar_tabela_pacotes_itens extends CDbMigration {

    public function safeUp() {
        $this->createTable('pacotes_itens', array(
            'id' => 'pk not null auto_increment',
            'pacote_id' => 'integer references pacotes(id)',
            'produto_id' => 'integer references produtos(id)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133729_criar_tabela_pacotes_itens does not support migration down.\n";
        return false;
    }

}
