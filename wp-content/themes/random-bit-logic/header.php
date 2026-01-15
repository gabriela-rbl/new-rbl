<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Random Bit Logic - AI-first software development agency based in NYC. Full-stack development and AI consultancy with global reach.">
    <meta name="keywords" content="AI development, software agency, full-stack development, AI consultancy, custom web platforms, autonomous agents">
    <meta name="author" content="Random Bit Logic">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
    <meta property="og:description" content="AI-first software development agency. We build custom platforms that transform your business.">
    <meta property="og:url" content="<?php echo home_url(); ?>">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="AI-first software development agency">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Site Header -->
<header class="site-header">
    <a href="<?php echo home_url(); ?>" class="site-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rbl-logo.png" alt="Random Bit Logic" />
    </a>
</header>
