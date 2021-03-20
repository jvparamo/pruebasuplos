<?php
require_once 'model.php';
// require "PHPExcel/Classes/PHPExcel.php";
class controller
{
    function __construct() 
        {
            $this->model = new Model();
        }
        public function index(){
            require_once 'bienes.php';
        }
        public function create()
        {
            if ($_GET) {
                
          
            $jvpc = new Model();
            $jvpc->city         =    $_GET['city'];
            $jvpc->type         =    $_GET['type'];
            $jvpc->address      =    $_GET['address'];
            $jvpc->phone        =    $_GET['phone'];
            $jvpc->postal_code  =    $_GET['postal_code'];
            $jvpc->price        =    $_GET['price'];    
            $jvpc->city_id =$this->model->register_city($jvpc);    
            $jvpc->type_id =$this->model->register_type($jvpc);    
            $this->model->register_goods($jvpc);
        }
            header('Location: index.php');
        }
        public function delete()
        {
            $jvpc = new Model();
            $jvpc->id =$_GET['id'];
            $this->model->delete($jvpc->id);    
            header('Location: index.php');
        }
        public function report()
        {
            $jvpc = new Model();
            $jvpc->city =$_GET['city'];
            $jvpc->type =$_GET['type'];
            $objPHPExcel = new \PHPExcel();
            $objSheet = $objPHPExcel->setActiveSheetIndex(0);
            $col = 0;
            $row = 1;
            if (isset($this->header)) {
                foreach ($this->header as $v) {
                    $cell = \PHPExcel_Cell::stringFromColumnIndex($col) . $row;
                    $objSheet->setCellValue($cell, $v);
                    $col++;
                }
                $row++;
                $col = 0;
            }
            foreach ($this->model->good_reports($jvpc) as $rowValue) {
                foreach ($rowValue as $_v) {
                    $cell = \PHPExcel_Cell::stringFromColumnIndex($col) . $row;
                    $objSheet->setCellValue($cell, $_v);
                    $col++;
                }
                $row++;
                $col = 0;
            }
            $objPHPExcel->getActiveSheet()->setTitle($this->title);
            $objPHPExcel->setActiveSheetIndex(0);
            $this->browserExport($this->type, $this->filename);
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, $this->type);
            $objWriter->save('php://bienes');
            header('Location: index.php');
            
        }

}
