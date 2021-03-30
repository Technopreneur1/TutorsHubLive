@extends('layouts.master1')
@section('title')
    Home
@endsection
@section('styles')
<link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
<style>
@media screen and (max-width: 600px) {
    .top_panel_top{
        display: none;
    }
}

</style>
@endsection
@section('content')


    <body  class="home page-template-default page page-id-219 theme-smarthead frontpage woocommerce-no-js body_tag scheme_default blog_mode_home body_style_wide  is_stream blog_style_excerpt sidebar_hide expand_content header_style_header-default header_position_over menu_style_top no_layout wpb-js-composer js-comp-ver-6.1 vc_responsive">


    <div class="body_wrap">

        <div class="page_wrap">

            <header class="top_panel top_panel_default without_bg_image header-dark scheme_default">    <div class="top_panel_top">
                    <div class="content_wrap" style="padding:10px;">
                        <div class="custom_button_language">
                        </div>
                        <a href="{{route('login')}}" class=" trx_addons_login_link ">
                            <span class="sc_layouts_item_icon sc_layouts_login_icon trx_addons_icon-user-alt"></span>
                            <span class="sc_layouts_item_details sc_layouts_login_details login-btn-n"> Login <i class="fas fa-sign-in-alt"></i></span>
                        </a>
                    </div>
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
                                            <li id="menu-item-119" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-119"><a href="#news"><span>News</span></a></li>
                                            <li id="menu-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165"><a href="https://tutors-hub.com/contact"><span>Contact Us</span></a></li></ul>

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
                </div><!-- /.top_panel_navi -->
            </header>
            <div class="menu_mobile_overlay"></div>
            <div class="menu_mobile menu_mobile_fullscreen scheme_dark">
                <div class="menu_mobile_inner">
                    <a class="menu_mobile_close icon-cancel"></a><a class="sc_layouts_logo" href="#"><img src="{{url('wp-content/uploads/2016/12/logotxt.png')}}"  width="440" height="90"></a>
                    <nav class="menu_mobile_nav_area ">
                        <ul id="menu_mobile" class=" menu_mobile_nav">
                            <li id="menu_mobile-item-105" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-105"><a href="https://tutors-hub.com/"><span>Home</span></a>
                            <li id="menu_mobile-item-548" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-548"><a href="https://tutors-hub.com/student-registration"><span>Find a Tutor</span></a></li>
                            <li id="menu_mobile-item-164" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="https://tutors-hub.com/teacher-registration"><span>Become a Tutor</span></a></li>
                            <li id="menu_mobile-item-164" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="{{route('login')}}"><span>Login</span></a></li>
                            <li id="menu_mobile-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165"><a href="https://tutors-hub.com/contacts/"><span>Contact Us</span></a></li>
                        </ul>
                    </nav>
                   <div class="socials_mobile"><span class="social_item"><a href="twitter.com" target="_blank" class="social_icons social_twitter"><span class="trx_addons_icon-twitter"></span></a></span><span class="social_item"><a href="https://www.facebook.com/AncoraThemes/" target="_blank" class="social_icons social_facebook"><span class="trx_addons_icon-facebook"></span></a></span><span class="social_item"><a href="https://www.instagram.com/ancora_themes/" target="_blank" class="social_icons social_instagram"><span class="trx_addons_icon-instagram"></span></a></span><span class="social_item"><a href="https://dribbble.com/AncoraThemes" target="_blank" class="social_icons social_dribbble"><span class="trx_addons_icon-dribbble"></span></a></span></div>	</div>
            </div>

            <div class="page_content_wrap scheme_default">

                <div class="content_wrap">



                    <div class="content">


                        <article id="post-219" class="post_item_single post_type_page post-219 page type-page status-publish hentry">


                            <div class="post_content entry-content">
                                <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid vc_custom_1485445769518 vc_row-has-fill vc_row-no-padding special_class_1"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="wpb_revslider_element wpb_content_element">
                                                    <!-- START Home 1 REVOLUTION SLIDER 6.1.7 --><p class="rs-p-wp-fix"></p>
                                                    <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery" style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;max-width:">
                                                        <rs-module id="rev_slider_1_1" style="display:none;" data-version="6.1.7">
                                                            <rs-slides>
                                                                <rs-slide data-key="rs-1" data-title="Slide" data-thumb="/wp-content/uploads/2017/01/slide1.jpg" data-anim="ei:d;eo:d;s:600;r:0;t:fade;sl:d;" data-firstanim="t:fade;s:1500;sl:7;">
                                                                    <img src="/wp-content/uploads/2017/01/slide1.jpg" title="Home 1" data-lazyload="/wp-content/uploads/2017/01/slide1.jpg" data-parallax="10" class="rev-slidebg" data-no-retina>
                                                                    <!--
                                                                                                --><rs-layer
                                                                        id="slider-1-slide-1-layer-1"
                                                                        class="slider-small-text"
                                                                        data-type="text"
                                                                        data-color="rgba(255, 255, 255, 1)"
                                                                        data-xy="x:c;y:c;yo:-73px;"
                                                                        data-text="s:22;l:28;a:inherit;"
                                                                        data-vbility="t,t,t,f"
                                                                        data-layeronlimit="on"
                                                                        data-frame_0="o:1;tp:600;"
                                                                        data-frame_0_chars="x:-105%;o:1;rX:0deg;rY:0deg;rZ:-90deg;"
                                                                        data-frame_0_mask="u:t;"
                                                                        data-frame_1="tp:600;e:Power4.easeInOut;st:660;sp:1000;sR:660;"
                                                                        data-frame_1_chars="d:10;"
                                                                        data-frame_1_mask="u:t;"
                                                                        data-frame_999="o:0;tp:600;st:w;sR:5340;"
                                                                        style="z-index:5;font-family:Sanchez;"
                                                                    >In-Person & Online Tutors
                                                                    </rs-layer><!--

							--><rs-layer
                                                                        id="slider-1-slide-1-layer-2"
                                                                        data-type="text"
                                                                        data-color="rgba(255, 255, 255, 1)"
                                                                        data-xy="x:c;y:c;yo:-15px;"
                                                                        data-text="s:90;l:108;a:inherit;"
                                                                        data-vbility="t,t,t,f"
                                                                        data-layeronlimit="on"
                                                                        data-frame_0="o:1;tp:600;"
                                                                        data-frame_0_chars="x:-105%;o:1;rX:0deg;rY:0deg;rZ:-90deg;"
                                                                        data-frame_0_mask="u:t;"
                                                                        data-frame_1="tp:600;e:Power4.easeInOut;sp:1500;sR:10;"
                                                                        data-frame_1_chars="d:10;"
                                                                        data-frame_1_mask="u:t;"
                                                                        data-frame_999="o:0;tp:600;st:w;sR:5990;"
                                                                        style="z-index:6;font-family:Sanchez;"
                                                                    >Find a Tutor Near You

                                                                    </rs-layer><!--

							--><rs-layer
                                                                        id="slider-1-slide-1-layer-3"
                                                                        data-type="text"
                                                                        data-color="rgba(255, 255, 255, 1)"
                                                                        data-xy="x:c;y:c;yo:95px;"
                                                                        data-text="l:22;a:inherit;"
                                                                        data-frame_0="sX:0.8;sY:0.8;tp:600;"
                                                                        data-frame_1="tp:600;e:Power4.easeOut;st:3770;sp:1000;sR:3770;"
                                                                        data-frame_999="o:0;tp:600;st:w;sR:4230;"
                                                                        style="z-index:7;font-family:Open Sans;"
                                                                    ><div class="sc_item_button sc_button_wrap"><a href="https://tutors-hub.com/student-registration" id="sc_button_212681052" class="sc_button sc_button_default sc_button_icon_left"><span class="sc_button_text"><span class="sc_button_title">FIND A TUTOR
</span></span><!-- /.sc_button_text --></a><a href="https://tutors-hub.com/teacher-registration" id="sc_button_212681052" class="sc_button sc_button_default sc_button_icon_left"><span class="sc_button_text"><span class="sc_button_title">BECOME A TUTOR
</span></span><!-- /.sc_button_text --></a><!-- /.sc_button --></div><!-- /.sc_item_button -->
                                                                    </rs-layer><!--
-->						</rs-slide>
                                                                <rs-slide data-key="rs-4" data-title="Slide" data-thumb="{{url('wp-content/uploads/2017/01/slide3.jpg')}}" data-anim="ei:d;eo:d;s:600;r:0;t:fade;sl:d;">
                                                                    <img src="{{url('wp-content/uploads/2017/01/slide3.jpg')}}" title="Home 1" data-lazyload="{{url('wp-content/uploads/2017/01/slide3.jpg')}}" data-parallax="10" class="rev-slidebg" data-no-retina>
                                                                    <!--
                                                                                                --><rs-layer
                                                                        id="slider-1-slide-4-layer-1"
                                                                        class="slider-small-text"
                                                                        data-type="text"
                                                                        data-color="rgba(255, 255, 255, 1)"
                                                                        data-xy="x:c;y:c;yo:-73px;"
                                                                        data-text="s:22;l:28;a:inherit;"
                                                                        data-vbility="t,t,t,f"
                                                                        data-layeronlimit="on"
                                                                        data-frame_0="o:1;tp:600;"
                                                                        data-frame_0_chars="x:-105%;o:1;rX:0deg;rY:0deg;rZ:-90deg;"
                                                                        data-frame_0_mask="u:t;"
                                                                        data-frame_1="tp:600;e:Power4.easeInOut;st:660;sp:1000;sR:660;"
                                                                        data-frame_1_chars="d:10;"
                                                                        data-frame_1_mask="u:t;"
                                                                        data-frame_999="o:0;tp:600;st:w;sR:5340;"
                                                                        style="z-index:5;font-family:Sanchez;"
                                                                    >In-Person & Online Tutors
                                                                    </rs-layer><!--

							--><rs-layer
                                                                        id="slider-1-slide-4-layer-2"
                                                                        data-type="text"
                                                                        data-color="rgba(255, 255, 255, 1)"
                                                                        data-xy="x:c;xo:1px;y:c;yo:-14px;"
                                                                        data-text="s:90;l:108;a:inherit;"
                                                                        data-vbility="t,t,t,f"
                                                                        data-layeronlimit="on"
                                                                        data-frame_0="o:1;tp:600;"
                                                                        data-frame_0_chars="x:-105%;o:1;rX:0deg;rY:0deg;rZ:-90deg;"
                                                                        data-frame_0_mask="u:t;"
                                                                        data-frame_1="tp:600;e:Power4.easeInOut;sp:1500;sR:10;"
                                                                        data-frame_1_chars="d:10;"
                                                                        data-frame_1_mask="u:t;"
                                                                        data-frame_999="o:0;tp:600;st:w;sR:6490;"
                                                                        style="z-index:6;font-family:Sanchez;"
                                                                    >Find a Tutor Near You
                                                                    </rs-layer><!--

							--><rs-layer
                                                                        id="slider-1-slide-4-layer-3"
                                                                        data-type="text"
                                                                        data-color="rgba(255, 255, 255, 1)"
                                                                        data-xy="x:c;y:c;yo:95px;"
                                                                        data-text="l:22;a:inherit;"
                                                                        data-frame_0="sX:0.8;sY:0.8;tp:600;"
                                                                        data-frame_1="tp:600;e:Power4.easeOut;st:3770;sp:1000;sR:3770;"
                                                                        data-frame_999="o:0;tp:600;st:w;sR:4230;"
                                                                        style="z-index:7;font-family:Open Sans;"
                                                                    ><div class="sc_item_button sc_button_wrap"><a href="/tutors/" id="sc_button_398409179" class="sc_button sc_button_default sc_button_icon_left"><span class="sc_button_text"><span class="sc_button_title">FIND A TUTOR
</span></span><!-- /.sc_button_text --></a><a href="https://tutors-hub.com/teacher-registration" id="sc_button_212681052" class="sc_button sc_button_default sc_button_icon_left"><span class="sc_button_text"><span class="sc_button_title">BECOME A TUTOR
</span></span><!-- /.sc_button_text --></a><!-- /.sc_button --></div><!-- /.sc_item_button -->
                                                                    </rs-layer><!--
-->						</rs-slide>
                                                                <rs-slide data-key="rs-3" data-title="Slide" data-thumb="wp-content/uploads/2017/01/slide3.jpg" data-anim="ei:d;eo:d;s:600;r:0;t:fade;sl:d;">
                                                                    <img src="{{url('wp-content/uploads/2017/01/slide3.jpg')}}" title="Home 1" data-lazyload="wp-content/uploads/2017/01/slide3.jpg" data-parallax="10" class="rev-slidebg" data-no-retina>
                                                                    <!--
                                                                                                --><rs-layer
                                                                        id="slider-1-slide-3-layer-1"
                                                                        class="slider-small-text"
                                                                        data-type="text"
                                                                        data-color="rgba(255, 255, 255, 1)"
                                                                        data-xy="x:c;y:c;yo:-73px;"
                                                                        data-text="s:22;l:28;a:inherit;"
                                                                        data-vbility="t,t,t,f"
                                                                        data-layeronlimit="on"
                                                                        data-frame_0="o:1;tp:600;"
                                                                        data-frame_0_chars="x:-105%;o:1;rX:0deg;rY:0deg;rZ:-90deg;"
                                                                        data-frame_0_mask="u:t;"
                                                                        data-frame_1="tp:600;e:Power4.easeInOut;st:660;sp:1000;sR:660;"
                                                                        data-frame_1_chars="d:10;"
                                                                        data-frame_1_mask="u:t;"
                                                                        data-frame_999="o:0;tp:600;st:w;sR:5340;"
                                                                        style="z-index:5;font-family:Sanchez;"
                                                                    >In-Person & Online Tutors
                                                                    </rs-layer><!--

							--><rs-layer
                                                                        id="slider-1-slide-3-layer-2"
                                                                        data-type="text"
                                                                        data-color="rgba(255, 255, 255, 1)"
                                                                        data-xy="x:c;xo:1px;y:c;yo:-15px;"
                                                                        data-text="s:90;l:108;a:inherit;"
                                                                        data-vbility="t,t,t,f"
                                                                        data-layeronlimit="on"
                                                                        data-frame_0="o:1;tp:600;"
                                                                        data-frame_0_chars="x:-105%;o:1;rX:0deg;rY:0deg;rZ:-90deg;"
                                                                        data-frame_0_mask="u:t;"
                                                                        data-frame_1="tp:600;e:Power4.easeInOut;sp:1500;sR:10;"
                                                                        data-frame_1_chars="d:10;"
                                                                        data-frame_1_mask="u:t;"
                                                                        data-frame_999="o:0;tp:600;st:w;sR:5790;"
                                                                        style="z-index:6;font-family:Sanchez;"
                                                                    >Find a Tutor Near You
                                                                    </rs-layer><!--

							--><rs-layer
                            id="slider-1-slide-1-layer-3"
                            data-type="text"
                            data-color="rgba(255, 255, 255, 1)"
                            data-xy="x:c;y:c;yo:95px;"
                            data-text="l:22;a:inherit;"
                            data-frame_0="sX:0.8;sY:0.8;tp:600;"
                            data-frame_1="tp:600;e:Power4.easeOut;st:3770;sp:1000;sR:3770;"
                            data-frame_999="o:0;tp:600;st:w;sR:4230;"
                            style="z-index:7;font-family:Open Sans;"
                        ><div class="sc_item_button sc_button_wrap"><a href="https://tutors-hub.com/student-registration" id="sc_button_212681052" class="sc_button sc_button_default sc_button_icon_left"><span class="sc_button_text"><span class="sc_button_title">FIND A TUTOR
</span></span><!-- /.sc_button_text --></a><a href="https://tutors-hub.com/teacher-registration" id="sc_button_212681052" class="sc_button sc_button_default sc_button_icon_left"><span class="sc_button_text"><span class="sc_button_title">BECOME A TUTOR
</span></span><!-- /.sc_button_text --></a><!-- /.sc_button --></div><!-- /.sc_item_button -->
                        </rs-layer><!--
-->						</rs-slide>
                                                            </rs-slides>
                                                            <rs-progress class="rs-bottom" style="visibility: hidden !important;"></rs-progress>
                                                        </rs-module>
                                                        <script type="text/javascript">
                                                            setREVStartSize({c: 'rev_slider_1_1',rl:[1240,1024,778,480],el:[890],gw:[1900],gh:[890],type:'standard',justify:'',layout:'fullwidth',mh:"0"});
                                                            var	revapi1,
                                                                tpj;
                                                            jQuery(function() {
                                                                tpj = jQuery;
                                                                if(tpj("#rev_slider_1_1").revolution == undefined){
                                                                    revslider_showDoubleJqueryError("#rev_slider_1_1");
                                                                }else{
                                                                    revapi1 = tpj("#rev_slider_1_1").show().revolution({
                                                                        jsFileLocation:"//smarthead.ancorathemes.com/wp-content/plugins/revslider/public/assets/js/",
                                                                        visibilityLevels:"1240,1024,778,480",
                                                                        gridwidth:1900,
                                                                        gridheight:890,
                                                                        hideLayerAtLimit:669,
                                                                        lazyType:"smart",
                                                                        editorheight:"890,690,600,400",
                                                                        responsiveLevels:"1240,1024,778,480",
                                                                        disableProgressBar:"on",
                                                                        navigation: {
                                                                            mouseScrollNavigation:false,
                                                                            onHoverStop:false,
                                                                            touch: {
                                                                                touchenabled:true,
                                                                                swipe_min_touches:50
                                                                            },
                                                                            bullets: {
                                                                                enable:true,
                                                                                tmp:"",
                                                                                style:"hephaistos",
                                                                                hide_onmobile:true,
                                                                                hide_under:600,
                                                                                h_align:"left",
                                                                                h_offset:56,
                                                                                v_offset:112,
                                                                                direction:"vertical",
                                                                                space:25
                                                                            }
                                                                        },
                                                                        parallax: {
                                                                            levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
                                                                            type:"mouse",
                                                                            origo:"slidercenter",
                                                                            speed:2000
                                                                        },
                                                                        fallbacks: {
                                                                            allowHTML5AutoPlayOnAndroid:true
                                                                        },
                                                                    });
                                                                }

                                                            });
                                                        </script>
                                                        <script>
                                                            var htmlDivCss = unescape("%23rev_slider_1_1_wrapper%20.hephaistos%20.tp-bullet%20%7B%0A%09width%3A7px%3B%0A%09height%3A7px%3B%0A%09position%3Aabsolute%3B%0A%09background%3A%23999999%3B%0A%09border%3A0px%20solid%20rgba%28255%2C255%2C255%2C0.9%29%3B%0A%09border-radius%3A50%25%3B%0A%09cursor%3A%20pointer%3B%0A%09box-sizing%3Acontent-box%3B%0A%20%20%20%20box-shadow%3A%200px%200px%202px%201px%20rgba%28130%2C130%2C130%2C%200.3%29%3B%0A%7D%0A%23rev_slider_1_1_wrapper%20.hephaistos%20.tp-bullet%3Ahover%2C%0A%23rev_slider_1_1_wrapper%20.hephaistos%20.tp-bullet.selected%20%7B%0A%09background%3A%23ffffff%3B%0A%20%20%20%20border-color%3A%23000000%3B%0A%7D%0A");
                                                            var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
                                                            if(htmlDiv) {
                                                                htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                                            }else{
                                                                var htmlDiv = document.createElement('div');
                                                                htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
                                                                document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
                                                            }
                                                        </script>
                                                        <script>
                                                            var htmlDivCss = unescape("%23rev_slider_1_1%5Bdata-slideactive%3D%22rs-1%22%5D%20.hephaistos%20.tp-bullet%7B%0Awidth%3A%207px%20%21important%3B%0Aheight%3A%207px%20%21important%3B%0Aborder%3A%200px%20solid%20rgba%28255%2C255%2C255%2C0.9%29%20%21important%3B%0A%7D%0A%0A%0A%0A");
                                                            var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
                                                            if(htmlDiv) {
                                                                htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                                            }else{
                                                                var htmlDiv = document.createElement('div');
                                                                htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
                                                                document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
                                                            }
                                                        </script>
                                                    </rs-module-wrap>
                                                    <!-- END REVOLUTION SLIDER -->
                                                </div><div class="vc_row wpb_row vc_inner vc_row-fluid special_class_2"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                                <div class="tp-form-shortcode-wrap">

                                                                </div>
                                                                </div></div></div></div></div></div></div></div><div class="vc_row-full-width vc_clearfix"></div><div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1485445777014 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner"><div class="wpb_wrapper"><div id="sc_title_2054305088"

                                                                                                                                                                                                                                                                                                                                                                                                                                                                  class="sc_title sc_title_default  vc_custom_1484220986265"><h6 class="sc_item_subtitle sc_title_subtitle sc_align_default sc_item_title_style_default clr-green">Find the best tutors around you</h6><h2 class="sc_item_title sc_title_title sc_align_default sc_item_title_style_default">Find tutors and message them directly
                                                    </h2></div><!-- /.sc_title --><div  id="sc_promo_1988157650"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              class="sc_promo sc_promo_default sc_promo_size_normal sc_promo_no_paddings sc_promo_image_position_right"><div class="sc_promo_image" style="background-image:url(https://smarthead.ancorathemes.com/wp-content/uploads/2016/12/photo11.jpg);width:51%;right: 0;"></div>
                                                    <a href="{{ $settings ? ($settings->videoURL ? : '') : '' }}" class="sc_promo_link_on_image" target="_target">View Our Video Presentation<span class="icon-play"></span></a>
                                                    <div class="sc_promo_text" style="width: 49%;float: left;">
                                                        <div class="sc_promo_text_inner" style=""><h6 class="sc_item_subtitle sc_promo_subtitle sc_align_left sc_item_title_style_default">Most Popular</h6><h3 class="sc_item_title sc_promo_title sc_align_left sc_item_title_style_default">Trending Subjects</h3><div class="sc_promo_content sc_item_content"><div  class="vc_wp_custommenu wpb_content_element columns-2"><div class="widget widget_nav_menu"><div class="menu-subjects-container"><ul id="menu-subjects" class="menu"><li id="menu-item-174" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-174">Mathematics</li>
                                                                                <?php $count = 1; ?>
                                                                                @foreach ($subjects as $records)
                                                                                    <?php if($count == 14) break; ?>
                                                                                    <li id="menu-item-175" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-175">{{$records->name}}</li>
                                                                                        <?php $count++; ?>
                                                                                @endforeach
                                                                             </ul></div></div></div></div>


                                                            <!-- /.sc_item_button sc_item_button_default sc_promo_button sc_align_left --></div>
                                                    </div><!-- /.sc_promo_text --></div><!-- /.sc_promo --></div></div></div></div><div class="vc_row-full-width vc_clearfix"></div><div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1484230061946 vc_row-has-fill inverse_colors special_class_1"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="sc_services sc_services_iconed" data-slides-per-view="3" data-slides-min-width="250"		>
                                                    <h6 class="sc_item_subtitle sc_services_subtitle sc_align_default sc_item_title_style_default"></h6>
                                                    <h2 class="sc_item_title sc_services_title sc_align_default sc_item_title_style_default">Find the right tutors for you</h2>
                                                    <div class="sc_services_columns sc_item_columns sc_item_columns_3 trx_addons_columns_wrap columns_padding_bottom">
                                                        <div class="trx_addons_column-1_3 "><div class="sc_services_item with_content with_icon sc_services_item_featured_top">
                                                                <div class="sc_services_item_header">
                                                                    <a href="#"
                                                                        class="sc_services_item_icon icon-prof"
                                                                    ></a>	</div>
                                                                <div class="sc_services_item_content">
                                                                    <h6 class="sc_services_item_title">Professional Tutors</h6>
                                                                    <div class="sc_services_item_subtitle"><a href="#" title="View all posts in Guarantee">Guarantee</a></div>
                                                                    <div class="sc_services_item_text"><p>We screen and interview our tutors. We strive to provide a safe, friendly and professional environment.
                                                                        </p>
                                                                    </div>
                                                                    <div class="sc_services_item_button sc_item_button"><a href="#" class="sc_button sc_button_simple">Learn more</a></div>
                                                                </div>
                                                            </div>
                                                        </div><div class="trx_addons_column-1_3 "><div class="sc_services_item with_content with_icon sc_services_item_featured_top">
                                                                <div class="sc_services_item_header">
                                                                    <a href="#"
                                                                       class="sc_services_item_icon icon-real-results"
                                                                    ></a>	</div>
                                                                <div class="sc_services_item_content">
                                                                   <h6 class="sc_services_item_title">Talent and Expertise</h6>
                                                                    <div class="sc_services_item_subtitle"><a href="#" title="View all posts in Guarantee">Guarantee</a></div>
                                                                    <div class="sc_services_item_text"><p>Native speakers and experienced teachers at your service to help you improve your language skills and
                                                                            succeed in you exams (Math, MCAT...).
                                                                        </p>
                                                                    </div>
                                                                    <div class="sc_services_item_button sc_item_button"><a href="#" class="sc_button sc_button_simple">Learn more</a></div>
                                                                </div>
                                                            </div>
                                                        </div><div class="trx_addons_column-1_3 "><div class="sc_services_item with_content with_icon sc_services_item_featured_top">
                                                                <div class="sc_services_item_header">
                                                                    <a href="#"
                                                                       class="sc_services_item_icon icon-university"
                                                                    ></a>	</div>
                                                                <div class="sc_services_item_content">
                                                                   <h6 class="sc_services_item_title">Flexible & No Commitment</h6>
                                                                    <div class="sc_services_item_subtitle"><a href="#" title="View all posts in Guarantee">Guarantee</a></div>
                                                                    <div class="sc_services_item_text"><p>Chose the right tutor for you, who will work according to your pace and your schedule.
                                                                        </p>
                                                                    </div>
                                                                    <div class="sc_services_item_button sc_item_button"><a href="#" class="sc_button sc_button_simple">Learn more</a></div>
                                                                </div>
                                                            </div>
                                                        </div></div></div><!-- /.sc_services --><div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1484143305148 vc_row-has-fill special_class_3"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                                <div class="wpb_text_column wpb_content_element  special_class_4" >
                                                                    <div class="wpb_wrapper">
                                                                        <p><span class="title-1">INTERACTIVE PLATFORM</span><br />
                                                                            <span class="title-2">Interact with any tutor you want</span><br />
                                                                            Ask them questions and get to know them before you hire them.
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            </div></div></div></div></div></div></div></div>



                                <div class="vc_row-full-width vc_clearfix"></div>


                                <div class="vc_row wpb_row vc_row-fluid vc_custom_1484220977347"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner vc_custom_1486382076421"><div class="wpb_wrapper"><div id="sc_title_1914006197"
                                                <div class="tp-container" data-slides="3">
                                                    <div class="tp-columns-container">
                                                        <?php $count = 0; ?>
                                                    @foreach($teachers as $teacher)

                                                                <?php if($count == 3) break; ?>
                                                                <div class="tutor-plugin column-1-3" style="float: left;">
                                                            <div id="post-572" class="post-572 tutor type-tutor status-publish has-post-thumbnail hentry tutor_group-personal tutor_tag-chemistry tutor_tag-coding tutor_tag-communication">
                                                                <div class="tp-single tp-post">
                                                                    <div class="tp-featured">
                                                                        @if(isset($teacher->avatar))
                                                                        <img width="740" height="792" src="https://tutors-hub.com/storage/images/{{$teacher->avatar}}" class="attachment-tutor-archive size-tutor-archive wp-post-image" alt="" srcset="https://tutors-hub.com/storage/images/{{$teacher->avatar}} 740w, https://tutors-hub.com/storage/images/{{$teacher->avatar}} 280w, https://tutors-hub.com/storage/images/{{$teacher->avatar}} 370w" sizes="(max-width: 740px) 100vw, 740px" />                            <div class="tp-featured-overlay">
                                                                         @else
                                                                                    <img width="740" height="792" src="https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-740x792.jpg" class="attachment-tutor-archive size-tutor-archive wp-post-image" alt="" srcset="https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-740x792.jpg 740w, https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-280x300.jpg 280w, https://tutors-hub.com/wp-content/uploads/2016/11/tutor7-370x397.jpg 370w" sizes="(max-width: 740px) 100vw, 740px" />                        <div class="tp-featured-overlay">
                                                                           @endif
                                                                            <div class="tp-price">
                                                                                <span class="tp-present-price"><span class="small">$</span>{{$teacher->rate}}                                            </span>
                                                                                <span class="tp-period-price">hour</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tp-content"><div class="tp-subjects"><p class="tp-tutor-subjects">{{$teacher->subject_name}}</p> </div>
                                                                        <div class="tp-title">
                                                                            <p class="tp-title-link">{{$teacher->name}}</p>
                                                                        </div>
                                                                        <div class="tp-read-more">
                                                                            <form   action="{{route('viewtutor')}}"  method="POST" >
                                                                                @csrf

                                                                                <input type="hidden" name="availability" value="{{$teacher->availability}}">
                                                                                <input type="hidden" name="id" value="{{$teacher->id}}">
                                                                                <input type="hidden" name="name" value="{{$teacher->name}}">
                                                                                <input type="hidden" name="subject" value="{{$teacher->subject_name}}">
                                                                                <input type="hidden" name="rate" value="{{$teacher->rate}}">
                                                                                <input type="hidden" name="avatar" value="{{$teacher->avatar}}">
                                                                                <input type="hidden" name="created_at" value="{{$teacher->created_at}}">
                                                                                <input type="hidden" name="bio" value="{{$teacher->bio}}">
                                                                                <button type="submit" class="tp-title-read-more sc_button_hover_slide_left" name="form-{{$teacher->id}}">View Tutor</button>
                                                                            </form>                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div></div>
                                                                    <?php $count++; ?>

                                                        @endforeach
                                                      </div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                          <div  id="sc_action_1338897222" class="sc_action sc_action_simple  vc_custom_1495537959265" data-slides-min-width="250">
                                                              <div class="sc_action_content sc_item_content">
                                                              <div class="sc_action_item sc_action_item_simple sc_action_item_ml">
                                                            <h3 class="sc_action_item_title"><span>Want to become a tutor at Tutors-Hub</span><span>?</span></h3><div class="sc_action_item_description"><span>Tutors-Hub collaborates  with professional and talented tutors from all over the world! Join us right now!</span></div>
                                                            <a href="https://tutors-hub.com/teacher-registration" class="sc_action_item_link">register now</a></div></div></div><!-- /.sc_action --></div></div></div></div><div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1485435081882 vc_row-has-fill inverse_colors"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner"><div class="wpb_wrapper"><div id="sc_content_729558933"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  class="sc_content sc_content_default sc_align_center"><div class="sc_content_container"><div  id="sc_action_839234"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                class="sc_action sc_action_default" data-slides-min-width="250"	><div class="sc_action_content sc_item_content"><div class="sc_action_item sc_action_item_default sc_action_item_mc">
                                                                    <h6 class="sc_action_item_subtitle"><span>Call Us <a href="tel:289-901-4000">{{ $settings ? $settings->contact_number : '' }}</a></span></h6><h3 class="sc_action_item_title"><span>Do You Need Help?</span></h3><div class="sc_action_item_description"><span>Our specialists can help you find the right tutor for you or your kids</span></div><a href="https://tutors-hub.com/contact" class="sc_action_item_link">CONTACT US NOW</a></div></div></div><!-- /.sc_action --></div></div><!-- /.sc_content --></div></div></div></div><div class="vc_row-full-width vc_clearfix"></div><div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1484231990562 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner"><div class="wpb_wrapper"><div id="sc_title_225094306"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          class="sc_title sc_title_default  vc_custom_1484231980126"><h6 class="sc_item_subtitle sc_title_subtitle sc_align_default sc_item_title_style_default"><span style="color: #aece61;">Enjoy Online or In-Person Lessons with Tutors</span></h6><h2 class="">Online Lessons & <span style="color: #aece61;">In-Person Lessons</span></h2></div><!-- /.sc_title --><div  id="sc_promo_418702708"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              class="sc_promo sc_promo_default sc_promo_size_normal sc_promo_no_paddings sc_promo_image_position_left"><div class="sc_promo_image" style="background-image:url(https://smarthead.ancorathemes.com/wp-content/uploads/2016/12/promo-bg-2.jpg);width:51%;left: 0;"></div><div class="sc_promo_text" style="width: 49%;float: right;">
                                                        <div class="sc_promo_text_inner" style=""><h6 class="sc_item_subtitle sc_promo_subtitle sc_align_left sc_item_title_style_default">Your needs are too specific? Don’t worry!</h6><h3 class="sc_item_title sc_promo_title sc_align_left sc_item_title_style_default">Post an Add</h3><div class="sc_promo_content sc_item_content">
                                                                <div class="wpb_text_column wpb_content_element " >
                                                                    <div class="wpb_wrapper">
                                                                        <p>
                                                                            The tutors in your area will see your request and will contact you directly.
                                                                            You will then chose the right fit for you needs.
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                                <div style="display: none;" id="sc_skills_1022454968"
                                                                     class="sc_skills sc_skills_counter  vc_custom_1484232663769"
                                                                     data-type="counter"
                                                                ><div class="sc_skills_columns sc_item_columns trx_addons_columns_wrap columns_padding_bottom"><div class="sc_skills_column trx_addons_column-1_3"><div class="sc_skills_item_wrap"><div class="sc_skills_item"><div class="sc_skills_total" data-start="0" data-stop="50000" data-step="550" data-max="55000" data-speed="22" data-duration="2000" data-ed="">0</div></div><div class="sc_skills_item_title">Great Tutors</div></div></div><div class="sc_skills_column trx_addons_column-1_3"><div class="sc_skills_item_wrap"><div class="sc_skills_item"><div class="sc_skills_total" data-start="0" data-stop="52100" data-step="550" data-max="55000" data-speed="35" data-duration="3315" data-ed="">0</div></div><div class="sc_skills_item_title">Clever Students</div></div></div><div class="sc_skills_column trx_addons_column-1_3"><div class="sc_skills_item_wrap"><div class="sc_skills_item"><div class="sc_skills_total" data-start="0" data-stop="3900" data-step="550" data-max="55000" data-speed="20" data-duration="142" data-ed="">0</div></div><div class="sc_skills_item_title">World&#039;s Cities</div></div></div></div></div></div></div>
                                                    </div><!-- /.sc_promo_text --></div><!-- /.sc_promo --></div></div></div></div>
                                <div class="vc_row-full-width vc_clearfix"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1484233720219 vc_row-has-fill inverse_colors" style="display:none;"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left"><div class="vc_column-inner">
                                            <div class="wpb_wrapper">
                                                <div id="sc_title_477591769"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        class="sc_title sc_title_default  vc_custom_1484315074540"><h6 class="sc_item_subtitle sc_title_subtitle sc_align_default sc_item_title_style_default">Happy Clients Said About Our Service</h6><h2 class="sc_item_title sc_title_title sc_align_default sc_item_title_style_default">Our Testimonials</h2>
                                                </div><!-- /.sc_title -->
                                                <div class="sc_testimonials sc_testimonials_default swiper-slider-container slider_swiper slider_noresize slider_nocontrols slider_pagination" data-slides-per-view="2" data-slides-space="30" data-slides-min-width="150"		>
                                                    <div class="sc_testimonials_slider sc_item_slider slides swiper-wrapper">
                                                        @foreach ($testimonials as $testimonial)
                                                        <div class="swiper-slide">
                                                            <div class="sc_testimonials_item">
                                                                <div class="sc_testimonials_item_content"><h5>“{{$testimonial->title}}”</h5>
                                                                    <p>{{$testimonial->comment}}</p>
                                                                </div>
                                                                <div class="sc_testimonials_item_author">
                                                                    <div class="sc_testimonials_item_author_avatar"><img width="222" height="222" src="/wp-content/uploads/2016/12/testimo.jpg" class="attachment-smarthead-thumb-tiny size-smarthead-thumb-tiny wp-post-image" alt="Brian Woods" srcset="/wp-content/uploads/2016/12/testimo.jpg 222w, /wp-content/uploads/2016/12/testimo.jpg 600w, /wp-content/uploads/2016/12/testimo.jpg 100w, /wp-content/uploads/2016/12/testimo.jpg 300w, /wp-content/uploads/2016/12/testimo.jpg 150w, /wp-content/uploads/2016/12/testimo.jpg 768w, /wp-content/uploads/2016/12/testimo.jpg 370w, /wp-content/uploads/2016/12/testimo.jpg 770w, /wp-content/uploads/2016/12/testimo.jpg 900w" sizes="(max-width: 222px) 100vw, 222px" /></div>
                                                                    <div class="sc_testimonials_item_author_data">
                                                                        <h4 class="sc_testimonials_item_author_title">{{$testimonial->name}}</h4>
                                                                        <div class="sc_testimonials_item_author_subtitle">{{$testimonial->age}}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                    <div class="slider_pagination_wrap swiper-pagination"></div>
                                                </div><!-- /.sc_testimonials --></div></div></div></div>
                                                <div id="news" class="vc_row-full-width vc_clearfix"></div>
                                                <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1484233865553 vc_row-has-fill">
                                                    <div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left">
                                                        <div class="vc_column-inner">
                                                            <div class="wpb_wrapper">
                                                            <div id="sc_title_901123084" class="sc_title sc_title_default  vc_custom_1529413624943">
                                                                <h6 class="sc_item_subtitle sc_title_subtitle sc_align_default sc_item_title_style_default">Enjoy Online Lessons with Tutors</h6>
                                                            <h2 class="sc_item_title sc_title_title sc_align_default sc_item_title_style_default">Latest News</h2></div><!-- /.sc_title -->
                                                            <div class="vc_row wpb_row vc_inner vc_row-fluid">
                                                                <div class="wpb_column vc_column_container vc_col-sm-8 sc_layouts_column_icons_position_left">
                                                                    <div class="vc_column-inner">
                                                                        <div class="wpb_wrapper">
                                                                            <div class="sc_blogger sc_blogger_classic" data-slides-per-view="2" data-slides-min-width="150"		>
                                                                    <div  class="sc_blogger_columns sc_item_columns trx_addons_columns_wrap columns_padding_bottom">
                                                                        <div class="row">
                                                                        {{-- @if (App\Meta::where('key', 'display_blog')->pluck('value')->first() == 'yes') --}}
                                                                        @php $k = 1; @endphp
                                                                        @foreach (App\Blog::orderBy('created_at', 'desc')->take(2)->get() as $blog)
                                                                        <div class="trx_addons_column-1_2 col-md-6 col-lg-6 col-12 ">
                                                                            <div id="post-75"	class=" {{ ($k==2) ? 'mrgn-28' : '' }} sc_blogger_item post_format_standard post-75 post type-post status-publish format-standard has-post-thumbnail hentry category-distance-learning category-tutoring tag-class tag-learning">
                                                                                <div class="post_featured with_thumb hover_dots sc_blogger_item_featured">
                                                                                    <img width="740" height="792" src="{{asset('storage/blog') . "/" . $blog->image}}" class="attachment-smarthead-thumb-big-vertical size-smarthead-thumb-big-vertical wp-post-image" alt="Back-to-School: Tutoring as a Proactive Tool" />
                                                                                    <div class="mask"></div><a href="{{route('blog.view', $blog->id)}}" aria-hidden="true" class="icons"><span></span><span></span><span></span></a></div>
                                                                                    <div class="sc_blogger_item_content entry-content"><div class="sc_blogger_item_header entry-header">
                                                                                        <div class="post_meta">	<span class="post_meta_item post_date"><a href="">{{Carbon\Carbon::parse($blog->created_at)->format('F jS, Y')}}</a></span>
                                                                    <a class="post_meta_item post_author" rel="author" href="{{route('blog.view', $blog->id)}}">
                                                                                                Cindy Jefferson				</a>
                                                                    <a href="smarthead.ancorathemes.com/back-to-school-tutoring-as-a-proactive-tool/#comments" class="post_meta_item post_counters_item post_counters_comments trx_addons_icon-comment">
                                                                        <span class="post_counters_number">2</span>
                                                                            <span class="post_counters_label">Comments</span></a> </div><!-- .post_meta -->
                                                                            <h6 class="sc_blogger_item_title entry-title"><a href="" rel="bookmark">{{substr($blog->title, 0, 40)}}</a></h6>
                                                                </div><!-- .entry-header --><div class="sc_blogger_item_excerpt">
                                                                                        <div class="sc_blogger_item_button sc_item_button"><a href="{{route('blog.view', $blog->id)}}" class="sc_button">Read more</a></div>
                                                                                    </div><!-- .sc_blogger_item_excerpt -->
                                                                                </div><!-- .entry-content -->
                                                                            </div><!-- .sc_blogger_item -->
                                                                        </div>
                                                                        @php $k++; @endphp
                                                                        @endforeach
                                                                        {{-- @endif  --}}
                                                                    </div>

                                                            </div></div><!-- /.sc_blogger --></div></div></div><div class="wpb_column vc_column_container vc_col-sm-4 vc_col-has-fill sc_layouts_column_icons_position_left special_class_5"><div class="vc_column-inner vc_custom_1484578313285"><div class="wpb_wrapper"><div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center"><div class="vc_icon_element-inner vc_icon_element-color-green vc_icon_element-size-md vc_icon_element-style- vc_icon_element-background-color-grey" ><span class="vc_icon_element-icon fa fa-paper-plane" ></span></div></div>
                                                                <div class="wpb_text_column wpb_content_element " >
                                                                    <div class="wpb_wrapper">
                                                                        <h4 class="trx_addons_no_margin" style="text-align: center;">Subscribe On Our<br />
                                                                            News</h4>

                                                                            <!-- Begin Mailchimp Signup Form -->
                                                                    <style type="text/css">
                                                                        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
                                                                        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                                                                        We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                                                                    </style>


<!--End mc_embed_signup-->

                                                                    </div>
                                                                </div>

                                                                <div class="wpb_text_column wpb_content_element " >
                                                                    <div class="wpb_wrapper">
                                                                        <script>(function() {
                                                                                window.mc4wp = window.mc4wp || {
                                                                                    listeners: [],
                                                                                    forms: {
                                                                                        on: function(evt, cb) {
                                                                                            window.mc4wp.listeners.push(
                                                                                                {
                                                                                                    event   : evt,
                                                                                                    callback: cb
                                                                                                }
                                                                                            );
                                                                                        }
                                                                                    }
                                                                                }
                                                                            })();

                                                                        </script><!-- Mailchimp for WordPress v4.7.6 - https://wordpress.org/plugins/mailchimp-for-wp/ --><form id="mc4wp-form-1" action="https://tutors-hub.us2.list-manage.com/subscribe/post?u=923d058028bf062e7d5abe405&amp;id=784b0e7c13" class="mc4wp-form mc4wp-form-470" method="post" data-id="470" data-name="Subscribe On Our News" ><div class="mc4wp-form-fields"><div class="mailchimp_form">
                                                                                    <div class="mailchimp_inputs">
                                                                                        <input type="email" id="email_mailchimp" name="EMAIL" placeholder="Your Email" required />
                                                                                        <button class="icon-arrow-right-alt" type="submit"></button>
                                                                                    </div>
                                                                                    <p class="terms_agree_checkbox_wrap"><label class="terms_agree_checkbox"><input name="AGREE_TO_TERMS" type="checkbox" value="1" required="">I agree that my submitted data is being collected and stored.</label></p>
                                                                                </div></div><label style="display: none !important;">Leave this field empty if you're human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" /></label><input type="hidden" name="_mc4wp_timestamp" value="1593673891" /><input type="hidden" name="_mc4wp_form_id" value="470" /><input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1" /><div class="mc4wp-response"></div></form><!-- / Mailchimp for WordPress Plugin -->

                                                                    </div>
                                                                </div>
                                                            </div></div></div></div>
                                                        </div></div></div>

                                                        </div>
                                                            <div class="vc_row-full-width vc_clearfix"></div>
                                                            <div class="vc_row wpb_row vc_row-fluid vc_custom_1484233910026"><div class="wpb_column vc_column_container vc_col-sm-12 sc_layouts_column_icons_position_left">
                                                                <div class="vc_column-inner"><div class="wpb_wrapper"><div id="sc_title_2038374582"
                                                                                                                                                                                                                                                                                                                                                                                        class="sc_title sc_title_default  vc_custom_1484233898539"><h6 class="sc_item_subtitle sc_title_subtitle sc_align_default sc_item_title_style_default">Plenty of tutors to chose from</h6><h2 class="sc_item_title sc_title_title sc_align_default sc_item_title_style_default">Our Network</h2></div><!-- /.sc_title --></div></div></div>
                                                            <div class="resp-width wpb_column vc_column_container vc_col-sm-8 sc_layouts_column_icons_position_left">
                                                                <div class="vc_column-inner"><div class="wpb_wrapper"><div style="width:;" class="cqtooltip-wrapper " data-opacity="1" data-tooltipanimation="grow" data-tooltipstyle="shadow" data-trigger="" data-maxwidth="240" data-marginoffset="" data-isdisplayall="off" data-displayednum="1"><img src="https://smarthead.ancorathemes.com/wp-content/uploads/2016/12/map.png" alt="" /><div class="cq-hotspots"><div class="hotspot-item pulse-blue " style="top:20%;left:10%;" data-top="20%" data-left="10%"><a href="#" class="cq-tooltip" style="background:#f56796;" data-tooltip="
There are more than 1,000 tutors in this area" data-arrowposition=""><i class="fa fa-map-marker" style="color:#ffffff;"></i></a></div><div class="hotspot-item pulse-blue " style="top:45%;left:20%;" data-top="45%" data-left="20%"><a href="#" class="cq-tooltip" style="background:#f8c701;" data-tooltip="
There are more than 3,000 tutors in this area" data-arrowposition="top"><i class="fa fa-map-marker" style="color:#ffffff;"></i></a></div><div class="hotspot-item pulse-blue " style="top:15%;left:30%;" data-top="15%" data-left="30%"><a href="#" class="cq-tooltip" style="background:#00bff3;" data-tooltip="
There are more than 2,000 tutors in this area" data-arrowposition="top"><i class="fa fa-map-marker" style="color:#ffffff;"></i></a></div><div class="hotspot-item pulse-blue " style="top:40%;left:50%;" data-top="40%" data-left="50%"><a href="#" class="cq-tooltip" style="background:#aece61;" data-tooltip="
There are more than 4,000 tutors in this area" data-arrowposition="top"><i class="fa fa-map-marker" style="color:#ffffff;"></i></a></div><div class="hotspot-item pulse-blue " style="top:35%;left:80%;" data-top="35%" data-left="80%"><a href="#" class="cq-tooltip" style="background:#38d1c6;" data-tooltip="
There are more than 2,000 tutors in this area" data-arrowposition="top"><i class="fa fa-map-marker" style="color:#ffffff;"></i></a></div><div class="hotspot-item pulse-blue " style="top:60%;left:78%;" data-top="60%" data-left="78%"><a href="#" class="cq-tooltip" style="background:#45aded;" data-tooltip="
There are more than 5,000 tutors in this area" data-arrowposition="top"><i class="fa fa-map-marker" style="color:#ffffff;"></i></a></div></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-4 sc_layouts_column_icons_position_left special_class_6"><div class="vc_column-inner"><div class="wpb_wrapper">
                                                <div  class="wpb_single_image wpb_content_element vc_align_left  vc_custom_1484753191719  logo-icon">

                                                    <figure class="wpb_wrapper vc_figure">
                                                        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="84" height="120" src="https://smarthead.ancorathemes.com/wp-content/uploads/2016/12/logo-icon.png" class="vc_single_image-img attachment-thumbnail" alt="" /></div>
                                                    </figure>
                                                </div>

                                                <div class="wpb_text_column wpb_content_element " >
                                                    <div class="wpb_wrapper">
                                                        <h3 class="sc_item_title sc_title_title sc_align_center sc_item_title_style_default trx_addons_no_margin" style="text-align: center;">Large Network</h3>

                                                    </div>
                                                </div>

                                                <div class="wpb_text_column wpb_content_element  vc_custom_1571411058727" >
                                                    <div class="wpb_wrapper">
                                                        <p style="text-align: center;">Our network covers a large number of tutors and it is not restricted by any borders. Students can search for tutors near them wherever they are.</p>

                                                    </div>
                                                </div>
                                                </div></div></div></div>
                            </div><!-- .entry-content -->

                        </article>

                    </div><!-- </.content> -->

                </div><!-- </.content_wrap> -->			</div><!-- </.page_content_wrap> -->

        </div><!-- /.page_wrap -->

    </div><!-- /.body_wrap -->


    <script type="text/javascript">
        var ajaxRevslider;

        jQuery(document).ready(function() {


            // CUSTOM AJAX CONTENT LOADING FUNCTION
            ajaxRevslider = function(obj) {

                // obj.type : Post Type
                // obj.id : ID of Content to Load
                // obj.aspectratio : The Aspect Ratio of the Container / Media
                // obj.selector : The Container Selector where the Content of Ajax will be injected. It is done via the Essential Grid on Return of Content

                var content	= '';
                var data	= {
                    action:			'revslider_ajax_call_front',
                    client_action:	'get_slider_html',
                    token:			'1b5d580426',
                    type:			obj.type,
                    id:				obj.id,
                    aspectratio:	obj.aspectratio
                };



                // FIRST RETURN THE CONTENT WHEN IT IS LOADED !!
                return content;
            };

            // CUSTOM AJAX FUNCTION TO REMOVE THE SLIDER
            var ajaxRemoveRevslider = function(obj) {
                return jQuery(obj.selector + ' .rev_slider').revkill();
            };


            // EXTEND THE AJAX CONTENT LOADING TYPES WITH TYPE AND FUNCTION
            if (jQuery.fn.tpessential !== undefined)
                if(typeof(jQuery.fn.tpessential.defaults) !== 'undefined')
                    jQuery.fn.tpessential.defaults.ajaxTypes.push({type: 'revslider', func: ajaxRevslider, killfunc: ajaxRemoveRevslider, openAnimationSpeed: 0.3});
            // type:  Name of the Post to load via Ajax into the Essential Grid Ajax Container
            // func: the Function Name which is Called once the Item with the Post Type has been clicked
            // killfunc: function to kill in case the Ajax Window going to be removed (before Remove function !
            // openAnimationSpeed: how quick the Ajax Content window should be animated (default is 0.3)



        });
    </script>
    <!-- Post/page views count increment -->
    <script type="text/javascript">
        jQuery(document).on('action.ready_trx_addons', function() {
            if (!TRX_ADDONS_STORAGE['post_views_counter_inited']) {
                TRX_ADDONS_STORAGE['post_views_counter_inited'] = true;
                setTimeout(function() {
                    jQuery.post(TRX_ADDONS_STORAGE['ajax_url'], {
                        action: 'post_counter',
                        nonce: TRX_ADDONS_STORAGE['ajax_nonce'],
                        post_id: 228,
                        views: 1
                    }).done(function(response) {
                        var rez = {};
                        try {
                            rez = JSON.parse(response);
                        } catch (e) {
                            rez = { error: TRX_ADDONS_STORAGE['ajax_error'] };
                            console.log(response);
                        }
                        if (rez.error === '') {
                            jQuery('.post_counters_single .post_counters_views .post_counters_number').html(rez.counter);
                        }
                    });
                }, 10);
            }
        });
    </script><div id="trx_addons_login_popup" class="trx_addons_popup trx_addons_tabs mfp-hide">
        <ul class="trx_addons_tabs_titles"><li class="trx_addons_tabs_title trx_addons_tabs_title_login">
                <a href="#trx_addons_login_content">
                    <i class="trx_addons_icon-lock-open"></i>
                    Login			</a>
            </li><li class="trx_addons_tabs_title trx_addons_tabs_title_register" data-disabled="true">
                <a href="#trx_addons_register_content">
                    <i class="trx_addons_icon-user-plus"></i>
                    Register			</a>
            </li></ul>	<div id="trx_addons_login_content" class="trx_addons_tabs_content trx_addons_login_content">
            <div>
                <div class="trx_addons_popup_form_wrap trx_addons_popup_form_wrap_login">
                    <form class="trx_addons_popup_form trx_addons_popup_form_login sc_input_hover_iconed" action="#" method="post" name="trx_addons_login_form">
                        <input type="hidden" id="login_redirect_to" name="redirect_to" value="">
                        <div class="trx_addons_popup_form_field trx_addons_popup_form_field_login">
                            <label class="sc_form_field sc_form_field_log required">
		<span class="sc_form_field_wrap"><input type="text"
                                                name="log"
                                                id="log"
                                                value=""
                                                aria-required="true"										><span class="sc_form_field_hover"><i class="sc_form_field_icon trx_addons_icon-user-alt"></i><span class="sc_form_field_content" data-content="Login">Login</span></span>	</span>
                            </label>
                        </div>
                        <div class="trx_addons_popup_form_field trx_addons_popup_form_field_password">
                            <label class="sc_form_field sc_form_field_pwd required">
		<span class="sc_form_field_wrap"><input type="password"
                                                name="pwd"
                                                id="pwd"
                                                value=""
                                                aria-required="true"										><span class="sc_form_field_hover"><i class="sc_form_field_icon trx_addons_icon-lock"></i><span class="sc_form_field_content" data-content="Password">Password</span></span>	</span>
                            </label>
                        </div>
                        <div class="trx_addons_popup_form_field trx_addons_popup_form_field_remember">
                            <a href="my-account/lost-password/lost-password.html" class="trx_addons_popup_form_field_forgot_password">Forgot password?</a>
                            <input type="checkbox" value="forever" id="rememberme" name="rememberme"><label for="rememberme"> Remember me</label>
                        </div>
                        <div class="trx_addons_popup_form_field trx_addons_popup_form_field_submit">
                            <input type="submit" class="submit_button" value="Login">
                        </div>
                        <div class="trx_addons_message_box sc_form_result"></div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/600a4610a9a34e36b96f0ec0/1esk23cdf';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <script>(function() {function maybePrefixUrlField() {
            if (this.value.trim() !== '' && this.value.indexOf('http') !== 0) {
                this.value = "https://" + this.value;
            }
        }

            var urlFields = document.querySelectorAll('.mc4wp-form input[type="url"]');
            if (urlFields) {
                for (var j=0; j < urlFields.length; j++) {
                    urlFields[j].addEventListener('blur', maybePrefixUrlField);
                }
            }
        })();
    </script>


    </body>

@endsection
