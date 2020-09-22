<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use frontend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;
use yii\helpers\Url;

LoginAsset::register($this);

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="large-5 columns large-centered">

    <div class="box">

        <h1 class="login-box-title text-center">Login</h1>

        <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
        <ul>
            <?php foreach ($authAuthChoice->getClients() as $client) : ?>
                <li><?//= Html::a('Login com  ' . $client->title, ['site/auth', 'authclient' => $client->name,], ['class' => "login-box-social-button-$client->name "]) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php AuthChoice::end(); ?>


        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'input']) ?>
        <?= $form->field($model, 'password')->passwordInput(['class' => 'input']) ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <?= Html::submitButton('Login', ['class' => 'button-default', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>

        <div style="color:#999;margin:1em 0;">
            Se você esqueceu sua senha, pode <?= Html::a('redefini-la', ['site/request-password-reset']) ?>.
            <br>
            Precisa de um novo e-mail de verificação? <?= Html::a('Reenviar', ['site/resend-verification-email']) ?>
            <br>
            Ainda não possui uma conta ? <?= Html::a('Criar uma conta', ['site/signup']) ?>
        </div>




    </div>
</div>