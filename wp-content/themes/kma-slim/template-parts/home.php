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
        <div class="section-wrapper full-bg">

            <slider>
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
            </slider>

            <a class="clickdown icon center" href="#bot"><i class="fa fa-angle-down" aria-hidden="true"></i></a>

        </div>
    </article><!-- #post-## -->
    <div class="clear"></div>
</div>
