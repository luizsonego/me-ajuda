<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respostas".
 *
 * @property int $id
 * @property string $resposta
 * @property string|null $instituicao
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $user_id
 * @property int|null $perguntas_id
 *
 * @property Pergunta $perguntas
 */
class Respostas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'respostas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resposta'], 'required'],
            [['resposta'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'perguntas_id'], 'integer'],
            [['instituicao'], 'string', 'max' => 255],
            [['perguntas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perguntas::className(), 'targetAttribute' => ['perguntas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resposta' => 'Resposta',
            'instituicao' => 'Instituicao',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'perguntas_id' => 'Perguntas ID',
        ];
    }

    /**
     * Gets query for [[Perguntas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerguntas()
    {
        return $this->hasOne(Perguntas::className(), ['id' => 'perguntas_id']);
    }
}
