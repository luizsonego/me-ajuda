<?php

namespace app\models;

use common\models\Aluno;
use Yii;

/**
 * This is the model class for table "aluno_profile".
 *
 * @property int $aluno_id
 * @property string|null $name
 * @property string|null $public_email
 * @property string|null $gravatar_email
 * @property string|null $gravatar_id
 * @property string|null $location
 * @property string|null $timezone
 * @property string|null $bio
 * @property string|null $public_phone
 *
 * @property Aluno $aluno
 */
class AlunoProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aluno_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aluno_id'], 'required'],
            [['aluno_id'], 'integer'],
            [['name', 'public_email', 'gravatar_email', 'location', 'bio'], 'string', 'max' => 255],
            [['gravatar_id'], 'string', 'max' => 32],
            [['timezone'], 'string', 'max' => 40],
            [['public_phone'], 'string', 'max' => 20],
            [['aluno_id'], 'unique'],
            [['aluno_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlunoProfile::className(), 'targetAttribute' => ['aluno_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aluno_id' => 'Aluno ID',
            'name' => 'Name',
            'public_email' => 'Public Email',
            'gravatar_email' => 'Gravatar Email',
            'gravatar_id' => 'Gravatar ID',
            'location' => 'Location',
            'timezone' => 'Timezone',
            'bio' => 'Bio',
            'public_phone' => 'Public Phone',
        ];
    }

    /**
     * Gets query for [[Aluno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'aluno_id']);
    }
}
