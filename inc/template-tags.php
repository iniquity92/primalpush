<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Primal_Push
 */

if ( ! function_exists( 'primalpush_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function primalpush_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		$last_modified_on = '<time class="updated" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$last_modified_on = sprintf( $last_modified_on,
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_year = esc_html(get_the_date('Y'));
	$posted_month = esc_html(get_the_date('m'));
	$posted_date = esc_html(get_the_date('d'));

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'primalpush' ),
		'<a href="' . esc_url( get_day_link( $posted_year , $posted_month , $posted_date ) ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$archive_year = get_the_modified_date('Y');
	$archive_month = get_the_modified_date('m');
	$archive_date = get_the_modified_date('d');
	$last_modified = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Last modified on %s', 'modified date', 'primalpush' ),
		'<a href="' . esc_url( get_day_link( $archive_year , $archive_month , $archive_date ) ) . '" rel="bookmark">' . $last_modified_on . '</a>'
	);


	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'primalpush' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	return '<span class="posted-on">' . $posted_on . '</span> <span class="modified-on">' . $last_modified . '</span> <span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'primalpush_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function primalpush_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'primalpush' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'primalpush' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'primalpush' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'primalpush' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'primalpush' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'primalpush' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if( !function_exists( 'primalpush_social_builder' ) ):
	/*
		prints the code to show the social icons over the navigation bar
		@param 
			$soms -> an array of all the social media buttons that we need
	*/
	function primalpush_social_builder($soms){
		$social_div = '<div id="social" class="social social-icons social-media">';
		$social_string = '<a href="https://%1$s.com/primalpush" class="social-%1$s"><img src="'.get_template_directory_uri().'/assets/%2$s.svg" /></a>';

		$social_block = $social_div;

		foreach($soms as $link => $icon){
			$social_block .= sprintf($social_string,$link,$icon);
		}

		$social_block .= '</div>';

		echo $social_block;

	}

endif;

if(!function_exists('primalpush_make_carousel')):
	/*
		prints the code to show the carousel from the featured posts
		@params $featured_array -> an array containing the featured article contents

	*/

	function primalpush_make_carousel($featured_array){
		$carousel='<div class="%6$s">
          <img class="first-slide" src="%1$s" alt="Featured image for %2$s">
          <div class="container">
            <div class="carousel-caption">
              <h1>%2$s</h1>
			  <p class="entry-meta">%3$s</p>
			  <p>%4$s</p>
              <p><a class="btn btn-lg btn-primary" href="%5$s" role="button">Read More</a></p>
            </div>
          </div>
        </div>';
		$carousel_op='';
		$count = 0;
		$active_item_class = "";
		foreach($featured_array as $featured_post){
			if(!$count){
				$active_item_class = "item active";
			}
			else{
				$active_item_class = "item";
			}
			$carousel_op .= sprintf(
				$carousel,
				$featured_post['post_thumbnail_url'],
				$featured_post['post_title'],
				$featured_post['post_meta'],
				$featured_post['post_content'],
				$featured_array['post_permalink'],
				$active_item_class
			);		
			$count++;
		}
		echo $carousel_op;
	}
endif;