<?php
/**
 * 404 Page
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="hero is-light">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">404</h1>
                    <p class="subtitle">Page not found</p>
                </div>
            </div>
        </section>
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content">
                    <p>The page you requested does not exist or is no longer available.</p>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>