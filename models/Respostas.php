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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'resposta' => Yii::t('app', 'Resposta'),
            'instituicao' => Yii::t('app', 'Instituicao'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'user_id' => Yii::t('app', 'User ID'),
            'perguntas_id' => Yii::t('app', 'Perguntas ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RespostasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RespostasQuery(get_called_class());
    }
}
