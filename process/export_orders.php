<?php 
    require_once('../class/PHPExcel.php');
    require '../class/database.php';
    require '../class/customer.php';
    session_start();
    $db = new Database();
    if (!isset($_GET['min']) && !isset($_GET['max']) && !isset($_GET['agent']) && !isset($_GET['team']))
    {
         $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  od.quantity, p.product_description, o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                  p.product_price AS 'Price/Pill', od.unit_price AS 'Price', ship.price, o.tracking_number, o.status 
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN order_detail od
                 ON o.id = od.order_id
                 JOIN products p 
                 ON p.id = od.product_id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 ORDER BY 1 DESC, 2 DESC   
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array());
    }
    else
    {
        $min =  date('Y-m-d', strtotime($_GET['min']));
        $max =  date('Y-m-d', strtotime($_GET['max']));
      if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['team'] == 0 && $_GET['agent'] == 0)  // search by date
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  od.quantity, p.product_description, o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                  p.product_price AS 'Price/Pill', od.unit_price AS 'Price', ship.price, o.tracking_number, o.status 
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN order_detail od
                 ON o.id = od.order_id
                 JOIN products p 
                 ON p.id = od.product_id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.order_date BETWEEN ? AND ?
                 ORDER BY 1 DESC, 2 DESC   
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($min , $max));
      } 
      else if ($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['team'] != 0 && $_GET['agent'] != 0) //search by all
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  od.quantity, p.product_description, o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                  p.product_price AS 'Price/Pill', od.unit_price AS 'Price', ship.price, o.tracking_number, o.status 
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN order_detail od
                 ON o.id = od.order_id
                 JOIN products p 
                 ON p.id = od.product_id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.order_date BETWEEN ? AND ? AND o.prepared_by = ? AND u.team_id = ? 
                 ORDER BY 1 DESC, 2 DESC   
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($min , $max , $_GET['agent'] , $_GET['team']));
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['team'] == 0 && $_GET['agent'] != 0 ) // search by agent only
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  od.quantity, p.product_description, o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                  p.product_price AS 'Price/Pill', od.unit_price AS 'Price', ship.price, o.tracking_number, o.status 
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN order_detail od
                 ON o.id = od.order_id
                 JOIN products p 
                 ON p.id = od.product_id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.prepared_by = ? 
                 ORDER BY 1 DESC, 2 DESC   
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($_GET['agent']));
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['team'] != 0 && $_GET['agent'] == 0) // search by team only
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  od.quantity, p.product_description, o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                  p.product_price AS 'Price/Pill', od.unit_price AS 'Price', ship.price, o.tracking_number, o.status 
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN order_detail od
                 ON o.id = od.order_id
                 JOIN products p 
                 ON p.id = od.product_id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 where u.team_id = ?
                 ORDER BY 1 DESC, 2 DESC   
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($_GET['agent']));
      }
      else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['team'] == 0 && $_GET['agent'] != 0) //search by date and agent
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  od.quantity, p.product_description, o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                  p.product_price AS 'Price/Pill', od.unit_price AS 'Price', ship.price, o.tracking_number, o.status 
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN order_detail od
                 ON o.id = od.order_id
                 JOIN products p 
                 ON p.id = od.product_id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.order_date BETWEEN ? AND ? AND o.prepared_by = ?  
                 ORDER BY 1 DESC, 2 DESC   
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($min , $max, $_GET['agent']));
      }
      else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['team'] != 0 && $_GET['agent'] == 0) //search by date and team
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  od.quantity, p.product_description, o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                  p.product_price AS 'Price/Pill', od.unit_price AS 'Price', ship.price, o.tracking_number, o.status 
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN order_detail od
                 ON o.id = od.order_id
                 JOIN products p 
                 ON p.id = od.product_id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.order_date BETWEEN ? AND ? AND u.team_id = ?  
                 ORDER BY 1 DESC, 2 DESC   
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($min , $max, $_GET['team']));
      }
    }
    
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
            ->mergeCells('A1:Q1')
            ->setCellValue('A1' , 'Sales Tracker ')
            ->getStyle("A1:Q1")->applyFromArray($style)->getFont()->setSize(16);

  $objPHPExcel->getActiveSheet() 
            ->mergeCells('A2:Q2')
            ->setCellValue('A2' , 'List of Orders')
            ->getStyle("A2:Q2")->applyFromArray($style)->getFont()->setSize(16);

  if(isset($_GET['min']) && isset($_GET['max']))
  {
      $objPHPExcel->getActiveSheet() 
            ->mergeCells('A3:Q3')
            ->setCellValue('A3' , 'From '.date('Y-m-d' , strtotime($_GET['min'])) .' To '. date('Y-m-d' , strtotime($_GET['max'])))
            ->getStyle("A3:Q3")->applyFromArray($style)->getFont()->setSize(16);
  } 
  else
  {
      $objPHPExcel->getActiveSheet() 
            ->mergeCells('A3:Q3')
            ->setCellValue('A3' , 'As of '.date('Y-m-d'))
            ->getStyle("A3:Q3")->applyFromArray($style)->getFont()->setSize(16);
  }         


  
  
  foreach(range('A','Q') as $columnID) 
  {
      $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
  }

  $objPHPExcel->getActiveSheet()
        ->setCellValue('A5', 'Order ID')
        ->setCellValue('B5', 'Date')
        ->setCellValue('C5', 'Name')
        ->setCellValue('D5', 'Quantity')
        ->setCellValue('E5', 'Product Name')
        ->setCellValue('F5', 'Remarks')
        ->setCellValue('G5', 'Shipping Address')
        ->setCellValue('H5', 'City')
        ->setCellValue('I5', 'Zip')
        ->setCellValue('J5', 'State')
        ->setCellValue('K5', 'Country')
        ->setCellValue('L5', 'Shipping Method')
        ->setCellValue('M5', 'Price/Pill')
        ->setCellValue('N5', 'Price')  
        ->setCellValue('O5', 'Shipping')   
        ->setCellValue('P5', 'Tracking Number')   
        ->setCellValue('Q5', 'Remarks')       
        ->getStyle("A5:Q5")->applyFromArray($style)
        ;

  //Put each record in a new cell    
  $ii = 0;
  for($i=0; $i<count($excelData); $i++)
  {
      $ii = $i+6;
      $objPHPExcel->getActiveSheet()->setCellValue('A'.$ii, $excelData[$i][0]);
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$ii, date('Y-m-d' , strtotime($excelData[$i][1])) );
      $objPHPExcel->getActiveSheet()->setCellValue('C'.$ii, $excelData[$i][2]);
      $objPHPExcel->getActiveSheet()->setCellValue('D'.$ii, $excelData[$i][3])->getStyle('D'.$ii)->getNumberFormat()->setFormatCode("0.00");
      $objPHPExcel->getActiveSheet()->setCellValue('E'.$ii, $excelData[$i][4]);
      $objPHPExcel->getActiveSheet()->setCellValue('F'.$ii, $excelData[$i][5]);
      $objPHPExcel->getActiveSheet()->setCellValue('G'.$ii, $excelData[$i][6]);
      $objPHPExcel->getActiveSheet()->setCellValue('H'.$ii, $excelData[$i][7]);
      $objPHPExcel->getActiveSheet()->setCellValue('I'.$ii, $excelData[$i][8]);
      $objPHPExcel->getActiveSheet()->setCellValue('J'.$ii, $excelData[$i][9]);
      $objPHPExcel->getActiveSheet()->setCellValue('K'.$ii, $excelData[$i][10]);
      $objPHPExcel->getActiveSheet()->setCellValue('L'.$ii, $excelData[$i][11]);
      $objPHPExcel->getActiveSheet()->setCellValue('M'.$ii, $excelData[$i][12])->getStyle('M'.$ii)->getNumberFormat()->setFormatCode("0.00");
      $objPHPExcel->getActiveSheet()->setCellValue('N'.$ii, $excelData[$i][13])->getStyle('N'.$ii)->getNumberFormat()->setFormatCode("0.00");
      $objPHPExcel->getActiveSheet()->setCellValue('O'.$ii, $excelData[$i][14])->getStyle('O'.$ii)->getNumberFormat()->setFormatCode("0.00");
      $objPHPExcel->getActiveSheet()->setCellValue('P'.$ii, $excelData[$i][15]);
      $objPHPExcel->getActiveSheet()->setCellValue('Q'.$ii, $excelData[$i][16]);
     
      if($excelData[$i][16] == 0)
        $objPHPExcel->getActiveSheet()->setCellValue('Q'.$ii, "On Hold Order");
      else if($excelData[$i][16] == 1)
        $objPHPExcel->getActiveSheet()->setCellValue('Q'.$ii, "Approved Order");
      else if($excelData[$i][16] == 2)
        $objPHPExcel->getActiveSheet()->setCellValue('Q'.$ii, "Shipped");

      // $objPHPExcel->getActiveSheet()->setCellValue('N'.$ii, $excelData[$i][13])
      //->getStyle('N'.$ii)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
  }

  $iiiv2 = $ii + 1;
  $objPHPExcel->getActiveSheet() 
              ->setCellValue('N'.$iiiv2, "=SUM(N6:N".($ii).")")->getStyle('N'.$iiiv2)->getNumberFormat()->setFormatCode("0.00");
  
  $objPHPExcel->getActiveSheet() 
              ->setCellValue('O'.$iiiv2, "=SUM(O6:O".($ii).")")->getStyle('O'.$iiiv2)->getNumberFormat()->setFormatCode("0.00");
                 


  $iii = $ii + 3;
  $objPHPExcel->getActiveSheet() 
            ->setCellValue('A'.$iii , 'Prepared By: ');
  $objPHPExcel->getActiveSheet()
            ->setCellValue('B'.$iii , $_SESSION['firstname']." ".$_SESSION['lastname']);
  
  // Set worksheet title
   $objPHPExcel->getActiveSheet()->setTitle("Admin");
   $objPHPExcel->setActiveSheetIndex(0);
   header('Content-Type: application/vnd.ms-excel');
   header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
  header('Cache-Control: max-age=0');

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');


?>