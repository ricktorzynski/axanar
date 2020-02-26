<!DOCTYPE html>
<html class=" js no-touch" style=""><!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title><?= config('app.versionName') ?> - Perk Vault</title>

    <meta name="description" content="Ares Digital 3.0 fundraiser perk delivery.">
    <meta name="author" content="Ares Digital 3.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

    <link rel="shortcut icon" href="/images/client/favicon.png">
    <link rel="apple-touch-icon" href="/images/apple-icon/icon57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="/images/apple-icon/icon72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="/images/apple-icon/icon76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="/images/apple-icon/icon114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="/images/apple-icon/icon120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="/images/apple-icon/icon144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="/images/apple-icon/icon152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="/images/apple-icon/icon180.png" sizes="180x180">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/plugins.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/themes.css">

    <script type="text/javascript">
      document.write = function() {
      };
      document.writeln = function() {
      };
    </script>

    <script async="" src="//www.google-analytics.com/analytics.js"></script>
    <script src="/js/vendor/modernizr-respond.min.js"></script>
    <script language="JavaScript"> var message = '';

      function clickIE4() {
        if (event.button == 2) {
          alert(message);
          return false;
        }
      }

      function clickNS4(e) {
        if (document.layers || document.getElementById && !document.all) {
          if (e.which == 2 || e.which == 3) {
            alert(message);
            return false;
          }
        }
      }

      if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS4;
      } else if (document.all && !document.getElementById) {
        document.onmousedown = clickIE4;
      }
      document.oncontextmenu = new Function('return false'); </script>

    <style>
        @font-face {
            font-family: 'SerpentineStd-Medium';
            src: url('/fonts/SerpentineStd-Medium.eot?#iefix') format('embedded-opentype'), url('/fonts/SerpentineStd-Medium.otf') format('opentype'), url('/fonts/SerpentineStd-Medium.woff') format('woff'), url('/fonts/SerpentineStd-Medium.ttf') format('truetype'), url('/fonts/SerpentineStd-Medium.svg#SerpentineStd-Medium') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'SerpentineStd-Light';
            src: url('/fonts/SerpentineStd-Light.eot?#iefix') format('embedded-opentype'), url('/fonts/SerpentineStd-Light.otf') format('opentype'), url('/fonts/SerpentineStd-Light.woff') format('woff'), url('/fonts/SerpentineStd-Light.ttf') format('truetype'), url('/fonts/SerpentineStd-Light.svg#SerpentineStd-Light') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        /*@font-face { font-family: 'AmarilloUSAFProDemo-Medium';src: url('/fonts/AmarilloUSAFProDemo-Medium.eot?#iefix') format('embedded-opentype'),  url('/fonts/AmarilloUSAFProDemo-Medium.woff') format('woff'), url('/fonts/AmarilloUSAFProDemo-Medium.ttf')  format('truetype'), url('/fonts/AmarilloUSAFProDemo-Medium.svg#AmarilloUSAFProDemo-Medium') format('svg');font-weight: normal;font-style: normal; }*/
        /*@font-face { font-family: 'HorizonBT-Regular';src: url('/fonts/HorizonBT-Regular.eot?#iefix') format('embedded-opentype'),  url('/fonts/HorizonBT-Regular.woff') format('woff'), url('/fonts/HorizonBT-Regular.ttf')  format('truetype'), url('/fonts/HorizonBT-Regular.svg#HorizonBT-Regular') format('svg');font-weight: normal;font-style: normal; }*/
    </style>
</head>
<body>
<div id="page-container">

    <header class="header-scroll">
        <div class="container">
            <a href="/dashboard.html" class="site-logo" style="text-decoration:none;"><i class="gi gi-home"></i>&nbsp;&nbsp;<img src="/images/client/logo-micro.png"
                                                                                                                                 style="width:250px;height:40px;"></a>
            <nav>
                <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm"><i class="fa fa-bars"></i></a>
                <ul class="site-nav">
                    <li class="visible-xs visible-sm"><a href="javascript:void(0)" class="site-menu-toggle text-center"><i class="fa fa-times"></i></a></li>
                    <li><a href="/dashboard.html" style="text-decoration:none;"><i class="fa fa-tachometer"></i>&nbsp; Dashboard</a></li>
                    <li><a href="/faq.html" style="text-decoration:none;"><i class="fa fa-question"></i>&nbsp; F.A.Q.</a></li>
                    <li>
                        <a href="javascript:void();" class="site-nav-sub" style="text-decoration:none;"><i class="fa fa-wrench"></i>&nbsp;
                            <i class="fa fa-angle-down site-nav-arrow"></i>Account</a>
                        <ul>
                            <li><a href="/account-shipping.html" style="text-decoration:none;">Update Shipping Info</a></li>

                            <li><a href="/account-changepassword.html" style="text-decoration:none;">Change Password</a></li>
                        </ul>
                    </li>

                    <li><a href="http://www.axanar.com/donate/" target="_blank" class="btn btn-success" style="text-shadow: 2px 2px 4px #000000;text-decoration:none;"><i
                                    class="fa fa-usd"></i>&nbsp; Donate</a></li>

                    <li><a href="/donor-store.html" class="btn btn-warning" style="text-shadow: 2px 2px 4px #000000;text-decoration:none;"><i class="fa fa-tags"></i>&nbsp;
                            Store</a></li>

                    <li><a href="/logout.html" style="text-decoration:none;"><i class="fa fa-lock"></i>&nbsp; Log Out</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="media-container">
        <section class="site-section site-section-light site-section-top">
            <div class="container text-center">
                <h1 class="animation-slideDown" style="text-shadow: 2px 2px 4px #000000;color:#ffffaa;font-family:'SerpentineStd-Medium' !important;">Axanar
                    <strong>Fulfillment</strong></h1>
                <h3 class="h3 text-center animation-slideUp" style="text-shadow: 2px 2px 4px #000000;color:#ffffff;font-family:'SerpentineStd-Light' !important;">Digital Perk
                    Vault</h3>
            </div>
        </section>
        <img src="/images/client/header.jpg" alt="" class="media-image animation-pulseSlow">
    </div>

    <section class="site-content site-section">
        <div class="container">


            <div class="sidebar-block">
                <div class="alert alert-danger">
                    <h4><i class="fa fa-medkit"></i> &nbsp;<strong>ACTION REQUIRED</strong></h4>
                    <p>Your account is missing vital information that we will need to fulfill your physical perks, including any stretch goals that you
                        may be entitled to receive. Please update your account with your full name, shipping address, and other personalized details that are requested without
                        delay, because failure to update the required information will cause a delay in your perk processing.</p>
                    <p>Please visit the <b>Account &gt; Update Shipping Info</b> page using the menu above, or simply <a href="/account-shipping.html"
                                                                                                                                                     class="alert-link">
                            <button type="button" class="btn btn-alt btn-xs btn-danger">CLICK HERE</button>
                        </a> to update your donor records. Thank you for your prompt attention.
                    </p>
                </div>
            </div>

            <div class="col-sm-12"><a href="/dashboard.html" style="text-decoration:none;"><span class="label label-info"><strong><i class="gi gi-left_arrow"
                                                                                                                                     style="margin-bottom:3px;"></i>&nbsp;&nbsp;RETURN TO DASHBOARD&nbsp;&nbsp;</strong></span></a><br><br>
            </div>

            <div class="col-md-4 animation-fadeInQuick" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                <div class="store-item">
                    <div class="store-item-image"><img src="/images/client/perks/1/pta-ortiz-1.jpg"
                                                       alt=""
                                                       class="img-responsive"><img src="/images/overlays/perk_photo_overlay_zip.png"
                                                                                   style="position:absolute;top:0;left:0;"
                                                                                   class="img-responsive"></div>
                    <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                        <span class="store-item-price themed-color-dark pull-right" style="padding-left:15px;">1MB</span>
                        <strong>Juan Ortiz 'Prelude to Axanar' Poster #1</strong>
                    </div>

                    <div class="clearfix" style="text-align:center;margin-top:5px;">DOWNLOAD OPTIONS<br>
                        <a href="/vault-download.html?u=1&amp;c=1&amp;l=75&amp;m=db" target="_blank"><img src="/images/icons/db_icon_25.png"
                                                                                                          style="width:28px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from Dropbox"
                                                                                                          title="Download from Dropbox"></a> &nbsp;
                        <a href="/vault-download.html?u=1&amp;c=1&amp;l=75&amp;m=od" target="_blank"><img src="/images/icons/od_icon_25.png"
                                                                                                          style="width:41px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from OneDrive"
                                                                                                          title="Download from OneDrive"></a> &nbsp;
                        <a href="/vault-download.html?u=1&amp;c=1&amp;l=75&amp;m=gd" target="_blank"><img src="/images/icons/gd_icon_25.png"
                                                                                                          style="width:25px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from Google Drive"
                                                                                                          title="Download from Google Drive"></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4 animation-fadeInQuick" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                <div class="store-item">
                    <div class="store-item-image"><img src="/images/client/perks/1/pta-ortiz-2.jpg"
                                                       alt=""
                                                       class="img-responsive"><img src="/images/overlays/perk_photo_overlay_zip.png"
                                                                                   style="position:absolute;top:0;left:0;"
                                                                                   class="img-responsive"></div>
                    <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                        <span class="store-item-price themed-color-dark pull-right" style="padding-left:15px;">2MB</span>
                        <strong>Juan Ortiz 'Prelude to Axanar' Poster #2</strong>
                    </div>

                    <div class="clearfix" style="text-align:center;margin-top:5px;">DOWNLOAD OPTIONS<br>
                        <a href="/vault-download.html?u=2&amp;c=1&amp;l=75&amp;m=db" target="_blank"><img src="/images/icons/db_icon_25.png"
                                                                                                          style="width:28px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from Dropbox"
                                                                                                          title="Download from Dropbox"></a> &nbsp;
                        <a href="/vault-download.html?u=2&amp;c=1&amp;l=75&amp;m=od" target="_blank"><img src="/images/icons/od_icon_25.png"
                                                                                                          style="width:41px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from OneDrive"
                                                                                                          title="Download from OneDrive"></a> &nbsp;
                        <a href="/vault-download.html?u=2&amp;c=1&amp;l=75&amp;m=gd" target="_blank"><img src="/images/icons/gd_icon_25.png"
                                                                                                          style="width:25px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from Google Drive"
                                                                                                          title="Download from Google Drive"></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                <div class="store-item">
                    <div class="store-item-image"><img src="/images/client/perks/1/pta-titlecard.jpg"
                                                       alt=""
                                                       class="img-responsive"><img src="/images/overlays/perk_photo_overlay_zip.png"
                                                                                   style="position:absolute;top:0;left:0;"
                                                                                   class="img-responsive"></div>
                    <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                        <span class="store-item-price themed-color-dark pull-right" style="padding-left:15px;">631MB</span>
                        <strong>'Prelude to Axanar' Mobile Version 720p (.MP4 - NO SUBS)</strong>
                    </div>

                    <div class="clearfix" style="text-align:center;margin-top:5px;">DOWNLOAD OPTIONS<br>
                        <a href="/vault-download.html?u=3&amp;c=1&amp;l=75&amp;m=od" target="_blank"><img src="/images/icons/od_icon_25.png"
                                                                                                          style="width:41px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from OneDrive"
                                                                                                          title="Download from OneDrive"></a> &nbsp;
                        <a href="/vault-download.html?u=3&amp;c=1&amp;l=75&amp;m=gd" target="_blank"><img src="/images/icons/gd_icon_25.png"
                                                                                                          style="width:25px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from Google Drive"
                                                                                                          title="Download from Google Drive"></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                <div class="store-item">
                    <div class="store-item-image"><img src="/images/client/perks/1/pta-titlecard.jpg"
                                                       alt=""
                                                       class="img-responsive"><img src="/images/overlays/perk_photo_overlay_zip.png"
                                                                                   style="position:absolute;top:0;left:0;"
                                                                                   class="img-responsive"></div>
                    <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                        <span class="store-item-price themed-color-dark pull-right" style="padding-left:15px;">935MB</span>
                        <strong>'Prelude to Axanar' Desktop Version 720p (.MKV - SUBS)</strong>
                    </div>

                    <div class="clearfix" style="text-align:center;margin-top:5px;">DOWNLOAD OPTIONS<br>
                        <a href="/vault-download.html?u=4&amp;c=1&amp;l=75&amp;m=od" target="_blank"><img src="/images/icons/od_icon_25.png"
                                                                                                          style="width:41px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from OneDrive"
                                                                                                          title="Download from OneDrive"></a> &nbsp;
                        <a href="/vault-download.html?u=4&amp;c=1&amp;l=75&amp;m=gd" target="_blank"><img src="/images/icons/gd_icon_25.png"
                                                                                                          style="width:25px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from Google Drive"
                                                                                                          title="Download from Google Drive"></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                <div class="store-item">
                    <div class="store-item-image"><img src="/images/client/perks/1/pta-titlecard.jpg"
                                                       alt=""
                                                       class="img-responsive"><img src="/images/overlays/perk_photo_overlay_zip.png"
                                                                                   style="position:absolute;top:0;left:0;"
                                                                                   class="img-responsive"></div>
                    <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                        <span class="store-item-price themed-color-dark pull-right" style="padding-left:15px;">2.18GB</span>
                        <strong>'Prelude to Axanar' Desktop Version 1080p (.MKV - SUBS)</strong>
                    </div>

                    <div class="clearfix" style="text-align:center;margin-top:5px;">DOWNLOAD OPTIONS<br>
                        <a href="/vault-download.html?u=5&amp;c=1&amp;l=75&amp;m=od" target="_blank"><img src="/images/icons/od_icon_25.png"
                                                                                                          style="width:41px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from OneDrive"
                                                                                                          title="Download from OneDrive"></a> &nbsp;
                        <a href="/vault-download.html?u=5&amp;c=1&amp;l=75&amp;m=gd" target="_blank"><img src="/images/icons/gd_icon_25.png"
                                                                                                          style="width:25px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from Google Drive"
                                                                                                          title="Download from Google Drive"></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                <div class="store-item">
                    <div class="store-item-image"><img src="/images/client/perks/1/pta-scriptcover.jpg"
                                                       alt=""
                                                       class="img-responsive"><img src="/images/overlays/perk_photo_overlay_zip.png"
                                                                                   style="position:absolute;top:0;left:0;"
                                                                                   class="img-responsive"></div>
                    <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                        <span class="store-item-price themed-color-dark pull-right" style="padding-left:15px;">102MB</span>
                        <strong>'Prelude to Axanar' Illustrated Script</strong>
                    </div>

                    <div class="clearfix" style="text-align:center;margin-top:5px;">DOWNLOAD OPTIONS<br>
                        <a href="/vault-download.html?u=6&amp;c=1&amp;l=75&amp;m=od" target="_blank"><img src="/images/icons/od_icon_25.png"
                                                                                                          style="width:41px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from OneDrive"
                                                                                                          title="Download from OneDrive"></a> &nbsp;
                        <a href="/vault-download.html?u=6&amp;c=1&amp;l=75&amp;m=gd" target="_blank"><img src="/images/icons/gd_icon_25.png"
                                                                                                          style="width:25px;height:25px;border:0px;vertical-align:middle;"
                                                                                                          alt="Download from Google Drive"
                                                                                                          title="Download from Google Drive"></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                <div class="store-item">
                    <div class="store-item-image"><img src="/images/client/perks/1/facebook-group.jpg" alt="" class="img-responsive"></div>
                    <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                        <span class="store-item-price themed-color-dark pull-right" style="padding-left:15px;"></span>
                        <strong>Access to 'Axanar Donors Group' on Facebook</strong>
                    </div>

                    <div class="clearfix" style="text-align:center;margin-top:5px;">&nbsp;<br><img src="/images/site/spacer.png"
                                                                                                   style="width:1px;height:25px;border:0px;vertical-align:middle;"></div>

                </div>
            </div>

            <div class="col-md-4 visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInQuick" data-element-offset="-100">
                <div class="store-item">
                    <div class="store-item-image"><img src="/images/client/perks/1/ares-patch.jpg" alt="" class="img-responsive"></div>
                    <div class="store-item-info clearfix" style="background-color:#efefef;height:100px;">
                        <span class="store-item-price themed-color-dark pull-right" style="padding-left:15px;"></span>
                        <strong>Access to 'Axanar Donor Store'</strong>
                    </div>

                    <div class="clearfix" style="text-align:center;margin-top:5px;">&nbsp;<br><img src="/images/site/spacer.png"
                                                                                                   style="width:1px;height:25px;border:0px;vertical-align:middle;"></div>

                </div>
            </div>

            <div class="col-sm-12">
                <hr>
                <p><b>.ZIP COMPRESSION</b> — Most, if not all, of the digital downloads offered on <?= config('app.versionName') ?> have been compressed with the
                    industry standard .zip format using the WinZip program. If you experience trouble opening the .zip files using your desktop operating system's native .zip
                    functions then you may need to use a third-party program such as WinZip, WinRAR, 7-Zip, or Stuffit (Mac). If you are using a mobile device (smart phone, tablet,
                    etc.) to download the files then you will need an app to unzip them before they can be viewed.</p>
                <p><b>VIDEO PLAYBACK</b> — For the most effective playback of .MKV (Matroska) or .MP4 format video files, or any format of video and
                    audio files for that matter, <?= config('app.versionName') ?> recommends the wildly popular and open source VLC Media Player that is available for many operating systems and
                    devices. You may download this free program directly from the developer's website by <a href="http://www.videolan.org/vlc/index.html" target="_blank">clicking
                        here</a>.</p>
                <p><b>ANTI-VIRUS FALSE POSITIVES:</b> — Some anti-virus software does not care for .pdf files that are delivered in a .zip file and may
                    report a warning or a false positive when you attempt to download such files. All files offered on <?= config('app.versionName') ?> are wholly within our control and have been
                    thoroughly scanned before being offered to you, so it is our recommendation that you override the false positive and continue downloading if you expereince this
                    situation.</p>
                <br>
            </div>


        </div>
    </section>
    <?php require_once __DIR__ . '/resources/views/layouts/page-footer.php'; ?>
</div>

<a href="#" id="to-top"><i class="fa fa-angle-up"></i></a>

<script src="/js/vendor/jquery-1.11.3.min.js"></script>
<script src="/js/vendor/bootstrap.min.js"></script>
<script src="/js/plugins.js"></script>
<script src="/js/app.js"></script>
<script>
  (function(i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function() {
      (i[r].q = i[r].q || []).push(arguments);
    }, i[r].l = 1 * new Date();
    a = s.createElement(o), m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m);
  })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

  ga('create', 'UA-67558472-2', 'auto');
  ga('send', 'pageview');
</script>
<script type="text/JavaScript">setTimeout(function() {
    location.href = '/logout.html?auto=1';
  }, 3540000);</script>
</body>
</html>
