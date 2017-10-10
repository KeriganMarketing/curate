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

        $this->createWork();
        $this->createFeaturedWork();

    }

    private function createWork(){
	    $work = new CustomPostType( 'Work', [
		    'supports'           => [ 'title', 'revisions' ],
		    'menu_icon'          => 'dashicons-images-alt2',
		    'rewrite'            => [ 'with_front' => false ],
		    'has_archive'        => false,
		    'menu_position'      => null,
		    'public'             => false,
		    'publicly_queryable' => false,
	    ] );

	    $work->addTaxonomy( 'Artist' );
	    $work->convertCheckToRadio( 'artist' );

	    $work->addMetaBox( 'Work Details', [
		    'Photo File'           => 'image',
		    'Feature on Home page' => 'boolean',
            'Size'                 => 'text',
            'Price'                => 'text'
	    ] );

	    $work->addMetaBox( 'Long Description', [
		    'html'                 => 'wysiwyg',
	    ] );

    }

    private function createFeaturedWork(){
	    $featured = new CustomPostType( 'Featured Work', [
		    'supports'           => [ 'title', 'revisions' ],
		    'menu_icon'          => 'dashicons-images-alt2',
		    'rewrite'            => [ 'with_front' => false ],
		    'has_archive'        => false,
		    'menu_position'      => null,
		    'public'             => false,
		    'publicly_queryable' => false,
	    ] );

	    add_action('init', function(){
		    register_taxonomy_for_object_type('artist', 'featured_work');
	    });


	    $featured->addMetaBox( 'Work Details', [
		    'Photo File'           => 'image',
		    'Feature on Home page' => 'boolean',
	    ] );

	    $featured->addMetaBox( 'Long Description', [
		    'html'                 => 'wysiwyg',
	    ] );
    }

	/**
	 * @return null
	 */
	public function createAdminColumns() {

	    add_filter('manage_work_posts_columns',
            function ($defaults) {
                $defaults = [
                    'title'      => 'Title',
                    'artist'     => 'Artist',
                    'featured'   => 'Featured',
                    'work_photo' => 'Photo',
                    'date'       => 'Date'
                ];

                return $defaults;
            }, 0);

        add_action('manage_work_posts_custom_column', function ($column_name, $post_ID) {
            switch ($column_name) {
                case 'artist':
                    $term = wp_get_object_terms($post_ID, 'artist');
                    echo(isset($term[0]->name) ? $term[0]->name : null);
                    break;

                case 'work_photo':
                    $photo = get_post_meta($post_ID, 'work_details_photo_file', true);
	                $photoInfo = pathinfo($photo);
	                $newPhoto = $photoInfo['dirname'].'/'.$photoInfo['filename'].'-170x170.'.$photoInfo['extension'];
                    echo(isset($photo) ? '<img src ="' . $newPhoto . '" class="img-fluid" style="width:200px; max-width:100%;" >' : null);
                    break;

                case 'featured':
                    $featured = get_post_meta($post_ID, 'work_details_feature_on_home_page', true);
                    echo($featured == 'on' ? 'TRUE' : 'FALSE');
                    break;
            }
        }, 0, 2);

        add_action('restrict_manage_posts', function () {
            $type = 'post';
            if (isset($_GET['post_type'])) {
                $type = $_GET['post_type'];
            }

            if ('work' == $type) {

                $values = get_terms([
                    'taxonomy'   => 'artist',
                    'hide_empty' => false,
                ]);

                echo '<select name="artist">
                    <option value="">All Artists</option>';

                $current_v = isset($_GET['artist']) ? $_GET['artist'] : '';
                foreach ($values as $label => $value) {
                    printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value->slug,
                        $value->slug == $current_v ? ' selected="selected"' : '',
                        $value->name
                    );
                }

                echo '</select>';

            }
        });

	}

    /**
     * @param author ( post type category )
     * @return HTML
     */
    public function getWork( $taxonomy = '', $requestArray = [] ){

	    $request = [
		    'posts_per_page' => - 1,
		    'offset'         => 0,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order',
		    'post_type'      => 'work',
		    'post_status'    => 'publish',
	    ];

	    if ( $taxonomy != '' ) {
		    $categoryarray = [
			   [
				    'taxonomy'         => 'artist',
				    'field'            => 'slug',
				    'terms'            => $taxonomy,
				    'include_children' => false,
			    ],
		    ];
		    $request['tax_query'] = $categoryarray;
	    }

	    $args = array_merge( $request, $requestArray );

        //echo '<pre>',print_r($args),'</pre>';

	    $results = get_posts( $args );

        $resultArray = [];
        foreach ( $results as $item ){

        	$taxonomies = get_the_terms($item, 'artist');

	        array_push( $resultArray, [
		        'id'          => ( isset( $item->ID ) ? $item->ID : null ),
		        'name'        => ( isset( $item->post_title ) ? $item->post_title : null ),
		        'slug'        => ( isset( $item->post_name ) ? $item->post_name : null ),
                'size'        => ( isset( $item->work_details_size ) ? $item->work_details_size : null ),
                'price'       => ( isset( $item->work_details_price ) ? $item->work_details_price : null ),
		        'photo'       => ( isset( $item->work_details_photo_file ) ? $item->work_details_photo_file : null ),
		        'author'      => $taxonomies[0]->name,
		        'featured'    => ( isset( $item->work_details_feature_on_home_page ) ? $item->work_details_feature_on_home_page : null ),
		        'link'        => get_term_link( $taxonomies[0] ),
	        ] );

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
	        $output .= '<portfolioslide :id="'.$i.'" image="'.$item['photo'].'" artist="'.$item['author'].'" title="'.$item['name'].'" link="'.$item['link'].'" :islast="'.($i==count($resultArray) ? 'true' : 'false' ).'" ></portfolioslide>';
            $i++;
        }

        return $output;

    }

    public static function getArtists( $limit = 0 ){

        $artists = get_terms([
            'taxonomy'   => 'artist',
//            'orderby'    => 'term_order', Applied by SCP Order plugin
//            'number'     => $limit, This doesn't work with SCP Order plugin
            'hide_empty' => false,
        ]);

        //chop to limit manually since SCP Order is ganked.
        if ($limit != 0) {
            $artists = array_slice($artists, 0, $limit);
        }

        return $artists;

    }

    public function addTaxonomyMeta(){

        // SANITIZE DATA
        function ___sanitize_artist_meta_text ( $value ) {
            return sanitize_text_field ($value);
        }

        // GETTER (will be sanitized)
        function ___get_artist_video_embed( $term_id ) {
            $value = get_term_meta( $term_id, '__artist_video_embed', true );
            $value = ___sanitize_artist_meta_text( $value );
            return $value;
        }

        // ADD FIELD TO CATEGORY TERM PAGE
        add_action( 'artist_add_form_fields', '___add_form_field_artist_video_embed' );
        function ___add_form_field_artist_video_embed() { ?>
            <?php wp_nonce_field( basename( __FILE__ ), 'artist_video_embed_nonce' ); ?>
            <div class="form-field artist-meta-text-wrap">
                <label for="artist-meta-video-embed"><?php _e( 'Video Embed Code', 'kmaslim' ); ?></label>
                <textarea style="min-height:200px;" name="artist_video_embed" id="artist-video-embed" class="artist-video-embed-field"></textarea>
            </div>
        <?php }

        // ADD FIELD TO CATEGORY EDIT PAGE
        add_action( 'artist_edit_form_fields', '___edit_form_field_artist_video_embed' );
        function ___edit_form_field_artist_video_embed( $term ) {
            $value  = ___get_artist_video_embed( $term->term_id );
            if ( ! $value )
                $value = ""; ?>

            <tr class="form-field artist-video-embed-wrap">
                <th scope="row"><label for="artist-video-embed"><?php _e( 'Video Embed Code', 'text_domain' ); ?></label></th>
                <td>
                    <?php wp_nonce_field( basename( __FILE__ ), 'artist_video_embed_nonce' ); ?>
                    <textarea style="min-height:200px;" name="artist_video_embed" id="artist-video-embed" class="artist-video-embed-field"><?php echo esc_attr( $value ); ?></textarea>
                </td>
            </tr>
        <?php }

        // SAVE TERM META (on term edit & create)
        add_action( 'edit_artist',   '___save_artist_video_embed' );
        add_action( 'create_artist', '___save_artist_video_embed' );
        function ___save_artist_meta_text( $term_id ) {
            // verify the nonce --- remove if you don't care
            if ( ! isset( $_POST['artist_video_embed_nonce'] ) || ! wp_verify_nonce( $_POST['artist_video_embed_nonce'], basename( __FILE__ ) ) )
                return;
            $old_value  = ___get_artist_video_embed( $term_id );
            $new_value = isset( $_POST['artist_video_embed'] ) ? ___sanitize_artist_meta_text ( $_POST['artist_video_embed'] ) : '';
            if ( $old_value && '' === $new_value )
                delete_term_meta( $term_id, '__artist_video_embed' );
            else if ( $old_value !== $new_value )
                update_term_meta( $term_id, '__artist_video_embed', $new_value );
        }

    }

}