<?php


?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head();?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
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
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri()?>/tmp/title-image.png"></a>
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
