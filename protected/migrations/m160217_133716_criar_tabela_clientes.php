<?php

class m160217_133716_criar_tabela_clientes extends CDbMigration {

    public function safeUp() {
        $this->createTable('clientes', array(
            'id' => 'pk not null auto_increment',
            'cpf' => 'varchar(20)',
            'telefone' => 'varchar(50)',
            'celular' => 'varchar(50)',
            'sexo' => 'varchar(1)',
            'uf' => 'varchar(2)',
            'cidade' => 'varchar(150)',
            'cep' => 'varchar(30)',
            'numero' => 'varchar(30)',
            'complemento' => 'varchar(250)',
            'bairro' => 'varchar(250)',
            'endereco' => 'varchar(250)',
            'data_nascimento' => 'date',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133716_criar_tabela_clientes does not support migration down.\n";
        return false;
    }

}
