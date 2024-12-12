<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Admin</div>
                            <a class="nav-link" href="product.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Product
                            </a>
                            <a class="nav-link" href="category.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Category
                            </a>
                            <a class="nav-link" href="order.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Orders
                            </a>
                            <a class="nav-link" href="user.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Users
                            </a>
                            <a class="nav-link" href="systemInfo.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Settings
                            </a>
                            <div class="sb-sidenav-menu-heading">Reports</div>
                            <a class="nav-link" href="salesReport.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Daily Sales Report
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            $user = $_SESSION["admin"];
                            $resz= mysqli_query($link,"select username from users where id =$user ");
                            $rowz=mysqli_fetch_row($resz);  
                            $admin_name= $rowz[0];

                            echo $admin_name;
                        ?>
                    </div>
                </nav>
            </div>