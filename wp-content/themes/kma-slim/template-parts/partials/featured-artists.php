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
        <h2>Featured Artists</h2>
        <div class="columns is-multiline">

            <?php

            $artists = $portfolio::getArtists(8);
            $i = 1;
            foreach($artists as $artist){

                $work = $portfolio->getWork($artist->slug, array(
                    'posts_per_page' => 1,
                ) );

                $photoInfo = pathinfo($work[0]['photo']);
                $newPhoto = $photoInfo['dirname'].'/'.$photoInfo['filename'].'-300x300.'.$photoInfo['extension'];

                //echo $newPhoto;

                //echo '<pre>',print_r($work),'</pre>';
                if($i == 5){ ?>
                    <div class="column artist-thumb blank">
                        <figure class="artist-thumb-container is-1by1"></figure>
                    </div>
                    <div class="column artist-thumb blank">
                        <figure class="artist-thumb-container is-1by1"></figure>
                    </div>
                <?php } ?>
                <div class="column artist-thumb">
                    <div class="roll-box">
                        <p class="artist-name serif"><?php echo str_replace( ' ', '<br>', $artist->name ); ?></p>
                        <a href="<?php echo $work[0]['link']; ?>" class="button is-info roll-thumb-link">view</a>
                    </div>
                    <figure class="artist-thumb-container is-1by1">
                        <img src="<?php echo $newPhoto; ?>" alt="<?php echo $work[0]['name'] . ': ' . $artist->name; ?>">
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
