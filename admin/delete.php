
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"alimenta_db");
$id = $_GET["id"];
$name = $_GET["name"];
if($name == "product")
{
	mysqli_query($link,"Update product_list set status=0, delete_flag=1 where id=$id");
	?>
	<script type="text/javascript">
        alert("Product #<?php echo $id; ?> deleted successfully!!!");
        window.location = "product.php";
	</script>
	<?php
}
else if($name == "category")
{
	mysqli_query($link,"Update category_list set status=0, delete_flag=1 where id=$id");
	?>
	<script type="text/javascript">
        alert("Category #<?php echo $id; ?> deleted successfully!!!");
        window.location = "category.php";
	</script>
	<?php
}
else if($name == "user")
{
	mysqli_query($link,"delete from client_list where id=$id");
	?>
	<script type="text/javascript">
        alert("User #<?php echo $id; ?> deleted successfully!!!");
        window.location = "user.php";
	</script>
	<?php
}

?>
</body>
</html>