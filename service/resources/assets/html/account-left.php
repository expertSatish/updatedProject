<div class="col s12 l3">
                    <div class="MyAccountMenu">
                        <span class='dropdown-trigger' data-target='dropdown1'><i class="material-icons menu-ico">menu</i> My Account Menu</span>
                        <ul class="LeftPanel dropdown-content" id="dropdown1">
                            <li><a href="my-account.php" <?php if($active=='My Account')echo"class='active'";?>><i class="icofont-dashboard"></i> Dashboard</a></li>
                            <li><a href="order.php" <?php if($active=='Orders')echo"class='active'";?>><i class="icofont-inbox"></i> My Orders</a></li>
                            <li><a href="account-setting.php" <?php if($active=='Account Setting')echo"class='active'";?>><i class="icofont-business-man"></i> Account Settings</a></li>
                            <li><a href="upload-documents.php" <?php if($active=='Upload Documents')echo"class='active'";?>><i class="icofont-upload-alt"></i> Upload Documents</a></li>
                            <li><a href="review-and-ratings.php" <?php if($active=='Review & Ratings')echo"class='active'";?>><i class="icofont-ui-rate-add"></i> Review & Ratings</a></li>
                            <li><a href=""><i class="icofont-power"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>