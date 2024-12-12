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

$user = $_SESSION["admin"];

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"alimenta_db");

$res1= mysqli_query($link,"select meta_value from system_info where id =1 ");
$row1=mysqli_fetch_row($res1);  
$name= $row1[0];

$res2= mysqli_query($link,"select meta_value from system_info where id =6 ");
$row2=mysqli_fetch_row($res2);  
$sname= $row2[0];
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
                        <h1 class="mt-4">System Information Settings and User Authentication Settings</h1>

                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="name" type="text" name="name" value="<?php echo $name; ?>"/>
                                                        <label for="inputFirstName">System Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="sname" type="text" name="sname" value="<?php echo $sname; ?>"/>
                                                        <label for="inputFirstName">System Short Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"  style="margin-top: 10px;">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="btn btn-primary btn-block" style="background-color: green;" name="update_sys" type="submit" value="Update System Information" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="uname" type="text" name="uname" value="<?php echo $admin_name; ?>"/>
                                                        <label for="inputFirstName">User Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="cpwd" type="password" name="cpwd"/>
                                                        <label for="inputFirstName">Current Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="npwd" type="password" name="npwd"/>
                                                        <label for="inputFirstName">New Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="rpwd" type="password" name="rpwd"/>
                                                        <label for="inputFirstName">Re Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"  style="margin-top: 10px;">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="btn btn-primary btn-block" style="background-color: green;" name="update_password" type="submit" value="Update Password" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
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

        <?php
                        if(isset($_POST["update_sys"]))
                        {

                            if($_POST["name"] == "" || $_POST["sname"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                    alert("Field's Can't be Empty!!!")
                                </script>
                                <?php
                            }
                            else
                            {
                                    mysqli_query($link,"Update system_info set meta_value='$_POST[name]' where id=1 ");
                                    mysqli_query($link,"Update system_info set meta_value='$_POST[sname]' where id=6 ");
                                
                                ?>
                                <script type="text/javascript">
                                    alert("System Information has been updated successfully!!!")
                                    window.location="systemInfo.php";
                                </script>

                                <?php
                            }
                        }

                        if(isset($_POST["update_password"]))
                        {


                            $respwd=mysqli_query($link,"select password from users where id=$user");
                            $rowpwd = mysqli_fetch_row($respwd);
                            $decrypt_pwd = $rowpwd[0];

                            $verify = password_verify($_POST["cpwd"],$decrypt_pwd);

                            if($verify)
                            {
                                if($_POST["npwd"] != $_POST["rpwd"])
                                {
                                    ?>
                                    <script type="text/javascript">
                                        alert("Password not matched. Not able to update the password. Try again!!!");
                                        window.location = "systemInfo.php";
                                    </script>
                                    <?php
                                }
                                else
                                {
                                    $encrypt_pwd = password_hash($_POST["npwd"], PASSWORD_DEFAULT);
                                    $uname = $_POST["uname"];
                                    mysqli_query($link,"Update users set password='$encrypt_pwd', username ='$uname' where id=$user");
                    
                                    ?>
                                    <script type="text/javascript">
                                        alert("Password changed successfully!!!");
                                          window.location = "systemInfo.php";
                                    </script>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <script type="text/javascript">
                                    alert("Invalid Password!!!");
                                    window.location = "systemInfo.php";
                                </script>
                                <?php
                            }
                        }
                        ?>

    </body>
</html>
