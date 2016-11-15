<?php 
    require_once('../class/PHPExcel.php');
    require '../class/database.php';
    require '../class/customer.php';

    session_start();

    $db = new Database();
    $sql = "SELECT o.id , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'Fullname', 
            c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description,
            o.remarks, o.notes, o.status, o.shipping_fee, o.total
            FROM orders o
            JOIN customer c
            ON o.customer_id = c.id
            JOIN state s
            ON c.state_id = s.id
            JOIN countries coun
            ON c.country_id = coun.country_id
            JOIN shipping_method ship
            ON o.shipping_method_id = ship.id
            WHERE o.status BETWEEN 0 AND 1
            ORDER BY 1
            ";
    $cmd = $db->getDb()->prepare($sql);
    $cmd->execute(array());
    $orders = $cmd->fetchAll();
   
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
  $objPHPExcel->setActiveSheetIndex(0)
   ->getPageSetup()
    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

  // Add column headers

  $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

  $objPHPExcel->getActiveSheet()
            ->mergeCells('A1:N1')
            ->setCellValue('A1' , 'Sales Tracker ')
            ->getStyle("A1:N1")->applyFromArray($style)->getFont()->setSize(16);

  $objPHPExcel->getActiveSheet() 
            ->mergeCells('A2:N2')
            ->setCellValue('A2' , 'List of Orders')
            ->getStyle("A2:N2")->applyFromArray($style)->getFont()->setSize(16);

  $objPHPExcel->getActiveSheet() 
            ->mergeCells('A3:N3')
            ->setCellValue('A3' , 'As of '.date('Y-m-d'))
            ->getStyle("A3:N3")->applyFromArray($style)->getFont()->setSize(16);
  
  foreach(range('A','N') as $columnID) 
  {
      $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
  }

  $objPHPExcel->getActiveSheet()
        ->setCellValue('A5', 'Invoice Number')
        ->setCellValue('B5', 'Order Date')
        ->setCellValue('C5', 'Customer')
        ->setCellValue('D5', 'Shipping Address')
        ->setCellValue('E5', 'City')
        ->setCellValue('F5', 'Zip')
        ->setCellValue('G5', 'State')
        ->setCellValue('H5', 'Country')
        ->setCellValue('I5', 'Shipping Method')
        ->setCellValue('J5', 'Remarks')
        ->setCellValue('K5', 'Notes')
        ->setCellValue('L5', 'Status')
        ->setCellValue('M5', 'Shipping Fee')
        ->setCellValue('N5', 'Total')      
        ->getStyle("A5:N5")->applyFromArray($style)
        ;

  //Put each record in a new cell
  for($i=0; $i<count($excelData); $i++)
  {
      $ii = $i+6;
      $objPHPExcel->getActiveSheet()->setCellValue('A'.$ii, "INV-".$excelData[$i][0]);
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$ii, date('Y-m-d' , $excelData[$i][1]) );
      $objPHPExcel->getActiveSheet()->setCellValue('C'.$ii, $excelData[$i][2]);
      $objPHPExcel->getActiveSheet()->setCellValue('D'.$ii, $excelData[$i][3]);
      $objPHPExcel->getActiveSheet()->setCellValue('E'.$ii, $excelData[$i][4]);
      $objPHPExcel->getActiveSheet()->setCellValue('F'.$ii, $excelData[$i][5]);
      $objPHPExcel->getActiveSheet()->setCellValue('G'.$ii, $excelData[$i][6]);
      $objPHPExcel->getActiveSheet()->setCellValue('H'.$ii, $excelData[$i][7]);
      $objPHPExcel->getActiveSheet()->setCellValue('I'.$ii, $excelData[$i][8]);
      $objPHPExcel->getActiveSheet()->setCellValue('J'.$ii, $excelData[$i][9]);
      $objPHPExcel->getActiveSheet()->setCellValue('K'.$ii, $excelData[$i][10]);

      if($excelData[$i][11] == 0)
       {
          $objPHPExcel->getActiveSheet()->setCellValue('L'.$ii, "For Approval");
       }
       else
          $objPHPExcel->getActiveSheet()->setCellValue('L'.$ii, "Approved");

      // $objPHPExcel->getActiveSheet()->setCellValue('L'.$ii, $excelData[$i][11]);
      $objPHPExcel->getActiveSheet()->setCellValue('M'.$ii, $excelData[$i][12])
      ->getStyle('M'.$ii)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
      $objPHPExcel->getActiveSheet()->setCellValue('N'.$ii, $excelData[$i][13])
      ->getStyle('N'.$ii)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
     
  }

  $iii = $ii + 3;


  $objPHPExcel->getActiveSheet() 
            ->setCellValue('A'.$iii , 'Prepared By: ');

  $objPHPExcel->getActiveSheet()
            ->setCellValue('B'.$iii , $_SESSION['firstname']." ".$_SESSION['lastname']);
  
  // Set worksheet title
  $objPHPExcel->getActiveSheet()->setTitle($fileName);

  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');


?>