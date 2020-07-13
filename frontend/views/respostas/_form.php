<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="respostas-form">
    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>
    <?php
        $request = Yii::$app->request;
        $id = $request->get('id', 1);
    ?>
    <p class="list-group-item-text">
        <?= $form->field($model, 'resposta')->textarea(['rows' => 6])->label(false) ?>
    </p>
    <p class="list-group-item-text"><small></small></p>
    <div class="hidden">
        <?= $form->field($model, 'perguntas_id')->textInput(['readonly' => true, 'value' => $id]) ?>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-8">
        <div class="form-group pull-right">
            <?= Html::submitButton(Yii::t('app', 'Responder'), ['class' => 'btn btn-success btn-block']) ?>
        </div>
    </div>
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