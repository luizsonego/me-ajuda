<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use frontend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

LoginAsset::register($this);


$this->title = 'Solicitar redefinição de senha';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="large-6 columns large-centered">
    <div class="box">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Por favor, preencha seu email. Um link para redefinir a senha será enviado para lá.</p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'input']) ?>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'button-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>