<?php

use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Perguntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perguntas-index">

    <?php Pjax::begin(); ?>
    
    <div class="row">
        <div class="col-md-8 centered">
            <?php echo $this->render('_search', ['model' => $searchModel, 'materia'=>$materia]); ?>
            <?php foreach ($dataProvider->getModels() as $key => $quest) : ?>
                <div class="media border">
                    <div class="media-body">

                        <div class="question">
                            <div class="list-group-item-text"><?= nl2br($quest->pergunta) ?></div>
                        </div>
                        <div class="dados">
                            <div class="dado"><?= $quest->onematerias->materia ?></div>
                            <div class="dado"><?= $quest->created_at ?></div>
                        </div>
                        <div class="action">
                            <div class="user">
                                <!-- <h4 class="media-heading"><?= $quest->aluno->username ?></h4> -->
                                <div class="ico_user"></div>
                            </div>
                            <div class="acao">
                                <?php $url = Url::to(['perguntas/view', 'id' => $quest->id]); ?>
                                <a href="<?= $url ?>" class="btn btn-block btn-dark btn-outline-dark ">Responder</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-md-7 centered">
            <?php foreach ($dataProvider->getModels() as $key => $answer) : ?>
                <div class="media border">
                    <div class="media-left">
                        <a href="#">
                            <img style="border-radius:50%" class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNzI1M2ZjMzdiOSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE3MjUzZmMzN2I5Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi4xNzE4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $answer->user_id ?> Nome Usuario</h4>
                        <p style="min-height:50px;" class="list-group-item-text"><?= nl2br($answer->pergunta) ?></p>
                        <p class="list-group-item-text"><small><?= $answer->created_at ?></small></p>
                        <p>
                            <div class="row">
                                <div class="col-md-3">
                                    <span style="color:#d44572;">
                                        <i class="fas fa-apple-alt fa-2x"></i> <?= rand(1000, 5000) ?>
                                    </span>
                                </div>
                                <div class="col-md-3 col-md-offset-6">
                                    <?php
                                    $url = Url::to(['perguntas/view', 'id' => $answer->id]);
                                    ?>
                                <a href="<?= $url ?>" class="btn btn-block btn-dark btn-outline-dark btn-default">Responder</a>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    </div> -->
    <?
    ?>
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
        min-height: 15px;
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
        background-color: #c33f2c;
        color: #fff;
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