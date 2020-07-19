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
                <div class="dado"><?=date('d F \d\e Y', strtotime($quest->created_at))?></div>
            </div>
            <div class="action">
                <div class="user">

                </div>
                <div class="acao">
                    <?php $url = Url::to(['perguntas/view', 'id' => $quest->id]); ?>
                    <a href="<?= $url ?>" class="btn btn-block btn-dark btn-outline-dark mylast">Ver respostas</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php Pjax::end(); ?>
