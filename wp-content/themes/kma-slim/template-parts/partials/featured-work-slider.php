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
        'meta_query' => array(
            array(
                'key'     => 'work_details_feature_on_home_page',
                'value'   => 'on',
                'compare' => '='
            )
        )
    ) );
    ?>
</portfolioslider>
