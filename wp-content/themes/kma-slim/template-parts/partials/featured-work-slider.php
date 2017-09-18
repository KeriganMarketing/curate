<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>
<portfolioslider>
    <?php
    echo $portfolio->getWorkSlider(null, array(
	    'post_type'      => 'featured_work'
    ) );
    ?>
</portfolioslider>
