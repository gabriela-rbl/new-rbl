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

    <!-- Favicons for Light and Dark Mode -->
    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-light-mode.svg" id="favicon-light" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-dark-mode.svg" id="favicon-dark" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-light-mode.svg" id="favicon-default">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Topbar -->
<div class="site-topbar" id="topbar">
    <div class="topbar-content">
        <span class="topbar-badge">FREE</span>
        <span>Schedule your consultation call today<span class="hide-mobile"> - limited slots available</span></span>
        <a href="#" class="topbar-link open-consultation-popup">Book now →</a>
    </div>
</div>

<!-- Site Header -->
<header class="site-header with-topbar">
    <div class="header-container">
        <!-- Mobile hamburger menu button -->
        <button class="mobile-menu-toggle" aria-label="Toggle navigation menu" aria-expanded="false">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <?php /*
        <a href="<?php echo home_url(); ?>" class="site-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="Random Bit Logic Logo" style="height: 45px;">
        </a> */ ?>

        <?php if (has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <a href="<?php echo home_url(); ?>" class="site-logo">
                <span style="font-size: 1.5rem; font-weight: 800; color: var(--text-dark);">Random Bit Logic</span>
            </a>
        <?php endif;?>

        <nav class="main-nav">
            <ul>
                <li><a href="<?php echo home_url('/#enterprise'); ?>">Solutions</a></li>
                <li><a href="<?php echo home_url('/#solutions'); ?>">Services</a></li>
                <li><a href="<?php echo home_url('/#seatserve'); ?>">Cases</a></li>
                <li><a href="<?php echo esc_url(home_url('/insights/')); ?>">Insights</a></li>
            </ul>
        </nav>

        <div class="header-actions">
<!--            <a href="#" class="login-link">Login</a>-->
            <a href="#" class="nav-cta open-consultation-popup">
                <span>Request a demo</span>
                <span class="arrow">→</span>
            </a>
        </div>
    </div>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay">
        <nav class="mobile-nav">
            <ul>
                <li><a href="<?php echo home_url('/#enterprise'); ?>">Solutions</a></li>
                <li><a href="<?php echo home_url('/#solutions'); ?>">Services</a></li>
                <li><a href="<?php echo home_url('/#seatserve'); ?>">Cases</a></li>
                <li><a href="<?php echo esc_url(home_url('/insights/')); ?>">Insights</a></li>
<!--                <li><a href="#" class="mobile-login">Login</a></li>-->
            </ul>
        </nav>
    </div>
</header>
