<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aluno_profile}}`.
 */
class m200812_023822_create_aluno_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%aluno_profile}}', [
            'aluno_id' => $this->integer(11)->notNull(),
            'name' => $this->string(255),
            'public_email' => $this->string(255),
            'gravatar_email' => $this->string(255),
            'gravatar_id' => $this->string(32),
            'location' => $this->string(255),
            'timezone' => $this->string(40),
            'bio' => $this->string(255),
            'public_phone' => $this->string(20),
        ]);

        $this->addPrimaryKey('{{%aluno_profile_pk}}', '{{%aluno_profile}}', 'aluno_id');
        
        $this->addForeignKey('fk_aluno_profile_aluno', '{{%aluno_profile}}', 'aluno_id', '{{%aluno}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%aluno_profile}}');
    }
}
