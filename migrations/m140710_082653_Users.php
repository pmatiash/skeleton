<?php

class m140710_082653_Users extends CDbMigration
{
	public function safeUp()
	{
        $this->execute("CREATE TYPE user_status AS ENUM('active', 'deleted')");

        // create table
        $this->createTable('users', array(
            'id'        => 'pk',
            'email'     => 'varchar(50) NOT NULL',
            'password'  => 'varchar(60) NOT NULL',
            'salt'      => 'varchar(15) NOT NULL',
            'name'      => 'varchar(50) NULL',
            'role'      => 'varchar(20) NOT NULL',
            'status'    => "user_status NOT NULL DEFAULT 'active'::user_status",
        ));

        // add default admin user
        $salt = \Model\User::generateSalt(15);
        $passwordHash = \Model\User::getPasswordHash('admin', $salt);

        $this->insert('users', array(
            'email'     => 'admin@matyash.pw',
            'password'  => $passwordHash,
            'salt'      => $salt,
            'name'      => 'SkeletonAdmin',
            'role'      => \Model\User::ROLE_ADMINISTRATOR,
        ));
	}

	public function safeDown()
	{
        $this->dropTable('users');
        $this->execute("DROP TYPE user_status");
	}

}