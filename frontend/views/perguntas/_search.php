<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="perguntas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="grid-x">
        <div class="cell large-auto">
            <?= $form->field($model, 'pergunta') ?>
        </div>
        <div class="cell large-auto">
            <?= $form->field($model, 'materia') ?>
        </div>
        <div class="cell large-auto">
            <?= $form->field($model, 'instituicao') ?>
        </div>

        <div class="cell large-auto">
            <label>&nbsp;</label>
            <?= Html::submitButton('Search', ['class' => 'button radius bordered  primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'button radius bordered  secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>