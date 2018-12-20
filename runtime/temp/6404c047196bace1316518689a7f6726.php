<?php /*a:1:{s:52:"G:\www2\cms2\application\admin\view\login\index.html";i:1545323593;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>登入 - 后台管理中心</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/static/admin/login/admin.css" media="all">
  <link rel="stylesheet" href="/static/admin/login/login.css" media="all">
  <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js?v=1"></script>
  <style type="text/css">
    
   .videoBx {width: 100%;height: 100%;position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: -1;}
   .canvas{position: fixed;left: 0;top: 0;z-index: 0; opacity: .8; height: 100%; width: 100%}
   .v-b-shadow{
        background: url(/static/admin/img/v-b-shadow.jpg) no-repeat 0 bottom;
        background-size: cover;
        bottom: 0;
        height: 100%;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 0;
   }
  </style>
</head>
<body>
  <div class="videoBx">
  <div class="v-b-shadow"></div>
  <canvas id="canvas" class="canvas"></canvas>
</div>
  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
    
      <div class="layadmin-user-login-box layadmin-user-login-body layui-form" style="background-color: #ddd;border-radius: 5px;">
        <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>麻雀后台管理系统</h2>
       </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
          <input type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
        </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
          <input type="password" name="password" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input">
        </div>
        <div class="layui-form-item">
          <div class="layui-row">
            <div class="layui-col-xs7">
              <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
              <input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input" >
            </div>
            <div class="layui-col-xs5">
              <div style="margin-left: 10px;">
                <img src="<?php echo captcha_src(); ?>" class="layadmin-user-login-codeimg" id="vercode" onclick="this.src='/index.php/captcha.html?'+Math.random()">
              </div>
            </div>
          </div>
        </div>
        <div class="layui-form-item" style="margin-bottom: 20px;">
          <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
          <!-- <a href="forget.html" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">忘记密码？</a> -->
        </div>
        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login" >登 录</button>
        </div>
        
      </div>
    </div>
    
    <div class="layui-trans layadmin-user-login-footer">
      
      <p>© 2018 <a href="" target="_blank"></a></p>
    </div>
    
    
  </div>

  <script src="/static/admin/layui/layui.js"></script>  
  <script>
  //一般直接写在一个js文件中
  layui.use(['layer', 'form'], function(){
    var layer = layui.layer
    ,form = layui.form;

     //提交
    form.on('submit(login)', function(obj){

      $(obj.elem).attr("disabled",true);

      //请求登入接口
      $.post("<?php echo url('index'); ?>",obj.field,function(res){
   

          if(res.status=='0'){
              layer.msg(res.name);
              $("#vercode").click();
              $(obj.elem).attr("disabled",false);
          }else{
              //登入成功的提示与跳转
              layer.msg(res.name, {
                offset: '15px'
                ,icon: 1
                ,time: 1000
              }, function(){
                location.href = res.url; 
              });
          }      
 
      },"json");
      
    });

    }); 

  </script> 


  <script>

    var WINDOW_WIDTH = document.body.offsetWidth;
    var WINDOW_HEIGHT = document.body.offsetHeight;
    var canvas,context;
    var num = 500;
    var stars = [];
    var mouseX = WINDOW_WIDTH/2;
    var mouseY = WINDOW_HEIGHT/2;
    var rnd;

    window.onload = function(){
        function isIE(){

            if (!!window.ActiveXObject || "ActiveXObject" in window)  //是IE浏览器
                return true;
            else  //不是IE浏览器
                return false;
        }
        if (isIE()) {
            window.location.replace('/static/error.html')
        }
        canvas = document.getElementById('canvas');
        canvas.width = WINDOW_WIDTH;
        canvas.height = WINDOW_HEIGHT;

        context = canvas.getContext('2d');

        addStar();
        setInterval(render,33);
        liuxing();

        // render();
        document.body.addEventListener('mousemove',mouseMove);
    }

    function liuxing(){
        var time = Math.round(Math.random()*3000+33);
        setTimeout(function(){
            rnd = Math.ceil(Math.random()*stars.length)
            liuxing();
        },time)
    }

    function mouseMove(e){
        //因为是整屏背景，这里不做坐标转换
        mouseX = e.clientX;
        mouseY = e.clientY;
    }

    function render(){
        context.fillStyle = 'rgba(0,0,0,0.1)';
        context.fillRect(0,0,WINDOW_WIDTH,WINDOW_HEIGHT);
        // context.clearRect(0,0,WINDOW_WIDTH,WINDOW_HEIGHT)
        for(var i =0; i<num ; i++){
            var star = stars[i];
            if(i == rnd){
                star.vx = -5;
                star.vy = 20;
                context.beginPath();
                context.strokeStyle = 'rgba(255,255,255,'+star.alpha+')';
                context.lineWidth = star.r;
                context.moveTo(star.x,star.y);
                context.lineTo(star.x+star.vx,star.y+star.vy);
                context.stroke();
                context.closePath();
            }
            star.alpha += star.ra;
            if(star.alpha<=0){
                star.alpha = 0;
                star.ra = -star.ra;
                star.vx = Math.random()*0.2-0.1;
                star.vy = Math.random()*0.2-0.1;
            }else if(star.alpha>1){
                star.alpha = 1;
                star.ra = -star.ra
            }
            star.x += star.vx;
            if(star.x>=WINDOW_WIDTH){
                star.x = 0;
            }else if(star.x<0){
                star.x = WINDOW_WIDTH;
                star.vx = Math.random()*0.2-0.1;
                star.vy = Math.random()*0.2-0.1;
            }
            star.y += star.vy;
            if(star.y>=WINDOW_HEIGHT){
                star.y = 0;
                star.vy = Math.random()*0.2-0.1;
                star.vx = Math.random()*0.2-0.1;
            }else if(star.y<0){
                star.y = WINDOW_HEIGHT;
            }
            context.beginPath();
            var bg = context.createRadialGradient(star.x, star.y, 0, star.x, star.y, star.r);
            bg.addColorStop(0,'rgba(255,255,255,'+star.alpha+')')
            bg.addColorStop(1,'rgba(255,255,255,0)')
            context.fillStyle  = bg;
            context.arc(star.x,star.y, star.r, 0, Math.PI*2, true);
            context.fill();
            context.closePath();
        }
    }

    function addStar(){
        for(var i = 0; i<num ; i++){
            var aStar = {
                x:Math.round(Math.random()*WINDOW_WIDTH),
                y:Math.round(Math.random()*WINDOW_HEIGHT),
                r:Math.random()*3,
                ra:Math.random()*0.05,
                alpha:Math.random(),
                vx:Math.random()*0.2-0.1,
                vy:Math.random()*0.2-0.1
            }
            stars.push(aStar);
        }
    }
</script>
</body>
</html>