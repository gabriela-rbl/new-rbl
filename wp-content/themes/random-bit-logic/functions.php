<?php
/**
 * Random Bit Logic Theme Functions
 *
 * @package RandomBitLogic
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function rbl_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'random-bit-logic'),
    ));
}
add_action('after_setup_theme', 'rbl_theme_setup');

/**
 * Enqueue scripts and styles
 */
function rbl_enqueue_scripts() {
    // Theme stylesheet
    wp_enqueue_style(
        'rbl-style',
        get_stylesheet_uri(),
        array(),
        '2.0.0'
    );

    // Three.js library
    wp_enqueue_script(
        'threejs',
        'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js',
        array(),
        'r128',
        false
    );

    // Animations JavaScript
    wp_enqueue_script(
        'rbl-animations',
        get_template_directory_uri() . '/js/animations.js',
        array('threejs'),
        '2.0.0',
        true
    );

    // Theme utilities (favicon switcher, etc.)
    wp_enqueue_script(
        'rbl-theme-utils',
        get_template_directory_uri() . '/js/theme-utils.js',
        array(),
        '2.0.0'
    );

    // Flatpickr CSS for datepicker
    wp_enqueue_style(
        'flatpickr',
        'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
        array(),
        '4.6.13'
    );

    // Flatpickr JavaScript for datepicker
    wp_enqueue_script(
        'flatpickr',
        'https://cdn.jsdelivr.net/npm/flatpickr',
        array(),
        '4.6.13',
        true
    );

    // Main JavaScript (includes form handling, popup functionality, etc.)
    wp_enqueue_script(
        'rbl-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery', 'flatpickr'),
        '2.0.1',
        true
    );
}
add_action('wp_enqueue_scripts', 'rbl_enqueue_scripts');

/**
 * Custom excerpt length
 */
function rbl_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'rbl_excerpt_length');

/**
 * Handle contact form submission
 */
function rbl_handle_contact_form() {
    if (isset($_POST['rbl_contact_submit'])) {
        // Verify nonce
        if (!isset($_POST['rbl_contact_nonce']) ||
            !wp_verify_nonce($_POST['rbl_contact_nonce'], 'rbl_contact_form')) {
            wp_die('Security check failed');
        }

        // Sanitize input
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $service = sanitize_text_field($_POST['service']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validate
        if (empty($name) || empty($email) || empty($service) || empty($message)) {
            return;
        }

        // Map service values to readable names
        $service_names = array(
            'strategy' => 'AI Strategy Session',
            'ai' => 'AI & Automation Implementation',
            'software' => 'Custom Software Development',
            'web' => 'Web Platform / Redesign',
            'other' => 'Other / General Inquiry'
        );
        $service_name = isset($service_names[$service]) ? $service_names[$service] : $service;

        // Send email
        $to = get_option('admin_email');
        $subject = 'New Inquiry: ' . $service_name . ' - ' . $name;
        $body = "New contact form submission\n\n";
        $body .= "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Interested In: $service_name\n\n";
        $body .= "Message:\n$message\n\n";
        $body .= "---\n";
        $body .= "Submitted: " . date('Y-m-d H:i:s') . "\n";

        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $name . ' <' . $email . '>'
        );

        wp_mail($to, $subject, $body, $headers);

        // Redirect with success message
        wp_redirect(add_query_arg('contact', 'success', home_url('/#contact')));
        exit;
    }
}
add_action('template_redirect', 'rbl_handle_contact_form');

/**
 * Add body classes
 */
function rbl_body_classes($classes) {
    $classes[] = 'rbl-theme';
    return $classes;
}
add_filter('body_class', 'rbl_body_classes');

/**
 * Customize wp_title
 */
function rbl_wp_title($title, $sep) {
    if (is_feed()) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo('name', 'display');

    // Add the blog description for the home/front page
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary
    if (($paged >= 2 || $page >= 2) && !is_404()) {
        $title .= " $sep " . sprintf(__('Page %s', 'random-bit-logic'), max($paged, $page));
    }

    return $title;
}
add_filter('wp_title', 'rbl_wp_title', 10, 2);
