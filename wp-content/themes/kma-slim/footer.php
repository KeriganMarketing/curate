<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>
<footer id="bot" >
    <div class="section-wrapper white-section">

        <div class="footer-menu navbar-menu" >
            <?php wp_nav_menu( array(
                'theme_location' => 'footer-menu',
                'container'      => false,
                'menu_class'     => 'navbar is-trnsparent',
                'fallback_cb'    => '',
                'menu_id'        => 'footer-menu',
                'link_before'    => '',
                'link_after'     => '',
                'items_wrap'     => '<div id="%1$s" class="%2$s">%3$s</div>',
                'walker'         => new bulma_navwalker()
            ) ); ?>
        </div>

        <div class="footer-logo has-text-centered">
            <?php echo file_get_contents(wp_normalize_path(get_template_directory().'/img/curate.svg')); ?>
        </div>

    </div>
    <div class="section-wrapper gray-section">

        <div class="social-icons has-text-centered">

        </div>

        <div class="contact-location">
            <div class="container">
                <div class="is-one-third-desktop">
                    <?php //TODO: make fields editable ?>
                </div>
                <div class="is-one-third-desktop">
                    <?php //TODO: make fields editable ?>
                </div>
                <div class="is-one-third-desktop">
                    <?php //TODO: make fields editable ?>
                </div>
            </div>
        </div>

        <div class="signoff">
            <p id="copyright">&copy; <?php echo date('Y'); ?> {{ copyright }} <span id="siteby" >{{ siteby }}</span></p>
        </div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>