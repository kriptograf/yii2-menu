<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m170207_132739_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(255)->notNull(),
            'code'        => $this->string(255)->notNull(),
            'type'        => $this->string(255),
            'description' => $this->text(),
            'status'      => $this->integer(1)->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
