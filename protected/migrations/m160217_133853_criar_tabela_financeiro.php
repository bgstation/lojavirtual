<?php

class m160217_133853_criar_tabela_financeiro extends CDbMigration {

    public function safeUp() {
        $this->createTable('financeiro', array(
            'id' => 'pk not null auto_increment',
            'valor_item' => 'decimal(10,2)',
            'valor_cupom' => 'decimal(10,2)',
            'valor_liquido' => 'decimal(10,2)',
            'cupom_desconto_id' => 'integer references cupons_desconto(id)',
            'produto_pedido_id' => 'integer references produtos_pedidos(id)',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133853_criar_tabela_financeiro does not support migration down.\n";
        return false;
    }

}
