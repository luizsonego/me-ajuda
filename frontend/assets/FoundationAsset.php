<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class FoundationAsset extends AssetBundle
{

    public $sourcePath = "@vendor/zurb/foundation";

    public $css = [
        'dist\css\foundation.min.css',
        'dist\css\foundation-prototype.min.css',
        'dist\css\foundation-float.min.css',
    ];

    public $js = [
        'dist\js\foundation.min.js',
    ];

    public $depends = [
    ];
}