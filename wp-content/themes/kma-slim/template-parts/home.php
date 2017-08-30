<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ( $post->page_information_headline != '' ? $post->page_information_headline : $post->post_title );
$subhead  = ( $post->page_information_subhead != '' ? $post->page_information_subhead : '' );
$portfolio = new Portfolio();
?>
<div id="mid">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper reveal">

            <?php include(locate_template('template-parts/partials/featured-work-slider.php')); ?>

        </div>
        <div class="section-wrapper reveal">

            <div :class="['sticky-enewsletter', { stuck: showSignup }]">
                <?php include(locate_template('template-parts/partials/stay-connected.php')); ?>
            </div>

        </div>
        <div class="section-wrapper reveal">

            <div id="about-us" class="about-us section" >
                <div class="center-vertical columns is-multiline">
                    <div class="column is-11 is-one-third-desktop is-second-desktop is-centered">
                        <h2><?php echo $headline ?></h2>
                        <div class="content-justified">
                            <?php the_content() ?>
                        </div>
                        <p class="is-centered"><a class="button is-info" href="/about-curate">about Curate</a></p>
                    </div>
                    <div class="column is-6-mobile is-one-third-desktop is-first-desktop wall-art-left">
                        <img src="<?php echo get_template_directory_uri().'/img/left-side-wall-art.png'; ?>" >
                    </div>
                    <div class="column is-6-mobile is-one-third-desktop is-third-desktop wall-art-right">
                        <img src="<?php echo get_template_directory_uri().'/img/right-side-wall-art.png'; ?>" >
                    </div>
                </div>
            </div>

        </div>
        <div class="section-wrapper reveal">

            <?php include(locate_template('template-parts/partials/featured-artists.php')); ?>

        </div>
    </article><!-- #post-## -->
</div>
