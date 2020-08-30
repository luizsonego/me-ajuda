<?php

use yii\db\Migration;

/**
 * Class m200830_174842_add_lista_column_perguntas_table
 */
class m200830_174842_add_lista_column_perguntas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('perguntas', 'lista', $this->string()->defaultValue('Disabled'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200830_174842_add_lista_column_perguntas_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200830_174842_add_lista_column_perguntas_table cannot be reverted.\n";

        return false;
    }
    */
}
