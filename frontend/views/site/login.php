<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('modal')) : ?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-center"><?= Yii::$app->session->getFlash('modal') ?></h4>
                    <h4 class="type-sidelines"><span>OU</span></h4>
                    <?= Html::a('Crie uma conta', ['site/signup'], ['class' => 'btn btn-block btn-primary']) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            $('#myModal').modal();
        }
    </script>
<?php endif; ?>


<div class="login-box">
    <div class="row expanded">
        <div class="small-12 medium-6 column small-order-2 medium-order-1">
            <div class="login-box-form-section">
                <h1 class="login-box-title">Login</h1>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'login-box-input']) ?>
                <?= $form->field($model, 'password')->passwordInput(['class' => 'login-box-input']) ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <?= Html::submitButton('Login', ['class' => 'login-box-submit-button', 'name' => 'login-button']) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="or">OU</div>
        </div>
        <div class="small-12 medium-6 column small-order-1 medium-order-2 login-box-social-section">
            <div class="login-box-social-section-inner">
                <span class="login-box-social-headline">Faça login com <br /> sua rede social</span>

                    <?php use yii\authclient\widgets\AuthChoice; ?>
                    <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
                    <ul>
                    <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <li><?= Html::a( 'Login com  '. $client->title, ['site/auth', 'authclient'=> $client->name, ], ['class' => "login-box-social-button-$client->name "]) ?></li>
                    <?php endforeach; ?>
                    </ul>
                    <?php AuthChoice::end(); ?>

            </div>
        </div>
    </div>
</div>





<style>

    .login-box {
        box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
        background: #fefefe;
        border-radius: 0;
        overflow: hidden;

    }

    .login-box .or {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        display: inline-block;
        min-width: 2.1em;
        padding: 0.3em;
        border-radius: 50%;
        font-size: 0.6rem;
        text-align: center;
        font-size: 1.275rem;
        background: #cacaca;
        box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
    }

    @media screen and (max-width: 39.9375em) {
        .login-box .or {
            top: 85%;
        }
    }

    .login-box-title {
        font-weight: 300;
        font-size: 1.875rem;
        margin-bottom: 1.25rem;
    }

    .login-box-form-section,
    .login-box-social-section-inner {
        padding: 2.5rem;
        min-height: 380px;
    }

    .login-box-social-section {
        background: url("frontend/web/assets/splashLogin.jpg");
        background-size: cover;
        background-position: center;
    }

    .login-box-input {
        margin-bottom: 1.25rem;
        height: 2rem;
        border: 0;
        padding-left: 0;
        box-shadow: none;
        border-bottom: 1px solid #1779ba;
        font-weight: 400;
    }

    .login-box-input:focus {
        color: #1779ba;
        transition: 0.2s ease-in-out;
        box-shadow: none;
        border: 0;
        border-bottom: 2px solid #1779ba;
    }


    .login-box-submit-button {
        display: inline-block;
        vertical-align: middle;
        margin: 0 0 1rem 0;
        padding: 0.85em 1em;
        -webkit-appearance: none;
        border: 1px solid transparent;
        border-radius: 0;
        transition: background-color 0.25s ease-out, color 0.25s ease-out;
        font-size: 0.9rem;
        line-height: 1;
        text-align: center;
        cursor: pointer;
        background-color: #1779ba;
        color: #fefefe;
        display: block;
        width: 100%;
        margin-right: 0;
        margin-left: 0;
        border-radius: 0;
        text-transform: uppercase;
        margin-bottom: 0;
    }

    [data-whatinput='mouse'] .login-box-submit-button {
        outline: 0;
    }

    .login-box-submit-button:hover,
    .login-box-submit-button:focus {
        background-color: #126195;
        color: #fefefe;
    }

    .login-box-submit-button:hover,
    .login-box-submit-button:focus {
        box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
    }

    .login-box-submit-button:active {
        box-shadow: 0 1px 2px rgba(10, 10, 10, 0.4);
    }

    .login-box-social-button-facebook {
        display: inline-block;
        vertical-align: middle;
        margin: 0 0 1rem 0;
        padding: 0.85em 1em;
        -webkit-appearance: none;
        border: 1px solid transparent;
        border-radius: 0;
        transition: background-color 0.25s ease-out, color 0.25s ease-out;
        font-size: 0.9rem;
        line-height: 1;
        text-align: center;
        cursor: pointer;
        background-color: #3b5998;
        color: #fefefe;
        display: block;
        width: 100%;
        margin-right: 0;
        margin-left: 0;
        font-weight: 500;
        margin-bottom: 1.25rem;
        text-transform: uppercase;
    }

    [data-whatinput='mouse'] .login-box-social-button-facebook {
        outline: 0;
    }

    .login-box-social-button-facebook:hover,
    .login-box-social-button-facebook:focus {
        background-color: #2f477a;
        color: #fefefe;
    }

    .login-box-social-button-twitter {
        display: inline-block;
        vertical-align: middle;
        margin: 0 0 1rem 0;
        padding: 0.85em 1em;
        -webkit-appearance: none;
        border: 1px solid transparent;
        border-radius: 0;
        transition: background-color 0.25s ease-out, color 0.25s ease-out;
        font-size: 0.9rem;
        line-height: 1;
        text-align: center;
        cursor: pointer;
        background-color: #55acee;
        color: #fefefe;
        display: block;
        width: 100%;
        margin-right: 0;
        margin-left: 0;
        font-weight: 500;
        margin-bottom: 1.25rem;
        text-transform: uppercase;
    }

    [data-whatinput='mouse'] .login-box-social-button-twitter {
        outline: 0;
    }

    .login-box-social-button-twitter:hover,
    .login-box-social-button-twitter:focus {
        background-color: #1a8fe8;
        color: #fefefe;
    }

    .login-box-social-button-google {
        display: inline-block;
        vertical-align: middle;
        margin: 0 0 1rem 0;
        padding: 0.85em 1em;
        -webkit-appearance: none;
        border: 1px solid transparent;
        border-radius: 0;
        transition: background-color 0.25s ease-out, color 0.25s ease-out;
        font-size: 0.9rem;
        line-height: 1;
        text-align: center;
        cursor: pointer;
        background-color: #dd4b39;
        color: #fefefe;
        display: block;
        width: 100%;
        margin-right: 0;
        margin-left: 0;
        font-weight: 500;
        margin-bottom: 1.25rem;
        text-transform: uppercase;
    }

    [data-whatinput='mouse'] .login-box-social-button-google {
        outline: 0;
    }

    .login-box-social-button-google:hover,
    .login-box-social-button-google:focus {
        background-color: #be3221;
        color: #fefefe;
    }

    [class*="login-box-social-button-"]:hover,
    [class*="login-box-social-button-"]:focus {
        box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
    }

    .login-box-social-headline {
        display: block;
        margin-bottom: 2.5rem;
        font-size: 1.875rem;
        color: #fefefe;
        text-align: center;
        text-shadow: 2px 2px 3px #000;
    }
</style>



<style>
    .type-sidelines {
        display: block;
        text-align: center;
        overflow: hidden;
        white-space: nowrap;
    }

    .type-sidelines span {
        display: inline-block;
        position: relative;
        padding-left: 0.5em;
        padding-right: 0.5em;
    }

    .type-sidelines span:before,
    .type-sidelines span:after {
        content: '';
        position: absolute;
        height: 100%;
        width: 9999px;
        top: 50%;
        border-top-style: solid;
        border-top-width: 1px;
    }

    .type-sidelines span:before {
        right: 100%;
    }

    .type-sidelines span:after {
        left: 100%;
    }
</style>