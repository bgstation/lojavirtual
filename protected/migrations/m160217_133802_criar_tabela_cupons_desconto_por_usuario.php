<?php

class m160217_133802_criar_tabela_cupons_desconto_por_usuario extends CDbMigration {

    public function safeUp() {
        $this->createTable('cupons_desconto_por_usuario', array(
            'id' => 'pk not null auto_increment',
            'cupom_desconto_id' => 'integer references cupons_desconto(id)',
            'pedido_id' => 'integer references pedidos(id)',
            'utilizando' => 'boolean default true',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133802_criar_tabela_cupons_desconto_por_usuario does not support migration down.\n";
        return false;
    }

}
