<?
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-7 centered">
        <?php foreach ($model as $key => $my) : ?>
            <div class="media border">
                <div class="media-left">
                    <a href="#">
                        <img style="border-radius:50%" class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNzI1M2ZjMzdiOSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE3MjUzZmMzN2I5Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi4xNzE4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+" alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= $my->aluno->username ?></h4>
                    <p style="min-height:50px;" class="list-group-item-text"><?= nl2br($my->pergunta) ?></p>
                    <br>
                    <p class="list-group-item-text"><small><?= $my->created_at ?></small></p>
                    <hr>
                    <p>
                        <div class="row">
                            <div class="col-md-3">
                                <span style="color:#d44572;">
                                    <i class="fas fa-apple-alt fa-2x"></i> 100
                                </span>
                            </div>
                            <div class="col-md-3 col-md-offset-6">
                                <?php
                                $url = Url::to(['perguntas/view', 'id' => $my->id]);
                                ?>
                                <a href="<?= $url ?>" class="btn btn-block btn-dark btn-outline-dark btn-default">Ver respostas</a>
                            </div>
                        </div>
                    </p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
</div>