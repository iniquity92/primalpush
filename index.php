<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Primal_Push
 */

get_header(); ?>
	<?php get_search_form(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<!--h2>I'm in the index.php</h2-->
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;
			$count_featured = 0;
			$featured_array = array();
			/* Start the Loop */
			while ( have_posts() ) : 
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				
				//echo get_the_date('F j, Y')."<br />"; 
				//echo date('F j, Y'); //printing yesterday's date, check this;

				//time() is utc time time()+(5*3600+30*60) is the time of Indian time
				if(get_the_date('F j, Y')===date('F j, Y',time()+(5*3600+30*60))):
					$featured_array[] = array(
						'post_id' => get_the_ID(),
						'post_title' => get_the_title(),
						'post_thumbnail_url' => get_the_post_thumbnail_url(),
						'post_content' => get_the_content(),
						'post_permalink'=>get_permalink(),
						'post_meta'=>primalpush_posted_on()
					);
					$count_featured++;
					//get_template_part('template-parts/content-featured');
				else:
					if($count_featured>0){
						include(locate_template('template-parts/content-carousel.php'));
						$count_featured = 0;
					}
					get_template_part( 'template-parts/content', get_post_format() );
				endif;

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
?>