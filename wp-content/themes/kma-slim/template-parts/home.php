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
    </article><!-- #post-## -->
    <div class="clear"></div>
</div>
