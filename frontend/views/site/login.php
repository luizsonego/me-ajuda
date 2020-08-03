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
        console.log('tentando')
     }
</script>
<?php endif; ?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                <br>
                Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


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

.type-sidelines span:before, .type-sidelines span:after {
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