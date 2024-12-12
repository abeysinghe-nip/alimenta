<?php
session_start();
if($_SESSION["admin"]=="")
{
?>
<script type="text/javascript">
window.location="index.php";
</script>
<?php
}

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"alimenta_db");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="../uploads/alimenta.jpeg">
        <title>ALIMENTA - ADMIN</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    </head>
    <body class="sb-nav-fixed">
        <?php include("topbar.php"); ?>
        <div id="layoutSidenav">
            <?php include("sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Orders</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Orders
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Delivery Address</th>
                                            <th>Total</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Customer Name</th>
                                            <th>Delivery Address</th>
                                            <th>View</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM order_list where status=1 order by id desc";     
                                            $rs_result = mysqli_query ($link, $query); 
                                            while($row=mysqli_fetch_array($rs_result))
                                            {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["date_created"]; echo "</td>";
                                            echo "<td>"; echo $row["code"]; echo "</td>";

                                            $cus = $row["client_id"];
                                            $res1= mysqli_query($link,"select firstname from client_list where id = $cus ");
                                            $row1=mysqli_fetch_row($res1);  
                                            $fname= $row1[0];

                                            $res2= mysqli_query($link,"select lastname from client_list where id = $cus ");
                                            $row2=mysqli_fetch_row($res2);  
                                            $lname= $row2[0];

                                            $cus_name = $fname." ".$lname;


                                            echo "<td>"; echo $cus_name; echo "</td>";
                                            echo "<td>"; echo $row["delivery_address"]; echo "</td>";
                                            echo "<td>"; echo $row["total_amount"]; echo "</td>";
                                            echo "<td>"; ?> 
                                                <a href="viewOrder.php?id=<?php echo $row['id']; ?>"> <i class="far fa-eye" style="color: green; font-size: 18px;"></i> </a>
                                            <?php echo "</td>";
                                            echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include("footer.php"); ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
