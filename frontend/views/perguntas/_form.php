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
<div class="row">
<div class="col-md-4">
        <?
       echo $form->field($model, 'lista')->checkbox(['uncheck' => 'Disabled', 'value' => 'Active']);
        ?>

    </div>
    <div class="col-md-12">
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
    <div class="col-md-4">
        <?
        echo $form->field($model, 'materia')->dropDownList(
            $materia,
            ['prompt'=>'Selecione uma matéria', 'options'=>[$materiaSelected=>["Selected"=>true]]]
        )->label(false);
        ?>

    </div>
    <div class="col-md-8">
        <div class="form-group pull-right">

            <?= Html::submitButton('Perguntar', ['class' => 'btn btn-success ']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<!-- campo pergntar -->

<button class="_newQuest btn btn-success" id="newFormQuestion" style="display: none;">Criar nova pergunta</button>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Voce precisa estar logado para responder.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCadastrado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Pergunta cadastrada com sucesso</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
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
            document.getElementById("formQuestion").style.display = "none";
            document.getElementById("newFormQuestion").style.display = "block";
            $(\$form).trigger('reset')
            $('#modalCadastrado').modal();
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
$('#modalCadastrado').on('hidden.bs.modal', function (e) {
    $.pjax.reload({container: "#quest"})
})
JS;

$this->registerJs($js);
?>