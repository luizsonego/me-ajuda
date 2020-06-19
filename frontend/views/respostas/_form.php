<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respostas */
/* @var $form yii\widgets\ActiveForm */
// echo '<pre>';
// $request = Yii::$app->request;
// print_r($request->get('id', 1));
// echo '</pre>';
// die;
?>

<div class="respostas-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $request = Yii::$app->request;
    $id = $request->get('id', 1);
    ?>
    <h4 class="media-heading"> Nome Usuario que responde <span class="badge"></span></h4>
    <p class="list-group-item-text">
        <?= $form->field($model, 'resposta')->textarea(['rows' => 6]) ?>
    </p>
    <p class="list-group-item-text"><small></small></p>
    <?= $form->field($model, 'perguntas_id')->textInput(['readonly' => true, 'value' => $id]) ?>
    <p>
        <div class="row">
            <div class="col-md-3">
                <?= Html::submitButton(Yii::t('app', 'Responder'), ['class' => 'btn btn-success']) ?>
                <br>
            </div>

        </div>
    </p>

    <?php ActiveForm::end(); ?>

</div>