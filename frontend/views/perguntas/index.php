<?php

use app\models\AlunoProfile;
use app\models\Auth;
use app\models\Respostas;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Perguntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perguntas-index">
    <div class="large-2 columns">&nbsp;</div>
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel, 'materia' => $materia]); 
    ?>
    <div class="large-8 columns">
        <?php foreach ($dataProvider->getModels() as $key => $quest) : ?>
            <?
        $source = Auth::findOne(['user_id' => $quest->user_id]);
        $profile = AlunoProfile::findOne($quest->user_id);
        $profileImage = $source->source === 'facebook' 
        ? 'http://graph.facebook.com/'.$profile->gravatar_id.'/picture?type=square' 
        : 'frontend/web/assets/users_ico/'.$profile->gravatar_id;
        ?>
            <div class="box">
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


        <?=
            // ListView::widget([
            //     'dataProvider' => $dataProvider,
            //     'itemOptions' => [
            //         'class' => 'item',
            //         'tag' => false,
            //     ],
            //     'options' => [
            //         'tag' => 'nav',
            //         'class' => 'pagination text-center',
            //         'id' => '',
            //         'aria-label' => 'Pagination'
            //     ],
            //     'pager' => [
            //         'firstPageLabel' => '<< Primeira',
            //         'lastPageLabel' => 'Última >>',
            //         'nextPageLabel' => 'Próxima >',
            //         'prevPageLabel' => '< Anterior',
            //         'maxButtonCount' => 3,
            //     ],
            //     'layout' => "{pager}"
            // ]);
            ListView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'firstPageLabel' => 'first',
                    'lastPageLabel' => 'last',
                    // 'prevPageLabel' => 'previous',
                    // 'nextPageLabel' => 'next',
                    'maxButtonCount' => 5,

                    // Customzing options for pager container tag
                    'options' => [
                        'tag' => 'div',
                        'class' => 'paginacao',
                        'id' => 'pager-container',
                    ],

                    // Customzing CSS class for pager link
                    'linkOptions' => ['class' => 'mylink'],
                    'activePageCssClass' => 'current',
                    'disabledPageCssClass' => 'disabeld',

                    // Customzing CSS class for navigating link
                    'prevPageCssClass' => 'mypre',
                    'nextPageCssClass' => 'mynext',
                    'firstPageCssClass' => 'myfirst',
                    'lastPageCssClass' => 'mylast',
                ],
                'layout' => "{pager}"
            ]);
        ?>
    </div>

    <?php Pjax::end(); ?>
</div>


<style>
    .paginacao {
        margin: 5vh auto;
        max-width: 405px;
        font-size: 1em;
        /*box-shadow: -2px 0px 31px -5px rgba(128,128,128,1);*/
    }

    .paginacao li {
        text-align: center;
        display: inline-block;
        background-color: #f8f8f8;
        padding: 15px;
        color: #838383;
        height: 45px;
        width: 15px;
        margin: 0 -5px 0 0;
        padding: 10px 25px 10px 15px;
    }

    .paginacao li:first-child {
        width: 60px;
        border-radius: 5px 0px 0px 5px;
    }

    .paginacao li:last-child {
        width: 60px;
        border-radius: 0px 5px 5px 0px;
    }

    .paginacao li:hover,
    .paginacao li:hover a {
        background-color: var(--color-primary);
        color: var(--color-text-secondary);
        cursor: pointer;
    }

    .paginacao li.current {
        background: var(--color-primary);
        font-weight: 600;
    }
    
    .paginacao li.current a {
        color: var(--color-white);
    }

    .paginacao li a {
        color: var(--color-text-primary);
    }

    .paginacao li.disabeld {
        background-color: #d8d8d8;
        color: white;
    }

    .paginacao li.disabeld:hover {
        background-color: #d8d8d8;
        color: white;
        /*font-weight: 600;*/
        cursor: default;
    }
</style>