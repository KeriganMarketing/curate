<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

$term = explode('/', $_SERVER['REQUEST_URI']);
$artist = get_term_by('slug',$term[2],$term[1]);

$headline = $artist->name;
$subhead = '';

//echo '<pre>',print_r($artist),'</pre>';
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="hero is-light">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title"><?php echo $headline; ?></h1>
                    <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
                </div>
            </div>
        </section>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content">
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
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>