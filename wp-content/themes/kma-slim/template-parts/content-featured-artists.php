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
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content all-artists one-column">
                    <h1 class="title is-1"><?php echo $headline; ?></h1>
                    <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
                    <div class="columns is-multiline">

                        <?php

                        $artists = $portfolio->getArtists();
                        $i = 1;
                        foreach($artists as $artist){

                            $work = $portfolio->getWork($artist->slug, array(
                                'posts_per_page' => 1,
                            ) );
                             ?>
                            <div class="column artist-thumb">
                                <div class="roll-box">
                                    <p class="artist-name serif"><?php echo str_replace( ' ', '<br>', $artist->name ); ?></p>
                                    <a href="<?php echo $work[0]['link']; ?>" class="button is-info roll-thumb-link">view</a>
                                </div>
                                <figure class="artist-thumb-container">
                                    <img src="<?php echo str_replace( '.jpg', '', $work[0]['photo'] ) . '-300x300.jpg'; ?>" alt="<?php echo $work[0]['name'] . ': ' . $artist->name; ?>">
                                </figure>
                            </div>
                            <?php

                            $i++;
                        }

                        ?>

                    </div>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
