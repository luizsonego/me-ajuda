<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%perguntas}}`.
 */
class m200526_015244_create_perguntas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%perguntas}}', [
            'id' => $this->primaryKey(),
            'pergunta' => $this->text()->notNull(),
            'materia' => $this->string(),
            'instituicao' => $this->string(),
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
        $this->dropTable('{{%perguntas}}');
    }
}
