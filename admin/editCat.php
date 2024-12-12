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
$res= mysqli_query($link,"select * from category_list where id=$id");
while($row=mysqli_fetch_array($res))
{
    $c_name= $row["name"];
    $des= $row["description"]; 
}
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
                        <h1 class="mt-4">Category #<?php echo $id; ?></h1>

                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="row mb-3">
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="name" type="text" name="name" value="<?php echo $c_name; ?>"/>
                                                        <label for="inputFirstName">Category Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <textarea class="form-control" name="des" rows="4" ><?php echo $des; ?></textarea>
                                                        <label for="inputFirstName">Description</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6"  style="margin-top: -20px;">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="btn btn-primary btn-block" style="background-color: green;" name="update_category" type="submit" value="Update Category" />
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                    </div>

<script type="text/javascript">
    <script type="text/javascript">
    function validation(evt) {
          
        var ASCII = (evt.which) ? evt.which : evt.keyCode
        if (ASCII > 31 && (ASCII < 48 || ASCII > 57) )
            return false;
        return true;
    }
</script>
</script>

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

        <?php
                        if(isset($_POST["update_category"]))
                        {
                            date_default_timezone_set("Asia/Colombo");
                            $tdy = date("Y-m-d h:i:s");

                            if($_POST["name"] == "" || $_POST["des"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                    alert("Field's Can't be Empty!!!")
                                </script>
                                <?php
                            }
                            else
                            {
                                    mysqli_query($link,"Update category_list set name='$_POST[name]', description='$_POST[des]', date_updated='$tdy' where id=$id");
                                
                                ?>
                                <script type="text/javascript">
                                    alert("Category has been updated successfully!!!")
                                    window.location="category.php";
                                </script>

                                <?php
                            }
                        }
                        ?>

    </body>
</html>
