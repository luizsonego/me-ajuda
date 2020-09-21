<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$request = Yii::$app->request;
$id = $request->get('id', 1);
$user_id = Yii::$app->user->identity->id;

?>
<?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>
<?= $form->field($model, 'resposta')->textarea(['rows' => 6])->label(false) ?>

<div class="form-group pull-right">
    <?= Html::submitButton(Yii::t('app', 'Responder'), ['class' => 'button-default']) ?>
</div>

<div class="hidden">
    <?= $form->field($model, 'perguntas_id')->textInput(['readonly' => true, 'value' => $id]) ?>
    <?= $form->field($model, 'user_id')->textInput(['readonly' => true, 'value' => $user_id]) ?>
</div>

<?php ActiveForm::end(); ?>
<div class="modal fade" id="modalRespondido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-center"><small>Pergunta respondida com sucesso.</small></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="button-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
            $('#modalRespondido').modal();
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