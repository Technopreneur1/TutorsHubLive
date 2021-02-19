@extends('layouts/master1')
@section('title')
    Find Tutor
@endsection
@section('content')



    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="format-detection" content="telephone=no">
        <link rel="profile" href="{{url('gmpg.org/xfn/11')}}">
        <link rel="pingback" href="{{url('smarthead.ancorathemes.com/xmlrpc.php')}}">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


        <title>Home</title>
        <style type="text/css" media="screen">#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td a.ui-state-active,#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td a.ui-state-active:hover,body #booked-profile-page input[type=submit].button-primary:hover,body .booked-list-view button.button:hover, body .booked-list-view input[type=submit].button-primary:hover,body table.booked-calendar input[type=submit].button-primary:hover,body .booked-modal input[type=submit].button-primary:hover,body table.booked-calendar th,body table.booked-calendar thead,body table.booked-calendar thead th,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button:hover,body #booked-profile-page .booked-profile-header,body #booked-profile-page .booked-tabs li.active a,body #booked-profile-page .booked-tabs li.active a:hover,body #booked-profile-page .appt-block .google-cal-button > a:hover,#ui-datepicker-div.booked_custom_date_picker .ui-datepicker-header{ background:#134477 !important; }body #booked-profile-page input[type=submit].button-primary:hover,body table.booked-calendar input[type=submit].button-primary:hover,body .booked-list-view button.button:hover, body .booked-list-view input[type=submit].button-primary:hover,body .booked-modal input[type=submit].button-primary:hover,body table.booked-calendar th,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button:hover,body #booked-profile-page .booked-profile-header,body #booked-profile-page .appt-block .google-cal-button > a:hover{ border-color:#134477 !important; }body table.booked-calendar tr.days,body table.booked-calendar tr.days th,body .booked-calendarSwitcher.calendar,body #booked-profile-page .booked-tabs,#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar thead,#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar thead th{ background:#092746 !important; }body table.booked-calendar tr.days th,body #booked-profile-page .booked-tabs{ border-color:#092746 !important; }#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td.ui-datepicker-today a,#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td.ui-datepicker-today a:hover,body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,body #booked-profile-page .booked-profile-appt-list .appt-block.approved .status-block,body #booked-profile-page .appt-block .google-cal-button > a,body .booked-modal p.booked-title-bar,body table.booked-calendar td:hover .date span,body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active,body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover,.booked-ms-modal .booked-book-appt /* Multi-Slot Booking */{ background:#aece61; }body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body #booked-profile-page .appt-block .google-cal-button > a,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active,body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover{ border-color:#aece61; }body .booked-modal .bm-window p i.fa,body .booked-modal .bm-window a,body .booked-appt-list .booked-public-appointment-title,body .booked-modal .bm-window p.appointment-title,.booked-ms-modal.visible:hover .booked-book-appt{ color:#aece61; }.booked-appt-list .timeslot.has-title .booked-public-appointment-title { color:inherit; }</style><meta name='robots' content='noindex,nofollow' />
        <link rel="alternate" hreflang="en" href="{{url('home-2.html')}}" />
        <link rel='dns-prefetch' href='{{url('ajax.googleapis.com/')}}' />
        <link rel='dns-prefetch' href='{{url('fonts.googleapis.com/')}}' />
        <link rel='dns-prefetch' href='{{url('s.w.org/')}}' />
        <link rel="alternate" type="application/rss+xml" title="SmartHead &raquo; Feed" href="{{url('feed/feed.html')}}" />
        <link rel="alternate" type="application/rss+xml" title="SmartHead &raquo; Comments Feed" href="{{url('comments/feed/feed.html')}}" />
        <script type="text/javascript">
            window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/smarthead.ancorathemes.com\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.4"}};
            /*! This file is auto-generated */
            !function(e,a,t){var r,n,o,i,p=a.createElement("canvas"),s=p.getContext&&p.getContext("2d");function c(e,t){var a=String.fromCharCode;s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,e),0,0);var r=p.toDataURL();return s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,t),0,0),r===p.toDataURL()}function l(e){if(!s||!s.fillText)return!1;switch(s.textBaseline="top",s.font="600 32px Arial",e){case"flag":return!c([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])&&(!c([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!c([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]));case"emoji":return!c([55357,56424,55356,57342,8205,55358,56605,8205,55357,56424,55356,57340],[55357,56424,55356,57342,8203,55358,56605,8203,55357,56424,55356,57340])}return!1}function d(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(i=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},o=0;o<i.length;o++)t.supports[i[o]]=l(i[o]),t.supports.everything=t.supports.everything&&t.supports[i[o]],"flag"!==i[o]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[i[o]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(r=t.source||{}).concatemoji?d(r.concatemoji):r.wpemoji&&r.twemoji&&(d(r.twemoji),d(r.wpemoji)))}(window,document,window._wpemojiSettings);
        </script>
        <style type="text/css">
            img.wp-smiley,
            img.emoji {
                display: inline !important;
                border: none !important;
                box-shadow: none !important;
                height: 1em !important;
                width: 1em !important;
                margin: 0 .07em !important;
                vertical-align: -0.1em !important;
                background: none !important;
                padding: 0 !important;
            }
            div#sc_action_1338897222 {
                border-top-width: 1px !important;
                padding-top: 2.5rem !important;
                padding-bottom: 3rem !important;
                border-top-color: #d9dfe5 !important;
                border-top-style: dashed !important;
            }
            .nm{
                margin-top: 24px!important;
            }
        </style>

        <link rel='stylesheet' id='vc_extensions_cqbundle_adminicon-css'  href='{{url('wp-content/plugins/vc-extensions-bundle/css/admin_icon.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='wp-block-library-css'  href='{{url('wp-includes/css/dist/block-library/style.min.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='wc-block-style-css'  href='{{url('wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/style.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='booked-icons-css'  href='{{url('wp-content/plugins/booked/assets/css/icons.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='booked-tooltipster-css'  href='{{url('wp-content/plugins/booked/assets/js/tooltipster/css/tooltipster.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='booked-tooltipster-theme-css'  href='{{url('wp-content/plugins/booked/assets/js/tooltipster/css/themes/tooltipster-light.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='booked-animations-css'  href='{{url('wp-content/plugins/booked/assets/css/animations.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='booked-styles-css'  href='{{url('wp-content/plugins/booked/assets/css/styles.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='booked-responsive-css'  href='{{url('wp-content/plugins/booked/assets/css/responsive.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='contact-form-7-css'  href='{{url('wp-content/plugins/contact-form-7/includes/css/styles.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='jquery-ui-theme-css'  href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.min.css?ver=1.11.4' type='text/css' media='all' />
        <link rel='stylesheet' id='jquery-ui-timepicker-css'  href='{{url('wp-content/plugins/contact-form-7-datepicker/js/jquery-ui-timepicker/jquery-ui-timepicker-addon.min.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='essential-grid-plugin-settings-css'  href='{{url('wp-content/plugins/essential-grid/public/assets/css/settings.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='tp-fontello-css'  href='{{url('wp-content/plugins/essential-grid/public/assets/font/fontello/css/fontello.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='rs-plugin-settings-css'  href='{{url('wp-content/plugins/revslider/public/assets/css/rs6.css')}}' type='text/css' media='all' />
        <style id='rs-plugin-settings-inline-css' type='text/css'>
            #rs-demo-id {}
        </style>
        <link rel='stylesheet' id='trx_addons-icons-css'  href='{{url('wp-content/plugins/trx_addons/css/font-icons/css/trx_addons_icons-embedded.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='swiperslider-css'  href='{{url('wp-content/plugins/trx_addons/js/swiper/swiper.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='magnific-popup-css'  href='{{url('wp-content/plugins/trx_addons/js/magnific/magnific-popup.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='trx_addons-css'  href='{{url('wp-content/plugins/trx_addons/css/trx_addons.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='trx_addons-animation-css'  href='{{url('wp-content/plugins/trx_addons/css/trx_addons.animation.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='trx_demo_icons-css'  href='{{url('wp-content/plugins/trx_demo-master/css/font-icons/css/trx_demo_icons.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='trx_demo_icons_animation-css'  href='{{url('wp-content/plugins/trx_demo-master/css/font-icons/css/animation.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='trx_demo_panels-css'  href='{{url('wp-content/plugins/trx_demo-master/css/trx_demo_panels.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='tutor-plugin-style-css'  href='{{url('wp-content/plugins/tutor-plugin/css/tutor-plugin.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='tutor-plugin-colors-css'  href='{{url('wp-content/plugins/tutor-plugin/css/colors.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='tutor-plugin-fontello-style-css'  href='{{url('wp-content/plugins/tutor-plugin/css/fontello/css/fontello.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='woocommerce-layout-css'  href='{{url('wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='woocommerce-smallscreen-css'  href='{{url('wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css')}}' type='text/css' media='only screen and (max-width: 768px)' />
        <link rel='stylesheet' id='woocommerce-general-css'  href='{{url('wp-content/plugins/woocommerce/assets/css/woocommerce.css')}}' type='text/css' media='all' />
        <style id='woocommerce-inline-inline-css' type='text/css'>
            .woocommerce form .form-row .required { visibility: visible; }
        </style>
        <link rel='stylesheet' id='wpml-legacy-vertical-list-0-css'  href='../wp-content/plugins/sitepress-multilingual-cms/templates/language-switchers/legacy-list-vertical/style.css' type='text/css' media='all' />
        <style id='wpml-legacy-vertical-list-0-inline-css' type='text/css'>
            .wpml-ls-statics-shortcode_actions{background-color:#ffffff;}.wpml-ls-statics-shortcode_actions, .wpml-ls-statics-shortcode_actions .wpml-ls-sub-menu, .wpml-ls-statics-shortcode_actions a {border-color:#cdcdcd;}.wpml-ls-statics-shortcode_actions a {color:#444444;background-color:#ffffff;}.wpml-ls-statics-shortcode_actions a:hover,.wpml-ls-statics-shortcode_actions a:focus {color:#000000;background-color:#eeeeee;}.wpml-ls-statics-shortcode_actions .wpml-ls-current-language>a {color:#444444;background-color:#ffffff;}.wpml-ls-statics-shortcode_actions .wpml-ls-current-language:hover>a, .wpml-ls-statics-shortcode_actions .wpml-ls-current-language>a:focus {color:#000000;background-color:#eeeeee;}
        </style>
        <link rel='stylesheet' id='js_composer_front-css'  href='../wp-content/plugins/js_composer/assets/css/js_composer.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='wpgdprc.css-css'  href='../wp-content/plugins/wp-gdpr-compliance/assets/css/front.css' type='text/css' media='all' />
        <style id='wpgdprc.css-inline-css' type='text/css'>

            div.wpgdprc .wpgdprc-switch .wpgdprc-switch-inner:before { content: 'Yes'; }
            div.wpgdprc .wpgdprc-switch .wpgdprc-switch-inner:after { content: 'No'; }

        </style>

        <link rel='stylesheet' id='smarthead-font-google_fonts-css'  href='http://fonts.googleapis.com/css?family=Titillium+Web%3A400%2C600%2C700%7CSanchez%3A400%2C400italic%2C700%2C700italic&#038;subset=latin%2Clatin-ext&#038;ver=5.4' type='text/css' media='all' />
        <link rel='stylesheet' id='fontello-style-css'  href='{{url('wp-content/themes/smarthead/css/fontello/css/fontello-embedded.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='smarthead-main-css'  href='{{url('wp-content/themes/smarthead/style.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='smarthead-colors-css'  href='{{url('wp-content/themes/smarthead/css/__colors.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='smarthead-styles-css'  href='{{url('wp-content/themes/smarthead/css/__styles.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='mediaelement-css'  href='{{url('wp-includes/js/mediaelement/mediaelementplayer-legacy.min.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='wp-mediaelement-css'  href='{{url('wp-includes/js/mediaelement/wp-mediaelement.min.css')}}' type='text/css' media='all' />
        <link rel='stylesheet' id='smarthead-responsive-css'  href='{{url('wp-content/themes/smarthead/css/responsive.css')}}' type='text/css' media='all' />
        <script type='text/javascript' src='{{url('wp-includes/js/jquery/jquery.js')}}'></script>
        <script type='text/javascript' src='{{url('wp-includes/js/jquery/jquery-migrate.min.js')}}'></script>
        <script type='text/javascript' src='{{url('wp-content/plugins/revslider/public/assets/js/revolution.tools.min.js')}}'></script>
        <script type='text/javascript' src='{{url('wp-content/plugins/revslider/public/assets/js/rs6.min.js')}}'></script>
        <script type='text/javascript' src='{{url('wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js')}}'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var wc_add_to_cart_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View cart","cart_url":"http:\/\/smarthead.ancorathemes.com\/cart\/","is_cart":"","cart_redirect_after_add":"no"};
            /* ]]> */
        </script>
        <script type='text/javascript' src='{{url('wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js')}}'></script>
        <script type='text/javascript' src='{{url('wp-content/plugins/js_composer/assets/js/vendors/woocommerce-add-to-cart.js')}}'></script>
        <link rel="EditURI" type="application/rsd+xml" title="RSD" href="{{url('smarthead.ancorathemes.com/xmlrpc.php?rsd')}}" />
        <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{{url('wp-includes/wlwmanifest.xml')}}" />
        <meta name="generator" content="WordPress 5.4" />
        <meta name="generator" content="WooCommerce 4.0.1" />
        <meta name="generator" content="WPML ver:4.0.8 stt:1,3;" />
        <noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
        <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style><meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress."/>
        <meta name="generator" content="Powered by Slider Revolution 6.1.7 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
        <link rel="icon" href="{{url('wp-content/uploads/2016/12/cropped-favicon-100x100.jpg')}}" sizes="32x32" />
        <link rel="icon" href="{{url('wp-content/uploads/2016/12/cropped-favicon-222x222.jpg')}}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{url('wp-content/uploads/2016/12/cropped-favicon-222x222.jpg')}}" />
        <meta name="msapplication-TileImage" content="{{url('wp-content/uploads/2016/12/cropped-favicon-300x300.jpg')}}" />
        <script type="text/javascript">function setREVStartSize(e){
                try {
                    var pw = document.getElementById(e.c).parentNode.offsetWidth,
                        newh;
                    pw = pw===0 || isNaN(pw) ? window.innerWidth : pw;
                    e.tabw = e.tabw===undefined ? 0 : parseInt(e.tabw);
                    e.thumbw = e.thumbw===undefined ? 0 : parseInt(e.thumbw);
                    e.tabh = e.tabh===undefined ? 0 : parseInt(e.tabh);
                    e.thumbh = e.thumbh===undefined ? 0 : parseInt(e.thumbh);
                    e.tabhide = e.tabhide===undefined ? 0 : parseInt(e.tabhide);
                    e.thumbhide = e.thumbhide===undefined ? 0 : parseInt(e.thumbhide);
                    e.mh = e.mh===undefined || e.mh=="" || e.mh==="auto" ? 0 : parseInt(e.mh,0);
                    if(e.layout==="fullscreen" || e.l==="fullscreen")
                        newh = Math.max(e.mh,window.innerHeight);
                    else{
                        e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
                        for (var i in e.rl) if (e.gw[i]===undefined || e.gw[i]===0) e.gw[i] = e.gw[i-1];
                        e.gh = e.el===undefined || e.el==="" || (Array.isArray(e.el) && e.el.length==0)? e.gh : e.el;
                        e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
                        for (var i in e.rl) if (e.gh[i]===undefined || e.gh[i]===0) e.gh[i] = e.gh[i-1];

                        var nl = new Array(e.rl.length),
                            ix = 0,
                            sl;
                        e.tabw = e.tabhide>=pw ? 0 : e.tabw;
                        e.thumbw = e.thumbhide>=pw ? 0 : e.thumbw;
                        e.tabh = e.tabhide>=pw ? 0 : e.tabh;
                        e.thumbh = e.thumbhide>=pw ? 0 : e.thumbh;
                        for (var i in e.rl) nl[i] = e.rl[i]<window.innerWidth ? 0 : e.rl[i];
                        sl = nl[0];
                        for (var i in nl) if (sl>nl[i] && nl[i]>0) { sl = nl[i]; ix=i;}
                        var m = pw>(e.gw[ix]+e.tabw+e.thumbw) ? 1 : (pw-(e.tabw+e.thumbw)) / (e.gw[ix]);

                        newh =  (e.type==="carousel" && e.justify==="true" ? e.gh[ix] : (e.gh[ix] * m)) + (e.tabh + e.thumbh);
                    }

                    if(window.rs_init_css===undefined) window.rs_init_css = document.head.appendChild(document.createElement("style"));
                    document.getElementById(e.c).height = newh;
                    window.rs_init_css.innerHTML += "#"+e.c+"_wrapper { height: "+newh+"px }";
                } catch(e){
                    console.log("Failure at Presize of Slider:" + e)
                }
            };</script>
        <noscript><style> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript></head>

    <body class="tutor-template-default single single-tutor postid-578 theme-smarthead woocommerce-no-js body_tag scheme_default blog_mode_tutor_single body_style_wide  is_stream blog_style_excerpt sidebar_hide expand_content header_style_header-default header_position_default menu_style_top no_layout wpb-js-composer js-comp-ver-6.1 vc_responsive">


    <div class="body_wrap">

        <div class="page_wrap">

            <header class="top_panel top_panel_default without_bg_image with_featured_image header-dark scheme_default">    <div class="top_panel_top">
                    <div class="content_wrap">
                        <div class="custom_button_language">
                        </div>
                        <a href="{{route('login')}}" class=" trx_addons_login_link "><span class="sc_layouts_item_icon sc_layouts_login_icon trx_addons_icon-user-alt"></span><span class="sc_layouts_item_details sc_layouts_login_details">Login</span></a>        </div>
                </div>
                <div class="top_panel_navi sc_layouts_row sc_layouts_row_type_normal sc_layouts_row_fixed
    scheme_default">
                    <div class="content_wrap">
                        <div class="columns_wrap">
                            <div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left column-1_4">
                                <div class="sc_layouts_item"><a class="sc_layouts_logo" href="https://tutors-hub.com/"><img src="{{url('wp-content/uploads/2016/12/logotxt.png')}}"  width="440" height="90"></a></div>
                            </div><div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left column-3_4">
                                <div class="sc_layouts_item">

                                    <nav class="menu_main_nav_area sc_layouts_hide_on_mobile"><ul id="menu_main" class="sc_layouts_menu_nav menu_main_nav">
                                            <li id="menu-item-105" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-105"><a href="https://tutors-hub.com"><span>Home</span></a></li>
                                            <li id="menu-item-548" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-548"><a href="https://tutors-hub.com/student-registration"><span>Find a Tutor</span></a></li>
                                            <li id="menu-item-164" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="https://tutors-hub.com/teacher-registration"><span>Become a Tutor</span></a></li>
                                            <li id="menu-item-119" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-119"><a href="#"><span>News</span></a></li>
                                            <li id="menu-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165"><a href="https://tutors-hub.com/contact"><span>Contacts</span></a></li></ul>

                                    </nav>
                                    <div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
                                        <a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
                                            <span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.sc_layouts_row -->
                    </div><!-- /.content_wrap -->
                </div><!-- /.top_panel_navi -->	<div class="top_panel_title sc_layouts_row">
                    <div class="content_wrap">
                        <div class="sc_layouts_column sc_layouts_column_align_center">
                            <div class="sc_layouts_item">
                                <div class="sc_layouts_title">
                                    <div class="sc_layouts_title_meta"><div class="post_meta">
                                            <span class="post_meta_item post_date date updated" itemprop="datePublished"><a href="#">{{date('d-m-Y', strtotime($data['created_at']))}}</a></span>

                                        </div><!-- .post_meta --></div><div class="sc_layouts_title_title">							<h1 class="sc_layouts_title_caption">{{$data['name']}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </header><div class="menu_mobile_overlay"></div>
            <div class="menu_mobile menu_mobile_fullscreen scheme_dark">
                <div class="menu_mobile_inner">
                    <a class="menu_mobile_close icon-cancel"></a><a class="sc_layouts_logo" href="https://tutors-hub.com/"><img src="{{url('wp-content/uploads/2016/12/logotxt.png')}}"  width="440" height="90"></a>
                    <nav class="menu_mobile_nav_area ">
                        <ul id="menu_mobile" class=" menu_mobile_nav">
                            <li id="menu_mobile-item-105" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-105"><a href="https://tutors-hub.com/"><span>Home</span></a>
                            <li id="menu_mobile-item-548" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-548"><a href="https://tutors-hub.com/student-registration"><span>Find a Tutor</span></a></li>
                            <li id="menu_mobile-item-164" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="https://tutors-hub.com/teacher-registration"><span>Become a Tutor</span></a></li>
                            <li id="menu_mobile-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165"><a href="https://tutors-hub.com/contacts/"><span>Contacts</span></a></li>
                        </ul>
                    </nav>
                    <div class="socials_mobile"><span class="social_item"><a href="{{('twitter.com/ancora_themes')}}" target="_blank" class="social_icons social_twitter"><span class="trx_addons_icon-twitter"></span></a></span><span class="social_item"><a href="https://www.facebook.com/AncoraThemes/" target="_blank" class="social_icons social_facebook"><span class="trx_addons_icon-facebook"></span></a></span><span class="social_item"><a href="https://www.instagram.com/ancora_themes/" target="_blank" class="social_icons social_instagram"><span class="trx_addons_icon-instagram"></span></a></span><span class="social_item"><a href="https://dribbble.com/AncoraThemes" target="_blank" class="social_icons social_dribbble"><span class="trx_addons_icon-dribbble"></span></a></span></div>	</div>
            </div>

            <div class="page_content_wrap scheme_default">

                <div class="content_wrap">



                    <div class="content">

                        <div class="tp-single-wrap">

                            <div class="tp-featured">
                                @if(isset($data->avatar))
                                    <img width="300" height="300" src="https://tutors-hub.com/storage/images/{{$data['avatar']}}" class="attachment-tutor-single size-tutor-single wp-post-image" alt="Josh Summers" itemprop="image" />
                                        @else
                                    <img width="300" height="300" src="https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-740x792.jpg" class="attachment-tutor-single size-tutor-single wp-post-image" alt="Josh Summers" itemprop="image" />

                                                @endif



                            </div><div class="tp-info">
                                <h2 class="tp-single-title">{{$data['name']}}</h2><div class="tp-price">
                                    <span class="tp-present-price"><span class="small">$</span>{{$data['rate']}}                        </span>
                                    <span class="tp-period-price">hour                        </span>
                                </div>
{{--                                <div class="tp-rating">--}}
{{--                                    <span class="tp-rating-star tutor-icon-bookmark-star"></span>--}}
{{--                                    <span class="tp-rating-star tutor-icon-bookmark-star"></span>--}}
{{--                                    <span class="tp-rating-star tutor-icon-bookmark-star"></span>--}}
{{--                                    <span class="tp-rating-star tutor-icon-bookmark-star"></span>--}}
{{--                                    <span class="tp-rating-star tutor-icon-bookmark-star"></span>--}}
{{--                                </div>--}}
                                <div class="tp-biography">{{$data['bio']}}</div><div class="tp-subjects"><span class="label">Subjects: </span>{{$data['subject']}}<br/> <span class="label">Availability:</span> {{$data['availability'] == null ? 'N/A' : $data['availability']}}</div><div class="tp-single-contact-form">


                                </div>
                            </div>
                        </div>
                        <div id="app"  class="homepage">

                            <register-form url="#" ></register-form>


                        </div>



                    </div><!-- </.content> -->

                </div><!-- </.content_wrap> -->			</div><!-- </.page_content_wrap> -->

            <script src="{{asset('js/app.js')}}?v=132131214ss4w1s32s122ssa4"></script>

@endsection
