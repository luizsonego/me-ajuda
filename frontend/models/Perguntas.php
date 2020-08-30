<?php

namespace app\models;

use common\models\Aluno;
use Yii;

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
            [['pergunta', 'materia'], 'required'],
            [['pergunta', 'lista'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['materia', 'instituicao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pergunta' => 'Pergunta',
            'materia' => 'Materia',
            'instituicao' => 'Instituicao',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'lista' => 'Lista Pergntas',
        ];
    }

    /**
     * Gets query for [[Respostas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRespostas()
    {
        return $this->hasMany(Respostas::className(), ['perguntas_id' => 'id']);
    }

    public static function getLastQuest()
    {
        $last = Perguntas::find()
            ->limit(5)
            ->orderBy('id DESC')
            ->all();
            
        return $last;
    }

    public static function getMyLastQuest()
    {
        $last = Perguntas::find()
            ->where(['user_id' => Yii::$app->user->identity->id])
            ->limit(1)
            ->orderBy('id DESC')
            ->all();
            
        return $last;
    }

    public static function getMyQuestions()
    {
        $my = Perguntas::find()
            ->where(['user_id' => Yii::$app->user->identity->id])
            ->limit(5)
            ->orderBy('id DESC')
            ->all();

        return $my;
    }

    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'user_id']);
    }

    public function getOnematerias()
    {
        return $this->hasOne(Materias::className(), ['id' => 'materia']);
    }
}
