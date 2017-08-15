<?php
/**
 * Portfolio
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Portfolio {

    /**
     * Slider constructor.
     */
    function __construct() {

    }

    /**
     * @return null
     */
    public function createPostType() {

        $work = new Custom_Post_Type( 'Work', array(
            'supports'           => array( 'title', 'revisions' ),
            'menu_icon'          => 'dashicons-images-alt2',
            'rewrite'            => array( 'with_front' => false ),
            'has_archive'        => false,
            'menu_position'      => null,
            'public'             => false,
            'publicly_queryable' => false,
        ) );

        $work->add_taxonomy( 'Artist' );

        $work->add_meta_box( 'Work Details', array(
            'Photo File'         => 'image',
            'Author'             => 'text',
            'Title'              => 'text',
            'Alt Tag'            => 'text',
        ) );

        $work->add_meta_box(
            'Long Description',
            array(
                'HTML' => 'wysiwyg',
            )
        );

    }

    /**
     * @param author ( post type category )
     * @return HTML
     */
    public function getWork( $category = '' ){

        $request = array(
            'posts_per_page' => - 1,
            'offset'         => 0,
            'order'          => 'ASC',
            'orderby'        => 'menu_order',
            'post_type'      => 'slide_image',
            'post_status'    => 'publish',
        );

        if ( $category != '' ) {
            $categoryarray        = array(
                array(
                    'taxonomy'         => 'slider',
                    'field'            => 'slug',
                    'terms'            => $category,
                    'include_children' => false,
                ),
            );
            $request['tax_query'] = $categoryarray;
        }

        $results = get_posts( $request );

        $resultArray = array();
        foreach ( $results as $item ){

            array_push($resultArray, array(
                'id'            => (isset($item->ID)                               ? $item->ID : null),
                'name'          => (isset($item->post_title)                       ? $item->post_title : null),
                'slug'          => (isset($item->post_name)                        ? $item->post_name : null),
                'photo'         => (isset($item->work_details_photo_file)          ? $item->work_details_photo_file : null),
                'author'        => (isset($item->work_author)                      ? $item->work_details_headline : null),
                'title'         => (isset($item->work_details_caption)             ? $item->work_details_caption : null),
                'alt'           => (isset($item->work_details_alt_tag)             ? $item->work_details_alt_tag : null),
                'description'   => (isset($item->long_description_html)            ? $item->long_description_html : null),
                'link'          => get_permalink($item->ID),
            ));

        }

        return $resultArray;

    }

    /**
     * @param author ( post type category )
     * @return HTML
     */
    public function getFeatured($artist = ''){

        $slides = $this->getSlides($artist);
        $slider = '';

        $i = 0;
        foreach($slides as $slide){

            $slider .= '<slide image="'.$slide['photo'].'" '.( $i==0 ? ':active="true"' : '' ).'>
                    <section class="hero is-fullheight is-transparent white-80">
                        <div class="hero-label">
                            <div class="container">'
                               . ($slide['author'] != '' ? '<h2 class="title is-1">'.$slide['author'].'</h2>' : '')
                               . ($slide['caption'] != '' ? '<p class="subtitle is-3">'.$slide['caption'].'</p>' : '')
                               . ($slide['description'] != '' ? $slide['description'] : '') .
                            '</div>
                        </div>
                    </section>
                </slide>';
            $i++;
        }

        return $slider;

    }

}