<?php /*a:1:{s:52:"G:\www2\cms2\application\admin\view\index\index.html";i:1545324403;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理中心</title>

  <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
  
  <script src="/static/admin/layui/layui.js?v=1"></script>
    
  <script type="text/javascript" src="https://cdn.bootcss.com/layer/2.3/layer.js"></script>
  <script type="text/javascript" src="/static/admin/js/admin.js"></script>

  <link rel="stylesheet" href="/static/admin/layui/css/layui.css?v=2">
  <link rel="stylesheet" href="/static/admin/css/admin.css?v=1.4">
 
</head>
<body class="layui-layout-body">

<div class="layui-layout layui-layout-admin">
  <div class="layui-header">

    <div></div>
    <div class="layui-logo">后台管理中心</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left layui-hide-xs">
      <li class="layui-nav-item"><a href="/<?php echo config('site.adminpath'); ?>">功能管理</a></li>
      <li class="layui-nav-item "><a href="/index.php" target="_blank">网站首页</a></li>
    </ul>
    <ul class="layui-nav layui-layout-right ">
      <li class="layui-nav-item layui-hide-xs">
        <a href="javascript:;">
          <img src="<?php echo htmlentities(app('session')->get('admin.avatar')); ?>" class="layui-nav-img">
          <?php echo htmlentities(app('session')->get('admin.nickname')); ?>
        </a>
      </li>
      <li class="layui-nav-item"><a href="<?php echo Url('login/loginout'); ?>">退出</a></li>
    </ul>
  </div>


  <div class="layui-side layui-bg-black left-menu">
    <div class="layui-side-scroll" >
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->

      <ul class="layui-nav layui-nav-tree"  lay-filter="menu">
      
        <?php if((app('session')->get('admin.adminid') == '1') or (administrator == '麻雀cms')): ?>
        <li class="layui-nav-item <?php if($controller == 'index'): ?>layui-nav-itemed<?php endif; ?>">

          <a href="<?php echo Url('index/ecscharts'); ?>" target="iframe">
            <i class="layui-icon">&#xe68e;</i>  数据统计
          </a>
        </li>
        
        <li class="layui-nav-item">
          <a href="javascript:;">
            <i class="layui-icon">&#xe634;</i>  轮播管理
          </a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo Url('banner/lists'); ?>" target="iframe">轮播列表</a></dd>
            <dd><a href="<?php echo Url('banner/add'); ?>" target="iframe">轮播添加</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">
            <i class="layui-icon">&#xe62a;</i>  新闻管理
          </a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo Url('news/newslist'); ?>" target="iframe">新闻列表</a></dd>
            <dd><a href="<?php echo Url('news/catelist'); ?>" target="iframe">分类管理</a></dd>
            <dd><a href="<?php echo Url('news/modellist'); ?>" target="iframe">模型管理</a></dd>
            <dd><a href="<?php echo Url('news/authorlist'); ?>" target="iframe">作者管理</a></dd>
            <dd><a href="<?php echo Url('news/comment'); ?>" target="iframe">评论管理</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">
            <i class="layui-icon">&#xe770;</i>  用户管理
          </a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo Url('user/lists'); ?>" target="iframe">用户列表</a></dd>
            <!-- <dd><a href="');<?php echo Url('news/newsadd'); ?>">添加新闻</a></dd> -->
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="<?php echo Url('msg/lists'); ?>" target="iframe">
            <i class="layui-icon">&#xe63c;</i>  留言管理
          </a>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">
            <i class="layui-icon">&#xe64c;</i>  友情链接
          </a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo Url('link/lists'); ?>" target="iframe">链接列表</a></dd>
            <dd><a href="<?php echo Url('link/add'); ?>" target="iframe">链接添加</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">
            <i class="layui-icon">&#xe716;</i>  站点管理
          </a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo Url('site/index'); ?>" target="iframe">网站信息</a></dd>
            <dd><a href="<?php echo Url('site/water'); ?>" target="iframe">水印设置</a></dd>
            <dd><a href="<?php echo Url('site/upload'); ?>" target="iframe">上传设置</a></dd>
            <dd><a href="<?php echo Url('site/template'); ?>" target="iframe">模板选择</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">
            <i class="layui-icon">&#xe613;</i>  权限管理
          </a>
          <dl class="layui-nav-child">
            <dd><a href="<?php echo Url('auth/adminlist'); ?>" target="iframe">管理员列表</a></dd>
            <dd><a href="<?php echo Url('auth/rolelist'); ?>" target="iframe">角色列表</a></dd>
            <dd><a href="<?php echo Url('auth/actionlist'); ?>" target="iframe">权限列表</a></dd>
            <dd><a href="<?php echo Url('auth/loglist'); ?>" target="iframe">操作日志</a></dd>
            <dd><a href="<?php echo Url('auth/modifypd'); ?>" target="iframe">修改密码</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item ">
          <a href="javascript:FormAjax('<?php echo url('index/delcache'); ?>')" target="iframe">
            <i class="layui-icon">&#xe60b;</i>  清空缓存
          </a>
        </li>
        <li class="layui-nav-item ">
          <a href="<?php echo url('index/serveradd'); ?>" target="iframe">
            <i class="layui-icon">&#xe631;</i>  服务器信息
          </a>
        </li>
      <?php else: ?>
      <?php echo RoleMenu(); ?>
      <?php endif; ?>
        <li class="layui-nav-item ">
          <a href="<?php echo url('login/loginout'); ?>" target="iframe">
            <i class="layui-icon">&#xe60f;</i>  退出登录
          </a>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="layui-body layui-body-iframe">
   <!-- 内容主体区域 -->
  <div id="main">
   
      <iframe src="<?php echo url('index/ecscharts'); ?>" class="base-iframe" id='iframe' name="iframe"></iframe>
       
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    <a href="https://gitee.com/32684028888/MaQuecms" target="_blank" >© 麻雀cms</a>
  </div>
</div> 

<script>
//左边菜单栏目代码区域
layui.use('element', function(){
  let element = layui.element;
  /*element.on('nav(menu)', function(elem){
    let href = elem.context.href;
    if(href != 'javascript:;' || href != '' || typeof(href) == "undefined"){
      
    }
  });*/
});

function ToLink(url){
  $("iframe").attr('src',url);
}
</script>

</body>
</html>