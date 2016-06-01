<?php
ob_start();
/**
 *
 */
    $options = get_option( SITEAPI_OPTION );
    $option_name = "site_title_image";
    if ( isset($options[$option_name]) && $options[$option_name] ) $src_title_image = $options[$option_name];
    else $src_title_image = get_template_directory_uri() . "/tmp/title-image.png";


?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if (function_exists('is_tag') && is_tag()) { echo 'Tag Archive for &quot;'.$tag.'&quot; - '; } elseif (is_archive()) { wp_title(''); echo ' Archive - '; } elseif (is_search()) { echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; } elseif (!(is_404()) && (is_single()) || (is_page())) { wp_title(''); echo ' - '; } elseif (is_404()) { echo 'Not Found - '; } if (is_home()) { bloginfo('name'); echo ' - '; bloginfo('description'); } else { bloginfo('name'); } ?></title>
    <?php wp_head();?>

    <script>
        var home_url = "<?php echo home_url()?>";
    </script>
</head>
<body <?php body_class( is_front_page() ? 'front' : '' ); ?>>

<header>
    <div class="header-inner">
        <nav class="xs menu">
            <span class="icon left dashicons dashicons-admin-home"></span>
            <span class="project-name"><?php include 'part/site-title.php'?></span>
            <span class="icon right dashicons dashicons-menu"></span>
        </nav>
        <nav class="xs sub-menu">
            <?php echo get_header_sub_menu()?>
        </nav>

        <div class="md">
            <nav class="md-menu md-menu-fixed">
                <span class="project-name"><?php include 'part/site-title.php'?></span>
                <?php echo get_header_sub_menu()?>
            </nav>
            <div class="md-movable-header">
                <div class="md-title-image">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <img src="<?php echo $src_title_image?>">
                    </a>
                </div>
                <nav class="md-menu">
                    <?php /*
                    <span class="project-name"><?php include 'part/site-title.php'?></span>
 */ ?>
                    <?php echo get_header_sub_menu()?>
                </nav>
            </div>
        </div>
    </div>
</header>
<section class="layout-content">
    <div class="layout-content-inner">
        <div class="content-left">
            <div class="content-left-inner">

