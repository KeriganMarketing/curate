<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M6HWN8G');</script>
    <!-- End Google Tag Manager -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <?php if(is_page(15)){ ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API; ?>" ></script>
    <?php } ?>
</head>

<body <?php body_class(); ?> >
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M6HWN8G" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'kmaslim' ); ?></a>
<div id="app">
<header id="top" class="header">
    <nav class="navbar">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="<?php echo get_template_directory_uri() . '/img/curate-logo.svg'; ?>" alt="curate, a collaboration with vinings gallery" style="width:100%;" >
            </a>

            <div class="navbar-burger burger" id="TopNavBurger" data-target="TopNavMenu" @click="toggleMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="TopNavMenu" :class="[{ 'is-active': isOpen }, 'navbar-menu']" >
			<?php wp_nav_menu( array(
					'theme_location' => 'main-menu',
					'container'      => false,
					'menu_class'     => 'navbar-end',
					'fallback_cb'    => '',
					'menu_id'        => 'main-menu',
					'link_before'    => '',
					'link_after'     => '',
					'items_wrap'     => '<div id="%1$s" class="%2$s">%3$s</div>',
					'walker'         => new bulma_navwalker()
				) ); ?>
        </div>
    </nav>


</header>
