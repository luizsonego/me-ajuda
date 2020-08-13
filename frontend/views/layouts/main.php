<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\AlunoProfile;
use app\models\Auth;
use app\models\Profile;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\FoundationAsset;

AppAsset::register($this);
FoundationAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> -->
    <style>
        .centered {
            margin: 0 auto !important;
            float: none !important;
        }

        #user_img_menu a {
            padding: 10px;
        }
    </style>

    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <?php
    NavBar::begin([
        'brandLabel' => '<img alt="Brand" src="frontend/web/assets/logo.svg" width="30">',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Perguntas', 'url' => ['/perguntas']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = [
            'label' => 'login',
            'img' => 'frontend/web/assets/user_auth.svg',
            'url' => ['/site/login']
        ];
    } else {
        $source = Auth::findOne(['user_id' => Yii::$app->user->identity->id]);
        $profile = AlunoProfile::findOne(Yii::$app->user->identity->id);
        $profileImage = $profile->gravatar_id;
        $menuItems[] = [
            'label' =>
            Html::img(
                $source->source === 'facebook' 
                    ? 'http://graph.facebook.com/'.$profileImage.'/picture?type=square' 
                    : 'frontend/web/assets/users_ico/'.$profileImage,
                ['width' => '30px', 'height' => '30px', 'style' => 'border-radius: 50%']
            ) . '',
            'items' => [
                [
                    'label' => Yii::$app->user->identity->username,
                    'options' => ['style' => 'text-align: center;font-size: 1.5em;']
                ],
                '<li class="divider"></li>',
                ['label' => 'Minhas Perguntas', 'url' => ['/perguntas/myquestions']],
                '<li class="divider"></li>',
                [
                    'label' =>
                    Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout',
                            ['class' => 'btn-link logout']
                        )
                        . Html::endForm(),
                    // 'url' => ['/site/logout'],
                ],
            ],
            'options' => ['id' => 'user_img_menu']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="wrap">
        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>


    <footer class="marketing-site-footer">
        <div class="row medium-unstack">
            <div class="medium-4 columns">
                <h4 class="marketing-site-footer-name">&nbsp;</h4>
                <ul class="menu marketing-site-footer-bottom-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Perguntas</a></li>
                    <li><a href="#">Registrar</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
            <div class="medium-4 columns">
            </div>
            <div class="medium-4 columns">
                <h4 class="marketing-site-footer-title">Social</h4>
                <div class="menu row small-up-3">
                    <div class="column column-block">
                        <li><a href="#"><i class="fa fa-youtube-square fa-3x" aria-hidden="true"></i></a></li>
                    </div>
                    <div class="column column-block">
                        <li><a href="#"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a></li>
                    </div>
                    <div class="column column-block">
                        <li><a href="#"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a></li>
                    </div>
                </div>
            </div>
        </div>
        <div class="marketing-site-footer-bottom">
            <div class="row large-unstack align-middle">
                <div class="column">
                    <p>&copy; 2017 No rights reserved</p>
                </div>
                <div class="column">
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>