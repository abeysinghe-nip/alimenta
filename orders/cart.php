<style>
    .prod-img{
        width:calc(100%);
        height:auto;
        max-height: 10em;
        object-fit:scale-down;
        object-position:center center
    }
</style>
<div class="content py-3">
    <div class="card card-outline card-primary rounded-0 shadow-0" style="border-top: 3px solid green;">
        <div class="card-header">
            <h5 class="card-title">Cart List</h5>
        </div>
        <div class="card-body">
            <div id="cart-list">
                <div class="row">
                <?php 
                $gtotal = 0;
                $vendors = $conn->query("SELECT * FROM `vendor_list` where id in (SELECT vendor_id from product_list where id in (SELECT product_id FROM `cart_list` where client_id ='{$_settings->userdata('id')}'))");
                while($vrow=$vendors->fetch_assoc()):                
                ?>
                    <div class="col-12 border">
                        <span>Vendor: <b><?= $vrow['code']?></b></span>
                    </div>
                    <div class="col-12 border p-0">
                        <?php 
                        $vtotal = 0;
                        $products = $conn->query("SELECT c.*, p.name as `name`, p.price,p.image_path FROM `cart_list` c inner join product_list p on c.product_id = p.id where c.client_id = '{$_settings->userdata('id')}' and p.vendor_id = '{$vrow['id']}' order by p.name asc");
                        while($prow = $products->fetch_assoc()):
                            $total = $prow['price'] * $prow['quantity'];
                            $gtotal += $total;
                            $vtotal += $total;
                        ?>
                        <div class="d-flex align-items-center border p-2">
                            <div class="col-2 text-center">
                                <a href="./?page=products/view_product&id=<?= $prow['product_id'] ?>"><img src="<?=$prow['image_path'] ?>" alt="" class="img-center prod-img border bg-gradient-gray"></a>
                            </div>
                            <div class="col-auto flex-shrink-1 flex-grow-1">
                                <h4><b><?= $prow['name'] ?></b></h4>
                                <div class="d-flex">
                                    <div class="col-auto px-0"><small class="text-muted">Price: </small></div>
                                    <div class="col-auto px-0 flex-shrink-1 flex-grow-1"><p class="m-0 pl-3"><small class="text-primary" style="color: green !important"><?= format_num($prow['price']) ?></small></p></div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-auto px-0"><small class="text-muted">Qty: </small></div>
                                    <div class="col-auto">
                                        <div class="" style="width:10em">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend"><button class="btn btn-primary min-qty" style="background-color: green;" data-id="<?= $prow['id'] ?>" type="button"><i class="fa fa-minus"></i></button></div>
                                                <input type="text" value="<?= $prow['quantity'] ?>" class="form-control text-center" readonly="readonly">
                                                <div class="input-group-append"><button class="btn btn-primary plus-qty" style="background-color: green;" data-id="<?= $prow['id'] ?>" type="button"><i class="fa fa-plus"></i></button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto flex-shrink-1 flex-grow-1">
                                        <button class="btn btn-flat btn-outline-danger btn-sm rem_item"  data-id="<?= $prow['id'] ?>"><i class="fa fa-times"></i> Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 text-right"><?= format_num($total) ?></div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="col-12 border">
                        <div class="d-flex">
                            <div class="col-9 text-right font-weight-bold text-muted">Total</div>
                            <div class="col-3 text-right font-weight-bold"><?= format_num($vtotal) ?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
                    <div class="col-12 border">
                        <div class="d-flex">
                            <div class="col-9 h4 font-weight-bold text-right text-muted">Grand Total</div>
                            <div class="col-3 h4 font-weight-bold text-right"><?= format_num($gtotal) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-outline card-primary rounded-0 shadow-0" style="border-top: 3px solid green;">
        <div class="card-header">
            <h5 class="card-title">Card Details for Payment</h5>
        </div>
        <div class="card-body">
        <div class="row">
                <div class="col-md-12">
                    <form action="" id="checkout-form" method="POST">
                        <div class="row">
                        <div class="form-group col-md-12">
                            <label for="" class="control-label">Name on Card</label>
                            <input type="text" name="name" class="form-control rounded-0">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="" class="control-label">Card number</label>
                            <input type="text" name="card" class="form-control rounded-0" onkeypress="return validation(event)" maxlength="16">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Expiry Date(mm/yy)</label>
                            <input type="text" name="exp" class="form-control rounded-0" maxlength="5">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">CVV</label>
                            <input type="text" name="cvv" class="form-control rounded-0" onkeypress="return validation(event)" maxlength="3">
                        </div>
                        </div>

                        <div class="text-right">
                            <input type="submit" class="btn btn-flat btn-primary btn-sm" value="Checkout" name="checkout" style="background-color: green;">
                        </div>
                    </form>
                    <script type="text/javascript">
                                        function validation(evt) {
          
                                            var ASCII = (evt.which) ? evt.which : evt.keyCode
                                            if (ASCII > 31 && (ASCII < 48 || ASCII > 57) )
                                                return false;
                                            return true;
                                        }
                                    </script>
                </div>
            </div>
        </div>
    </div>
            <?php
                if(isset($_POST["checkout"]))
                {
                    if($_POST["name"] == "" || $_POST["card"] == "" || $_POST["exp"] == "" || $_POST["cvv"] == "")
                    {
                        ?>
                        <script type="text/javascript">
                            alert("Fields are empty!!!");
                        </script>
                        <?php 
                    }
                    else
                    {
                        ?>
                        <script type="text/javascript">
                            window.location="mailcode.php";
                        </script>
                        <?php 
                    }
                } 
            ?>
    
</div>
<script>
    $(function(){
        $('.plus-qty').click(function(){
            var group = $(this).closest('.input-group')
            var qty = parseFloat(group.find('input').val()) + 1;
            group.find('input').val(qty)
            var cart_id = $(this).attr('data-id')
            var el = $('<div>')
            el.addClass('alert alert-danger')
            el.hide()
            start_loader()
            $.ajax({
                url:_base_url_+'classes/Master.php?f=update_cart_qty',
                method:'POST',
                data:{cart_id:cart_id,quantity:qty},
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
            
        })
        $('.min-qty').click(function(){
            var group = $(this).closest('.input-group')
            if(parseFloat(group.find('input').val()) == 1){
                return false;
            }
            var qty = parseFloat(group.find('input').val()) - 1;
            group.find('input').val(qty)
            var cart_id = $(this).attr('data-id')
            var el = $('<div>')
            el.addClass('alert alert-danger')
            el.hide()
            start_loader()
            $.ajax({
                url:_base_url_+'classes/Master.php?f=update_cart_qty',
                method:'POST',
                data:{cart_id:cart_id,quantity:qty},
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
            
        })
        $('.rem_item').click(function(){
        _conf("Are you sure delete this item from cart list?",'delete_cart',[$(this).attr('data-id')])
        })
    })
    function delete_cart($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_cart",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>