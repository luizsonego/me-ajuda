<?php

use yii\db\Migration;

/**
 * Class m200527_022150_create_fk_perguntas_respostas
 */
class m200527_022150_create_fk_perguntas_respostas extends Migration
{
    public function up()
    {
        // creates index for column `perguntas_id`
        $this->addForeignKey('fk_perguntas_respostas_id', 'respostas', 'perguntas_id', 'perguntas', 'id');
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200527_022150_create_fk_perguntas_respostas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200527_022150_create_fk_perguntas_respostas cannot be reverted.\n";

        return false;
    }
    */
}
