<?php

use yii\helpers\Html;
$this->title = 'Create Perguntas';
?>

<div class="perguntas-create border" id="questions">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

