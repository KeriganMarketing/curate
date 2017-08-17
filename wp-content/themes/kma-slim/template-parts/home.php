<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ( $post->page_information_headline != '' ? $post->page_information_headline : $post->post_title );
$subhead  = ( $post->page_information_subhead != '' ? $post->page_information_subhead : '' );
?>
<div id="mid">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="section-wrapper reveal">

            <portfolioslider>
				<?php
				$portfolio = new Portfolio();
				echo $portfolio->getWorkSlider(null, array(
					'meta_query' => array(
						array(
							'key'     => 'work_details_feature_on_home_page',
							'value'   => 'on',
							'compare' => '='
						)
					)
                ) );
				?>
            </portfolioslider>

        </div>
        <div class="section-wrapper reveal">

            <div :class="['sticky-enewsletter', { stuck: showSignup }]">
                <?php get_template_part( 'template-parts/enewsletter-signup' ); ?>
            </div>

        </div>
        <div class="section-wrapper reveal">

            <div id="about-us" class="about-us" >
                <div class="center-vertical columns is-multiline">
                    <div class="column is-11 is-one-third-desktop is-second-desktop is-centered">
                        <h2>A True Original</h2>
                        <div class="content-justified">
                            <p>Like the impressive mix of nationally recognized and emerging artists featured on its walls, Curate30a Gallery is a true original located in the heart of Rosemary Beach, between Panama City and Destin, Florida. Curate30a is a collaboration with Vinings Gallery opened in Atlanta, in 1999, by owner Gary Handler, one of the country's leading art consultants and artist representatives. Gary has mastered the art of blending together a powerful palette of talented, nationally recognized artists in his seaside gallery, fast becoming the art destination of the gulf coast.</p>
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

            <div id="featured-artists" class="featured-artists">
                <h2>Featured Artists</h2>
                <div class="columns is-multiline">

                    <?php

                    $artists = $portfolio->getArtists();
                    echo '<pre>',print_r($artists),'</pre>';

                    foreach($artists as $artist){

                        $work = $portfolio->getWork(null, array(
                            'tax_query' => array(
                                array(
                                    'key'     => 'slug',
                                    'value'   => $artist->slug,
                                    'compare' => '='
                                )
                            )
                        ) );

                        echo '<pre>',print_r($work),'</pre>';

                    }

                    ?>

                </div>
            </div>

        </div>
    </article><!-- #post-## -->
</div>
