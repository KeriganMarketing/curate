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
                    <?php echo ($subhead!='' ? '<p class="subtitle">'.$subhead.'</p>' : null);
                    the_content();?>
                    <div class="columns is-multiline is-centered">

                        <?php

                        $artists = $portfolio->getArtists();
                        $i = 1;
                        foreach($artists as $num => $artist){

                            $work = $portfolio->getWork($artist->slug, array(
                                'posts_per_page' => 1,
                                'meta_query'     => [
	                                [
		                                'key'     => 'work_details_feature_on_home_page',
		                                'value'   => 'on',
		                                'compare' => '='
	                                ]
                                ]
                            ) );

                            $photoInfo = pathinfo($work[0]['photo']);

                            if(file_exists($photoInfo['dirname'].'/'.$photoInfo['filename'].'-300x300.'.$photoInfo['extension'])){
                                $newPhoto = $photoInfo['dirname'].'/'.$photoInfo['filename'].'-300x300.'.$photoInfo['extension'];
                            }else{
                                $newPhoto = $photoInfo['dirname'].'/'.$photoInfo['filename'].'-170x170.'.$photoInfo['extension'];
                            }

                             ?>
                            <div class="column artist-thumb no-roll <?php echo $num; ?>">
                                <figure class="artist-thumb-container is-1by1">
                                    <a href="<?php echo $work[0]['link']; ?>">
                                        <img src="<?php echo $newPhoto; ?>" alt="<?php echo $work[0]['name'] . ': ' . $artist->name; ?>">
                                    </a>
                                </figure>
                                <div class="caption-box">
                                    <p class="artist-name serif"><?php echo $artist->name; ?></p>
                                    <a href="<?php echo $work[0]['link']; ?>" class="button is-info roll-thumb-link">view</a>
                                </div>
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
