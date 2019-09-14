<?php 
require_once 'app/home.php';
use Auth\Client as User;
use Controllers\PageController\PageController as PC;
GLOBAL $sessions;
?>
<!DOCTYPE html>
<html lang="<?= $sessions->get('locale_iso'); ?>" prefix="og: http://ogp.me/ns#">
    <head>
        
        <!-- metas -->
        <link rel="profile" href="//gmpg.org/xfn/11">            
        <link rel="manifest" href="<?= mix('manifest.json'); ?>">
        <meta name="application-name" content="<?= getenv('APP_NAME');?>" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="<?= getenv('APP_NAME');?>" />
        <meta name="msapplication-TileColor" content="#FFF" />
        <meta name="theme-color" content="#FFF" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#FFF" />
        
        <link rel="apple-touch-icon" sizes="57x57" href="<?= imgs('icos/apple-icon-57x57.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="apple-touch-icon" sizes="60x60" href="<?= imgs('icos/apple-icon-60x60.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?= imgs('icos/apple-icon-72x72.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?= imgs('icos/apple-icon-114x114.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?= imgs('icos/apple-icon-144x144.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?= imgs('icos/apple-icon-76x76.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="apple-touch-icon" sizes="120x120" href="<?= imgs('icos/apple-icon-120x120.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="apple-touch-icon" sizes="152x152" href="<?= imgs('icos/apple-icon-152x152.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?= imgs('icos/apple-icon-180x180.png').'?v='.uniqid().date('dmYhms');?>" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/favicon-32x32.png').'?v='.uniqid().date('dmYhms');?>" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/android-icon-36x36.png').'?v='.uniqid().date('dmYhms');?>" sizes="36x36" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/android-icon-48x48.png').'?v='.uniqid().date('dmYhms');?>" sizes="48x48" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/android-icon-72x72.png').'?v='.uniqid().date('dmYhms');?>" sizes="72x72" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/android-icon-96x96.png').'?v='.uniqid().date('dmYhms');?>" sizes="96x96" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/android-icon-144x144.png').'?v='.uniqid().date('dmYhms');?>" sizes="144x144" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/android-icon-192x192.png').'?v='.uniqid().date('dmYhms');?>" sizes="192x192" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/favicon-96x96.png').'?v='.uniqid().date('dmYhms');?>" sizes="96x96" />
        <link rel="icon" type="image/png" href="<?= imgs('icos/favicon-16x16.png').'?v='.uniqid().date('dmYhms');?>" sizes="16x16" />
        <meta name="msapplication-TileImage" content="<?= imgs('icos/ms-icon-144x144.png').'?v='.uniqid().date('dmYhms');?>" />
        <meta name="msapplication-square70x70logo" content="<?= imgs('icos/ms-icon-70x70.png').'?v='.uniqid().date('dmYhms');?>" />
        <meta name="msapplication-square150x150logo" content="<?= imgs('icos/ms-icon-150x150.png').'?v='.uniqid().date('dmYhms');?>" />
        <meta name="msapplication-wide310x150logo" content="<?= imgs('icos/ms-icon-310x150.png').'?v='.uniqid().date('dmYhms');?>" />
        <meta name="msapplication-square310x310logo" content="<?= imgs('icos/ms-icon-310x310.png').'?v='.uniqid().date('dmYhms');?>" />
        <link href="<?= imgs('icos/apple-startup-320x460.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-640x920.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-640x1096.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-748x1024.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 1) and (orientation: landscape)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-750x1024.png').'?v='.uniqid().date('dmYhms');?>" media="" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-750x1294.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-768x1004.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 1) and (orientation: portrait)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-1182x2208.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-1242x2148.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-1496x2048.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" rel="apple-touch-startup-image" />
        <link href="<?= imgs('icos/apple-startup-1536x2008.png').'?v='.uniqid().date('dmYhms');?>" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" rel="apple-touch-startup-image" />


        <link rel="shortcut icon" type="image/x-icon" href="<?= imgs('icos/favicon.ico').'?v='.uniqid().date('dmYhms'); ?>" />

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="<?= getenv('APP_AUTHOR');?>">
        <meta name="description" content="<?= getenv('APP_NAME').'. '.PC::getMetaKeywords()->meta_desc;?>">
        <meta name="keywords" content="<?= getenv('APP_KEYWORDS').','.PC::getMetaKeywords()->meta_key;?>, Miguel, Angel, Morales, Coterio, 19705040, 1012461973, face, facebook, travel, viaje, turismo, turistico, paquete, tour, trip, trivago">
        <meta name="type" content="WebApp">
        <meta name="csrf-token" content="<?= ($csrf_token ?? false) ;?>">

        <!-- FIN metas -->


        <!-- google -->

        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="<?= getenv('GOOGLE_CLIENTID');?>">
        <meta name="google-site-verification" content="<?= getenv('GOOGLE_SITEVERIFY');?>" />
        <meta name="google-site-verification" content="w3CZfUwaM_h7SfOHKBpGaNW5Xb5gZBoXcfowo7Q4qco" />
        <meta name="robots" content="all" />
        <meta name="googlebot" content="all" />

        <!-- facebook -->
        <meta name="Facebot" content="all">
        <meta property="fb:app_id" content="<?= getenv('FB_APP_ID');?>" />
        <meta property="fb:admins" content="<?= getenv('FB_ADMIN_ID');?>" />
        <meta name="fb:admins" content="<?= getenv('FB_APP_ID');?>">
        <meta name="fb:app_id" content="<?= getenv('FB_ADMIN_ID');?>">

        <meta property="business:contact_data:street_address" content="<?= getenv('FB_ADDRESS');?>" />
        <meta property="business:contact_data:locality" content="<?= getenv('FB_LOCALITY');?>"/>
        <meta property="business:contact_data:postal_code" content="<?= getenv('FB_POSTALCODE');?>" />
        <meta property="business:contact_data:country_name" content="<?= getenv('FB_COUNTRY');?>" />
        <meta property="place:location:latitude" content="<?= getenv('FB_LATITUDE');?>" />
        <meta property="place:location:longitude" content="<?= getenv('FB_LONGITUDE');?>" />


        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image">
        <!--meta name="twitter:card" content="summary" /-->
        <meta name="twitter:site" content="<?= getenv('TW_PROFILE'); ?>" />
        <meta name="twitter:title" content="<?= getenv('APP_NAME'); ?>">
        <meta name="twitter:creator" content="<?= getenv('TW_AUTHOR'); ?>" />
        <meta name="twitter:description" content="<?= getenv('APP_DESCRIPTION'); ?>">
        <meta name="twitter:image:alt" content="Olimpus Soft Data">
        <!-- Twitter summary card with large image must be at least 280x150px -->
        <meta name="twitter:image:src" content="<?= getenv('APP_LOGO_URL'); ?>">
        <!--meta name="twitter:player" content=""-->

        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="<?= getenv('APP_NAME'); ?>">
        <meta itemprop="description" content="<?= getenv('APP_DESCRIPTION'); ?>">
        <meta itemprop="image" content="<?= getenv('APP_LOGO_URL'); ?>">

        <!-- Open Graph general (Facebook, Pinterest & Google+) -->
        <meta property="og:title" content="<?= getenv('APP_NAME'); ?>" />
        <meta property="og:description" content="<?= getenv('APP_DESCRIPTION'); ?>" />
        <meta property="og:url" content="<?= getenv('APP_URL'); ?>" />
        <meta name="og:image" content="<?= getenv('APP_LOGO_URL'); ?>">
        <meta name="og:url" content="<?= getenv('APP_URL'); ?>">
        <meta name="og:site_name" content="<?= getenv('APP_NAME'); ?>">
        <meta property="og:site_name" content="<?= getenv('APP_NAME'); ?>" />
        <meta name="og:locale" content="<?= $sessions->get('locale_iso'); ?>">
        <!--meta name="og:video" content="Mi Control Personal"-->
        <meta name="og:type" content="business.business">
        <meta property="og:type" content="business.business" />
        <meta property="og:publisher" content="<?= getenv('APP_NAME'); ?>" />

        <title><?= getenv('APP_NAME'); ?><?= $ADITIONAL_TITLE ?? '';?></title>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NHZR5P8');</script>
        <!-- End Google Tag Manager -->
        <!-- Custom styles for this template -->

        <!-- **************** FONTS ******************* -->
        <link rel="stylesheet" href="<?= resource('fonts/elusive-icons-2.0.0/css/elusive-icons.css');?>">

        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
        
        <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">
        <!--link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.1/css/v4-shims.css" crossorigin="anonymous"-->

        <link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">

        <!--link href='//rawgit.com/mapshakers/mapkeyicons/master/dist/MapkeyIcons.css' rel='stylesheet' type='text/css'-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.min.css" crossorigin="anonymous" />

        <link rel="stylesheet" href="<?php echo resource('fonts/flaticon/css/flaticon.css');?>">
    
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css" crossorigin="anonymous" />
        
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons-wind.min.css" crossorigin="anonymous" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.min.css" crossorigin="anonymous" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ionicons/4.4.0/collection/icon/icon.css" crossorigin="anonymous" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css" crossorigin="anonymous" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/octicons.min.css"/>

        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/map-icons@3.0.3/dist/css/map-icons.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" crossorigin="anonymous">

        <!--link href="<?php //echo resource('fonts/glyphicons/css/glyphicon.css'); ?>" rel="stylesheet" type='text/css'--> 
        <link href="<?php echo css('fonts.css'); ?>" rel="stylesheet" type='text/css'> 

        <!-- *********** FINAL: FONTS **************** -->
        <?php  
            if(getenv('MODE') !="development") {
        ?>
        <script type="text/javascript">
            console.log = function() {
                return false;
            }
        </script>
        <?php
            }
        ?>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@8.10.4/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" />
        <!--link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" crossorigin="anonymous" /-->
        <link rel="stylesheet" href="<?php //echo resource('client/assets/libs/animate/animate.css'); ?>" crossorigin="anonymous" />

        <link rel="stylesheet" href="<?= resource('client/assets/libs/selectbox/css/jquery.selectbox.css');?>">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/please-wait/0.0.5/please-wait.min.css" />

        <link rel="stylesheet" href="<?= resource('client/assets/libs/bootstrap/css/bootstrap.min.css');?>">
        <!-- Material Design Bootstrap -->
        <link href="//cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= resource('client/assets/css/layout.css');?>">
        <link rel="stylesheet" href="<?= resource('client/assets/css/components.css');?>">
        <link rel="stylesheet" href="<?= resource('client/assets/css/responsive.css');?>">

        <link rel="stylesheet" href="<?= resource('client/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');?>">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" crossorigin="anonymous" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" crossorigin="anonymous" />


        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" crossorigin="anonymous" />

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" crossorigin="anonymous" />

        <link href="<?php css('fonts.css'); ?>" rel="stylesheet" type='text/css'>
        <!--link href="<?php //css('all.css'); ?>" rel="stylesheet" type='text/css'-->
        <link href="<?= resource('style/custom_client.css'); ?>" rel="stylesheet" type='text/css'> 
        <link href="<?= resource('style/test_client.css'); ?>" rel="stylesheet" type='text/css'> 
        <!--
        <script src="<?php //echo resource('js/jquery/jquery-3.3.1.min.js'); ?>"></script>

        -->
        <!-- JQuery Vers: jquery-2.2.3.min.js   -->
        <!-- JQuery Vers: jquery-3.3.1.min.js   -->
        <!-- JQuery Vers: js/slick-master/slick.min.js   -->

            <!--
        <script src="<?php //echo resource('client/assets/libs/jquery/jquery-2.2.3.min.js');?>"></script>
            SEO ' MIGUEL ANGEL MORALES COTERIO 100012341980917 JOHNNY JOSE MORALES COTERIO 100000964416427' 
            --->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script src="<?php echo resource('client/assets/libs/bootstrap/js/bootstrap.min.js');?>"></script>
        <!--script src="<?php //echo resource('client/assets/libs/wow-js/wow.min.js');?>"></script-->

        <script src="//cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js" crossorigin="anonymous"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous"></script>

        <?= $contentStyles ?? ''; ?>
        <!--script src="<?php //echo resource('js/OwlCarousel2/owl.carousel.js'); ?>" defer></script-->

        <!--script src="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" crossorigin="anonymous"></script-->
        <script src="<?php echo resource('client/assets/libs/please-wait/please-wait.min.js');?>" crossorigin="anonymous"></script>
        <script src="<?php echo resource('client/assets/libs/slick-slider/slick.min.js');?>"></script>
        <script src="<?= resource('js/preload-client.js'); ?>"></script>
        
        <?php
            GLOBAL $trans;
            $localeLoadTrans = $sessions->get('locale_iso');
            if(!isset($localeLoadTrans) || empty($localeLoadTrans)) {
                $localeLoadTrans = 'es';
            }
            $LoadTrans = [];
            $dataLoadTrans = $trans->getAllTransJs(['locale' => $localeLoadTrans]);
            foreach ($dataLoadTrans as $keyLoadTrans => $valueLoadTrans) {
                $LoadTrans[$valueLoadTrans['trans_idx']] = $valueLoadTrans['tranlaste'];
            }
        ?>
        <script type="text/javascript">
            if($.loadTrans) {
                //$.loadTrans("<?php //echo $sessions->get('locale_iso'); ?>");
            }
            if(!$.__trans) {
                $.extend( $ , { __trans:<?= json_encode($LoadTrans, JSON_PRETTY_PRINT); ?>});
            }
            window.__trans = <?= json_encode($LoadTrans, JSON_PRETTY_PRINT); ?>;
            $.__trans = <?= json_encode($LoadTrans, JSON_PRETTY_PRINT); ?>;
        </script>
        <style>
            .topbar-left > li:hover {
                -webkit-box-shadow: 0 3px 6px rgba(0, 0, 0, .16), 0 3px 6px rgba(0, 0, 0, .23) !important; 
                -moz-box-shadow: 0 3px 6px rgba(0, 0, 0, .16), 0 3px 6px rgba(0, 0, 0, .23) !important; 
                box-shadow: 0 3px 6px rgba(0, 0, 0, .16), 0 3px 6px rgba(0, 0, 0, .23) !important;
            }
        </style>
        <script type="application/ld+json">
            <?= PC::getLdJson(); ?>
        </script>
    </head>
<body>
<div id="app" class="app">
    <!-- Google Tag Manager (noscript) -->
     <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NHZR5P8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->