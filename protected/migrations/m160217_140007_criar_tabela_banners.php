<?php

class m160217_140007_criar_tabela_banners extends CDbMigration {

    public function safeUp() {
        $this->createTable('banners', array(
            'id' => 'pk not null auto_increment',
            'imagem' => 'varchar(200)',
            'link' => 'varchar(200)',
            'ordem' => 'integer',
            'excluido' => 'boolean default false',
            'datahora_insercao' => 'datetime',
            'datahora_ultima_atualizacao' => 'datetime',
        ));
    }

    public function safeDown() {
        echo "m160217_140007_criar_tabela_banners does not support migration down.\n";
        return false;
    }

}
