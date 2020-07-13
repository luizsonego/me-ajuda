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
    <div class="col-md-8 centered">
        <div class="media border">
            <div class="media-body">

                <div class="question">
                    <div class="list-group-item-text"><?= nl2br($model->pergunta) ?></div>
                </div>
                <div class="dados">
                    <div class="dado"><?= $model->onematerias->materia ?></div>
                    <div class="dado"><?= $model->created_at ?></div>
                </div>
                <div class="action">
                    <div class="user">
                        <!-- <h4 class="media-heading"><?= $model->aluno->username ?></h4> -->
                        <div class="ico_user"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-8 centered">
        <div class="border">
            <?= $this->render('/respostas/create', array('model' => $answer)); ?>
        </div>
    </div>
</div>

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
                        <div class="dado"><?= $resposta->created_at ?></div>
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

    .acao {
        display: flex;
        width: 200px;
        justify-content: end;
        float: right;
        margin: 10px 0;
    }


    .action .btn {
        /* background-color: #c33f2c;
        color: #fff; */
        border-radius: 1px;
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

    .ver-mais {
        background-color: #333;
        color: #fefefe;
        border-radius: 1px;
        margin: 15px 0;
        display: block;
        justify-content: center;
        width: 200px;
    }
</style>