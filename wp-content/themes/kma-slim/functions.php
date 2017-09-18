<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

require('vendor/autoload.php');
require('inc/bulma_navwalker.php');
require('inc/bulma_pagination.php');
require('inc/CustomPostType/CustomPostType.php');
include('inc/modules/social/sociallinks.php');
include('inc/modules/layouts/Layouts.php');
include('inc/modules/portfolio/Portfolio.php');

$socialLinks = new SocialSettingsPage();
if(is_admin()) {
    $socialLinks->createPage();
}

$portfolio = new Portfolio();
$portfolio->createPostType();
$portfolio->createAdminColumns();
$portfolio->addTaxonomyMeta();

$layouts = new Layouts();
$layouts->createPostType();
$layouts->createDefaultFormats();

if(is_admin()) {

    $post_id = ( isset ( $_GET['post'] ) ? $_GET['post'] : ( isset ( $_POST['post_ID'] ) ? $_POST['post_ID'] : null ) );

    if ( ($post_id == get_option( 'page_on_front' ) ? true : false) ) {
        $frontpage = new CustomPostType('Page');
        $frontpage->addMetaBox('Contact Info', array(
            'phone'   => 'text',
            'email'   => 'text',
            'address' => 'textarea',
            'hours'   => 'textarea'
        ));
    }

};

if ( ! function_exists( 'kmaslim_setup' ) ) :

function kmaslim_setup() {

	load_theme_textdomain( 'kmaslim', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'mobile-menu'    => esc_html__( 'Mobile Menu', 'kmaslim' ),
		'footer-menu'    => esc_html__( 'Footer Menu', 'kmaslim' ),
		'main-menu'      => esc_html__( 'Main Navigation', 'kmaslim' )
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption'
	) );

	function kmaslim_inline() {?>
		<style type="text/css">
			<?php echo file_get_contents(get_template_directory() . '/style.css'); ?>
		</style>
	<?php }
	add_action( 'wp_head', 'kmaslim_inline' );

	add_image_size( 'small-thumbnail', 170, 170, true );

}
endif;
add_action( 'after_setup_theme', 'kmaslim_setup' );

function kmaslim_scripts() {
	wp_register_script( 'scripts', get_template_directory_uri() . '/app.js', array(), '0.0.1', true );
	wp_enqueue_script( 'scripts' );
//	wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'kmaslim_scripts' );