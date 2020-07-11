<?php

use yii\db\Migration;

/**
 * Class m200708_230627_create_table_materias
 */
class m200708_230627_create_table_materias extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%materias}}', [
            'id' => $this->primaryKey(),
            'materia' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
            'user_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%materias}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200708_230627_create_table_materias cannot be reverted.\n";

        return false;
    }
    */
}
