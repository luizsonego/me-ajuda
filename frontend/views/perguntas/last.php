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
    // echo '<pre>';
    // print_r($model);
    // echo '</pre>';
    // die;
    $source = Auth::findOne(['user_id' => $quest->user_id]);
    $profile = AlunoProfile::findOne($quest->user_id);
    $profileImage = $source->source === 'facebook' 
    ? 'http://graph.facebook.com/'.$profile->gravatar_id.'/picture?type=square' 
    : 'frontend/web/assets/users_ico/'.$profile->gravatar_id;
    ?>

    <div class="box" id="quest">
        <div class="content">
            <?= $quest->pergunta ?>
        </div>
        <div class="footer">
            <div class="materia">
                <span class="materia">
                    <?= $quest->onematerias->materia ?> <br>
                </span>
                <span class="data">
                    <?= date('d F \d\e Y', strtotime($quest->created_at)) ?>
                </span>
            </div>
            <div class="respostas">
                <img src="frontend/web/assets/icon_comment.svg" alt="icone respostas"> <?= Respostas::sumAnswers($quest->id) ?> respostas
            </div>
            <div class="actions">
                <?php $url = Url::to(['perguntas/view', 'id' => $quest->id]); ?>
                <button class="button-answer" onclick="location.href='<?= $url ?>'">Responder</button>
                <img src="<?= $profileImage; ?>" alt="<?= $profile->name ?>" title="<?= $profile->name ?>" class="img-profile">
            </div>
        </div>
    </div>

<?php endforeach; ?>
<?php Pjax::end(); ?>
<br>
<?php $urlAll = Url::to(['/perguntas']); ?>
<div class="row">
    <div class="col-md-4  large-centered   columns small-6 small-centered">
        <button onclick="location.href='<?= $urlAll ?>'" class="button-default">Ver todas</button>
    </div>
</div>