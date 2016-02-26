<?php

class m160217_133720_criar_tabela_produtos extends CDbMigration {

    public function safeUp() {
        $this->createTable('produtos', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(250)',
            'descricao' => 'text',
            'url_amigavel' => 'varchar(250)',
            'imagem' => 'varchar(100)',
            'video_apresentacao' => 'varchar(100)',
            'valor' => 'decimal(10,2)',
            'desconto' => 'decimal(10,2)',
            'carga_horaria' => 'decimal(10,2)',
            'quantidade_visualizacao' => 'integer',
            'periodo_visualizacao' => 'integer',
            'tipo_produto' => 'integer',
            'materia_id' => 'integer references materias(id)',
            'destaque' => 'boolean default false',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_133720_criar_tabela_produtos does not support migration down.\n";
        return false;
    }

}
