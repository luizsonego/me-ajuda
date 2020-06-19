<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%respostas}}`.
 */
class m200526_015432_create_respostas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%respostas}}', [
            'id' => $this->primaryKey(),
            'resposta' => $this->text()->notNull(),
            'instituicao' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
            'user_id' => $this->integer(),
            'perguntas_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%respostas}}');
    }
}
