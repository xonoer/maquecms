<?php
namespace app\admin\controller;

use think\Db;
use app\admin\model\BaseModel;

#@用户管理@#
class User extends Common{

    //分类成员变量
    public $user_table="user_list";
    public $user_pk="userid";

    public $model;

    protected function initialize(){

        $this->model = new \app\admin\model\UserModel();
    }


    #数据列表#
    public function lists(){


        if($this->request->isGet()){

            if($this->request->isAjax()){
                
                $param=$this->request->param();

                echo $this->model->Page($this->user_table,$param,"nickname|tel","addtime","addtime desc");
               
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

            $post=$this->request->post();

            $res= $this->model->BannerIns($post);

            if($res == true){
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

                if(!empty($info)){
                    $this->assign('info',$info);
                }
            }

            return $this->fetch();

        }else if($this->request->isPut()){ 

            $post=$param=$this->request->put();

            if(empty($post['status']))  $post['status']='0';

            $res= $this->model->UserUp($post); 

            if($res==true){
                $this->success("修改成功~",url('lists'));
            } 

            $this->error("修改失败，请重试！");

        }
    }

    #删除数据#
    public function del(){

        if($this->request->isDelete()){
          
          $bannerid=$this->request->delete('bannerid');

          $res = $this->model->BannerDel($bannerid);

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

            $res = $this->model->UserUp($post);

            if($res){
                $this->success('状态修改成功');
            }

            $this->error('状态修改失败,请稍后再试！');

        }
    }

    #导出用户#
    public function ExportExcel(){

        $Env=new \think\facade\Env;
       
        require_once $Env::get('ROOT_PATH').'/vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
       
        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                             ->setLastModifiedBy("Maarten Balliauw")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Test result file");

        $list=Db::name('user_list')->order('userid desc')->select();

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '账号')
                    ->setCellValue('B1', '昵称')
                    ->setCellValue('C1', '邮箱')
                    ->setCellValue('D1', '手机号')
                    ->setCellValue('E1', '加入时间');

        foreach ($list as $k => $v) {

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($k+2), $v['username'])
                    ->setCellValue('B'.($k+2), $v['nickname'])
                    ->setCellValue('C'.($k+2), $v['email'])
                    ->setCellValue('D'.($k+2), $v['tel'])
                    ->setCellValue('E'.($k+2), $v['addtime']);
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('用户列表');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="导出用户'.date('Y-m-d H:i:s',time()).'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;


    }

  
    #excel导入#
    public function ExportPort(Request $request){
        if(request()->isGET()){

            return $this->fetch();

        }else if(request()->isPost()){

            $Env=new \think\facade\Env;
       
            require_once $Env::get('ROOT_PATH').'/vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
           
            // Create new PHPExcel object
            $objPHPExcel = new \PHPExcel();

            $file=$_FILES['file']['tmp_name'];

            
            $file_types = explode ( ".", $_FILES ['file'] ['name'] );
            $file_type = strtolower($file_types [count ( $file_types ) - 1]);
            if ($file_type  != "xlsx" &&   $file_type  != "xls"){
                    alert("不是Excel文件，请重新上传");
            }
            if($file_type=='xls'){
                $reader =  \PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
            }else if($file_type=='xlsx'){
                $reader =  \PHPExcel_IOFactory::createReader('Excel2007');//设置以Excel2007格式(OFFICE2007以上版本)
            }
            
            $PHPExcel = $reader->load($file); // 载入excel文件
            $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumm = $sheet->getHighestColumn(); // 取得总列数 （最后一列序号）
            $highestColumm= \PHPExcel_Cell::columnIndexFromString($highestColumm); //将列序号转换为数字
            //PHPExcel_Cell::stringFromColumnIndex($i); // 将数字转换为序号

            /** 循环读取每个单元格的数据 */
            for ($row = 2; $row <= $highestRow; $row++){//行数是以第2行开始,开始是1,第一行是标题
                for ($column = '0'; $column < $highestColumm; $column++) {//列数是以0开始
                 // $column =   \PHPExcel_Cell::stringFromColumnIndex($column);
                  // $data[$row]['name']=$sheet->getCell($column.$row)->getValue();

                  // echo $sheet->getCellByColumnAndRow($column,$row)->getValue(); 读取某行，某个？ 
                  // 
                  
                  $name= \PHPExcel_Cell::stringFromColumnIndex($column);//数字转换成字母
                  $key=$this->order_excel_new_title($name);
                  if($column=='0'||$column=='1'||$column=='16'){ //excel 内容 时间转换为时间戳
                    //getCell($name.$row) . 还是，？？？
                    $data[$row][$key]=strtotime($sheet->getCell($name.$row)->getValue());
                  }else{
                    $data[$row][$key]=$sheet->getCell($name.$row)->getValue();
                  }
                  
                  
                }
                
                //待处理     

            }


        }
    }


}
