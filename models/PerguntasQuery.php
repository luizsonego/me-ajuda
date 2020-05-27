<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Perguntas]].
 *
 * @see Perguntas
 */
class PerguntasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Perguntas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Perguntas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
