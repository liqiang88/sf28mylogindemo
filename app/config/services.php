<?php

use AppBundle\Service\MessageGenerator;
use Symfony\Component\DependencyInjection\Reference;
use AppBundle\EventListener\ExceptionListener;
use AppBundle\EventSubscriber\ExceptionSubscriber;

//注册一个容器服务
$container->register('app.message_generator', MessageGenerator::class)
    ->addArgument(new Reference('logger'));  //容器参数
//    ->addArgument(new Reference('logger'))->setLazy(true);  //lazy方式

//$container->setDefinition();

//注册异常事件监听
//$container
//    ->register('app.exception_listener', ExceptionListener::class)
//    ->addTag('kernel.event_listener', array('event' => 'kernel.exception'))
//;

//事件订阅
//$container
//    ->register('app.exception_subscriber', ExceptionSubscriber::class)
//    ->addTag('kernel.event_subscriber');
//
//
////mysqli服务
//$container->register('db_mysqli', \AppBundle\Service\MysqliDb::class)
//    ->setArguments(['%database_host%','%database_user%','%database_password%','%database_name%','%database_port%']);
