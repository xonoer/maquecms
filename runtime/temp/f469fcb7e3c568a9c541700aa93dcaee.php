<?php /*a:3:{s:54:"G:\www2\cms2\application\admin\view\auth\rolelist.html";i:1542725515;s:52:"G:\www2\cms2\application\admin\view\public\base.html";i:1543161944;s:52:"G:\www2\cms2\application\admin\view\public\head.html";i:1541778938;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理中心</title>

  <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
  
  <script src="/static/admin/layui/layui.js?v=1"></script>


  <link rel="stylesheet" href="/static/admin/layui/css/layui.css?v=2">
  <link rel="stylesheet" href="/static/admin/css/admin.css?v=1.4">
  <script type="text/javascript" src="https://cdn.bootcss.com/layer/2.3/layer.js"></script>
  <script type="text/javascript" src="/static/admin/js/admin.js"></script>
  
</head>
<body class="layui-layout-body">



  
  <div class="layui-body">
   <!-- 内容主体区域 -->
  <div id="main">

      <blockquote class="layui-elem-quote">
        <?php echo htmlentities($title); ?>  

        
      </blockquote>
   
      
<form class="layui-form">
  <div class="demoTable">
    条件搜索：
   
    <div class="layui-inline">
      <input class="layui-input" name="keyword" id="keyword" autocomplete="off" placeholder="请输入关键字">
    </div>
    <div class="layui-inline">
      <input class="layui-input" name="start" id="start"  placeholder="请输入添加开始时间">
    </div>
    <div class="layui-inline">
      <input class="layui-input" name="end" id="end"  placeholder="请输入添加结束时间">
    </div>
    <div class="layui-inline">
      <button class="layui-btn" lay-filter="submit" lay-submit>搜索</button>
      <button class="layui-btn layui-btn-primary"  lay-filter="submit" lay-submit>重置</button>
      <a href="javascript:LayerOpen('<?php echo url('auth/roleadd'); ?>');" class="layui-btn">添加角色</a>
    </div>

  </div>
</form>
<table class="layui-table" lay-data="{height:650,url:location.href,where:{roleid:'<?php echo input('roleid'); ?>'}, page:true, id:'rolelist'}" lay-filter="table" lay-size="lg">
  <thead>
    <tr>
      <th lay-data="{field:'roleid'}">ID</th>
      <th lay-data="{field:'px'}">排序</th>
      <th lay-data="{field:'name'}">名称</th>
      <th lay-data="{field:'status',templet:'#status'}">状态</th>
      <th lay-data="{field:'addtime'}">添加时间</th>
      <th lay-data="{fixed: 'right', width:160, align:'center', toolbar: '#barDemo'}">操作</th>
    </tr>
  </thead>
</table>

<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-xs" lay-event="menu">菜单</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script>
layui.use(['table','laydate','form'], function(){
  table = layui.table;
  var laydate = layui.laydate;
  var form = layui.form;
   laydate.render({
      elem: '#start',
      max: 0
   });
    laydate.render({
      elem: '#end',
      max: 1
   });

  //搜索
  form.on('submit(submit)', function(data){
   
    var field=data.field;

    if($(data.elem).html()=="重置"){

        $("input").val("");
        field="";
    }

    table.reload('rolelist', {
       where: field
    });

    return false; 
  });


  table.on('tool(table)', function(obj){

    var data = obj.data;

    if(obj.event === 'del'){

        Delete("<?php echo Url('roledel'); ?>",{'bannerid': data.bannerid},obj);
        
    } else if(obj.event === 'edit'){

      LayerOpen("roleedit/roleid/"+data.roleid);

    }else if(obj.event === 'menu'){

        location.href="/admin.php/auth/rolemenu/roleid/"+data.roleid;
    }

  });


  //开关
  form.on('switch(status)', function(data){

    Status("<?php echo url('roleup'); ?>",{'status':data.elem.checked,'roleid':data.value});
   
  }); 


  //图片查看
  layer.photos({
    photos: 'div'
    ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
  });


});

</script>


<script type="text/html" id="link">
  {{#  if(d.url != '' && typeof(d.url) != 'undefined'){ }}
     <a href="{{d.url}}" class="layui-table-link" target="_blank">{{d.title}}</a>
  {{#  } else { }}
    {{d.title}}
  {{#  } }}
</script>

<script type="text/html" id="status">
  {{#  if(d.status == '1'){ }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="启用|禁用" lay-filter="status" value="{{d.roleid}}" checked>
  {{#  } else { }}
    <input type="checkbox" name="status" lay-skin="switch" lay-text="启用|禁用" lay-filter="status"  value="{{d.roleid}}">
  {{#  } }}
</script>



       
  </div>
</div> 


<script type="text/javascript" src="/static/admin/js/admin.js"></script>
</body>
</html>