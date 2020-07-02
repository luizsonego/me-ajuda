<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Perguntas */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => "formQuestion", 
]); ?>
    <div class="row">
        <div class="col-md-12">
                <!-- <div class="col-md-5"><h3>Nome do usuario</h3></div> -->
                <div class="col-md-7"><?= $form->field($model, 'materia')->textInput(['maxlength' => true]) ?></div>
                <div class="col-md-12">
                    <?= $form->field($model, 'pergunta')->textarea(['rows' => 6]) ?>
                </div>
        </div>
        <div class="form-group pull-right">
            <?= Html::submitButton('Perguntar', ['class' => 'btn btn-success ']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>


<?php
$js = <<<JS
// get the form id and set the event
$('form#formQuestion').on('beforeSubmit', function(e) {
    // return false to prevent submission
    var \$form = $(this)
    $.post(
        \$form.attr("action"),
        \$form.serialize()
    )
    .done(function(result) {
        console.log(result)
        if(result == 1){
            // document.getElementById("formQuestion").style.display = "none";
            // $(\$form).trigger('reset')
            // document.getElementById('toast').innerHTML = '';
            // $.pjax.reload({container: '#questions'})
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