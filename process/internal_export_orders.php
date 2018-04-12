<?php 
    require_once('../class/PHPExcel.php');
    require '../class/database.php';
    require '../class/customer.php';
    session_start();
    $db = new Database();
    if (!isset($_GET['min']) && !isset($_GET['max']) && !isset($_GET['agent']) && !isset($_GET['team']) && !isset($_GET['status']) && !isset($_GET['groups']))
    {
         if($_SESSION['user_type'] == 4 || $_SESSION['user_type'] == 5 )
         {
            $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   WHERE u.team_id = ?
                   ORDER BY 1
              ";
              $cmd = $db->getDb()->prepare($sql);
              $cmd->execute(array($_SESSION['team_id'])); 
         }
         else
         {
           $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   ORDER BY 1
              ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array());  
        }
            
    }
    else
    {
        $min =  date('Y-m-d', strtotime($_GET['min']));
        $max =  date('Y-m-d', strtotime($_GET['max']));
      if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['team'] == 0 && $_GET['agent'] == 0 && $_GET['status'] == 0 && $_GET['groups'] == 0)  // search by date
      {
         if($_SESSION['user_type'] == 4 || $_SESSION['user_type'] == 5 )
         {
            $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   WHERE u.team_id = ? AND o.order_date BETWEEN ? AND ?
                   ORDER BY 1   
              ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($_SESSION['team_id'], $min , $max));
         }
         else
         {
            $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   
                   WHERE o.order_date BETWEEN ? AND ?
                   ORDER BY 1   
              ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($min , $max));
        }
      } 
      else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['agent'] == 0 && $_GET['team'] == 0 && $_GET['status'] != 0 && $_GET['groups'] == 0) //search by date and status
      {
         if($_SESSION['user_type'] == 4 || $_SESSION['user_type'] == 5 )
         {
            $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                      o.notes, 
                      c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                       ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                     FROM orders o
                     JOIN customer c
                     ON o.customer_id = c.id
                     JOIN state s
                     ON c.state_id = s.id
                     JOIN countries coun
                     ON c.country_id = coun.country_id
                     JOIN shipping_method ship
                     ON o.shipping_method_id = ship.id
                     JOIN users u 
                     ON u.id = o.prepared_by
                     WHERE u.team_id = ? AND o.order_date BETWEEN ? AND ? AND o.status = ?
                     ORDER BY 1   
                ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($_SESSION['team_id'], $min , $max, $_GET['status']));
         }
         else 
         {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   WHERE o.order_date BETWEEN ? AND ? AND o.status = ?
                   ORDER BY 1   
              ";
          $cmd = $db->getDb()->prepare($sql);
          $cmd->execute(array($min , $max, $_GET['status']));
         }
      }
      else if ($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['team'] != 0 && $_GET['agent'] != 0 && $_GET['status'] != 0 && $_GET['groups'] == 0) //search by all
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                   ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.order_date BETWEEN ? AND ? AND o.prepared_by = ? AND u.team_id = ? AND o.status = ?
                 ORDER BY 1  
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($min , $max , $_GET['agent'] , $_GET['team'] , $_GET['status']));
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['team'] == 0 && $_GET['agent'] != 0  && $_GET['status'] == 0 && $_GET['groups'] == 0) // search by agent only
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                   ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.prepared_by = ? 
                 ORDER BY 1 
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($_GET['agent']));
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['team'] != 0 && $_GET['agent'] == 0 && $_GET['status'] == 0 && $_GET['groups'] == 0) // search by team only
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                   ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 where u.team_id = ?
                 ORDER BY 1  
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($_GET['team']));
      }
      else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['team'] == 0 && $_GET['agent'] != 0 && $_GET['status'] == 0 && $_GET['groups'] == 0 ) //search by date and agent
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                   ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.order_date BETWEEN ? AND ? AND o.prepared_by = ?  
                 ORDER BY 1
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($min , $max, $_GET['agent']));
      }
      else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['team'] != 0 && $_GET['agent'] == 0 && $_GET['status'] == 0 && $_GET['groups'] == 0) //search by date and team
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                  o.notes, 
                  c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                   ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                 FROM orders o
                 JOIN customer c
                 ON o.customer_id = c.id
                 JOIN state s
                 ON c.state_id = s.id
                 JOIN countries coun
                 ON c.country_id = coun.country_id
                 JOIN shipping_method ship
                 ON o.shipping_method_id = ship.id
                 JOIN users u 
                 ON u.id = o.prepared_by
                 WHERE o.order_date BETWEEN ? AND ? AND u.team_id = ?  
                 ORDER BY 1
            ";
        $cmd = $db->getDb()->prepare($sql);
        $cmd->execute(array($min , $max, $_GET['team']));
      }
     else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['agent'] == 0 && $_GET['team'] != 0 && $_GET['status'] != 0 && $_GET['groups'] == 0) //search by date status and team
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   WHERE o.order_date BETWEEN ? AND ? AND u.team_id = ? AND o.status = ?
                   ORDER BY 1
              ";
          $cmd = $db->getDb()->prepare($sql);
          $cmd->execute(array($min , $max, $_GET['team'] , $_GET['status'] ));
      }
      else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['agent'] != 0 && $_GET['team'] == 0 && $_GET['status'] != 0 && $_GET['groups'] == 0) //search by date status and agent
      {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   WHERE o.order_date BETWEEN ? AND ? AND o.prepared_by = ? AND o.status = ?
                   ORDER BY 1
              ";
          $cmd = $db->getDb()->prepare($sql);
          $cmd->execute(array($min , $max, $_GET['agent'] , $_GET['status'] ));
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['agent'] != 0 && $_GET['team'] == 0 && $_GET['status'] != 0 && $_GET['groups'] == 0) //search by status and agent
      {
        $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   WHERE o.prepared_by = ? AND o.status = ?
                   ORDER BY 1
              ";
          $cmd = $db->getDb()->prepare($sql);
          $cmd->execute(array($_GET['agent'] , $_GET['status'] ));
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['agent'] == 0 && $_GET['team'] != 0 && $_GET['status'] != 0 && $_GET['groups'] == 0) //search by status and team
      {
        $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   WHERE u.team_id = ? AND o.status = ?
                   ORDER BY 1
              ";
          $cmd = $db->getDb()->prepare($sql);
          $cmd->execute(array($_GET['team'] , $_GET['status'] ));
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['agent'] != 0 && $_GET['team'] != 0 && $_GET['status'] != 0 && $_GET['groups'] == 0) //search by status agent and team
      {
        $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total, o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   WHERE u.team_id = ? AND o.prepared_by = ? AND o.status = ?
                   ORDER BY 1
              ";
          $cmd = $db->getDb()->prepare($sql);
          $cmd->execute(array($_GET['team'] , $_GET['agent'] , $_GET['status'] ));
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['agent'] == 0 && $_GET['team'] == 0 && $_GET['status'] != 0 && $_GET['groups'] == 0) //search by status only
      {
        if($_SESSION['user_type'] == 4 || $_SESSION['user_type'] == 5 )
         {
            $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                      o.notes, 
                      c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                       ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                     FROM orders o
                     JOIN customer c
                     ON o.customer_id = c.id
                     JOIN state s
                     ON c.state_id = s.id
                     JOIN countries coun
                     ON c.country_id = coun.country_id
                     JOIN shipping_method ship
                     ON o.shipping_method_id = ship.id
                     JOIN users u 
                     ON u.id = o.prepared_by
                     WHERE u.team_id = ? AND o.status = ?
                     ORDER BY 1
                ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($_SESSION['team_id'], $_GET['status'] ));
         }
         else 
         {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                      o.notes, 
                      c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                       ship.price, o.tracking_number, o.status , o.total , o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                     FROM orders o
                     JOIN customer c
                     ON o.customer_id = c.id
                     JOIN state s
                     ON c.state_id = s.id
                     JOIN countries coun
                     ON c.country_id = coun.country_id
                     JOIN shipping_method ship
                     ON o.shipping_method_id = ship.id
                     JOIN users u 
                     ON u.id = o.prepared_by
                     WHERE o.status = ?
                     ORDER BY 1
                ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($_GET['status'] ));
        }
      }
      else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['agent'] == 0 && $_GET['team'] == 0 && $_GET['status'] == 0 && $_GET['groups'] != 0) //search by group only
        {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total, o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   JOIN teams tm
                   ON u.team_id = tm.id
                   JOIN groupings g 
                   ON g.id = tm.group_id
                   WHERE g.id = ?
                   ORDER BY 1
                ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($_GET['groups'] ));
        }
        else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['agent'] == 0 && $_GET['team'] == 0 && $_GET['status'] == 0 && $_GET['groups'] != 0) //search by date and group 
        {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total, o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   JOIN teams tm
                   ON u.team_id = tm.id
                   JOIN groupings g 
                   ON g.id = tm.group_id
                   WHERE o.order_date BETWEEN ? AND ? AND g.id = ? 
                   ORDER BY 1
                ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($min , $max, $_GET['groups'] ));
        }
        else if($_GET['min'] != 0 && $_GET['max'] != 0 && $_GET['agent'] == 0 && $_GET['team'] == 0 && $_GET['status'] != 0 && $_GET['groups'] != 0) //search by date status and group 
        {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total, o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   JOIN teams tm
                   ON u.team_id = tm.id
                   JOIN groupings g 
                   ON g.id = tm.group_id
                   WHERE o.order_date BETWEEN ? AND ? AND g.id = ? AND o.status = ? 
                   ORDER BY 1
                ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($min , $max, $_GET['groups'] , $_GET['status'] ));
        }
        else if($_GET['min'] == 0 && $_GET['max'] == 0 && $_GET['agent'] == 0 && $_GET['team'] == 0 && $_GET['status'] != 0 && $_GET['groups'] != 0) //search by status and group 
        {
          $sql = "SELECT  o.invoice_number , o.order_date, CONCAT(c.firstname, ' ', c.lastname) AS 'CustomerName', 
                    o.notes, 
                    c.shipping_address, c.city,  c.zip, s.code, coun.country_code, ship.description AS 'Shipping Method',
                     ship.price, o.tracking_number, o.status , o.total, o.id, CONCAT(u.first_name, ' ', u.lastname) AS 'prepared_by', o.merchant
                   FROM orders o
                   JOIN customer c
                   ON o.customer_id = c.id
                   JOIN state s
                   ON c.state_id = s.id
                   JOIN countries coun
                   ON c.country_id = coun.country_id
                   JOIN shipping_method ship
                   ON o.shipping_method_id = ship.id
                   JOIN users u 
                   ON u.id = o.prepared_by
                   JOIN teams tm
                   ON u.team_id = tm.id
                   JOIN groupings g 
                   ON g.id = tm.group_id
                   WHERE g.id = ? AND o.status = ?
                   ORDER BY 1
                ";
            $cmd = $db->getDb()->prepare($sql);
            $cmd->execute(array($_GET['groups'] , $_GET['status'] ));
        }
    }
    
    $orders  = $cmd->fetchAll();
    
    $fileName = 'internal_report'.date('Y-m-d');
    //prepare the records to be added on the excel file in an array
    $excelData = array_unique($orders, SORT_REGULAR);
   
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()
        ->setCreator("sales tracker")
        ->setTitle("Internal Report")
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
            ->mergeCells('A1:E1')
            ->setCellValue('A1' , 'Internal Report ')
            ->getStyle("A1:E1")->applyFromArray($style)->getFont()->setSize(16);
  $objPHPExcel->getActiveSheet() 
            ->mergeCells('A2:E2')
            ->setCellValue('A2' , 'List of Orders')
            ->getStyle("A2:E2")->applyFromArray($style)->getFont()->setSize(16);
  if(isset($_GET['min']) != null && $_GET['max'] != null)
  {
      $objPHPExcel->getActiveSheet() 
            ->mergeCells('A3:E3')
            ->setCellValue('A3' , 'From '.date('Y-m-d' , strtotime($_GET['min'])) .' To '. date('Y-m-d' , strtotime($_GET['max'])))
            ->getStyle("A3:E3")->applyFromArray($style)->getFont()->setSize(16);
  } 
  else 
  {
      $objPHPExcel->getActiveSheet() 
            ->mergeCells('A3:E3')
            ->setCellValue('A3' , 'As of '.date('Y-m-d'))
            ->getStyle("A3:E3")->applyFromArray($style)->getFont()->setSize(16);
  }         
  foreach(range('A','E') as $columnID) 
  {
      $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
  }
  $objPHPExcel->getActiveSheet()
        ->setCellValue('A5', 'Agent')
        ->setCellValue('B5', 'Date Process')
        ->setCellValue('C5', 'Customer Name')
        ->setCellValue('D5', 'Total')
        ->setCellValue('E5', 'Merchant Name')
        //->setCellValue('F5', 'Merchant Name')
        // ->setCellValue('G5', 'Shipping Address')
        // ->setCellValue('H5', 'City')
        // ->setCellValue('I5', 'Zip')
        // ->setCellValue('J5', 'State')
        // ->setCellValue('K5', 'Country')
        // ->setCellValue('L5', 'Shipping Method')
        // ->setCellValue('M5', 'Price/Pill')
        // ->setCellValue('N5', 'Price')  
        // ->setCellValue('O5', 'Shipping')   
        // ->setCellValue('P5', 'Tracking Number')   
        // ->setCellValue('Q5', 'Remarks')       
        ->getStyle("A5:Q5")->applyFromArray($style)
        ;
  if(count($excelData) > 0 )
  {
    //Put each record in a new cell    
    $ii = 6;
    $total = 0;
    foreach ($excelData as $d ) 
    {
       $total = $total + $d['total'];
       $objPHPExcel->getActiveSheet()->setCellValue('A'.$ii, $d['prepared_by']);
       $objPHPExcel->getActiveSheet()->setCellValue('B'.$ii, date('Y-m-d' , strtotime($d['order_date'])) );
       $objPHPExcel->getActiveSheet()->setCellValue('C'.$ii, $d['CustomerName']);
       $objPHPExcel->getActiveSheet()->setCellValue('D'.$ii, $d['total'])->getStyle('D'.$ii)->getNumberFormat()->setFormatCode("0.00");
       $objPHPExcel->getActiveSheet()->setCellValue('E'.$ii, $d['merchant'])->getStyle('E'.$ii)->getNumberFormat()->setFormatCode("0.00");
       // $objPHPExcel->getActiveSheet()->setCellValue('F'.$ii, $d['notes']);
       //  $objPHPExcel->getActiveSheet()->setCellValue('G'.$ii, $d['shipping_address']);
       //  $objPHPExcel->getActiveSheet()->setCellValue('H'.$ii, $d['city']);
       //  $objPHPExcel->getActiveSheet()->setCellValue('I'.$ii, $d['zip']);
       //  $objPHPExcel->getActiveSheet()->setCellValue('J'.$ii, $d['code']);
       //  $objPHPExcel->getActiveSheet()->setCellValue('K'.$ii, $d['country_code']);
       //  $objPHPExcel->getActiveSheet()->setCellValue('L'.$ii, $d['Shipping Method']);
       //  $objPHPExcel->getActiveSheet()->setCellValue('O'.$ii, $d['price'])->getStyle('O'.$ii)->getNumberFormat()->setFormatCode("0.00");
       //  $objPHPExcel->getActiveSheet()->setCellValue('P'.$ii, $d['tracking_number']);

    //     if($d['status'] == 1)
    //       $objPHPExcel->getActiveSheet()->setCellValue('Q'.$ii, "On Hold Order");
    //     else if($d['status'] == 2)
    //       $objPHPExcel->getActiveSheet()->setCellValue('Q'.$ii, "Approved Order");
    //     else if($d['status'] == 3)
    //       $objPHPExcel->getActiveSheet()->setCellValue('Q'.$ii, "Shipped");

    //     $sql2 = "SELECT o.invoice_number, od.quantity, p.product_description, 
    //             p.product_price AS 'Price/Pill', od.unit_price AS 'Price'
    //             FROM orders o
    //             JOIN order_detail od
    //             ON o.id = od.order_id
    //             JOIN products p 
    //             ON p.id = od.product_id
    //             WHERE o.id = ?
    //             ";
    //     $cmd2= $db->getDb()->prepare($sql2);
    //     $cmd2->execute(array($d['id']));  
    //     $orders2 = $cmd2->fetchAll();
    
    //    foreach ($orders2 as $d2 ) 
    //    {
    //       $objPHPExcel->getActiveSheet()->setCellValue('D'.$ii, $d2['quantity'])->getStyle('D'.$ii)->getNumberFormat()->setFormatCode("0.00");
    //       $objPHPExcel->getActiveSheet()->setCellValue('E'.$ii, $d2['product_description'] );
    //       $objPHPExcel->getActiveSheet()->setCellValue('M'.$ii, $d2['Price/Pill'])->getStyle('M'.$ii)->getNumberFormat()->setFormatCode("0.00");
    //       $objPHPExcel->getActiveSheet()->setCellValue('N'.$ii, $d2['Price'])->getStyle('N'.$ii)->getNumberFormat()->setFormatCode("0.00");
    //        $ii++;  
    //     }
       $ii++;  
    }
    // $iiiv2 = $ii + 1;
    // $objPHPExcel->getActiveSheet() 
    //             ->setCellValue('N'.$iiiv2, "=SUM(N6:N".($ii).")")->getStyle('N'.$iiiv2)->getNumberFormat()->setFormatCode("0.00");
    
    // $objPHPExcel->getActiveSheet() 
    //             ->setCellValue('O'.$iiiv2, "=SUM(O6:O".($ii).")")->getStyle('O'.$iiiv2)->getNumberFormat()->setFormatCode("0.00");
                   
    $iii = $ii + 3;
    $objPHPExcel->getActiveSheet() 
              ->setCellValue('A'.$iii , 'Prepared By: ');
    $objPHPExcel->getActiveSheet()
              ->setCellValue('B'.$iii , $_SESSION['firstname']." ".$_SESSION['lastname']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$iii , 'Total Sales: ');
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$iii, $total)
        ->getStyle('D'.$iii)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
  }
  // Set worksheet title
    $objPHPExcel->getActiveSheet()->setTitle("Internal Report");
    $objPHPExcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
?>