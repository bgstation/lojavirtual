<?php

class m160227_000854_criar_tabela_configuracoes extends CDbMigration {

    public function up() {
        $this->createTable('configuracoes', array(
            'id' => 'integer not null auto_increment primary key',
            'codigo' => 'varchar(50)',
            'valor' => 'text',
            'descricao' => 'text',
            'exibir' => 'boolean default true',
            'excluido' => 'boolean default false',
            'tipo' => 'integer',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime'
        ));

        $this->insert('configuracoes', array(
            'codigo' => 'PAGSEGURO_EMAIL',
            'descricao' => 'Email do PagSeguro',
            'tipo' => 0,
        ));
        
        $this->insert('configuracoes', array(
            'codigo' => 'PAGSEGURO_TOKEN',
            'descricao' => 'Token do PagSeguro',
            'tipo' => 0,
        ));
    }

    public function down() {
        echo "m160227_000854_criar_tabela_configuracoes does not support migration down.\n";
        return false;
    }

}
