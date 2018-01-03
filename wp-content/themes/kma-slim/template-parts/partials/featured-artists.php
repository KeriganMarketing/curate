<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>
<div id="featured-artists" class="featured-artists">
    <div class="container">
        <h2>featured artists</h2>
        <div class="columns is-multiline">

            <?php

            $artists = $portfolio::getArtists(8);
            $i = 1;
            foreach($artists as $num => $artist){

	            $work = $portfolio->getWork( $artist->slug, array(
		            'posts_per_page' => 1,
		            'meta_query'     => [
			            [
				            'key'     => 'work_details_feature_on_home_page',
				            'value'   => 'on',
				            'compare' => '='
			            ]
		            ]
	            ) );

                $wpID = attachment_url_to_postid($work[0]['photo']);
                $bigPhoto = wp_get_attachment_image_src($wpID,'thumbnail');
                $smallPhoto = wp_get_attachment_image_src($wpID,'small-thumbnail');

                if($bigPhoto && $bigPhoto[1] == '300' && $bigPhoto[2] == '300'){
                    $newPhoto = $bigPhoto[0];
                }else{
                    $newPhoto = $smallPhoto[0];
                }

                if($i == 5){ ?>
                    <div class="column artist-thumb blank">
                        <figure class="artist-thumb-container image is-1by1"></figure>
                    </div>
                    <div class="column artist-thumb blank">
                        <figure class="artist-thumb-container image is-1by1"></figure>
                    </div>
                <?php } ?>
                <div class="column artist-thumb <?php echo $num; ?>">
                    <div class="roll-box">
                        <p class="artist-name serif"><?php echo str_replace( ' ', '<br>', $artist->name ); ?></p>
                        <a href="<?php echo $work[0]['link']; ?>" class="button is-info roll-thumb-link">view</a>
                    </div>
                    <figure class="artist-thumb-container is-1by1">
                        <a href="<?php echo $work[0]['link']; ?>">
                        <img src="<?php echo $newPhoto; ?>" alt="<?php echo $work[0]['name'] . ': ' . $artist->name; ?>">
                        </a>
                    </figure>
                </div>
                <?php

                $i++;
            }

            ?>

        </div>
        <p class="is-centered"><a class="button is-info" href="/featured-artists">see all artists</a></p>
    </div>
</div>
