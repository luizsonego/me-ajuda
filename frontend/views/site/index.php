<?php
/* @var $this yii\web\View */
?>

<div class="row">
    <div class="col-md-7 centered">
        <?= $this->render('/perguntas/create', array('model' => $model)); ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-7 centered">
        <?= $this->render('/perguntas/last', array('model' => $last)); ?>
    </div>
</div>