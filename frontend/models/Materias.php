<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "materias".
 *
 * @property int $id
 * @property string|null $materia
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $user_id
 */
class Materias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['materia'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'materia' => 'Materia',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    public static function getDataList() { // could be a static func as well

        $models = Materias::find()->asArray()->orderBy('materia')->all();

        return ArrayHelper::map($models, 'id', 'materia');

    }

}
