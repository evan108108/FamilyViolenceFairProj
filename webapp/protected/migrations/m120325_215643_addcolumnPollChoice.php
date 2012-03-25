<?php

class m120325_215643_addcolumnPollChoice extends CDbMigration
{
	public function up()
  {
    $this->addColumn('poll_choice', 'right_answer', 'int(1) unsigned NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('poll_choice', 'right_answer');
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
