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

if(isset($_POST["add_category"]))
{

    if($_POST["name"] == "" || $_POST["des"] == "")
    {
        ?>
        <script type="text/javascript">
            alert("Field's Can't be Empty!!!")
        </script>
        <?php
        header("refresh:0.1;url=category.php");
    }
    else
    {

        date_default_timezone_set("Asia/Colombo");
        $tdy = date("Y-m-d h:i:s");
     
        mysqli_query($link,"insert into category_list values('','1','$_POST[name]','$_POST[des]','1','0','$tdy','$tdy')");

        ?>
        <script type="text/javascript">
            alert("Category added successfully!!!");
        </script>
        <?php
        header("refresh:0.1;url=category.php");
                                
    }
                        
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
          .open-button {
  background-color: green;
  color: white;
  border: none;
  cursor: pointer;
  width: 150px;
  height: 40px;
  border-radius: 5%;
  margin-left: 900px;
}
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 400px;
  right: 150px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password], .form-container textarea, .form-container select, .form-container input[type=file] {
  width: 100%;
  padding: 10px;
  margin: 5px 0 12px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}


/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: black;
  border-color: transparent;
  margin-top: 10px;
  width: 45%
}
    @media(max-width: 768px){
          .open-button {
  margin-left: 100px;
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
                        <h1 class="mt-4">Categories</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Categories
                                <button class="open-button" onclick="openForm()">+Add Categories</button>
                                <script>
                                    function openForm() {
                                        document.getElementById("myForm").style.display = "block";
                                    }
        
                                    function closeForm() {
                                        document.getElementById("myForm").style.display = "none";
                                    }
                                </script>
                            </div>
                            <div class="form-popup" id="myForm">
  <form method="POST" class="form-container" enctype="multipart/form-data">
    <h1></h1>

    <label for="name"><b>Category Name</b></label>
    <input type="text" name="name">

    <label for="des"><b>Category Description</b></label>
    <textarea name="des"></textarea>

    <input type="submit" name="add_category" value="ADD" class="btn" style="border-color: transparent; width: 45%; font-weight: bold; cursor:pointer; background-color: green; margin-top: 10px; color: white;">
    <button type="button" class="btn cancel" onclick="closeForm()" style="color: white;">Close</button>
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
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Created Date</th>
                                            <th>Updated date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Created Date</th>
                                            <th>Updated date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM category_list where status=1 and delete_flag=0 order by id desc";     
                                            $rs_result = mysqli_query ($link, $query); 
                                            while($row=mysqli_fetch_array($rs_result))
                                            {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["name"]; echo "</td>";
                                            echo "<td>"; echo $row["description"]; echo "</td>";
                                            echo "<td>"; echo $row["date_created"]; echo "</td>";
                                            echo "<td>"; echo $row["date_updated"]; echo "</td>";
                                            echo "<td>"; ?> 
                                                <a href="editCat.php?id=<?php echo $row['id']; ?>"> <i class="far fa-edit" style="color: green; font-size: 18px;"></i> </a>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>&name=category"> <i class="far fa-trash-alt" style="color: red; font-size: 18px;"></i> </a> 
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
