<?php
$loader->import('config.php');

$loader->import('security.php');

if (file_exists(__DIR__.'/security_local.php')) {
    $loader->import('security_local.php');
}

//monolog
$container->loadFromExtension('monolog', [
//    'channels' => [
//        'mautic',
//        'chrome',
//    ],
    'channels' => ['!event', '!doctrine'],
    'handlers' => [
        'main' => [
//            'formatter' => 'mautic.monolog.fulltrace.formatter',
            'type'      => 'fingers_crossed',
            'path'      => '%kernel.logs_dir%/%kernel.environment%.php',
            'level'     => 'error',
            'handler'    => 'nested',
//             'max_files' => 7,
        ],
        'nested'   => [
            'type'      => 'stream',
            'path'      => '%kernel.logs_dir%/%kernel.environment%.php',
            'level'     => 'debug'
        ],
        'console' => [
            'type'   => 'console',
//            'bubble' => false,
        ],
//        'mautic' => [
//            'formatter' => 'mautic.monolog.fulltrace.formatter',
//            'type'      => 'rotating_file',
//            'path'      => '%kernel.logs_dir%/mautic_%kernel.environment%.php',
//            'level'     => 'debug',
//            'channels'  => [
//                'mautic',
//            ],
//            'max_files' => 7,
//        ],
//        'chrome' => [
//            'type'     => 'chromephp',
//            'level'    => 'debug',
//            'channels' => [
//                'chrome',
//            ],
//        ],
    ],
]);


//Twig Configuration
$container->loadFromExtension('twig', [
    'cache'       => '%mautic.tmp_path%/%kernel.environment%/twig',
    'auto_reload' => true,
]);