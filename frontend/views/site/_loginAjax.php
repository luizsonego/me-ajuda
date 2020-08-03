<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!-- modal dialog for display pop up login -->

<div class="modal-dialog">


  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title" id="myModalLabel"></h4>
    </div>
    <div class="modal-body">
        <h4 class="text-center"><small>Para responder vc precisa estar logado.</small></h4>
      <div class="col-md-6 centered">
        <!-- start ActiveForm -->
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => 'true']); ?>
        <?= $form->field($model, 'username', [
          'template' => "{label}\n{error}\n{input}\n{hint}\n",
          'errorOptions' => ['class' => 'help-block alert alert-danger', 'style' => 'display:none;']
        ]) ?>
        <?= Html::a('Forgot your password?', ['site/repassword'], ['class' => 'password-recovery']) ?>
        <?= $form->field($model, 'password', [
          'template' => "{label}\n{error}\n{input}\n{hint}\n",
          'errorOptions' => ['class' => 'help-block alert alert-danger', 'style' => 'display:none;']
        ])->passwordInput() ?>
      </div>
      <div class="modal-footer">
        <div class="form-group our-form-group">
          <?= Html::a('Criar conta', ['site/signup'], ['class' => 'btn btn-link']) ?>
          <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>


    </div>
  </div>