<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%respostas}}`.
 */
class m200711_155631_add_best_column_likeable_column_to_respostas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%respostas}}', 'is_best', $this->integer()->defaultValue(0));
        $this->addColumn('{{%respostas}}', 'is_likeable', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%respostas}}', 'is_best');
        $this->dropColumn('{{%respostas}}', 'is_likeable');
    }
}
