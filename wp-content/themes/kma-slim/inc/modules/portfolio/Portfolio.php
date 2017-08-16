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
		    'Feature on Home page' => 'boolean',
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

        //Create column labels in admin view
        add_filter('manage_work_posts_columns', 'columns_head_work', 0);
        function columns_head_work($defaults) {

            $defaults = array(
                'title'      => 'Title',
                'artist'     => 'Artist',
                'featured'    => 'Featured',
                'work_photo' => 'Photo',
                'date'       => 'Date'
            );

            return $defaults;
        }

        //Creates data used in each column
        add_action('manage_work_posts_custom_column', 'columns_content_work', 0, 2);
        function columns_content_work($column_name, $post_ID) {
            switch ( $column_name ) {
                case 'lead_type':
                    $term = wp_get_object_terms( $post_ID, 'type' );
                    echo (isset($term[0]->name) ? $term[0]->name : null );
                    break;

                case 'work_photo':
                    $photo = get_post_meta( $post_ID, 'work_details_photo_file', TRUE );
                    echo (isset($photo) ? '<img src ="'.$photo.'" class="img-fluid" style="width:400px; max-width:100%;" >' : null );
                    break;

                case 'featured':
                    $featured = get_post_meta( $post_ID, 'work_details_feature_on_home_page', true );
                    echo ( $featured == 'on' ? 'TRUE' : 'FALSE' );
                    break;
            }
        }

        //Adds a dropdown in the admin view to filter by artist (taxonomy)
        add_action( 'restrict_manage_posts', 'admin_posts_filter_restrict_manage_posts' );
        function admin_posts_filter_restrict_manage_posts(){
            $type = 'post';
            if (isset($_GET['post_type'])) {
                $type = $_GET['post_type'];
            }

            if ('work' == $type){

                $values = get_terms( array(
                    'taxonomy' => 'artist',
                    'hide_empty' => false,
                ) );

                ?>
                <select name="artist">
                    <option value="">All Artists</option>
                    <?php
                    $current_v = isset($_GET['artist'])? $_GET['artist']:'';
                    foreach ($values as $label => $value) {
                        printf
                        (
                            '<option value="%s"%s>%s</option>',
                            $value->slug,
                            $value->slug == $current_v ? ' selected="selected"':'',
                            $value->name
                        );
                    }
                    ?>
                </select>
                <?php
            }
        }

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