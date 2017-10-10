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
            <p id="copyright">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo(); ?>. <span id="siteby" style="padding: 0 0 0 1rem;"><svg version="1.1" id="kma" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="14" width="20" viewBox="0 0 12.5 8.7" style="enable-background:new 0 0 12.5 8.7;" xml:space="preserve">
                            <path class="kma" fill="#b4be35" d="M6.4,0.1c0,0,0.1,0.3,0.2,0.9c1,3,3,5.6,5.7,7.2l-0.1,0.5c0,0-0.4-0.2-1-0.4C7.7,7,3.7,7,0.2,8.5L0.1,8.1
                                c2.8-1.5,4.8-4.2,5.7-7.2C6,0.4,6.1,0.1,6.1,0.1H6.4L6.4,0.1z"/>
                            </svg> <a href="https://keriganmarketing.com" target="_blank" style="text-decoration: underline" >Site by KMA</a>.</span></p>
        </div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>