<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%avaliacao}}`.
 */
class m200526_015444_create_avaliacao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%avaliacao}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%avaliacao}}');
    }
}
