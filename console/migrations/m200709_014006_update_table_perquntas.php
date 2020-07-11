<?php

use yii\db\Migration;

/**
 * Class m200709_014006_update_table_perquntas
 */
class m200709_014006_update_table_perquntas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('perguntas', 'materia', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200709_014006_update_table_perquntas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200709_014006_update_table_perquntas cannot be reverted.\n";

        return false;
    }
    */
}
