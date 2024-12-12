 <?php  
 
      $link=mysqli_connect("localhost","root","");
      mysqli_select_db($link,"mvogms_db");

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=Daily sales.csv');  

      $output = fopen("php://output", "w");  
      fputcsv($output, array('Product Id', 'Quantity', 'Price', 'Total'));  
      $year = $_GET["date"];;
      $result = mysqli_query($link, "SELECT * from order_items where date_created like '$year%' ");  
      while($row = mysqli_fetch_assoc($result))  
      {  
            $tot = floatval($row["quantity"]*$row["price"]);
            fputcsv($output, array($row["product_id"], $row["quantity"], $row["price"], $tot )); 
      }  
      fclose($output);  
 
 ?>