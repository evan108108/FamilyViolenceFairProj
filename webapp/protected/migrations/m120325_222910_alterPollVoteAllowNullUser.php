<?php

class m120325_222910_alterPollVoteAllowNullUser extends CDbMigration
{
	public function up()
  {
    $this->alterColumn('poll_vote','user_id','int(11) NULL DEFAULT NULL');
	}

	public function down()
	{
		$this->alterColumn('poll_vote', 'user_id', "int(11) NOT NULL DEFAULT '0'");
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
