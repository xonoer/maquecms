<?php
// +----------------------------------------------------------------------
// | 麻雀cms [ 麻雀虽小，五脏俱全 ]
// +----------------------------------------------------------------------
// | gitee:https://gitee.com/32684028888/MaQuecms
// +----------------------------------------------------------------------
// | 作者: 与光同尘
// +----------------------------------------------------------------------
// | 技术支持群：159360042 ， 欢迎加入交流，讨论
// +----------------------------------------------------------------------
// 
// [ 应用入口文件 ]

namespace think;

//检测是否安装，安装后可以注释掉本文件
if (!file_exists('./install/install.lock'))  header("location:install.php"); 

//删掉注释，可以免登陆进入后台，用于忘记超级管理员密码
//define("administrator", "麻雀cms");

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 支持事先使用静态方法设置Request对象和Config对象
// 执行应用并响应
Container::get('app')->bind('admin')->run()->send();
