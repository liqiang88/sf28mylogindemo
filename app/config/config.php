<?php
$loader->import('parameters.php');
$loader->import('security.php');
$loader->import('services.php');

$container->setParameter('locale', 'en');


//framework
$container->loadFromExtension('framework', [
    'secret' => '%secret%',
    'router' => [
        'resource'            => '%kernel.root_dir%/config/routing.php',
        'strict_requirements' => null,
    ],
    'form'            => null,
//    'csrf_protection' => false,
    'validation'      => [
        'enable_annotations' => true,
    ],
    'templating' => [
        'engines' => ['twig','php'],
//        'form'    => [
//            'resources' => [
//                'MauticCoreBundle:FormTheme\\Custom',
//            ],
//        ],
    ],
    'default_locale' => '%locale%',
    'translator'     => [
        'enabled'  => true,
        'fallback' => 'en_US',
    ],
    //'trusted_hosts'   => '%mautic.trusted_hosts%',
    //'trusted_proxies' => '%mautic.trusted_proxies%',
    'session'         => [ //handler_id set to null will use default session handler from php.ini
        'handler_id'    => null,
        //'name'          => $sessionName,
        //'cookie_secure' => $secureCookie,
    ],
    'fragments'            => null,
    'http_method_override' => true,

    /*'validation'           => array(
        'static_method' => array('loadValidatorMetadata')
    )*/
]);

//Doctrine Configuration
$dbalSettings = [
    'driver'   => 'pdo_mysql',
    'host'     => '%database_host%',
    'port'     => '%database_port%',
    'dbname'   => '%database_name%',
    'user'     => '%database_user%',
    'password' => '%database_password%',
    'charset'  => 'UTF8',
//    'types'    => [
//        'array'    => 'Mautic\CoreBundle\Doctrine\Type\ArrayType',
//        'datetime' => 'Mautic\CoreBundle\Doctrine\Type\UTCDateTimeType',
//    ],
    // Prevent Doctrine from crapping out with "unsupported type" errors due to it examining all tables in the database and not just Mautic's
//    'mapping_types' => [
//        'enum'  => 'string',
//        'point' => 'string',
//        'bit'   => 'string',
//    ],
    'server_version' => '5.6', //数据库引擎版本
];

$container->loadFromExtension('doctrine', [
    'dbal' => $dbalSettings,
    'orm'  => [
        'auto_generate_proxy_classes' => '%kernel.debug%',
        'auto_mapping'                => true,
//        'mappings'                    => $ormMappings,
    ],
]);



// Swiftmailer Configuration
$mailerSettings = [
    'transport'  => '%mailer_transport%',
    'host'       => '%mailer_host%',
//    'port'       => '%mailer_port%',
//    'username'   => '%mailer_user%',
    'password'   => '%mailer_password%',
//    'encryption' => '%mailer_encryption%',
//    'auth_mode'  => '%mailer_auth_mode%',
];

// Only spool if using file as otherwise emails are not sent on redirects
//$spoolType = $container->getParameter('mailer_spool_type');
//if ($spoolType == 'file') {
//    $mailerSettings['spool'] = [
//        'type' => '%mailer_spool_type%',
//        'path' => '%mailer_spool_path%',
//    ];
//}
$container->loadFromExtension('swiftmailer', $mailerSettings);

