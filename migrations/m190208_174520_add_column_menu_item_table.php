<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu_item`.
 */
class m190208_174520_add_column_menu_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('menu_item', 'encode', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('encode');
    }
}
