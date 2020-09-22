<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use frontend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

LoginAsset::register($this);

$this->title = 'Cadastrar';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="large-5 columns large-centered">
    <div class="box">
        <h1 class="login-box-title text-center">Criar sua conta</h1>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'input']) ?>
        <?= $form->field($model, 'email')->textInput(['class' => 'input']) ?>
        <?= $form->field($model, 'password')->passwordInput(['class' => 'input']) ?>
        <?= Html::submitButton('Cadastrar', ['class' => 'button-default', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>

        <hr>
        <h3 class="text-center">Se cadastre com sua rede social</h3>
        <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false]); ?>
        <ul>
            <?php foreach ($authAuthChoice->getClients() as $client) : ?>
                <li><?//= Html::a('Login com  ' . $client->title, ['site/auth', 'authclient' => $client->name,], ['class' => "login-box-social-button-$client->name "]) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php AuthChoice::end(); ?>

    </div>
</div>

