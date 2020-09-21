<?
use app\models\AlunoProfile;
use app\models\Auth;
use yii\helpers\Url;
use app\models\Respostas;
?>


<div class="large-8 columns large-centered">
    <?
        if (empty($model)){
            echo '<h1  class="text-center">Você não fez perguntas ainda :/ </h1>';
        }
        ?>
    <?php

    foreach ($model as $key => $my) : ?>
        <?
            $source = Auth::findOne(['user_id' => $my->user_id]);
            $profile = AlunoProfile::findOne($my->user_id);
            $profileImage = $source->source === 'facebook' 
            ? 'http://graph.facebook.com/'.$profile->gravatar_id.'/picture?type=square' 
            : 'frontend/web/assets/users_ico/'.$profile->gravatar_id;
            ?>
        <div class="box">
            <div class="content">
                <?= $my->pergunta ?>
            </div>
            <div class="footer">
                <div class="materia">
                    <span class="materia">
                        <?= $my->onematerias->materia ?> <br>
                    </span>
                    <span class="data">
                        <?= date('d F \d\e Y', strtotime($my->created_at)) ?>
                    </span>
                </div>
                <div class="respostas">
                    <img src="frontend/web/assets/icon_comment.svg" alt="icone respostas"> <?= Respostas::sumAnswers($my->id) ?> respostas
                </div>
                <div class="actions">
                    <?php $url = Url::to(['perguntas/view', 'id' => $my->id]); ?>
                    <button class="button-answer" onclick="location.href='<?= $url ?>'">Ver respostas</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
