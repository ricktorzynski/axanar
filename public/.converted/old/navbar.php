<?php if ($_SESSION && array_key_exists('userId', $_SESSION)) { ?>
    <header>
        <div class="container">
            <a href="/dashboard.php"
               class="site-logo"
               style="text-decoration:none;"><i class="gi gi-home"></i>&nbsp;&nbsp;<img src="/images/client/new-logo-sm.png"
                                                                                        style="width:250px;height:40px;"
                                                                                        alt=""
                                                                                        title=""></a>
            <nav>
                <a href="javascript:void(0)"
                   class="btn btn-default site-menu-toggle visible-xs visible-sm"><i class="fa fa-bars"></i></a>
                <ul class="site-nav">
                    <li class="visible-xs visible-sm"><a href="javascript:void(0)"
                                                         class="site-menu-toggle text-center"><i class="fa fa-times"></i></a></li>
                    <li><a id="dashboard" href="/dashboard.php" style="text-decoration:none;"><i class="fa fa-tachometer"></i>&nbsp;
                            Dashboard</a></li>
                    <li><a id="faq" href="/faq" style="text-decoration:none;"><i class="fa fa-question"></i>&nbsp; F.A.Q.</a>
                    </li>
                    <?php if (isAdmin()) { ?>
                        <li>
                            <a id="account"
                               href="javascript:void();"
                               class="site-nav-sub"
                               style="text-decoration:none;"><i class="fa fa-unlock-alt"></i>&nbsp;
                                <i class="fa fa-angle-down site-nav-arrow"></i>Admin</a>
                            <ul>
                                <li><a href="/admin-members.php" style="text-decoration:none;">Members</a></li>
                                <!--                    <li><a href="admin-members-merge.php" style="text-decoration:none;">Merge Members</a></li>-->
                                <li><a href="/admin-campaigns.php" style="text-decoration:none;">Campaigns</a></li>
                                <li><a href="/admin-fulfillment-tiers.php" style="text-decoration:none;">Packages/Tiers</a></li>
                                <li><a href="/admin-fulfillment-dashboard.php" style="text-decoration:none;">Items</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li>
                        <a id="account"
                           href="javascript:void();"
                           class="site-nav-sub"
                           style="text-decoration:none;"><i class="fa fa-wrench"></i>&nbsp;
                            <i class="fa fa-angle-down site-nav-arrow"></i>Account</a>
                        <ul>
                            <li><a href="/account-shipping.php" style="text-decoration:none;">Update Shipping Info</a></li>
                            <li><a href="/account-changeemail.php" style="text-decoration:none;">Change Email</a></li>
                            <li><a href="/account-changepassword.php" style="text-decoration:none;">Change Password</a></li>
                        </ul>
                    </li>

                    <?php if (false && userHasStoreAccess()) { ?>
                        <li><a href="/donorStation.php"
                               class="btn btn-warning"
                               style="text-shadow: 2px 2px 4px #000000;text-decoration:none;"><i class="fa fa-tags"></i>&nbsp;
                                Donor Station</a></li>
                    <?php } ?>
                    <li><a href="/logout.php" style="text-decoration:none;"><i class="fa fa-lock"></i>&nbsp; Log Out</a></li>
                </ul>
            </nav>
        </div>
    </header>
<?php } else { ?>
    <header>
        <div class="container">
            <a href="/index.php" class="site-logo" style="text-decoration:none;"><img src="/images/client/new-logo-sm.png"
                                                                                      style="width:250px;height:40px;"></a>
            <nav>
                <a href="javascript:void(0)"
                   class="btn btn-defaudonorlt site-menu-toggle visible-xs visible-sm"><i class="fa fa-bars"></i></a>
                <ul class="site-nav">
                    <li class="visible-xs visible-sm"><a href="javascript:void(0)"
                                                         class="site-menu-toggle text-center"><i class="fa fa-times"></i></a></li>


                    <li><a href="/login.php" class="btn btn-info" style="text-shadow: 2px 2px 4px #000000;text-decoration:none;"><i
                                    class="fa fa-unlock"></i>&nbsp; Log In</a></li>
                </ul>
            </nav>
        </div>
    </header>
<?php }

$pageActive = basename(filter_var($_SERVER["SCRIPT_FILENAME"], FILTER_SANITIZE_STRING), '.php');
$tabActive = null;
switch ($pageActive) {
    case 'dashboard':
        $tabActive = 'dashboard';
        break;
    case 'faq':
        $tabActive = 'faq';
        break;
    case 'admin':
    case 'admin-campaigns':
    case 'admin-members':
        $tabActive = 'admin';
        break;
    case 'account':
    case 'account-shipping':
    case 'account-setpassword':
    case 'account-changepassword':
    case 'account-forgotpassword':
        $tabActive = 'account';
        break;
}

if ($pageActive !== 'index') {
    require_once __DIR__ . '/page-media-header.php';
}

?>
<script>
  $(function() {
    $("#<?php echo $tabActive;?>").addClass('active');
  });
</script>
