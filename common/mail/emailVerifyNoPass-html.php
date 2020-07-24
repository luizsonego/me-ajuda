<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Olá <?= Html::encode($user->username) ?>,</p>
    <p>Você escolheu criar uma conta sem senha, por segurança criamos uma senha padrão para você</p>

    <p>Segue os dados de acesso para sua conta</p>

    <p>Usuario: <?= Html::encode($user->username) ?></p>
    <!-- <p>Senha: <?= Html::encode($user->password) ?></p> -->


    <p>Obrigado por escolher nossa plataforma</p>

</div>
