<?php
$project_name = "Project Name";

$menus = [];
$menus[] = "<a class='' href=''>Home</a>";
$menus[] = "<a class='' href=''>About</a>";
$menus[] = "<a class='' href=''>Forum</a>";
$menus[] = "<a class='' href=''>Contact</a>";

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

<nav class="xs menu">
    <span class="icon left dashicons dashicons-admin-home"></span>
    <span class="project-name"><?php echo $project_name?></span>
    <span class="icon right dashicons dashicons-menu"></span>
</nav>
<nav class="xs sub-menu">
    <?php foreach ( $menus as $menu ) { ?>
        <?php echo $menu ?>
    <?php } ?>
</nav>
<nav class="md navbar navbar-fixed-top navbar-dark bg-inverse">
    <a class="navbar-brand" href="<?php echo home_url()?>"><?php echo $project_name?></a>

    <ul class="nav navbar-nav">
        <li class="nav-item active home"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item about"><a class="nav-link" href="#">About</a></li>
        <li class="nav-item forum"><a class="nav-link" href="#">Forum</a></li>
        <li class="nav-item contact"><a class="nav-link" href="#">Contact</a></li>
    </ul>

</nav>

<div class="container content">
    <div class="row content-left-right">
        <div class="col-xs-12 col-sm-9 content-left">
