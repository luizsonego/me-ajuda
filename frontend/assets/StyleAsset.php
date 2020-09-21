<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class StyleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/_global.css',
        'css/styles.css',
        'css/questions.css',
        'css/answer.css',
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    public $publishOptions = [
        'forceCopy' => false,
    ];
}