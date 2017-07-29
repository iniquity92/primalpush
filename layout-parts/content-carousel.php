<?php
/**
 * Template part for displaying the most recent post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Primal_Push
 */

?>

<?php
    if(count($featured_array) > 1):
?>
        <!-- Carousel
    ================================================== -->
   <div class="jumbotron">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <?php
            primalpush_make_carousel($featured_array);
        ?>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
    </div>

<?php
    else:        
?>
        <div class="jumbotron">
            
                <header class="entry-header">
                    <?php
                        the_post_thumbnail('large');
                        if ( is_singular() ) :
                            the_title( '<h1 class="entry-title">', '</h1>' );
                        else :
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                        endif;

                        if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <?php echo primalpush_posted_on();
                                    //the_date('F j, Y');
                                ?>
                            </div><!-- .entry-meta -->
                    <?php
                        endif; 
                    ?>
                </header><!-- .entry-header -->
                <div class="entry-content">

                <?php
                    the_content( sprintf(
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
                    ) );

                    
                ?>
            </div><!-- .entry-content -->


                <!--p>
                <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">View navbar docs &raquo;</a>
                </p-->
        </div>        
<?php
    endif;
?>

