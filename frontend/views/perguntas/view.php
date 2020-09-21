<?php

use app\models\AlunoProfile;
use app\models\Auth;
use app\models\Respostas;
use common\models\AlunoLoginForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = $model->id;
\yii\web\YiiAsset::register($this);

$source = Auth::findOne(['user_id' => $model->user_id]);
$profile = AlunoProfile::findOne($model->user_id);
$profileImage = $source->source === 'facebook' 
    ? 'http://graph.facebook.com/'.$profile->gravatar_id.'/picture?type=square' 
    : 'frontend/web/assets/users_ico/'.$profile->gravatar_id;

?>

<div class="large-8 columns large-centered">

    <div class="box">
        <div class="content">
            <?php echo $model->pergunta; ?>
        </div>
        <div class="footer">
            <div class="materia">
                <span class="materia">
                    <?php echo $model->onematerias->materia; ?> <br>
                </span>
                <span class="data">
                    <?php echo date('d F \d\e Y', strtotime($model->created_at)); ?>
                </span>
            </div>
            <div class="actions">
                <img src="<?php echo $profileImage; ?>" alt="<?php echo $profile->name; ?>" title="<?php echo $profile->name; ?>" class="img-profile" />
            </div>
        </div>
    </div>


    <?php
    if (!Yii::$app->user->isGuest) {
        echo $this->render('/respostas/create', array('model' => $answer));
    }
    ?>
    <hr>
    <?php Pjax::begin(['id' => 'answer']); ?>
    <?php foreach ($resposta as $resposta): ?>

        <div class="box">
            <div class="content">
                <?php echo nl2br($resposta->resposta); ?>
            </div>
            <div class="footer answer">
                <div class="likes">
                    <div class="button-action">
                        <?php echo
                            Html::button(
                                '<div class="text-count">' . $resposta->is_likeable . '</div>',
                                [
                                    'class' => 'button-like',
                                    'onclick' => '$.ajax({
                                        url: "index.php?r=respostas/likeable",
                                        data: { "id" : ' . $resposta->id . ', "now" : ' . $resposta->is_likeable . ' },
                                        success: function (result) {
                                            $.pjax.reload({container: "#answer"})
                                        },
                                        error: function (errormessage) {
                                            console.log("error", errormessage)
                                        }
                                    })'
                                ]
                            );
                        ?>
                    </div>
                    <?php
                        if ($resposta->is_best === 1) {
                            echo '<div class="button-action">';
                            echo '  <div class="is-best"><img src="frontend/web/assets/best.svg" /></div>';
                            echo '</div>';
                        }
                    ?>
                    <div class="button-action">
                        <?php
                            if(!Yii::$app->user->isGuest && $model->user_id === Yii::$app->user->identity->id && $hasBatter != 1) {
                                echo Html::button(
                                    '<div class="text-count">Melhor resposta</div>',
                                    [
                                        'class' => 'button-best',
                                        'onclick' => '$.ajax({
                                            url: "index.php?r=respostas/best",
                                            data: { "id" : ' . $resposta->id . ' },
                                            success: function (result) {
                                                $.pjax.reload({container: "#answer"})
                                            },
                                            error: function (errormessage) {
                                                console.log("error", errormessage)
                                            }
                                        })'
                                    ]
                                );
                            }
                            if(!Yii::$app->user->isGuest && $model->user_id === Yii::$app->user->identity->id) {
                                if ($resposta->is_best === 1){
                                    echo Html::button(
                                        '<div class="text-count hide-for-small-only">Remover melhor resposta</div>',
                                        [
                                            'class' => 'button-remove-best',
                                            'onclick' => '$.ajax({
                                                url: "index.php?r=respostas/removebest",
                                                data: { "id" : ' . $resposta->id . ' },
                                                success: function (result) {
                                                    $.pjax.reload({container: "#answer"})
                                                },
                                                error: function (errormessage) {
                                                    console.log("error", errormessage)
                                                }
                                            })'
                                        ]
                                    );
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="actions">
                    <?php
                        $source = Auth::findOne(['user_id' => $resposta->user_id]);
                        $profile = AlunoProfile::findOne($resposta->user_id);
                        $profileImage = $source->source === 'facebook' 
                            ? 'http://graph.facebook.com/'.$profile->gravatar_id.'/picture?type=square' 
                            : 'frontend/web/assets/users_ico/'.$profile->gravatar_id;
                        ?>
                    <img src="<?php echo $profileImage; ?>" alt="<?php echo $profile->name; ?>" title="<?php echo $profile->name; ?>" class="img-profile" />
                </div>
            </div>
        </div>

    <?php endforeach; ?>
    <?php Pjax::end(); ?>

</div>

<div class="reveal" id="login-modal" data-reveal data-animation-in="fade-in">
    <h4>Pergunta cadastrada com sucesso</h4>
</div>

<?php if (Yii::$app->user->isGuest) {
    $js = <<< JS
    $('.list-link').click(function(){
        $.ajax({
            url: 'index.php?r=site/login-ajax&url=',
            dataType: "json",
            success: function(data) {
                $(".well").html(data.id);                
            }
        })
    });
JS;
$this->registerJs($js);
?>

<!-- <script>
        $(document).ready(function() { 
            var url = <?= $model->id ?>
            $.ajax({
                type: 'POST',
                url: 'index.php?r=site/login-ajax&url=' + url,
                success: function(data) {
                    $('#login-modal').html(data)
                    $('#login-modal').foundation('open')
                }
            });
        });
    </script> -->
<?php } ?>