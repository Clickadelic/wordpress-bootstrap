<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<meta name="color-scheme" content="dark light">
<?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply' ); ?>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php do_action('before_wp_head_render'); ?>
<?php wp_head(); ?>
<?php do_action('after_wp_head_render'); ?>
</head>
<body id="top" <?php body_class("wordpress-bootstrap"); ?>>
<?php wp_body_open(); ?>
<?php get_template_part('templates/navbar'); ?>
<?php get_template_part('templates/slideshow'); ?>
<?php get_template_part('templates/breadcrumbs'); ?>