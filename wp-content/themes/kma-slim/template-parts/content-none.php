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
        <section id="content" class="content section">
            <div class="container">
                <div class="entry-content one-column is-centered">
                    <h1 class="title is-1">404</h1>
                    <p class="subtitle">Page not found</p>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>