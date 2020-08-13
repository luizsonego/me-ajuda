<?php

use app\models\AlunoProfile;
use app\models\Auth;
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
    <div class="media border">
        <div class="media-body">

            <div class="question">
                <div class="list-group-item-text"><?= nl2br($quest->pergunta) ?></div>
            </div>
            <div class="dados">
                <div class="dado"><?= $quest->onematerias->materia ?></div>
                <div class="dado"><?= date('d F \d\e Y', strtotime($quest->created_at)) ?></div>
            </div>
            <div class="action">
                <div class="user">
                    <div class="ico_user">
                        <img src="<?= $profileImage; ?>" alt="">
                    </div>
                </div>
                <div class="acao">
                    <?php $url = Url::to(['perguntas/view', 'id' => $quest->id]); ?>
                    <a href="<?= $url ?>" class="btn btn-block btn-dark btn-outline-dark last">Responder</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php Pjax::end(); ?>
<br>
<?php $urlAll = Url::to(['/perguntas']); ?>
<div class="row">
    <div class="col-md-4 centered">
        <a href="<?= $urlAll ?>" class="btn btn-block btn-dark btn-outline-dark All">Ver Mais perguntas</a>
    </div>
</div>

<style>
.ico_user img {
        border-radius: 50%;
    }
</style>