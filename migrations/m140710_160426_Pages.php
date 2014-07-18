<?php

class m140710_160426_Pages extends CDbMigration
{

	public function safeUp()
	{
        $this->createTable('pages', array(
            'id'        => 'pk',
            'url'     => 'varchar(50) NOT NULL'
        ));

        $this->createTable('pages_data', array(
            'id'        => 'pk',
            'page_id'   => 'integer',
            'title'   => 'varchar(255) NOT NULL',
            'description'   => 'TEXT',
            'meta_description'   => 'varchar(255)',
            'meta_keywords'   => 'varchar(255)',
        ));

        $this->addForeignKey('page_id_fk', 'pages_data', 'page_id', 'pages', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('page_idx', 'pages_data', 'page_id');
	}

	public function safeDown()
	{
        $this->dropTable('pages');

        $this->dropTable('pages_data');
	}

}