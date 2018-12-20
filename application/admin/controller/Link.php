<?php
namespace app\admin\controller;
use app\admin\model\LinkModel;

#@友情链接管理@#
class Link extends Common{

    public $table="link_list";
    public $pk="linkid";

    public $model;

    protected function initialize(){

        $this->model = new \app\admin\model\LinkModel();
    }

    #数据列表#
    public function lists(){

        if($this->request->isGet()){

            //ajax请求
            if($this->request->isAjax()){
                
                $param=$this->request->param();

                echo $this->model->Page($this->table,$param,"bannerid|link");
               
                exit;
            }
          
        		return $this->fetch();

        }

    }

    #添加数据#
    public function add(){
        
        if($this->request->isGet()){

            return $this->fetch();

        }else{ 

            $post=$param=$this->request->post();


            $res= $this->model->LinkIns($post);

            if($res==true){
                $this->success("添加成功~",url('lists'));
            } 
            
            $this->error("添加失败，请重试！");
              
        }
    }
    
    #修改数据#
    public function edit(){
        
        if($this->request->isGet()){

            $get=$this->request->param();
            
            if(isset($get[$this->pk])){

                //查询条件
                $map[$this->pk]=$get[$this->pk];

                $info = $this->model->DataFind($this->table,$map);

                if(!empty($info)) $this->assign('info',$info);
                    
            }

            return $this->fetch();

        }else if($this->request->isPut()){

            $post=$param=$this->request->put();

            if(empty($post['status']))  $post['status']='0';

            $res= $this->model->LinkUp($post); 

            if($res==true){
                $this->success("修改成功~",url('lists'));
            } 

            $this->error("修改失败，请重试！"); 

        }
    }

    public function del(){

        if($this->request->isDelete()){
          
          $linkid=$this->request->delete('linkid');

          $res = $this->model->LinkDel($linkid);

          if($res){
            $this->success('删除成功');
          }

          $this->error('删除失败,请稍后再试！');

        }
    }

    #修改状态#
    public function up(){

        if($this->request->isPut()){

            $post= $this->request->put();
            
            $post['status']=$post['status']== 'true'?'1':'0';

            $res = $this->model->LinkUp($post);

            if($res){
                $this->success('状态修改成功');
            }

            $this->error('状态修改失败,请稍后再试！');

        }
    }

}
