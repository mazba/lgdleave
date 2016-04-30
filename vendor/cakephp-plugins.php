<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Rana' => $baseDir . '/plugins/Rana/',
        'Xety/Cake3Upload' => $baseDir . '/vendor/xety/cake3-upload/'
    ]
];
