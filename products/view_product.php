<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT  p.*,  c.name as `category` FROM `product_list` p inner join category_list c on p.category_id = c.id where p.delete_flag = 0 and p.id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
        echo "<script> alert('Unkown Product ID.'); location.replace('./?page=products') </script>";
        exit;
    }
}else{
    echo "<script> alert('Product ID is required.'); location.replace('./?page=products') </script>";
    exit;
}

if(isset($_POST["submit_feedback"]))
{

    if($_POST["feedback"] == "")
    {
        ?>
        <script type="text/javascript">
            alert("Field's Can't be Empty!!!")
            window.location = "./?page=products/view_product&id=<?php echo $_GET['id']; ?>";
        </script>
        <?php
    }
    else
    {
        $link=mysqli_connect("localhost","root","");
        mysqli_select_db($link,"mvogms_db");
        $user = $_settings->userdata('id'); 
        mysqli_query($link,"insert into feedback values('','$user','$_GET[id]','$_POST[feedback]')");

        ?>
        <script type="text/javascript">
            alert("Feedback added successfully!!!");
            window.location = "./?page=products/view_product&id=<?php echo $_GET['id']; ?>";
        </script>
        <?php                           
    }
                        
}


?>
<style>
    #prod-img-holder {
        height: 45vh !important;
        width: calc(100%);
        overflow: hidden;
    }

    #prod-img {
        object-fit: scale-down;
        height: calc(100%);
        width: calc(100%);
        transition: transform .3s ease-in;
    }
    #prod-img-holder:hover #prod-img{
        transform:scale(1.2);
    }
</style>
<div class="content py-3">
    <div class="card card-outline card-primary rounded-0 shadow" style="border-top: 3px solid green;">
        <div class="card-header">
            <h5 class="card-title"><b>Product Details</b></h5>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div id="msg"></div>
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12 text-center">
                        <div class="position-relative overflow-hidden" id="prod-img-holder">
                            <img src="<?=isset($image_path) ? $image_path : "" ?>" alt="<?= $row['name'] ?>" id="prod-img" class="img-thumbnail bg-white">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <h3 style="color: #2e466f; font-weight:bold; text-transform:uppercase;"><?= $name ?></h3>
                        <div class="d-flex w-100">
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Category : </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0"><small class="text-muted"><?= $category ?></small></p></div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">LKR </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0 pl-3" style="color: #9be8d3; font-weight:bold; font-size:15px;"><?= format_num($price) ?></p></div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-3 form-group">
                                <input type="number" min = "1" id= 'qty' value="1" class="form-control rounded-0 text-center">
                            </div>
                            <div class="col-md-3 form-group">
                                <button class="btn btn-primary btn-flat" type="button" id="add_to_cart" style="background-color: green;"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                            </div>
                        </div>
                        <div class="w-100" style="color: #9be8d3; font-weight:bold; font-size:15px;"><?= html_entity_decode($description) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $user = $_settings->userdata('id'); 
    if($user != null)
    {
    ?>
    <div class="card card-outline card-primary rounded-0 shadow" style="border-top: 3px solid green;">
        <div class="card-header">
            <h5 class="card-title"><b>Provide a Feedback</b></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="" id="checkout-form" method="POST">
                        <div class="row">
                        <div class="form-group col-md-12">
                            <label for="" class="control-label">Feedback</label>
                            <textarea name="feedback" class="form-control rounded-0" placeholder="Max 1000 characters"></textarea>
                        </div>
                        </div>

                        <div class="text-right">
                            <input type="submit" class="btn btn-flat btn-primary btn-sm" value="Submit" name="submit_feedback" style="background-color: green;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
</div>
<script>
    function add_to_cart(){
        var pid = '<?= isset($id) ? $id : '' ?>';
        var qty = $('#qty').val();
        var el = $('<div>')
        el.addClass('alert alert-danger')
        el.hide()
        $('#msg').html('')
        start_loader()
        $.ajax({
            url:_base_url_+'classes/Master.php?f=add_to_cart',
            method:'POST',
            data:{product_id:pid,quantity:qty},
            dataType:'json',
            error:err=>{
                console.error(err)
                alert_toast('An error occurred.','error')
                end_loader()
            },
            success:function(resp){
                if(resp.status =='success'){
                    location.reload()
                }else if(!!resp.msg){
                    el.text(resp.msg)
                    $('#msg').append(el)
                    el.show('slow')
                    $('html, body').scrollTop(0)
                }else{
                    el.text("An error occurred. Please try to refresh this page.")
                    $('#msg').append(el)
                    el.show('slow')
                    $('html, body').scrollTop(0)
                }
                end_loader()
            }
        })
    }
    $(function(){
        $('#add_to_cart').click(function(){
            if('<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3 ?>'){
                add_to_cart();
            }else{
                location.href = "./login.php"
            }
        })
    })
</script>