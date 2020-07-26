<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aluno}}`.
 */
class m200726_193501_create_aluno_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%aluno}}', [
                'id' => $this->primaryKey(),
                'username' => $this->string(255)->notNull(),
                'email' => $this->string(255)->notNull(),
                'password_hash' => $this->string(60)->notNull(),
                'auth_key' => $this->string(32)->notNull(),
                'unconfirmed_email' => $this->string(255),
                'registration_ip' => $this->string(45),
                'flags' => $this->integer()->notNull()->defaultValue('0'),
                'confirmed_at' => $this->integer(),
                'blocked_at' => $this->integer(),
                'updated_at' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'last_login_at' => $this->integer(),
                'last_login_ip' => $this->string(45)->null(),
                'gdpr_consent' => $this->tinyInteger(1),
                'gdpr_consent_date' => $this->integer(11),
                'gdpr_deleted' => $this->tinyInteger(1),
                'verification_token' => $this->string(255),
                'status' => $this->integer(11),
            ]);

        $this->createIndex('idx_aluno_username', '{{%aluno}}', 'username', true);
        $this->createIndex('idx_aluno_email', '{{%aluno}}', 'email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%aluno}}');
    }
}
