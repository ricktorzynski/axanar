@extends('layouts.app-wide')

@section('mediaTitle', 'Administrative Dashboard')

@section('content')

    <body xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <style>
        .list-group panel.active {
            background-color: #030;
            border-color: #aed248;
        }
    </style>
    <script>
      $('.list-group').on('click', '> a', function(e) {
        var $this = $(this);
        $('.list-group').find('.active').removeClass('active');
        $this.addClass('active');
      });

      function toggleShipping(userId, skuId) {
        action = parseInt($('#toggle_' + userId).attr('action'));
        $.ajax({
          type: 'POST',
          url: 'admin-toggle-shipping.php',
          data: 'action=' + parseInt($('#toggle_' + userId).attr('action')) + '&userId=' + userId + '&skuId=' + skuId,
          success: function(msg) {
            result = JSON.parse(msg);
            if (result.status && result.status == 'ok') {
              var v = '#itm_' + userId;
              el = $(v)[0];

              if (action == 1) {
                $(v).html('Yes');
                $('#toggle_' + userId).html('Mark Unshipped');
                $('#toggle_' + userId).attr({action: '0'});
              } else {
                $(v).html('No');
                $('#toggle_' + userId).html('Mark Shipped');
                $('#toggle_' + userId).attr({action: '1'});
              }

            } else {
            }
          },
        });
      }
    </script>
    <div id="page-container">

        <?php require_once __DIR__ . '/resources/views/layouts/navbar.php'; ?>

        <section class="site-content site-section">
            <div class="container">


            <?php showMessages(); ?>
            <!--
                                <div class="text-center"><a href="http://www.axanar.com/donate/" target="_blank"><img src="tallyboards/3/axanar-indiegogo2.html" style="width:100%;max-width:1140px;max-height:510px;border:0px;"></a></div>
                                <br/>
            -->
                <div class="list-group">
                    <h3>Fulfillment Item Overview</h3>
                    <br><strong><?php echo $item['name']; ?></strong>
                    <button type=button
                        class='btn btn-primary btn-sm'
                        onclick="location='admin-makeShippingList.php?skuId=<?php echo $skuId; ?>';">Download Shipping List
                    </button>
                    &nbsp;<button type=button
                        class='btn btn-primary btn-sm'
                        onclick="location='?all=1&skuId=<?php echo $skuId; ?>';">Mark All Shipped
                    </button>
                </div>
                <div class="container">
                    <div id="mainMenu">

                        <div class="list-group panel">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Shipped</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                foreach ($orders as $order) {
                                    $email = $order['email'];
                                    $userId = $order['user_id'];
                                    $has = checkListForShipped($userId, $filled);
                                    $v = "No";
                                    $a = 1;
                                    $b = "Mark Shipped";
                                    if ($has === true) {
                                        $a = 0;
                                        $v = "Shipped";
                                        $b = "Mark Unshipped";
                                    }
                                    echo "<tr>";
                                    echo "<td>" .
                                         $order['full_name'] .
                                         "</a></td><td><a href='mailto:$email'>$email</a></td><td id='itm_$userId'>$v</td>";
                                    echo "<td><button id='toggle_$userId' type='button' class='btn btn-primary btn-sm' action='$a' onclick='toggleShipping($userId,$skuId);'>$b</button></td>";
                                    echo "</tr>\n";
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </section>


        <footer class="site-footer site-section" style="background-color:rgba(37, 37, 37, 0.0);">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4" style="text-align:center;">
                        <h4 class="footer-heading"
                            style="font-family:'SerpentineStd-Light' !important;">Visit Axanar</h4>
                        <ul class="footer-nav list-inline">
                            <li><a href="http://www.axanar.com" target="_blank" class="site-logo"><i class="gi gi-globe"
                                        style="font-size:1em;"></i></a></li>
                            <li><a href="https://www.facebook.com/StarTrekAxanar" target="_blank" class="site-logo"><i
                                        class="si si-facebook"
                                        style="font-size:1em;"></i></a></li>
                            <li><a href="https://www.twitter.com/StarTrekAxanar" target="_blank" class="site-logo"><i
                                        class="si si-twitter"
                                        style="font-size:1em;"></i></a></li>
                            <li><a href="https://instagram.com/startrekaxanar" target="_blank" class="site-logo"><i
                                        class="si si-instagram"
                                        style="font-size:1em;"></i></a></li>
                            <li><a href="https://www.pinterest.com/startrekaxanar" target="_blank" class="site-logo"><i
                                        class="si si-pinterest"
                                        style="font-size:1em;"></i></a></li>
                            <li><a href="https://plus.google.com/+StarTrekAxanarOfficial"
                                    target="_blank"
                                    class="site-logo"><i class="si si-google_plus" style="font-size:1em;"></i></a>
                            </li>
                            <li><a href="https://www.youtube.com/StarTrekAxanar" target="_blank" class="site-logo"><i
                                        class="si si-youtube"
                                        style="font-size:1em;"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-4" style="text-align:center;">
                        <h4 class="footer-heading"></h4>
                        <ul class="footer-nav list-inline"></ul>
                    </div>
                    <div class="col-sm-6 col-md-4" style="text-align:center;">
                        <h4 class="footer-heading"
                            style="font-family:'SerpentineStd-Light' !important;letter-spacing: 2px;">Powered by
                            <a href="http://axanar.com"
                                target="_blank"
                                style="color:#ffffff;text-decoration:none;"><strong
                                    style="color:#ffffaa;font-family:'SerpentineStd-Medium' !important;">ARES</strong>.digital</a>
                        </h4>
                        <ul class="footer-nav list-inline"
                            style="font-family:'SerpentineStd-Light' !important;letter-spacing: 1px;">&nbsp;Copyright &copy;2015-2016 - All rights
                            reserved.
                        </ul>
                    </div>
                </div>
            </div>
        </footer>


    </div>

    <?php require_once __DIR__ . '/resources/views/layouts/footer.php'; ?>
