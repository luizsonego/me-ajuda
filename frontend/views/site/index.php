<?php
use yii\helpers\Url;
?>
<div id="toast"></div>

<div class="row">
    <div class="col-md-7 centered">
        <?
        echo $this->render('/perguntas/create', [
            'model' => $model,
            'materia' => $materia,
        ]); ?>
    </div>
</div>
<br>
<h3 class="text-center">Minhas perguntas</h3>
<div class="row">
    <div class="col-md-7 centered">
        <?php
            $url = Url::to(['perguntas/myquestions']);
        ?>
        <a 
            href="<?=$url?>"
            class="btn btn-block btn-dark btn-outline-dark btn-default">Responder</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-7 centered">
        <?= $this->render('/perguntas/last', array('model' => $last)); ?>
    </div>
</div>