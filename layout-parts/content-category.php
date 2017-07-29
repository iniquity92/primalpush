<?php $categories = get_the_category(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('post','post-category','post-'.$categories[0]->slug)); ?>>
    <header class="post entry-header">
        <?php the_post_thumbnail('large'); ?>
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <?php
            if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php primalpush_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		    endif; ?>
    </header>
    <div class="post-entry-content">
        <?php the_content(
            sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'primalpush' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
        ); ?>
    </div>
</article>