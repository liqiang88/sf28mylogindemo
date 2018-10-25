基于symfony2.8的加载DB的用户登录Demo

1、需要修改数据库配置parameter.yml
2、生成登录用户表；项目目录下执行脚本 php app/console doctrine:schema:update --force
3、登录页面http://xxx.com/login，需要登录后才能访问的页面http://xxx.com/adm/index