<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$contactInfo = get_post( get_option( 'page_on_front' ), OBJECT);

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

        <div class="has-text-centered">
            <div class="social">
                <?php
                $social = new SocialSettingsPage();
                $socialLinks = $social->getSocialLinks('svg','circle');
                if(is_array($socialLinks)) {
                    foreach ( $socialLinks as $socialId => $socialLink ) {
                        echo '<a class="' . $socialId . '" href="' . $socialLink[0] . '" target="_blank" >' . $socialLink[1] . '</a>';
                    }
                }
                ?></div>
        </div>

        <div class="container">
            <div class="contact-location">
                <div class="columns is-centered">
                    <div class="column is-narrow is-12-mobile">
                        <h3 class="serif">contact:</h3>
                        <p><a href="tel:<?php echo $contactInfo->contact_info_phone; ?>" ><?php echo $contactInfo->contact_info_phone; ?></a><br>
                            <a href="mailto:<?php echo $contactInfo->contact_info_email; ?>" ><?php echo $contactInfo->contact_info_email; ?></a></p>
                    </div>
                    <div class="column is-narrow is-12-mobile">
                        <h3 class="serif">address:</h3>
                        <p><?php echo nl2br($contactInfo->contact_info_address); ?></p>
                    </div>
                    <div class="column is-narrow is-12-mobile">
                        <h3 class="serif">hours:</h3>
                        <p><?php echo nl2br($contactInfo->contact_info_hours); ?></p>
                    </div>
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