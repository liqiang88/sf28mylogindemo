<?php
$firewalls = [
    'dev' => [
        'pattern'   => '^/(_(profiler|wdt)|css|images|js)/',
        'security'  => false,
    ],
//    'login' => [
//        'pattern'=> '^/login',
//        'anonymous' => true
//    ],
    'main' => [
        'pattern'  => '^/',  //匹配路径
        'anonymous' => null,
//        'provider'  => 'our_db_provider',  //定义的providers
        'provider'  => 'webservice_provider',  //定义的providers2
        'form_login'  => [
//            'username_parameter'  =>  '_username',  //默认值为_username，对应表单用户名域中的name值
//            'password_parameter'  =>  '_password',   //默认值为_password，对应表单密码域中的name值
            'check_path'  => 'login',  //登录表单提交地址
            'login_path'  => 'login',    //登录页面地址
        ],
        'logout'  => [
            'path'    => 'logout', //退出url
            'target'  => 'homepage',  //退出后跳转地址
        ],


    ]
    //....

];

$container->loadFromExtension(
    'security',
    [
        'encoders'     =>[
            'AppBundle\Entity\User'  => [
                'algorithm'  => 'bcrypt',  //php>＝5.5 password_hash 密码长度至少产生60个字符
                'cost'       => 12  //指明算法的递归层数
            ],
        ],
        'providers'    => [ //可以有多个providers

//            'in_memory' => ['memory'  => null]
            'webservice_provider'   => [  //自定义一个服务user provider
                'id' => 'app.webservice_user_provider'   //注册的服务id
            ],

            'our_db_provider' =>[  //自定义的provider
                'entity'  =>  [
                    'class'  =>  'AppBundle:User',
                    'property'  => 'username',//如果注释掉会执行UserRespository loadUserByUsername方法，否则只根据属性username去检测用户
                ],
            ]

        ],
        'firewalls'    => $firewalls,  //最重要的防火墙配置
//
        'access_control'  => [
            ['path'  => '^/login','roles' => 'IS_AUTHENTICATED_ANONYMOUSLY'], //登录页面加入白名单允许匿名访问
            ['path'  => '^/adm','roles' => 'ROLE_ADMIN'], //指定角色可以访问
        ],

        'role_hierarchy'  => [
            'ROLE_ADMIN'  => ['ROLE_USER'], //登录用户角色继承，ROLE_ADMIN角色拥有ROLE_USER角色权限
            'ROLE_SUPERADMIN'   => ['ROLE_ADMIN'],  //登录用户角色继承，ROLE_ADMIN角色拥有ROLE_ADMIN角色权限
        ]
    ]
);