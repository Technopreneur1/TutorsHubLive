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
        <script type='text/javascript' src='wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js'></script>
        <script type='text/javascript' src='wp-content/plugins/js_composer/assets/js/vendors/woocommerce-add-to-cart.js'></script>
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

    <body class="archive post-type-archive post-type-archive-tutor theme-smarthead woocommerce-no-js body_tag scheme_default blog_mode_tutors body_style_wide  is_stream blog_style_excerpt sidebar_show sidebar_left header_style_header-default header_position_default menu_style_top no_layout wpb-js-composer js-comp-ver-6.1 vc_responsive">


    <div class="body_wrap">

        <div class="page_wrap">

            <header class="top_panel top_panel_default without_bg_image header-dark scheme_default">    <div class="top_panel_top">
                    <div class="content_wrap">
                        <div class="custom_button_language">
                            <ul class="language_list">
                                </li></ul>
                        </div>
                        <a href="tutors.html#trx_addons_login_popup" class="trx_addons_popup_link trx_addons_login_link "><span class="sc_layouts_item_icon sc_layouts_login_icon trx_addons_icon-user-alt"></span><span class="sc_layouts_item_details sc_layouts_login_details">Login</span></a>        </div>
                </div>
                <div class="top_panel_navi sc_layouts_row sc_layouts_row_type_normal sc_layouts_row_fixed
    scheme_default">
                    <div class="content_wrap">
                        <div class="columns_wrap">
                            <div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left column-1_4">
                                <div class="sc_layouts_item"><a class="sc_layouts_logo" href="https://tutors-hub.com/"><img src="{{url('wp-content/uploads/2016/12/logotxt.png')}}"  width="440" height="90"></a></div>
                            </div><div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left column-3_4">
                                <div class="sc_layouts_item">
                                    <nav class="menu_main_nav_area sc_layouts_hide_on_mobile"><ul id="menu_main" class="sc_layouts_menu_nav menu_main_nav"><li id="menu-item-105" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-105"><a href="https://tutors-hub.com/"><span>Home</span></a>
                                            </li><li id="menu-item-106" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-106">
                                                <ul class="sub-menu"><li id="menu-item-107" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-107"><a href="tutors.html#"><span>Tools</span></a>
                                                        <ul class="sub-menu"><li id="menu-item-112" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-112"><a href="../shortcodes.html"><span>Shortcodes</span></a></li><li id="menu-item-111" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-111"><a href="../typography.html"><span>Typography</span></a></li></ul>
                                                    </li><li id="menu-item-113" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-113"><a href="tutors.html#"><span>Help</span></a>
                                                        <ul class="sub-menu"><li id="menu-item-758" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-758"><a href="../service-plus.html"><span>Service Plus</span></a></li><li id="menu-item-759" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-759"><a href="../privacy-policy.html"><span>Privacy Policy</span></a></li></ul>
                                                    </li><li id="menu-item-114" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-114"><a href="tutors.html#"><span>Pages</span></a>
                                                        <ul class="sub-menu"><li id="menu-item-236" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-236"><a href="tutors.html#"><span>About Us</span></a>
                                                                <ul class="sub-menu"><li id="menu-item-237" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-237"><a href="../about-style-1.html"><span>Style 1</span></a></li><li id="menu-item-238" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-238"><a href="../about-style-2.html"><span>Style 2</span></a></li></ul>
                                                            </li><li id="menu-item-115" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-115"><a href="tutors.html#"><span>Gallery</span></a>
                                                                <ul class="sub-menu"><li id="menu-item-118" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-118"><a href="../galllery-grid.html"><span>Grid</span></a></li><li id="menu-item-116" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-116"><a href="../gallery-cobbles.html"><span>Cobbles</span></a></li><li id="menu-item-117" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-117"><a href="../gallery-masonry.html"><span>Masonry</span></a></li></ul>
                                                            </li></ul>
                                                    </li><li id="menu-item-549" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-549"><a href="../shop.html"><span>Shop</span></a></li></ul>
                                            </li><li id="menu-item-164" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="../become-a-tutor.html"><span>Become a Tutor</span></a></li><li id="menu-item-119" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-119"><a href="tutors.html#"><span>News</span></a>

                                            </li><li id="menu-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165"><a href="../contacts.html"><span>Contacts</span></a></li></ul></nav>					<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
                                        <a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="tutors.html#">
                                            <span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.sc_layouts_row -->
                    </div><!-- /.content_wrap -->
                </div><!-- /.top_panel_navi -->

                <div class="top_panel_title sc_layouts_row">
                    <div class="content_wrap">
                        <div class="sc_layouts_column sc_layouts_column_align_center">
                            <div class="sc_layouts_item">
                                <div class="sc_layouts_title">
                                    <div class="sc_layouts_title_title">							<h1 class="sc_layouts_title_caption">All Tutors</h1>
                                    </div><div class="sc_layouts_title_breadcrumbs"><div class="breadcrumbs"><a class="breadcrumbs_item home" href="../smarthead_ancorathemes_default.html">Home</a><span class="breadcrumbs_delimiter"></span><span class="breadcrumbs_item current">All Tutors</span></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header><div class="menu_mobile_overlay"></div>
            <div class="menu_mobile menu_mobile_fullscreen scheme_dark">
                <div class="menu_mobile_inner">
                    <a class="menu_mobile_close icon-cancel"></a><a class="sc_layouts_logo" href="../smarthead_ancorathemes_default.html"><img src="../wp-content/uploads/2016/12/logotype.png"  width="440" height="90"></a><nav class="menu_mobile_nav_area "><ul id="menu_mobile" class=" menu_mobile_nav"><li id="menu_mobile-item-105" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-105"><a href="tutors.html#"><span>Home</span></a>
                                <ul class="sub-menu"><li id="menu_mobile-item-235" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-235"><a href="../smarthead_ancorathemes_default.html"><span>Home 1</span></a></li><li id="menu_mobile-item-234" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-234"><a href="../home-2.html"><span>Home 2</span></a></li><li id="menu_mobile-item-519" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-519"><a href="../home-3.html"><span>Home 3</span></a></li><li id="menu_mobile-item-518" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-518"><a href="../home-4.html"><span>Home 4</span></a></li></ul>
                            </li><li id="menu_mobile-item-106" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-106"><a href="tutors.html#"><span>Features</span></a>
                                <ul class="sub-menu"><li id="menu_mobile-item-107" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-107"><a href="tutors.html#"><span>Tools</span></a>
                                        <ul class="sub-menu"><li id="menu_mobile-item-112" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-112"><a href="../shortcodes.html"><span>Shortcodes</span></a></li><li id="menu_mobile-item-111" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-111"><a href="../typography.html"><span>Typography</span></a></li></ul>
                                    </li><li id="menu_mobile-item-113" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-113"><a href="tutors.html#"><span>Help</span></a>
                                        <ul class="sub-menu"><li id="menu_mobile-item-758" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-758"><a href="../service-plus.html"><span>Service Plus</span></a></li><li id="menu_mobile-item-759" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-759"><a href="../privacy-policy.html"><span>Privacy Policy</span></a></li></ul>
                                    </li><li id="menu_mobile-item-114" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-114"><a href="tutors.html#"><span>Pages</span></a>
                                        <ul class="sub-menu"><li id="menu_mobile-item-236" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-236"><a href="tutors.html#"><span>About Us</span></a>
                                                <ul class="sub-menu"><li id="menu_mobile-item-237" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-237"><a href="../about-style-1.html"><span>Style 1</span></a></li><li id="menu_mobile-item-238" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-238"><a href="../about-style-2.html"><span>Style 2</span></a></li></ul>
                                            </li><li id="menu_mobile-item-115" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-115"><a href="tutors.html#"><span>Gallery</span></a>
                                                <ul class="sub-menu"><li id="menu_mobile-item-118" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-118"><a href="../galllery-grid.html"><span>Grid</span></a></li><li id="menu_mobile-item-116" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-116"><a href="../gallery-cobbles.html"><span>Cobbles</span></a></li><li id="menu_mobile-item-117" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-117"><a href="../gallery-masonry.html"><span>Masonry</span></a></li></ul>
                                            </li></ul>
                                    </li><li id="menu_mobile-item-549" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-549"><a href="../shop.html"><span>Shop</span></a></li></ul>
                            </li><li id="menu_mobile-item-164" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="../become-a-tutor.html"><span>Become a Tutor</span></a></li><li id="menu_mobile-item-119" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-119"><a href="tutors.html#"><span>News</span></a>
                                <ul class="sub-menu"><li id="menu_mobile-item-123" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-123"><a href="../blog-streampage/blog-streampage.html"><span>Blog Streampage</span></a></li><li id="menu_mobile-item-120" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-120"><a href="tutors.html#"><span>Classic Style</span></a>
                                        <ul class="sub-menu"><li id="menu_mobile-item-122" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-122"><a href="../blog-classic-2-columns/blog-classic-2-columns.html"><span>2 Columns</span></a></li><li id="menu_mobile-item-121" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121"><a href="../blog-classic-3-columns/blog-classic-3-columns.html"><span>3 Columns</span></a></li></ul>
                                    </li><li id="menu_mobile-item-124" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-124"><a href="tutors.html#"><span>Chess Style</span></a>
                                        <ul class="sub-menu"><li id="menu_mobile-item-127" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-127"><a href="../blog-chess-2-columns/blog-chess-2-columns.html"><span>2 Columns</span></a></li><li id="menu_mobile-item-126" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-126"><a href="../blog-chess-4-columns/blog-chess-4-columns.html"><span>4 Columns</span></a></li><li id="menu_mobile-item-125" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-125"><a href="../blog-chess-6-columns/blog-chess-6-columns.html"><span>6 Columns</span></a></li></ul>
                                    </li></ul>
                            </li><li id="menu_mobile-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165"><a href="../contacts.html"><span>Contacts</span></a></li></ul></nav><div class="search_wrap search_style_normal search_mobile">
                        <div class="search_form_wrap">
                            <form role="search" method="get" class="search_form" action="../smarthead_ancorathemes_default.html">
                                <input type="text" class="search_field" placeholder="Search" value="" name="s">
                                <button type="submit" class="search_submit trx_addons_icon-search"></button>
                            </form>
                        </div>
                    </div><div class="socials_mobile"><span class="social_item"><a href="https://twitter.com/ancora_themes" target="_blank" class="social_icons social_twitter"><span class="trx_addons_icon-twitter"></span></a></span><span class="social_item"><a href="https://www.facebook.com/AncoraThemes/" target="_blank" class="social_icons social_facebook"><span class="trx_addons_icon-facebook"></span></a></span><span class="social_item"><a href="https://www.instagram.com/ancora_themes/" target="_blank" class="social_icons social_instagram"><span class="trx_addons_icon-instagram"></span></a></span><span class="social_item"><a href="https://dribbble.com/AncoraThemes" target="_blank" class="social_icons social_dribbble"><span class="trx_addons_icon-dribbble"></span></a></span></div>	</div>
            </div>

            <div class="page_content_wrap scheme_default">

                <div class="content_wrap">


                    <div class="tp-form-shortcode-wrap">
                        <div class="tp-form-header">
                            <h6 class="tp-form-title">Find Your</h6>
                            <h4 class="tp-form-title">Tutor</h4>
                        </div>
                        <div class="tp-form">
                            <form  action="{{url('search_location')}}" method="post"  >
                                @csrf
                                <input type="hidden" name="post_type" value="tutor" />
                                <input type="hidden" name="" value="" />
                                <select name="subject">
                                    <option value="All" selected>All Subjects</option>

                                    @foreach ($subjects as $records)
                                        <option value="{{$records->id}}" >{{$records->name}}</option>
                                    @endforeach

                                </select>

                                <input id="pac-input" type="text" name="location" placeholder="Enter a location">
                                <input type="text" id="lat" name="lat" value="" hidden>
                                <input type="text" id="lng" name="lng" value="" hidden>


                                <select name="groups">
                                    <option value="all" selected>All Groups</option>
                                    <option value="online">Online</option><option value="personal">Personal</option>
                                </select>
                                <div id="map" hidden></div>
                                <div class="tp-form-button">
                                    <button type="submit" value="">Find Now</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="content">




                        <div class="tp-columns-container">
                            @if (!empty($data))
                            @foreach ($data as $record)

                                <div class="tutor-plugin column-1-2" style="float:left;">

                                    <div id="post-577" class="post-577 tutor type-tutor status-publish has-post-thumbnail hentry tutor_group-online tutor_group-personal tutor_tag-biology tutor_tag-business-study tutor_tag-chemistry">
                                        <div class="tp-single tp-post">
                                            <div class="tp-featured">
                                                <img width="740" height="792" src="https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-740x792.jpg" class="attachment-tutor-archive size-tutor-archive wp-post-image" alt="" srcset="https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-740x792.jpg 740w, https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-280x300.jpg 280w, https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-370x397.jpg 370w" sizes="(max-width: 740px) 100vw, 740px" />                        <div class="tp-featured-overlay">
                                                    <div class="tp-price">
                                                        <span class="tp-present-price"> 24<span class="small">$</span>                                              </span>
                                                        <span class="tp-period-price">hour </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tp-content"><div class="tp-subjects"><span class="tp-tutor-subjects">{{$record->subject_name}}</span></div>
                                                <div class="tp-title">
                                                    <a class="tp-title-link" href="">{{$record->name}}</a>
                                                </div>
                                                <div class="tp-read-more">

                                                    <form   action="{{route('viewtutor')}}"  method="POST" >
                                                        @csrf

                                                        <input type="hidden" name="id" value="{{$record->id}}">
                                                        <button type="submit" class="tp-title-read-more sc_button_hover_slide_left" >View Tutor</button>

                                                    </form>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            @else
                            <h3>No Tutor Found </h3>
                            @endif
                        </div>

                    </div><!-- </.content> -->

                    <div class="sidebar left widget_area scheme_default" role="complementary">
                        <div class="sidebar_inner">
                            <aside id="tag_cloud-3" class="widget widget_tag_cloud"><h5 class="widget_title">Subjects</h5><div class="tagcloud">
                                    @if (!empty($data))
                                        @foreach ($data as $record)
                                    <a href="" class="tag-cloud-link tag-link-65 tag-link-position-1" style="font-size: 22pt;" aria-label="Architecture (2 items)">{{$record->subject_name}}</a>
                                    @endforeach
                                    @else
                                        <p>No Tutor Found </p>
                                    @endif

                                </div>
                            </aside><aside id="categories-3" class="widget widget_categories"><h5 class="widget_title">Categories</h5>		<ul>
                                    <li class="cat-item cat-item-10"><a href="../category/distance-learning/distance-learning.html">Distance Learning</a>
                                    </li>
                                    <li class="cat-item cat-item-7"><a href="../category/lesson-planning/lesson-planning.html">Lesson Planning</a>
                                    </li>
                                    <li class="cat-item cat-item-8"><a href="../category/online-tutoring/online-tutoring.html">Online Tutoring</a>
                                    </li>
                                    <li class="cat-item cat-item-9"><a href="../category/resources/resources.html">Resources</a>
                                    </li>
                                    <li class="cat-item cat-item-6"><a href="../category/tutoring/tutoring.html">Tutoring</a>
                                    </li>
                                </ul>

                            </aside>




                        </div><!-- /.sidebar_inner -->
                    </div><!-- /.sidebar -->
                </div><!-- </.content_wrap> -->			</div><!-- </.page_content_wrap> -->


