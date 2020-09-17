<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>
<?php $form = ActiveForm::begin([
    'id' => "formQuestion",
    'options' => [
        'class' => "formQuest",
    ]
]); ?>

<?php
$pergnta = '';
$materiaSelected = '';
$cookies = Yii::$app->request->cookies;
if ($cookies->has('myquestbeforelogin')) {
    $arrCookies = explode('~', $cookies->getValue('myquestbeforelogin'));
    $pergnta = $arrCookies[0];
    $materiaSelected = $arrCookies[1];
}
?>

<div class="columns small-12 large-expand">

    <div class="">
        <?= $form->field($model, 'pergunta')->label(false)->widget(CKEditor::className(), [
            'preset' => 'custom',
            'clientOptions' => [
                'toolbar' => [
                    [
                        'name' => 'row1',
                        'items' => [
                            'Bold', 'Italic', 'Underline', '-',
                            'TextColor', 'BGColor', '-',
                            'NumberedList', 'BulletedList', '-',
                            'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'list', 'indent', 'blocks', 'align', 'bidi', '-',
                        ],
                    ],

                ],
            ],
            'options' => ['rows' => 6, 'value' => $pergnta],
        ]) ?>
    </div>
    <div class="col-md-3">
        <?
        echo $form->field($model, 'materia')->dropDownList(
            $materia,
            ['prompt'=>'Selecione uma matéria', 'options'=>[$materiaSelected=>["Selected"=>true]]]
        )->label(false);
        ?>

    </div>
    <div class="col-md-3">
        <?
        echo $form->field($model, 'lista')->checkbox(['uncheck' => 'Disabled', 'value' => 'Active']);
        ?>
    </div>
    <div class="col-md-6">
        <div class="form-group pull-right">
            <?= Html::submitButton('Perguntar', ['class' => 'button-default']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<!-- campo pergntar -->


<button class="_newQuest btn btn-success" id="newFormQuestion" style="display: none;">Criar nova pergunta</button>

<div class="reveal" id="pergunta-cadastrada" data-reveal data-animation-in="fade-in">
    <h4>Pergunta cadastrada com sucesso</h4>
</div>

<?php
$js = <<<JS
$('form#formQuestion').on('beforeSubmit', function(e) {
    var \$form = $(this)
    $.post(
        \$form.attr("action"),
        \$form.serialize()
    )
    .done(function(result) {
        console.log(result)
        if(result == 1){
            document.getElementById("formQuestion").style.display = "none";
            document.getElementById("newFormQuestion").style.display = "block";
            $("#message").html(result)
            $('#pergunta-cadastrada').foundation('open');
        }
        else{
            $("#message").html(result)
        }
    }).fail(function(){
        console.log('ERROR =(')
    })
    return false;
}).on('submit', function(e){    // can be omitted
    e.preventDefault();         // can be omitted
});


$('._newQuest').on('click', function(event){
    event.preventDefault();
    var element, name, arr;
    element = document.getElementById("formQuestion").style.display = "block";
    element = document.getElementById("newFormQuestion").style.display = "none";
});
$('#pergunta-cadastrada').on('closed.zf.reveal', function (e) {
    e.preventDefault()
    $.pjax.reload({container: "#quest"})
})

JS;

$this->registerJs($js);
?>