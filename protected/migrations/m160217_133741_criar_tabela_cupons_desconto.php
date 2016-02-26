<?php

class m160217_133741_criar_tabela_cupons_desconto extends CDbMigration {

    public function safeUp() {
        $this->createTable('cupons_desconto', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(100)',
            'percentual' => 'decimal(10,2)',
            'limitacao' => 'integer',
            'utilizados' => 'integer',
            'data_expiracao' => 'datetime',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133741_criar_tabela_cupons_desconto does not support migration down.\n";
        return false;
    }

}
