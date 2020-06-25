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
    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>
        <?php
            $request = Yii::$app->request;
            $id = $request->get('id', 1);
        ?>
        <!-- <h4 class="media-heading"> Nome Usuario que responde <span class="badge"></span></h4> -->
        <p class="list-group-item-text">
            <?= $form->field($model, 'resposta')->textarea(['rows' => 6]) ?>
        </p>
        <p class="list-group-item-text"><small></small></p>
        <div class="hidden">
            <?= $form->field($model, 'perguntas_id')->textInput(['readonly' => true, 'value' => $id]) ?>
        </div>
        <?= Html::submitButton(Yii::t('app', 'Responder'), ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>


<?php
$js = <<<JS
// get the form id and set the event
$('form#{$model->formName()}').on('beforeSubmit', function(e) {
    // return false to prevent submission
    var \$form = $(this)
    $.post(
        \$form.attr("action"),
        \$form.serialize()
    )
    .done(function(result) {
        if(result !== ''){
            $(\$form).trigger('reset')
            $.pjax.reload({container: '#answer'})
        }else{
                $("#message").html(result)
            }
    }).fail(function(){
        console.log('ERROR =(')
    })
    return false;
}).on('submit', function(e){    // can be omitted
    e.preventDefault();         // can be omitted
});
JS;
 
$this->registerJs($js);
?>