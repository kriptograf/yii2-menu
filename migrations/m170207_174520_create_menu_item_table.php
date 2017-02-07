<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu_item`.
 */
class m170207_174520_create_menu_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu_item', [
            'id' => $this->primaryKey(),
            'parent_id'=>$this->integer(11)->defaultValue(0),
            'menu_id'=>$this->integer(11)->notNull(),
            'title'=>$this->string(255)->notNull(),
            'url'=>$this->string(255)->notNull(),
            'class'=>$this->string(255),
            'attr_title'=>$this->string(255),
            'target'=>$this->string(255),
            'rel'=>$this->string(255),
            'sort'=>$this->integer(11),
            'status'=>$this->integer(1)->defaultValue(1),
        ]);
        
        $this->createIndex('idx-menu-id', 'menu_item', 'menu_id');
        $this->addForeignKey('fdx-menu-id', 'menu_item', 'menu_id', 'menu', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fdx-menu-id', 'menu_item');
        $this->dropIndex('idx-menu-id', 'menu_item');
        $this->dropTable('menu_item');
    }
}
