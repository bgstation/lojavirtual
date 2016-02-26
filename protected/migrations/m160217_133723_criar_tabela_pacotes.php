<?php

class m160217_133723_criar_tabela_pacotes extends CDbMigration {

    public function safeUp() {
        $this->createTable('pacotes', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(250)',
            'descricao' => 'text',
            'url_amigavel' => 'varchar(250)',
            'desconto' => 'decimal(10,2)',
            'video_apresentacao' => 'varchar(100)',
            'imagem' => 'varchar(100)',
            'destaque' => 'boolean default false',
            'quantidade_visualizacao' => 'integer',
            'periodo_visualizacao' => 'integer',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133723_criar_tabela_pacotes does not support migration down.\n";
        return false;
    }

}
