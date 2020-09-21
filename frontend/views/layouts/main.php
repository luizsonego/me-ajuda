<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\AlunoProfile;
use app\models\Auth;
use app\models\Profile;

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

use common\widgets\Alert;

use frontend\assets\AppAsset;
use frontend\assets\FoundationAsset;
use frontend\assets\StyleAsset;
use yii\helpers\Url;

AppAsset::register($this);
StyleAsset::register($this);
FoundationAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="multilevel-offcanvas off-canvas position-right" id="offCanvasRight" data-off-canvas>

        <ul class="vertical menu" data-accordion-menu>
            <li><a href="#">SERVICES</a>
                <ul class="menu vertical nested">
                    <li><a href="#">Brand</a></li>
                    <li><a href="#">Web Apps</a></li>
                    <li><a href="#">Mobile Apps</a></li>
                </ul>
            </li>
            <li><a href="#">PRODUCTS</a>
                <ul class="menu vertical nested">
                    <li><a href="#">Product 1</a></li>
                    <li><a href="#">Product 2</a></li>
                    <li><a href="#">Product 3</a></li>
                </ul>
            </li>
            <li><a href="#">CITIES</a>
                <ul class="menu vertical nested">
                    <li><a href="#">London</a></li>
                    <li><a href="#">New York</a></li>
                    <li><a href="#">Paris</a></li>
                </ul>
            </li>
        </ul>
    </div>


    <div class="off-canvas-content" data-off-canvas-content>
        <div class="nav-bar">
            <div class="nav-bar-left">
                <a href="./" class="nav-bar-logo">
                    <img class="logo" src="frontend/web/assets/logo.svg" width="70px" />
                </a>
            </div>
            <div class="nav-bar-right">
                <ul class="menu">
                    <li>
                        <button class="button-new-quest hide-for-small-only" onclick="location.href='<?= Url::to(['perguntas/create']) ?>'">Nova pergunta</button>
                    </li>
                    <li class="profile-menu dropdown">
                        <span onclick="openProfileMenu()" class="dropbtn">
                            <?
                            if (!Yii::$app->user->isGuest) {
                                $source = Auth::findOne(['user_id' => Yii::$app->user->identity->id]);
                                $profile = AlunoProfile::findOne(Yii::$app->user->identity->id);
                                $profileImage = $profile->gravatar_id;
                                echo $source->source === 'facebook'
                                ? '<img src="http://graph.facebook.com/' . $profileImage . '/picture?type=square" class="img-profile" alt="Imagem perfil"/>'
                                : '<img src="frontend/web/assets/users_ico/' . $profileImage . '" class="img-profile" alt="Imagem perfil"/> ';
                                $name = explode(" ", $profile->name);
                                echo $name[0];
                            }
                            ?>
                        </span>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="<?= Url::to(['aluno/profile']) ?>">Perfil</a>
                            <a href="<?= Url::to(['perguntas/myquestions']) ?>">Minhas perguntas</a>
                            <a href="<?= Url::to(['perguntas/create']) ?>">Perguntar</a>
                            <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post']]) ?>
                        </div>

                    </li>
                    <?
                    if (Yii::$app->user->isGuest) {
                        echo '<li>';
                    ?>
                    <button class="button-login" onclick="location.href='<?= Url::to(['site/login']) ?>'">Login</button>
                    <?
                        echo '</li>';
                    }
                    ?>
                    <!-- <li class="hide-for-small-only"><a href="#">TOUR</a></li>
                    <li class="hide-for-small-only"><a href="#">LOGIN</a></li> -->
                    <!-- <li>
                        <button class="offcanvas-trigger" type="button" data-open="offCanvasRight">
                            <span class="offcanvas-trigger-text hide-for-small-only">Menu</span>
                            <div class="hamburger">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </button>
                    </li> -->
                </ul>
            </div>
        </div>



        <div class="wrap">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>

    </div>




    <footer>

        <div class="col-md-4 show-for-small-only large-centered   columns small-6 small-centered">
            <img class="logo" src="frontend/web/assets/logo-completa.svg" width="150px" />
        </div>

        <div class="content-footer hide-for-small-only">

            <div class="col-md-3">
                <img class="logo" src="frontend/web/assets/logo-completa.svg" width="150px" />
            </div>
            <div class="col-md-3">
                <h1>Meu perfil</h1>
                <ul>
                    <li>Minhas perguntas</li>
                    <li>Informaçoes pessoais</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h1>Perguntas</h1>
                <ul>
                    <li>Materias</li>
                    <li>Últimas perguntas</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h1>Sobre</h1>
                <ul>
                    <li>Como usar</li>
                    <li>Sobre</li>
                </ul>
            </div>

            <!-- <div class="col-md-3"></div>
            <div class="col-md-9">
                <div class="social">
                    <div class="col-md-3">Redes sociais</div>
                    <div class="col-md-2">
                        <img class="logo" src="frontend/web/assets/facebook_icon.svg" width="60px" />
                    </div>
                    <div class="col-md-2">
                        <img class="logo" src="frontend/web/assets/linkedin_icon.svg" width="60px" />
                    </div>
                    <div class="col-md-2">
                        <img class="logo" src="frontend/web/assets/instagram_icon.svg" width="60px" />
                    </div>
                    <div class="col-md-2">
                        <img class="logo" src="frontend/web/assets/twitter_icon.svg" width="60px" />
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-md-3"></div>
            <div class="col-md-9">
                <div class="copy">
                    ©
                </div>
            </div> -->

        </div>


    </footer>



    <?php $this->endBody() ?>
</body>

<script>
    $(document).foundation();

    function openProfileMenu() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
</script>



</html>
<?php $this->endPage() ?>