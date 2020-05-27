<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respostas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respostas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resposta')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'instituicao')->textInput(['maxlength' => true]) ?>

    <?php 
    $request = Yii::$app->request;
    $id = $request->get('id', 1); 
    ?>

    <?= $form->field($model, 'perguntas_id')->textInput(['readonly' => true, 'value' => $id]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
