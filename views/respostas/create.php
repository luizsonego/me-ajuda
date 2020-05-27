<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respostas */

$this->title = Yii::t('app', 'Create Respostas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Respostas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respostas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
