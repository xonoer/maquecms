<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\LoginModel;

class Login extends Controller{

    #初始化操作#
    protected function initialize(){

    }

    public function index(){
         
        if($this->request->isGet()){
        	
            return $this->fetch();
        		
        }else{
        	
        	$data=$this->request->post();
     		
     		if( !captcha_check($data['vercode'])){
     			$arr = ['name' => '验证码错误~', 'status' => '0'];
        		echo  json_encode($arr); exit;
     		}

        	echo LoginModel::login($data);

        }

    }

    #退出登录#
    public function loginout(){
        
        LoginModel::loginout();
        $common=new \app\admin\controller\Common;
        $common->log("退出登录");
        
        $this->success("退出成功~",url('login/index'));
        exit;
    }
}
