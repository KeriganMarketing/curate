<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

$artist = get_term_by( 'slug', get_query_var( 'term' ), 'artist' );
$type = isset($_GET['type']) ? $_GET['type'] : null;
$typeObject = get_term_by( 'slug', $type, 'work_type' );

$headline = $artist->name;
$subhead = '';
$modalContent = '';

$portfolio = new Portfolio();
$profilePhoto = get_term_meta( $artist->term_id, 'artist_artist_photo', true );
if($profilePhoto != ''){
    $photoInfo = pathinfo($profilePhoto);
    $artistPhoto = $photoInfo['dirname'].'/'.$photoInfo['filename'].'-300x300.'.$photoInfo['extension'];
}else{
    $profilePhoto = $portfolio->getWork( $artist->slug, [
        'posts_per_page' => 1,
        'meta_query'     => [
            [
                'key'     => 'work_details_feature_on_home_page',
                'value'   => 'on',
                'compare' => '='
            ]
        ]
    ] )[0];

    $wpID = attachment_url_to_postid($profilePhoto['photo']);
    $bigPhoto = wp_get_attachment_image_src($wpID,'thumbnail');
    $smallPhoto = wp_get_attachment_image_src($wpID,'small-thumbnail');

    if($bigPhoto && $bigPhoto[1] == '300' && $bigPhoto[2] == '300'){
        $artistPhoto = $bigPhoto[0];
    }else{
        $artistPhoto = $smallPhoto[0];
    }

}


$workTypes = $portfolio->getWorkTypes($artist);
//echo '<pre>',print_r($profilePhoto),'</pre>';

?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content two-column">
                    <?php if(!$type) { ?>
                    <div class="columns" >
                        <div class="column is-8-tablet is-9-desktop artist-left">
                            <div class="content">
                                <div class="columns">
                                    <div class="column is-12-mobile is-4-desktop">
                                        <figure class="artist-profile" >
                                            <p class="image is-150x150">
                                                <img src="<?php echo $artistPhoto; ?>" alt="<?php echo $artist->name; ?>">
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
                        <div class="column is-4-tablet is-3-desktop artist-right">
                            <div class="columns is-multiline">
                            <?php foreach($workTypes as $num => $type){

                                if(isset($type['work']['photo'])) {
                                    $wpID = attachment_url_to_postid($type['work']['photo']);
                                    $bigPhoto = wp_get_attachment_image_src($wpID,'thumbnail');
                                    $smallPhoto = wp_get_attachment_image_src($wpID,'small-thumbnail');

                                    if($bigPhoto && $bigPhoto[1] == '300' && $bigPhoto[2] == '300'){
                                        $newPhoto = $bigPhoto[0];
                                    }else{
                                        $newPhoto = $smallPhoto[0];
                                    }
                                ?>
                                <div class="column is-6-mobile is-12-tablet <?php echo $num; ?>">
                                    <figure class="artist-thumb-container is-1by1">
                                        <a href="<?php echo $type['work']['link']. '?type=' . $type['taxonomy']->slug; ?>">
                                            <img src="<?php echo $newPhoto; ?>" alt="<?php echo $type['taxonomy']->name . ': ' . $artist->name; ?>">
                                        </a>
                                    </figure>
                                    <div class="caption-box">
                                        <p class="artist-name serif"><?php echo $type['taxonomy']->name; ?></p>
                                    </div>
                                </div>
                            <?php
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>

                        <h1 class="title is-1"><?php echo $headline; ?></h1>
                        <p class="subtitle"><?php echo $typeObject->name; ?></p>
                        <p><a class="button is-primary" href="/artist/<?php echo $artist->slug; ?>" >Back to Artist</a></p>

                        <div class="columns is-multiline">
                            <?php

                            $work = $portfolio->getWork(
                                    $artist->slug,
                                    [
                                        'tax_query' => [
                                            'relation' => 'AND',
                                            [
                                                'taxonomy' => 'work_type',
                                                'field'    => 'slug',
                                                'terms' => $type,
                                                'include_children' => false
                                            ],
                                            [
                                                'taxonomy' => 'artist',
                                                'field'    => 'slug',
                                                'terms' => $artist->slug,
                                                'include_children' => false
                                            ]
                                        ]
                                    ]
                            );

                            $i = 0;
                            clearstatcache();
                            foreach($work as $num => $piece){
                                $photoInfo = pathinfo($piece['photo']);
                                $wpID = attachment_url_to_postid($piece['photo']);
                                $bigPhoto = wp_get_attachment_image_src($wpID,'thumbnail');
                                $smallPhoto = wp_get_attachment_image_src($wpID,'small-thumbnail');

                                if($bigPhoto && $bigPhoto[1] == '300' && $bigPhoto[2] == '300'){
                                    $newPhoto = $bigPhoto[0];
                                }else{
                                    $newPhoto = $smallPhoto[0];
                                }

                                $modalContent .= '<slide '.( $i==0 ? ':active="true"' : '' ).'>
                                    <div class="content is-centered">
                                        <div class="image-container">
                                            <img src="'.$piece['photo'].'" >
                                        </div>
                                        <div class="caption-container">
                                            <h3 class="serif">'.$piece['name'].'</h3>
                                            <p>'.$artist->name.
                                                 ( $piece['medium']!='' ? ' | '.$piece['medium'] : '') .
                                                 ( $piece['size']!='' ? ' | '.$piece['size'] : '') .
                                                 //( $piece['price']!='' && is_numeric ($piece['price']) ? ' | $'.number_format($piece['price']) : '') .
                                                 '</p>
                                            <p><a class="button is-secondary" href="mailto:curate30a@gmail.com?subject=Please send information regarding '.$piece['name'].' by '.$artist->name.'" >request information</a></p>
                                        </div>
                                    </div>
                                </slide>';
                                ?>
                                <div class="column is-3 artist-thumb no-roll <?= $num; ?>">
                                    <figure class="artist-thumb-container is-1by1">
                                        <a @click="$emit('toggleModal', 'workViewer',<?= $num; ?>)" >
                                            <img src="<?= $newPhoto; ?>" alt="<?= $piece['name'] . ': ' . $artist->name; ?>">
                                            <span class="piece-name"><?= $piece['name']; ?></span>
                                        </a>
                                    </figure>
                                </div>
                                <?php
                                $i++;
                            }
                            ?>
                        </div>

                    <?php } ?>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php if($modalContent!='') { ?>
    <modal>
        <div class="work-viewer" >
            <slider>
                <?php echo $modalContent; ?>
            </slider>
        </div>
    </modal>
<?php } ?>

