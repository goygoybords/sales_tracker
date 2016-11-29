<?php 
    require_once('../class/PHPExcel.php');
    require '../class/database.php';
    require '../class/customer.php';

    session_start();

    $db = new Database();
    $sql = "SELECT o.id , o.order_date, o.date_submitted, CONCAT(c.firstname, ' ', c.lastname) AS 'Fullname', 
            c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description,
            o.remarks, o.notes, o.status, o.total
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
            ORDER BY 2 DESC
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
      ->setCreator("sales tracker")
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
        ->setCellValue('C5', 'Date Processed')
        ->setCellValue('D5', 'Customer')
        ->setCellValue('E5', 'Shipping Address')
        ->setCellValue('F5', 'City')
        ->setCellValue('G5', 'Zip')
        ->setCellValue('H5', 'State')
        ->setCellValue('I5', 'Country')
        ->setCellValue('J5', 'Shipping Method')
        ->setCellValue('K5', 'Remarks')
        ->setCellValue('L5', 'Notes')
        ->setCellValue('M5', 'Status')
        ->setCellValue('N5', 'Total')      
        ->getStyle("A5:N5")->applyFromArray($style)
        ;

  //Put each record in a new cell
    
  for($i=0; $i<count($excelData); $i++)
  {

      $ii = $i+6;
      $objPHPExcel->getActiveSheet()->setCellValue('A'.$ii, "INV-".$excelData[$i][0]);
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$ii, date('Y-m-d' , strtotime($excelData[$i][1])) );
      $objPHPExcel->getActiveSheet()->setCellValue('C'.$ii, date('Y-m-d' , strtotime($excelData[$i][2])) );
      $objPHPExcel->getActiveSheet()->setCellValue('D'.$ii, $excelData[$i][3]);
      $objPHPExcel->getActiveSheet()->setCellValue('E'.$ii, $excelData[$i][4]);
      $objPHPExcel->getActiveSheet()->setCellValue('F'.$ii, $excelData[$i][5]);
      $objPHPExcel->getActiveSheet()->setCellValue('G'.$ii, $excelData[$i][6]);
      $objPHPExcel->getActiveSheet()->setCellValue('H'.$ii, $excelData[$i][7]);
      $objPHPExcel->getActiveSheet()->setCellValue('I'.$ii, $excelData[$i][8]);
      $objPHPExcel->getActiveSheet()->setCellValue('J'.$ii, $excelData[$i][9]);
      $objPHPExcel->getActiveSheet()->setCellValue('K'.$ii, $excelData[$i][10]);
      $objPHPExcel->getActiveSheet()->setCellValue('L'.$ii, $excelData[$i][11]);

      if($excelData[$i][12] == 0)
       {
          $objPHPExcel->getActiveSheet()->setCellValue('M'.$ii, "Pending Order");
       }
       else
          $objPHPExcel->getActiveSheet()->setCellValue('M'.$ii, "Billed Order");

      // $objPHPExcel->getActiveSheet()->setCellValue('L'.$ii, $excelData[$i][11]);
   
      $objPHPExcel->getActiveSheet()->setCellValue('N'.$ii, $excelData[$i][13])
      ->getStyle('N'.$ii)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
     
  }

  // $iii = $ii + 3;
  // $objPHPExcel->getActiveSheet() 
  //           ->setCellValue('A'.$iii , 'Prepared By: ');
  // $objPHPExcel->getActiveSheet()
  //           ->setCellValue('B'.$iii , $_SESSION['firstname']." ".$_SESSION['lastname']);
  
  // Set worksheet title
  $objPHPExcel->getActiveSheet()->setTitle("Admin");


    $newsheet = $objPHPExcel->createSheet();
    $newsheet->setTitle("Agent");

    $newsheet
            ->mergeCells('A1:U1')
            ->setCellValue('A1' , 'Sales Tracker ')
            ->getStyle("A1:U1")->applyFromArray($style)->getFont()->setSize(16);

    $newsheet
            ->mergeCells('A2:U2')
            ->setCellValue('A2' , 'List of Orders')
            ->getStyle("A2:U2")->applyFromArray($style)->getFont()->setSize(16);

    $newsheet
            ->mergeCells('A3:U3')
            ->setCellValue('A3' , 'As of '.date('Y-m-d'))
            ->getStyle("A3:U3")->applyFromArray($style)->getFont()->setSize(16);

    foreach(range('A','U') as $columnID) 
    {
        $newsheet->getColumnDimension($columnID)
        ->setAutoSize(true);
    }

    $newsheet
        ->setCellValue('A5', 'Agent')
        ->setCellValue('B5', 'Screen name')
        ->setCellValue('C5', 'Order Date')
        ->setCellValue('D5', 'Date Processed')
        ->setCellValue('E5', 'Customer')
        ->setCellValue('F5', 'Phone Number')
        ->setCellValue('G5', 'Email Address')
        ->setCellValue('H5', 'Shipping Address')
        ->setCellValue('I5', 'Billing Address')
        ->setCellValue('J5', 'Order')
        ->setCellValue('K5', 'Price')
        ->setCellValue('L5', 'Card Holder Name')
        ->setCellValue('M5', 'Card Number')
        ->setCellValue('N5', 'CVV')  
        ->setCellValue('O5', 'Card Type')   
        ->setCellValue('P5', 'Status')   
        ->setCellValue('Q5', 'Invoice Number') 
        ->setCellValue('R5', 'Remarks') 
        ->setCellValue('S5', 'Tracking Number')      
        ->setCellValue('T5', 'Reshipment Tracking Number')   
        ->setCellValue('U5', 'Shipping')   
        ->setCellValue('V5', 'Merchant')   
        ->getStyle("A5:V5")->applyFromArray($style);

        $sql = "SELECT CONCAT(u.first_name, ' ', u.lastname) AS 'salesman', u.screen_name,
            o.order_date, o.date_submitted,
            CONCAT(c.firstname, ' ',c.lastname) AS 'customer' , c.contact_number, c.email, c.shipping_address, c.billing_address,
            p.product_description, od.amount,
            cp.card_name, cp.card_number, cp.cvv, cp.card_type,
            o.status, o.id, o.remarks, o.tracking_number , s.description, o.merchant
            FROM orders o
            JOIN users u
            ON o.prepared_by = u.id
            JOIN customer c
            ON o.customer_id = c.id
            JOIN order_detail od
            ON o.id = od.order_id
            JOIN products p
            ON od.product_id = p.id 
            JOIN customer_payment_methods cp
            ON o.payment_method_id = cp.id
            JOIN shipping_method s
            ON o.shipping_method_id = s.id
            WHERE o.status BETWEEN 0 AND 1
            ORDER BY 3 DESC";

      $cmd = $db->getDb()->prepare($sql);
      $cmd->execute(array());
      $agent = $cmd->fetchAll();


      for($i=0; $i<count($agent); $i++)
      {
          $ii = $i+6;
          $newsheet->setCellValue('A'.$ii, $agent[$i][0]);
          $newsheet->setCellValue('B'.$ii, $agent[$i][1]);
          $newsheet->setCellValue('C'.$ii, date('Y-m-d', strtotime($agent[$i][2])) );
          $newsheet->setCellValue('D'.$ii, date('Y-m-d', strtotime($agent[$i][3])) );
          $newsheet->setCellValue('E'.$ii, $agent[$i][4]);
          $newsheet->setCellValue('F'.$ii, $agent[$i][5]);
          $newsheet->setCellValue('G'.$ii, $agent[$i][6]);
          $newsheet->setCellValue('H'.$ii, $agent[$i][7]);
          $newsheet->setCellValue('I'.$ii, $agent[$i][8]);
          $newsheet->setCellValue('J'.$ii, $agent[$i][9]);
          
          $newsheet->setCellValue('K'.$ii, $agent[$i][10])
          ->getStyle('K'.$ii)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

          $newsheet->setCellValue('L'.$ii, $agent[$i][11]);
          $newsheet->setCellValue('M'.$ii, $agent[$i][12]);
          $newsheet->setCellValue('N'.$ii, $agent[$i][13]);
          $newsheet->setCellValue('O'.$ii, $agent[$i][14]);
          
           if($agent[$i][15] == 0)
              $newsheet->setCellValue('P'.$ii, "Pending Order");
           else
              $newsheet->setCellValue('P'.$ii, "Billed Order");
         
          
          $newsheet->setCellValue('Q'.$ii, $agent[$i][16]);
          $newsheet->setCellValue('R'.$ii, $agent[$i][17]);
          $newsheet->setCellValue('S'.$ii, $agent[$i][18]);
          $newsheet->setCellValue('T'.$ii, "");
          $newsheet->setCellValue('U'.$ii, $agent[$i][19]);
          $newsheet->setCellValue('V'.$ii, $agent[$i][20]);

         
      }


 $objPHPExcel->setActiveSheetIndex(0);


  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');


?>