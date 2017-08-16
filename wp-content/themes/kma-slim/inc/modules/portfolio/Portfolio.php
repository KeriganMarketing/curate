<?php
/**
 * Portfolio
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Portfolio {

    /**
     * Portfolio constructor.
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
		    'Photo File'           => 'image',
		    'Author'               => 'text',
		    'Feature on Home page' => 'boolean',
		    'Title'                => 'text',
		    'Alt Tag'              => 'text',
	    ) );

        $work->add_meta_box(
            'Long Description',
            array(
                'HTML' => 'wysiwyg',
            )
        );

    }

	/**
	 * @return null
	 */
	public function createAdminColumns() {

		//TODO: make this work...

	}

    /**
     * @param author ( post type category )
     * @return HTML
     */
    public function getWork( $taxonomy = '', $requestArray = array() ){

	    $request = array(
		    'posts_per_page' => - 1,
		    'offset'         => 0,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order',
		    'post_type'      => 'work',
		    'post_status'    => 'publish',
	    );

	    if ( $taxonomy != '' ) {
		    $categoryarray        = array(
			    array(
				    'taxonomy'         => 'artist',
				    'field'            => 'slug',
				    'terms'            => $taxonomy,
				    'include_children' => false,
			    ),
		    );
		    $request['tax_query'] = $categoryarray;
	    }

	    $args = array_merge( $request, $requestArray );

	    $results = get_posts( $args );

        $resultArray = array();
        foreach ( $results as $item ){

        	$taxonomies = get_the_terms($item, artist);

	        array_push( $resultArray, array(
		        'id'          => ( isset( $item->ID ) ? $item->ID : null ),
		        'name'        => ( isset( $item->post_title ) ? $item->post_title : null ),
		        'slug'        => ( isset( $item->post_name ) ? $item->post_name : null ),
		        'photo'       => ( isset( $item->work_details_photo_file ) ? $item->work_details_photo_file : null ),
		        'author'      => $taxonomies[0]->name,
		        'featured'    => ( isset( $item->work_details_feature_on_home_page ) ? $item->work_details_feature_on_home_page : null ),
		        'description' => ( isset( $item->long_description_html ) ? $item->long_description_html : null ),
		        'link'        => get_permalink( $item->ID ),
	        ) );

        }


        return $resultArray;

    }

    /**
     * @param $taxonomy
     * @param array for get_posts
     * @return HTML
     */
    public function getWorkSlider($taxonomy = '', $requestArray = array()){

	    $resultArray = $this->getWork($taxonomy, $requestArray);
        $output = '';

        $i = 1;
        foreach($resultArray as $item){
	        $output .= '<portfolioslide :id="'.$i.'" image="'.$item['photo'].'" artist="'.$item['author'].'" title="'.$item['name'].'" link="'.$item['link'].'" ></portfolioslide>';
            $i++;
        }

        return $output;

    }

}