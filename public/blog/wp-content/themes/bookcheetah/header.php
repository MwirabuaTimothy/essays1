<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage BookCheetah
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
    <script type="text/javascript">
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=320691077999812";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>(function(){
        var uv=document.createElement('script');
        uv.type='text/javascript';
        uv.async=true;
        uv.src='//widget.uservoice.com/DaBJd20KGXiNvgpEJT8A.js';
        var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()
    </script>
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/bookcheetah.css">
</head>

<body <?php body_class(); ?>>
	 
<div id="page" class="hfeed site">

	<div class="middles header">
	 	<a href="../"><img class="logo" src="../assets/images/logo.png"/></a>

	 	<a href="../donate">
	 		<div class="charity">
	 			<span class="charity1">Keep BookCheetah Free!</span><br/>
	 			<span class="charity2">Click here to donate</span>
	 		</div>
	 	</a>

	 	<ul class="linkbar top1">
	 		<a href="../howitworks"><li>How it Works</li></a> |
	 		<a href="../forums"><li>Forum</li></a> | 
	 		<a href="../blog"><li>Blog</li></a> | 
	 		<a href="../contactus"><li>Contact Us</li></a> | 

	 		<!-- A link to launch the Classic Widget -->
	 		<a href="javascript:void(0)" data-uv-lightbox="classic_widget">
	 			<li>Customer Service</li></a>
	 	</ul>
	 </div>
	 
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">