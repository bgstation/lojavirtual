<?php

class m160217_140132_criar_tabela_arquivos extends CDbMigration {

    public function safeUp() {
        $this->createTable('arquivos', array(
            'id' => 'pk not null auto_increment',
            'titulo' => 'varchar(200)',
            'arquivo' => 'varchar(300)',
            'modulo_id' => 'integer references modulos(id)',
            'tipo_arquivo_id' => 'integer',
            'carga_horaria' => 'varchar(20)',
            'ordem' => 'integer',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_140132_criar_tabela_arquivos does not support migration down.\n";
        return false;
    }

}
