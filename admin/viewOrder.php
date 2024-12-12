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
$id = $_GET["id"];
$res1= mysqli_query($link,"select total_amount from order_list where id = $id ");
$row1=mysqli_fetch_row($res1);  
$tot= $row1[0];
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
        <style type="text/css">
                        .nav-profile-img {
        position: relative;
        width: 32px;
        height: 32px; }
        .nav-profile-img img {
          width: 32px;
          height: 32px;
          border-radius: 100%; }
              input, button{   
        height: 34px;   
    } 
    .bill {
        margin-left: 1200px; 
        margin-top: -20px;
    }
    @media(max-width: 768px){
        .bill {
        margin-left: 280px; 
        margin-top: -20px;
    }
    }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <?php include("topbar.php"); ?>
        <div id="layoutSidenav">
            <?php include("sidebar.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">View Order #<?php echo $id; ?> </h1>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Product details of order #<?php echo $id; ?>
                                <div class="bill">
                                    <b>Total Bill Amount : <?php echo $tot; ?></b>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM order_items where order_id=$id";     
                                            $rs_result = mysqli_query ($link, $query); 
                                            while($row=mysqli_fetch_array($rs_result))
                                            {
                                            echo "<tr>";

                                            $pid = $row["product_id"];
                                            $res2= mysqli_query($link,"select name from product_list where id = $pid ");
                                            $row2=mysqli_fetch_row($res2);  
                                            $name= $row2[0];

                                            $res3= mysqli_query($link,"select image_path from product_list where id = $pid ");
                                            $row3=mysqli_fetch_row($res3);  
                                            $image= $row3[0];

                                            echo "<td>"; ?>
                                                <div class="nav-profile-img">
                                                    <a href="../<?php echo $image; ?>"><img src="../<?php echo $image; ?>" /></a>
                                                </div>
                                            <?php  echo "</td>";
                                            echo "<td>"; echo $name; echo "</td>";
                                            echo "<td>"; echo $row["quantity"]; echo "</td>";
                                            echo "<td>"; echo $row["price"]; echo "</td>";

                                            $p_total = floatval($row["quantity"]*$row["price"]);

                                            echo "<td>"; echo $p_total; echo "</td>";
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
