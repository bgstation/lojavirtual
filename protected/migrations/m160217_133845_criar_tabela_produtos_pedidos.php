<?php

class m160217_133845_criar_tabela_produtos_pedidos extends CDbMigration {

    public function safeUp() {
        $this->createTable('produtos_pedidos', array(
            'id' => 'pk not null auto_increment',
            'pedido_id' => 'integer references pedidos(id)',
            'produto_id' => 'integer references produtos(id)',
            'pacote_id' => 'integer references pacotes(id)',
            'valor' => 'decimal(10,2)',
            'data_liberacao' => 'datetime',
            'data_expiracao' => 'datetime',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133845_criar_tabela_produtos_pedidos does not support migration down.\n";
        return false;
    }

}
