
<html>
  <head>
    <title>Verify</title>
    <script src="sweetalert.min.js"></script>
  </head>
      <style type="text/css">
        .swal-modal {
  background-color: #222222;
  border: 3px solid #29d9d5;
}
.swal-title {
  color: #29d9d5;
}
.swal-text {
  color: white;
}
.swal-button {
  margin-top: 1rem;
  display: inline-block;
  padding: 1rem 3rem;
  font-size: 1.7rem;
  color: #29d9d5;
  border: 0.2rem solid #29d9d5;
  border-radius: 5rem;
  cursor: pointer;
  background: none;
}
.swal-button:hover {
  background: #29d9d5;
  color: #222222;
}
    </style>
  <body>

<?php
session_start();
$value = $_GET["value"];
$code = $_SESSION["code"];

if($code == $value)
{
			?>
                <script type="text/javascript">
                    swal({
                        title: "Verified",
                        text: "Thank you. Verification success!!!",
                        icon: "success"
                    }).then(function() {
                        window.location = "./?page=orders/checkout";
                    });
                </script>
            <?php
            unset($_SESSION["code"]);
}
else
{
			?>
                <script type="text/javascript">
                    swal({
                        title: "Checkout Error",
                        text: "Verification Failed. Try Again!!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "./?page=orders/cart";
                    });
                </script>
            <?php
            unset($_SESSION["code"]);
}

?>

  </body>
</html>