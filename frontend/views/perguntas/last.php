<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(); ?>
<?php foreach ($model as $key => $quest) : ?>
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
<?php Pjax::end(); ?>

<?php
$urlAll = Url::to(['/perguntas']);
?>
<a href="<?= $urlAll ?>" class="btn ver-mais">Ver Mais perguntas</a>

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