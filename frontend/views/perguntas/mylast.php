<?php

use app\models\AlunoProfile;
use app\models\Auth;
use app\models\Respostas;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(); ?>
<?php foreach ($model as $key => $quest) : ?>
    <?
    $source = Auth::findOne(['user_id' => $quest->user_id]);
    $profile = AlunoProfile::findOne($quest->user_id);
    $profileImage = $source->source === 'facebook' 
    ? 'http://graph.facebook.com/'.$profile->gravatar_id.'/picture?type=square' 
    : 'frontend/web/assets/users_ico/'.$profile->gravatar_id;
    ?>

    <div class="box" id="quest">
        <div class="content">
            <span class="materia">
                <?= $quest->onematerias->materia ?> <br>
            </span>
            <br>
            <span class="pergunta">
                <?= substr($quest->pergunta, 0, 250) ?>
            </span>
        </div>
        <div class="footer-mylast">
            <div class="respostas">
                <img src="frontend/web/assets/icon_comment.svg" alt="icone respostas"> <?= Respostas::sumAnswers($quest->id) ?> respostas
            </div>
            <div class="actions">
                <?php $url = Url::to(['perguntas/view', 'id' => $quest->id]); ?>
                <button class="button-answer" onclick="location.href='<?= $url ?>'">Ver respostas</button>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php Pjax::end(); ?>