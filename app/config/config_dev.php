<?php
$loader->import('config.php');

if (file_exists(__DIR__.'/security_local.php')) {
    $loader->import('security_local.php');
}


//Twig Configuration
$container->loadFromExtension('twig', [
    'cache'            => false,
    'debug'            => '%kernel.debug%',
    'strict_variables' => '%kernel.debug%',
]);


//framework
$container->loadFromExtension('framework', [
    'router' => [
        'resource'            => '%kernel.root_dir%/config/routing_dev.php',
        'strict_requirements' => true,
    ],
    'profiler' => [
        'only_exceptions' => false,
    ],
]);



//web profile
$container->loadFromExtension('web_profiler', [
    'toolbar'             => true,
    'intercept_redirects' => false,
]);

//monolog
$container->loadFromExtension('monolog', [
//    'channels' => [
//        'mautic',
//        'chrome',
//    ],
//    'channels' => ['!event', '!doctrine'],
    'handlers' => [
        'main' => [
//            'formatter' => 'mautic.monolog.fulltrace.formatter',
            'type'      => 'stream',
            'path'      => '%kernel.logs_dir%/%kernel.environment%.php',
            'level'     => 'debug',
            'channels'  => [
                '!event',
            ],
            'max_files' => 7,
        ],
        'console' => [
            'type'   => 'console',
            'bubble' => false,
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