<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Perguntas */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
        
    ]); ?>
<div class="row">
    
        <div class="col-md-12">
            <div class="row">
                <!-- <div class="col-md-5"><h3>Nome do usuario</h3></div> -->
                <div class="col-md-7"><?= $form->field($model, 'materia')->textInput(['maxlength' => true]) ?></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <?= $form->field($model, 'pergunta')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
    
</div>

<br>

<div class="form-group">
    <?= Html::submitButton('Perguntar', ['class' => 'btn btn-success']) ?>
</div>


<?php ActiveForm::end(); ?>

