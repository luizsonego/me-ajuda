<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Perguntas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perguntas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pergunta')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'materia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instituicao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
