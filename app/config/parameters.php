<?php
//参数设置
$container->setParameter('database_host', '127.0.0.1');
$container->setParameter('database_port', 3306);
$container->setParameter('database_name', 'sf28mylogindemo');
$container->setParameter('database_user', 'root');
$container->setParameter('database_password', 'root123123');
$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host', '');
$container->setParameter('mailer_password', '');
$container->setParameter('secret', 'ThisTokenIsNotSoSecretChangeIt');