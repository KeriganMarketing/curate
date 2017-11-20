<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

$artist = get_term_by( 'slug', get_query_var( 'term' ), 'artist' );
$type = get_term_by( 'slug', get_query_var( 'term' ), 'type' );

echo '<pre>',print_r( $type ),'</pre>';

$headline = $artist->name;
$subhead = '';

$portfolio = new Portfolio();
$work = $portfolio->getWork($artist->slug);

echo '<pre>',print_r($artist),'</pre>';
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content two-column">
                    <div class="columns is-multiline">
                    <?php foreach($work as $num => $piece){
                        $photoInfo = pathinfo($piece['photo']);
                        $newPhoto = $photoInfo['dirname'].'/'.$photoInfo['filename'].'-170x170.'.$photoInfo['extension'];
                        ?>
                        <div class="column artist-thumb no-roll <?php echo $num; ?>">
                            <figure class="artist-thumb-container is-1by1">
                                <a @click="$emit('toggleModal', 'workViewer', <?php echo $num; ?>)" >
                                    <img src="<?php echo $newPhoto; ?>" alt="<?php echo $piece[0]['name'] . ': ' . $artist->name; ?>">
                                </a>
                            </figure>
                        </div>
                    <?php } ?>
                    </div>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<modal>
    <div class="work-viewer" >
        <slider>
            <?php

            $i = 0;
            foreach($work as $slide){

                echo '<slide '.( $i==0 ? ':active="true"' : '' ).'>
                    <div class="content is-centered">
                        <div class="image-container">
                            <img src="'.$slide['photo'].'" >
                        </div>
                        <div class="caption-container">
                            <h3 class="serif">'.$slide['name'].'</h3>
                            <p>'.$artist->name.
                            ( $slide['medium']!='' ? ' | '.$slide['medium'] : '') .
                            ( $slide['size']!='' ? ' | '.$slide['size'] : '') .
                            ( $slide['price']!='' ? ' | $'.number_format($slide['price']) : '') .
                            '</p>
                            <p><a class="button is-secondary" href="mailto:curate30a@gmail.com?subject=Please send information regarding '.$slide['name'].' by '.$artist->name.'" >request information</a></p>
                        </div>
                    </div>
                </slide>';
                $i++;
            }

            ?>
        </slider>
    </div>
</modal>