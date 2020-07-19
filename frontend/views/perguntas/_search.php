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
            <?
            echo $form->field($model, 'materia')->dropDownList(
                $materia,
                ['prompt' => 'Matéria']
            );
            ?>
        </div>
        <div class="cell large-auto">
            <?= $form->field($model, 'instituicao') ?>
        </div>

        <div class="cell large-auto">
            <label>&nbsp;</label>
            <?= Html::submitButton('Buscar', ['class' => 'button radius bordered  primary']) ?>
            <?= Html::resetButton('Limpar', ['class' => 'button radius bordered  secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    select {
        height: 39px!important;
        border-radius: 0!important;
    }
</style>