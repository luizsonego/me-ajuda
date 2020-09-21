<?php

use yii\helpers\Url;
$this->title = 'Pagina inicial';

?>

<? if (!Yii::$app->user->isGuest){ ?>
<div class="large-4 columns hide-for-small-only">
    <h3 class="text-center title-section myquestion">
        Minhas perguntas
    </h3>
    <?= $this->render('/perguntas/mylast', array('model' => $mylast)); ?>
</div>
<? } ?>


<div class="large-8 columns <?= Yii::$app->user->isGuest ? 'large-centered' : '' ?>">
<h3 class="text-center title-section myquestion">&nbsp;</h3>
    <div class="section-principal">
        <?
        echo $this->render('/perguntas/create', [
            'model' => $model,
            'materia' => $materia,
            ]); 
        ?>
    </div>

    <div class="section-principal">
        <h3 class="text-center title-section">Últimas perguntas</h3>
        <?
        echo $this->render('/perguntas/last', array('model' => $last)); 
        ?>
    </div>

</div>
