<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

$artist = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

$headline = $artist->name;
$subhead = '';

$portfolio = new Portfolio();
$featuredWork = $portfolio->getWork($artist->slug, array(
    'posts_per_page' => 1,
) );
$work = $portfolio->getWork($artist->slug, array(
    'posts_per_page' => 12,
    'offset' => 1,
) );

//echo '<pre>',print_r($artist),'</pre>';
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content">
                    <div class="columns" >
                        <div class="column is-7-desktop">
                            <figure class="artist-profile media-left">
                                <p class="image is-200x200">
                                <img src="<?php echo str_replace( '.jpg', '', $featuredWork[0]['photo'] ) . '-300x300.jpg'; ?>" alt="<?php echo $featuredWork[0]['name'] . ': ' . $artist->name; ?>">
                                </p>
                            </figure>
                            <h1 class="title is-1"><?php echo $headline; ?></h1>
                            <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>

                            <?php
                            the_content( sprintf(
                            /* translators: %s: Name of current post. */
                                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'kmaslim' ), array( 'span' => array( 'class' => array() ) ) ),
                                the_title( '<span class="screen-reader-text">"', '"</span>', false )
                            ) );
                            ?>
                        </div>
                        <div class="column is-5-desktop">
                            <div class="columns is-multiline">
                            <?php foreach($work as $piece){ ?>
                                <div class="column is-6 artist-thumb">
                                    <figure class="artist-thumb-container is-1by1">
                                        <img src="<?php echo str_replace( '.jpg', '', $piece['photo'] ) . '-300x300.jpg'; ?>" alt="<?php echo $piece['name'] . ': ' . $artist->name; ?>">
                                    </figure>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>

                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>