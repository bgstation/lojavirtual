<?php

class m160217_133825_criar_tabela_pedidos extends CDbMigration {

    public function safeUp() {
        $this->createTable('pedidos', array(
            'id' => 'pk not null auto_increment',
            'status_pagamento' => 'integer',
            'usuario_id' => 'integer references usuarios(id)',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133825_criar_tabela_pedidos does not support migration down.\n";
        return false;
    }

}
