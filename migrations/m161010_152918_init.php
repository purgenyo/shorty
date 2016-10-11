<?php

use yii\db\Migration;

class m161010_152918_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // create links table
        $this->createTable('{{%links}}', [
            'link_id' => $this->primaryKey(),
            'full_address' => $this->text(),
            'link_hash' => $this->string(32)->notNull()->defaultValue(''),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%links}}');

        return true;
    }
}
