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
$work = $portfolio->getWork($artist->slug);

$photoInfo = pathinfo($featuredWork[0]['photo']);
$newPhoto = $photoInfo['dirname'].'/'.$photoInfo['filename'].'-300x300.'.$photoInfo['extension'];

//echo '<pre>',print_r($artist),'</pre>';
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content two-column">
                    <div class="columns" >
                        <div class="column is-8-tablet is-7-desktop artist-left">
                            <div class="content">
                                <div class="columns">
                                    <div class="column is-2-mobile is-4-desktop">
                                        <figure class="artist-profile" >
                                            <p class="image is-150x150">
                                                <img src="<?php echo $newPhoto; ?>" alt="<?php echo $featuredWork[0]['name'] . ': ' . $artist->name; ?>">
                                            </p>
                                        </figure>
                                    </div>
                                    <div class="column is-10-mobile is-8-desktop valign">
                                        <h1 class="title is-1"><?php echo $headline; ?></h1>
                                        <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null); ?>
                                    </div>
                                </div>

                                <?php echo apply_filters('the_content', $artist->description); ?>
                            </div>
                        </div>
                        <div class="column is-4-tablet is-5-desktop artist-right">
                            <div class="columns is-multiline">
                            <?php foreach($work as $num => $piece){
                                $photoInfo = pathinfo($piece['photo']);
                                $newPhoto = $photoInfo['dirname'].'/'.$photoInfo['filename'].'-300x300.'.$photoInfo['extension'];
                                ?>
                                <div class="column is-6-mobile is-12-tablet is-6-desktop artist-thumb">
                                    <figure class="artist-thumb-container is-1by1">
                                        <a @click="$emit('toggleModal', 'workViewer', <?php echo $num; ?>)" >
                                        <img src="<?php echo $newPhoto; ?>" alt="<?php echo $piece['name'] . ': ' . $artist->name; ?>">
                                        </a>
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
<modal>
    <figure class="work-viewer" >
        <slider>
            <?php

            $i = 0;
            foreach($work as $slide){

                echo '<slide '.( $i==0 ? ':active="true"' : '' ).'>
                <div class="content is-centered">
                    <img src="'.$slide['photo'].'" >
                    <h3 class="serif">'.$piece['name'].'</h3>
                    <p>'.$artist->name.'</p>
                    </div>
                </slide>';
                $i++;
            }

            ?>
        </slider>
    </figure>
</modal>