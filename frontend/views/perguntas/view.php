<?php

use common\models\AlunoLoginForm;
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
        <?php
        if (!Yii::$app->user->isGuest) {
            echo $this->render('/respostas/create', array('model' => $answer));
        }
        ?>
    </div>
</div>
<br><br>
<div class="row">

    <?php Pjax::begin(['id' => 'answer']); ?>
    <?php foreach ($resposta as $resposta) : ?>
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
                        <div class="col-md-12">
                            <?=
                                Html::button(
                                    $resposta->is_likeable,
                                    [
                                        'class' => 'btn btn-apple',
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
                            <?
                            if ($resposta->is_best === 1) {
                                echo '<div class="btn best"><img src="frontend/web/assets/best.svg" /></div>';
                            }
                            if(!Yii::$app->user->isGuest && $model->user_id === Yii::$app->user->identity->id && $hasBatter != 1){
                                echo Html::button(
                                    'Melhor resposta',
                                    [
                                        'class' => 'btn btn-best',
                                        'onclick' => '$.ajax({
                                            url: "index.php?r=respostas/best",
                                            data: { "id" : ' . $resposta->id . ' },
                                            success: function (result) {
                                                $.pjax.reload({container: "#answer"})
                                            },
                                            error: function (errormessage) {
                                                console.log("error", errormessage)
                                            }
                                        })'
                                    ]
                                );
                            }
                            if(!Yii::$app->user->isGuest && $model->user_id === Yii::$app->user->identity->id){
                                if ($resposta->is_best === 1){
                                    echo Html::button(
                                        'Remover melhor resposta',
                                        [
                                            'class' => 'btn btn-best',
                                            'onclick' => '$.ajax({
                                                url: "index.php?r=respostas/removebest",
                                                data: { "id" : ' . $resposta->id . ' },
                                                success: function (result) {
                                                    $.pjax.reload({container: "#answer"})
                                                },
                                                error: function (errormessage) {
                                                    console.log("error", errormessage)
                                                }
                                            })'
                                        ]
                                    );
                                }
                            }
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

    .best {
        width: 50px;
        left: 20px;
        height: 30px;
        top: 13px;
        cursor: default;
    }

    .btn-best {
        background-color: #fff;
        box-shadow: 0 0 2px 0 #555;
        margin-top: 10px;
        border-radius: 5px;
    }

    .btn-apple {
        padding-right: 20px;
        padding-left: 35px;
        background-color: #fff;
        box-shadow: 0 0 2px 0 #555;
        margin-top: 10px;
        border-radius: 5px;
    }

    .btn-apple:before {
        width: 25px;
        content: "";
        background: url('frontend/web/assets/likeapple.svg') no-repeat;
        position: absolute;
        left: 20px;
        height: 30px;
        top: 13px;
    }
</style>

<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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


<?php if (Yii::$app->user->isGuest) { ?>
    <script>
        window.onload = function() {
            var url = <?php echo $model->id; ?>;
            $.ajax({
                type: 'POST',
                url: 'index.php?r=site/login-ajax&url=' + url,
                success: function(data) {
                    $('#modalLogin').html(data);
                    $('#modalLogin').modal();
                }
            });
        };
    </script>
<?php } ?>