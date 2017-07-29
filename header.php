<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Primal_Push
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE-Edge" >
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body <?php body_class('body'); ?>>
<div id="page" class="container-fluid">
  <div class="site-helpers">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'primalpush' ); ?></a>
    
    <?php 
      primalpush_social_builder(
        array(
          "facebook"=>"f_blue",
          "instagram"=>"insta",
          "twitter"=>"twitter_wob"
        )
      ); 
  ?>
</div>
	<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!--a class="navbar-brand" href="#"-->
                <?php
                the_custom_logo();
                //if ( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php //else : ?>
                    <!--p class="site-title"><a href="<?php //echo esc_url( home_url( '/' ) ); ?>" rel="home"><?//php bloginfo( 'name' ); ?></a></p-->
                <?php
               // endif;

                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                    <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php
                     endif; ?>
            <!--/a-->
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <?php
				wp_nav_menu( array(
					'theme_location' => 'menu-header',
					'menu_id'        => 'primary-menu',
					'menu_class'	=> 'nav navbar-nav'
				) );
			?>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
  
	<div id="content" class="site-content">
