<?php
session_start();
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
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary" style="background-color: green !important">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="Username" name="uname" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="pwd" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input class="btn btn-primary" type="submit" value="Login" name="login" style="background-color: green;" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <?php include("footer.php"); ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <?php
   
  if(isset($_POST["login"]))
  { 
    
      $res=mysqli_query($link,"select * from users");
        $count = 0;
        while($row=mysqli_fetch_array($res))
        {
          $u = strcmp($row["username"], $_POST["uname"]);
          $verify = password_verify($_POST["pwd"],$row["password"]);

          if($u == 0)
          {
            if($verify)
            {
              $_SESSION["admin"]=$row["id"];
              $count++;
              ?>
                  <script type="text/javascript">
                    window.location="product.php";
                  </script>
                  <?php
            }
            
          }
        }

          $u = strcmp("", $_POST["uname"]);
          $p = strcmp("", $_POST["pwd"]);
        if($count == 0 && $u != 0 && $p != 0)
        {
            ?>
                <script type="text/javascript">
                  alert("Invalid Login!!!");
                  window.location = "index.php";
                </script>
                <?php
        }
        if($u == 0 || $p == 0)
        {
            ?>
                <script type="text/javascript">
                  alert("Fields Can't be empty!!!");
                  window.location = "index.php";
                </script>
                <?php
        }

  }
  ?>

    </body>
</html>
