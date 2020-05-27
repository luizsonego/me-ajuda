<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "perguntas".
 *
 * @property int $id
 * @property string $pergunta
 * @property string|null $materia
 * @property string|null $instituicao
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $user_id
 *
 * @property Resposta[] $respostas
 */
class Perguntas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perguntas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pergunta'], 'required'],
            [['pergunta'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['materia', 'instituicao'], 'string', 'max' => 255],
        ];
    }

    public function behaviors() 
    { 
        return [ 
            [ 
                'class' => TimestampBehavior::class, 
                'value' => new Expression('NOW()') 
            ], 
            // [ 
            //    'class' => BlameableBehavior::className(), 
            //    'createdByAttribute' => 'user_id', 
            //    'updatedByAttribute' => 'user_id', 
            // ] 
        ]; 
    } 

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pergunta' => Yii::t('app', 'Pergunta'),
            'materia' => Yii::t('app', 'Materia'),
            'instituicao' => Yii::t('app', 'Instituicao'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * Gets query for [[Respostas]].
     *
     * @return \yii\db\ActiveQuery|RespostaQuery
     */
    public function getRespostas()
    {
        return $this->hasMany(Respostas::className(), ['perguntas_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PerguntasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PerguntasQuery(get_called_class());
    }
}
