<?php

use yii\db\Migration;

/**
 * Class m200811_200714_add_auth_column_aluno_table
 */
class m200811_200714_add_auth_column_aluno_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('aluno', 'password_reset_token', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200811_200714_add_auth_column_aluno_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200811_200714_add_auth_column_aluno_table cannot be reverted.\n";

        return false;
    }
    */
}
