<?php

use yii\helpers\Url;
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
<?
if (!Yii::$app->user->isGuest){
?>
<div class="row">
    <div class="col-md-8 centered">
        <h3 class="text-center title-section myquestion">MINHAS PERGUNTAS</h3>
        <?= $this->render('/perguntas/mylast', array('model' => $mylast)); ?>
        <?php
        $url = Url::to(['perguntas/myquestions']);
        ?>
        <a href="<?= $url ?>" class="btn btn-block btn-dark btn-outline-dark btn-default">Responder</a>
    </div>
</div>
<? } ?>
<br>
<div class="row">
    <div class="col-md-8 centered">
        <h3 class="text-center title-section last">ÚLTIMAS PERGUNTAS FEITAS</h3>
        <?= $this->render('/perguntas/last', array('model' => $last)); ?>
    </div>
</div>

<style>
    .title-section{
        font-size: 1.4em;
        margin-bottom: 30px;
        line-height: 2.3;
    }
    .myquestion{
        border-bottom: 2px solid #0161cd;
    }
    .last{
        border-bottom: 2px solid #cc0202;
    }
</style>