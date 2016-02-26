<?php

class m160217_133735_criar_tabela_carrinho extends CDbMigration {

    public function safeUp() {
        $this->createTable('carrinho', array(
            'id' => 'pk not null auto_increment',
            'usuario_id' => 'integer references usuarios(id)',
            'produto_id' => 'integer references produtos(id)',
            'pacote_id' => 'integer references pacotes(id)',
            'valor' => 'decimal(10,2)',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133735_criar_tabela_carrinho does not support migration down.\n";
        return false;
    }

}
