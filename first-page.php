<?php
wp_enqueue_style("first-page", get_template_directory_uri() . '/css/first-page.css');
?>
<div class="row">
    <?php
    $args = array(
        'numberposts' => 13,
        'offset' => 0,
        'category' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
    $shift = array_shift($recent_posts);
    setup_postdata($shift);
    ?>
    <style scoped>
    </style>
    <div class="first-post">
        <a href="<?php echo get_permalink( get_the_ID() )?>">
        <?php
        $src = forum()->get_first_image( get_the_ID() );
        if ( $src ) {
            ?>
            <div class="photo">
                    <img src='<?php echo $src?>'>
            </div>
            <?php
        }
        ?>
        <div class="title"><?php the_title()?></div>
            <div class="desc">
                <?php echo mb_strcut(strip_tags( get_the_content() ), 0, 180 * 3);?>
            </div>
            </a>
    </div>
    <?php
    foreach( $recent_posts as $recent ) {
        setup_postdata($recent);
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
                <a class="photo" href="<?php echo get_permalink($recent["ID"])?>">
                    <img src='<?php echo $src?>'>
                </a>
                <?php
            }
            ?>
            <div class="first-page-post-info">
                <span class="date"><?php echo lib()->date_short($recent["post_date"])?></span>
                <span class="author">
                by
                    <?php the_author() ?>
                    </span>
            </div>
            <div class="first-page-post-desc">
                <a href="<?php echo get_permalink($recent["ID"])?>"><?php echo mb_strcut(strip_tags($recent['post_content']), 0, 3 * 88);?></a>
            </div>
        </div>
        <?php
    }
    ?>
</div>
