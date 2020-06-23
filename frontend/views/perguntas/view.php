<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Perguntas */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Perguntas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<!-- <h1><?= Html::encode($this->title) ?></h1> -->

<p>
    <!-- <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> -->
    <!-- <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?> -->
</p>

<div class="row">
    <div class="container">
        <div class="col-md-8">
            <div class="perguntas-view border">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="media-heading"> 
                                    <?php
                                    echo Yii::$app->user->isGuest ? "Anônimo" : "usuario";
                                    ?> -
                                    <?php
                                    echo $model->materia;
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="height: 150px;">
                        <hr>
                            <p>
                                <?php
                                echo nl2br($model->pergunta);
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <small><?= $model->created_at ?></small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>






<hr>



<div class="row">
    <div class="col-md-12">
        <?= $this->render('/respostas/create', array('model' => $answer)); ?>
    </div>
</div>

<hr>

<?php foreach ($model->respostas as $resposta) : ?>
    <div class="media">
        <div class="media-left">
            <a href="#">
                <img style="border-radius:50%" class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNzI1M2ZjMzdiOSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE3MjUzZmMzN2I5Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi4xNzE4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+" alt="...">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><?= $resposta->user_id ?> Nome Usuario</h4>
            <p style="min-height:50px;" class="list-group-item-text"><?= nl2br($resposta->resposta) ?></p>
            <p class="list-group-item-text"><small><?= $resposta->created_at ?></small></p>
            <p>
                <div class="row">
                    <div class="col-md-3">
                        <span style="color:#d44572;">
                            <i class="fas fa-apple-alt fa-2x"></i> <?= rand(1000, 5000) ?>
                        </span>
                    </div>
                </div>


            </p>
        </div>
    </div>
    <hr>
<?php endforeach; ?>