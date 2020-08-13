<?php
use yii\helpers\Url;
$this->title = 'Pagina inicial';
?>

<div id="toast"></div>

<div class="row">
    <div class="col-md-8 centered">
        <?
        echo $this->render('/perguntas/create', [
            'model' => $model,
            'materia' => $materia,
        ]); ?>
    </div>
</div>
<br>
<? if (!Yii::$app->user->isGuest){ ?>
    <div class="row">
        <div class="col-md-8 centered" id="quest">
            <h3 class="text-center title-section myquestion">MINHAS PERGUNTAS</h3>
            <?= $this->render('/perguntas/mylast', array('model' => $mylast)); ?>
        </div>
    </div>
    <?php $urlAll = Url::to(['/perguntas/myquestions']); ?>
    <br>
    <div class="row">
        <div class="col-md-4 centered">
            <a href="<?= $urlAll ?>" class="btn btn-block btn-dark btn-outline-dark All">Todas minhas perguntas</a>
        </div>
    </div>
<? } ?>
<br>
<div class="row">
    <div class="col-md-8 centered" id="quest">
        <h3 class="text-center title-section last">ÚLTIMAS PERGUNTAS FEITAS</h3>
        <?= $this->render('/perguntas/last', array('model' => $last)); ?>
    </div>
</div>

<style>
    .title-section {
        font-size: 1.4em;
        margin-bottom: 30px;
        line-height: 2.3;
    }

    .myquestion {
        border-bottom: 2px solid #0161cd;
    }

    .last {
        border-bottom: 2px solid #cc0202;
    }

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

    .btn.All {
        background-color: #333;
        color: #fff;
        border-radius: 1px;

    }

    .action .btn.mylast {
        background-color: #0161cd;
        color: #fff;
        border-radius: 1px;
    }

    .action .btn.last {
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

    .ico_user img {
        border-radius: 50%;
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