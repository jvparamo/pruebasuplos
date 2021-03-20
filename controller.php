<?php
require_once 'model.php';
require "PHPExcel/Classes/PHPExcel.php";
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
            print_r($_GET['phone']);
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
             
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("Govinda")
                             ->setLastModifiedBy("Govinda")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Test result file");

                            // Add some data
                            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
                            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Sr no')->setCellValue('B1', 'Name')->setCellValue('C1', 'Age');


// Miscellaneous glyphs, UTF-8
$i=0;
foreach ($this->model->good_reports($jvpc) as $r) {

      $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $r->city);
      $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $r->type);
      $i++;
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('list');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment;filename="userList.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

  
            header('Location: index.php');
        }

}