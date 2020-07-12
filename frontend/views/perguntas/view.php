<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Perguntas */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="container">

        <div class="col-md-7 centered">
            <div class="border">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-10">
                            <h4 class="media-heading">
                                <?= $model->aluno->username; ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="min-height: 150px;">
                        <hr>
                        <p><?= nl2br($model->pergunta); ?></p>
                    </div>
                </div>
                <div class="row">
                    <hr>
                    <p class="pull-left"><?= $model->materias->materia ?></p>
                    <p class="pull-right"><small><?= $model->created_at ?></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<div class="row">
    <div class="container">
        <div class="col-md-7 centered">
            <?= $this->render('/respostas/create', array('model' => $answer)); ?>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="container">
        <?php Pjax::begin(['id' => 'answer']); ?>
        <?php foreach ($model->respostas as $resposta) : ?>
            <div class="col-md-7 centered border">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img style="border-radius:50%" class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNzI1M2ZjMzdiOSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE3MjUzZmMzN2I5Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi4xNzE4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $resposta->user_id ?> Nome Usuario</h4>
                        <p style="min-height:50px;" class="list-group-item-text"><?= nl2br($resposta->resposta) ?></p>
                        <p class="list-group-item-text"><small><?= $resposta->created_at ?></small></p>
                        <p>
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- <button id="_clickToLike" class="fas fa-apple-alt fa-2x" value="<?= $resposta->id ?>" data-value="<?= $resposta->is_likeable ?>">
                                        <?= $resposta->is_likeable ?>
                                    </button> -->
                                    <?=
                                    Html::button('<i class="fas fa-apple-alt fa-2x"></i> '.$resposta->is_likeable.'', 
                                        [ 
                                            'class' => 'btn', 
                                            'onclick' => '$.ajax({
                                                url: "index.php?r=respostas/likeable",
                                                data: { "id" : '.$resposta->id.', "now" : '.$resposta->is_likeable.' },
                                                success: function (result) {
                                                    $.pjax.reload({container: "#answer"})
                                                },
                                                error: function (errormessage) {
                                                    console.log("error", errormessage)
                                                }
                                            })' 
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
        <?php Pjax::end(); ?>
    </div>
</div>