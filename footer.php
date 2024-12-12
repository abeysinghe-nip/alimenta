<section class="footer">

    <div class="box-container">


        <div class="box">
            <h3>quick links</h3>
            <a href="./" class="links" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='lightgray'"> <i class="fas fa-arrow-right" style="color: #27725f;"></i> Home </a>
            <a href="./?page=products" class="links" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='lightgray'"> <i class="fas fa-arrow-right" style="color: #27725f;"></i> Shop </a>
            <a href="./?page=about" class="links" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='lightgray'"> <i class="fas fa-arrow-right" style="color: #27725f;"></i> About Us </a>

            <?php if(!($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3)): ?>
            <a href="./login.php" class="links" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='lightgray'"> <i class="fas fa-arrow-right" style="color: #27725f;"></i> Client Login </a>
            <a href="./admin" class="links" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='lightgray'"> <i class="fas fa-arrow-right" style="color: #27725f;"></i> Admin Login </a>
            <?php endif; ?>
            
            <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3): ?>
            <a href="./?page=orders/my_orders" class="links" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='lightgray'"> <i class="fas fa-arrow-right" style="color: #27725f;"></i> My Orders </a>
            <a href="./?page=manage_account" class="links" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='lightgray'"> <i class="fas fa-arrow-right" style="color: #27725f;"></i> My Profile </a>
            <a href="<?= base_url.'classes/Login.php?f=logout_client' ?>" class="links" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='lightgray'"> <i class="fas fa-arrow-right" style="color: #27725f;"></i> Logout </a>
            <?php endif; ?>
            
        </div>

        <div class="box">
            <h3>contact info</h3>
            <p> <i class="fas fa-map" style="color: #27725f;"></i> Badulla, Sri Lanka</p>
            <p> <i class="fas fa-phone" style="color: #27725f;"></i> 0775914420</p>
            <p> <i class="fas fa-envelope" style="color: #27725f;"></i> alimenta588@gmail.com</p>
            <p> <i class="fas fa-clock" style="color: #27725f;"></i> 8:00am - 10:00pm</p>           
        </div>

        <div class="box">
            <h3>newsletter</h3>
            <p>Subscribe for latest updates</p>
            <form action="" method="POST">
                <input type="email" name="sub_email"  class="email" id="" style="border-color: green;">
                <input type="submit" value="subscribe" name="subscribe" style="background-color: green; width: 225px; border: none; height: 40px; color: white; border-radius: 5%;">
            </form>
        </div>

    </div>

</section>
