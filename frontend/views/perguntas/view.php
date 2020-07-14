<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-8 centered">
        <div class="media border">
            <div class="media-body">

                <div class="question">
                    <div class="list-group-item-text"><?= nl2br($model->pergunta) ?></div>
                </div>
                <div class="dados">
                    <div class="dado"><?= $model->onematerias->materia ?></div>
                    <div class="dado"><?= date('d F \d\e Y', strtotime($model->created_at)) ?></div>
                </div>
                <div class="action">
                    <div class="user">
                        <div class="ico_user" alt="<?= $model->aluno->username ?>" title="<?= $model->aluno->username ?>">
                            <img src="frontend/web/assets/users_ico/user-005.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr>
<div class="row">
    <div class="col-md-8 centered">
        <?= $this->render('/respostas/create', array('model' => $answer)); ?>
    </div>
</div>
<br><br>
<div class="row">
    <?php Pjax::begin(['id' => 'answer']); ?>
    <?php foreach ($model->respostas as $resposta) : ?>
        <div class="col-md-8 centered">
            <div class="media border">
                <div class="media-body">

                    <div class="question">
                        <div class="list-group-item-text"><?= nl2br($resposta->resposta) ?></div>
                    </div>
                    <div class="dados">
                        <div class="dado"></div>
                        <div class="dado"><?= date('d F \d\e Y', strtotime($resposta->created_at)) ?></div>
                    </div>
                    <div class="action">
                        <div class="col-md-3">
                            <?=
                                Html::button(
                                    '<i class="fas fa-apple-alt fa-2x"></i> ' . $resposta->is_likeable . '',
                                    [
                                        'class' => 'btn',
                                        'onclick' => '$.ajax({
                                                url: "index.php?r=respostas/likeable",
                                                data: { "id" : ' . $resposta->id . ', "now" : ' . $resposta->is_likeable . ' },
                                                success: function (result) {
                                                    $.pjax.reload({container: "#answer"})
                                                },
                                                error: function (errormessage) {
                                                    console.log("error", errormessage)
                                                }
                                            })'
                                    ]
                                );
                            ?>
                        </div>
                        <div class="user">
                            <!-- <h4 class="media-heading"><?= $resposta->user_id ?></h4> -->
                            <div class="ico_user"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
    <?php Pjax::end(); ?>
</div>

<style>
    .question {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 1px;
        min-height: 50px;
    }

    .dados {
        min-height: 15px;
        padding: 10px;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
    }

    .action {
        min-height: 50px;
        display: flex;
        justify-content: space-between;
    }



    .ico_user {
        background-color: #ccc;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        vertical-align: middle;
        top: 10px;
        position: relative;
    }

</style>