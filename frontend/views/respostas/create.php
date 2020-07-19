<?php

use yii\helpers\Html;
?>
<div class="perguntas-create border" id="questions">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>