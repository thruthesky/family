<div class="row">
    <?php
    $args = array(
        'numberposts' => 12,
        'offset' => 0,
        'category' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
    foreach( $recent_posts as $recent ) {
        ?>
        <div class="first-page-post col-xs-6 col-lg-4">
            <h2 class="first-page-post-title">
                <a href="<?php echo get_permalink($recent["ID"])?>">
                    <?php echo mb_strcut($recent["post_title"], 0, 3 * 25)?>
                </a>
            </h2>
            <?php
            $src = forum()->get_first_image($recent['ID']);
            if ( $src ) {
                ?>
                <a href="<?php echo get_permalink($recent["ID"])?>">
                    <img src='<?php echo $src?>'>
                </a>
                <?php
            }
            ?>
            <div>
                <?php echo mb_strcut(strip_tags($recent['post_content']), 0, 3 * 88);?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
