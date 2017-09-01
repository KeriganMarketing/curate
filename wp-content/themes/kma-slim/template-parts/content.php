<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
$portfolio = new Portfolio();

$imgUrl = get_the_post_thumbnail_url($post, 'large');
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content one-column">
                    <?php if($imgUrl != ''){ ?>
                        <figure class="media-left">
                            <p class="image is-square">
                                <img src="<?php echo $imgUrl; ?>">
                            </p>
                        </figure>
                    <?php } ?>
                    <h1 class="title is-1"><?php echo $headline; ?></h1>
                    <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>

                    <?php
                    the_content( sprintf(
                    /* translators: %s: Name of current post. */
                        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kmaslim' ), array( 'span' => array( 'class' => array() ) ) ),
                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    ) );

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kmaslim' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                    <div class="clear"></div>
                </div><!-- .entry-content -->
            </div>
        </section>
        <div class="section-wrapper reveal">

            <?php include(locate_template('template-parts/partials/featured-artists.php')); ?>

        </div>
    </article><!-- #post-## -->
</div>