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
        'dist\js\plugins\foundation.core.js',
        'dist\js\foundation.min.js',
        'dist\js\plugins\foundation.offcanvas.js',
        'dist\js\plugins\foundation.util.keyboard.js',
        'dist\js\plugins\foundation.util.mediaQuery.js',
        'dist\js\plugins\foundation.util.triggers.js',
        'dist\js\plugins\foundation.util.motion.js',
        'dist\js\plugins\foundation.util.touch.js',
    ];

    public $depends = [];

    public $publishOptions = [
        'forceCopy' => true,
    ];
}
