<?php

use yii\helpers\Html;
?>
<div class="perguntas-create" id="questions">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>