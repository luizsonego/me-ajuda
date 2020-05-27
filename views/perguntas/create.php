<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Perguntas */

$this->title = Yii::t('app', 'Create Perguntas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Perguntas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perguntas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
