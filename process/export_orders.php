<?php 
    require_once('../class/PHPExcel.php');
    require '../class/database.php';

    $db = new Database();
    $table = 'orders';
    $fields = array('id' , 'order_date' , 'customer_id' , 'total' , 'remarks' , 'notes' , 'status');
    $where = " status BETWEEN  ? AND ? ";
    $params = array(0, 1);
    $orders = $db->select($table, $fields, $where, $params);



  $fileName = 'list_order'.date('Y-m-d');

  //prepare the records to be added on the excel file in an array
  $excelData = $orders;

  // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();

  // Set document properties
  $objPHPExcel->getProperties()
      ->setCreator("CRM")
      ->setTitle("Order List")
      ->setSubject("My Excel Sheet")
      ->setDescription("Excel Sheet")
      ->setKeywords("Excel Sheet")
      ->setCategory("Me");

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Add column headers

  $objPHPExcel->getActiveSheet()
            ->mergeCells('A1:G1')
            ->setCellValue('A1' , 'CRM ');
  
  $objPHPExcel->getActiveSheet() 
            ->mergeCells('A2:G2')
            ->setCellValue('A2' , 'List of Orders');

  $objPHPExcel->getActiveSheet() 
            ->mergeCells('A3:G3')
            ->setCellValue('A3' , 'As of '.date('Y-m-d'));
  
  $objPHPExcel->getActiveSheet()
        ->setCellValue('A5', 'Invoice Number')
        ->setCellValue('B5', 'Order Date')
        ->setCellValue('C5', 'Customer')
        ->setCellValue('D5', 'Total')
        ->setCellValue('E5', 'Remarks')
        ->setCellValue('F5', 'Notes')
        ->setCellValue('G5', 'Status')
        ;

  //Put each record in a new cell
  for($i=0; $i<count($excelData); $i++)
  {
    $ii = $i+6;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$ii, $excelData[$i][0]);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$ii, date('Y-m-d' , $excelData[$i][1]) );
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$ii, $excelData[$i][2]);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$ii, $excelData[$i][3]);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$ii, $excelData[$i][4]);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$ii, $excelData[$i][5]);
     if($excelData[$i][6] == 0)
     {
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$ii, "For Approval");
     }
     else
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$ii, "Approved");
     
  }

  // Set worksheet title
  $objPHPExcel->getActiveSheet()->setTitle($fileName);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');


?>