<?php

use app\models\AlunoProfile;
use app\models\Auth;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Perguntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perguntas-index">

    <?php Pjax::begin(); ?>

    <div class="row">
        <div class="col-md-8 centered">
            <?php echo $this->render('_search', ['model' => $searchModel, 'materia' => $materia]); ?>
            <?php foreach ($dataProvider->getModels() as $key => $quest) : ?>
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
                                    <img src="<?= $profileImage; ?>" alt="<?= $quest->aluno->username ?>" title="<?= $quest->aluno->username ?>">
                                </div>
                            </div>
                            <div class="acao">
                                <?php $url = Url::to(['perguntas/view', 'id' => $quest->id]); ?>
                                <a href="<?= $url ?>" class="btn btn-block btn-dark btn-outline-dark ">Responder</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 centered" >
            <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => [
                        'class' => 'item',
                        'tag' => false,
                    ],
                    'options' => [
                        'tag' => 'nav',
                        'class' => 'pagination text-center',
                        'id' => '',
                        'aria-label' => 'Pagination'
                    ],
                    'pager' => [
                        'firstPageLabel' => '<< Primeira',
                        'lastPageLabel' => 'Última >>',
                        'nextPageLabel' => 'Próxima >',
                        'prevPageLabel' => '< Anterior',
                        'maxButtonCount' => 3,
                    ],
                    'layout' => "{pager}\n{items}\n{summary}"
                ]);
            ?>
        </div>
    </div>

    <?php Pjax::end(); ?>
</div>


<style>
    .pagination > li > a, .pagination > li > span {
        border: none;
    }

    .question {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 1px;
        min-height: 50px;
    }

    .dados {
        min-height: 15px;
        padding: 10px;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
    }

    .action {
        min-height: 15px;
        display: flex;
        justify-content: space-between;
    }

    .acao {
        display: flex;
        width: 200px;
        justify-content: end;
        float: right;
        margin: 10px 0;
    }


    .action .btn {
        background-color: #c33f2c;
        color: #fff;
        border-radius: 1px;
    }

    .ico_user {
        background-color: #ccc;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        vertical-align: middle;
        top: 10px;
        position: relative;
    }
    .ico_user img {
        border-radius: 50%;
    }

    .ver-mais {
        background-color: #333;
        color: #fefefe;
        border-radius: 1px;
        margin: 15px 0;
        display: block;
        justify-content: center;
        width: 200px;
    }
</style>