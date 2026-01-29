<?php
/**
 * Plugin Name: RBL Form Submissions
 * Plugin URI: https://randombitlogic.com
 * Description: Handles form submissions for consultation requests and contact forms, stores them in database and sends email notifications
 * Version: 1.0.0
 * Author: Random Bit Logic
 * Author URI: https://randombitlogic.com
 * License: GPL v2 or later
 * Text Domain: rbl-form-submissions
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin class
 */
class RBL_Form_Submissions {

    /**
     * Database table name
     */
    private $table_name;

    /**
     * Email recipient
     */
    private $notification_email = 'sgs@randombitlogic.com';

    /**
     * Constructor
     */
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'rbl_form_submissions';

        // Activation hook
        register_activation_hook(__FILE__, array($this, 'activate'));

        // Initialize plugin
        add_action('init', array($this, 'init'));

        // Admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));

        // Admin styles
        add_action('admin_enqueue_scripts', array($this, 'admin_styles'));
    }

    /**
     * Plugin activation - create database table
     */
    public function activate() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            form_type varchar(50) NOT NULL,
            service varchar(100) DEFAULT NULL,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            message text NOT NULL,
            consultation_date date DEFAULT NULL,
            consultation_time varchar(20) DEFAULT NULL,
            ip_address varchar(100) DEFAULT NULL,
            user_agent text DEFAULT NULL,
            submitted_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY form_type (form_type),
            KEY email (email),
            KEY submitted_at (submitted_at)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    /**
     * Initialize plugin hooks
     */
    public function init() {
        // Handle consultation form submission
        if (isset($_POST['rbl_consultation_submit'])) {
            $this->handle_consultation_submission();
        }

        // Handle contact form submission
        if (isset($_POST['rbl_contact_submit'])) {
            $this->handle_contact_submission();
        }
    }

    /**
     * Validate anti-spam measures
     *
     * Checks:
     * - Honeypot fields (should be empty)
     * - Time-based validation (form submitted too quickly = bot)
     * - JavaScript token (proves JS is enabled)
     * - Common spam patterns in content
     *
     * @return array Array with 'success' boolean and 'reason' string
     */
    private function validate_antispam() {
        // Check honeypot fields - should be empty
        $honeypot1 = isset($_POST['website_url']) ? $_POST['website_url'] : '';
        $honeypot2 = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';

        if (!empty($honeypot1) || !empty($honeypot2)) {
            return array('success' => false, 'reason' => 'honeypot');
        }

        // Check JavaScript token
        $js_token = isset($_POST['rbl_js_token']) ? sanitize_text_field($_POST['rbl_js_token']) : '';
        if (empty($js_token) || !wp_verify_nonce($js_token, 'rbl_antispam_token')) {
            return array('success' => false, 'reason' => 'invalid_token');
        }

        // Check time-based validation (minimum 3 seconds to fill form)
        $form_time = isset($_POST['rbl_form_time']) ? intval($_POST['rbl_form_time']) : 0;
        $current_time = round(microtime(true) * 1000); // Current time in milliseconds
        $elapsed_seconds = ($current_time - $form_time) / 1000;

        if ($form_time === 0 || $elapsed_seconds < 3) {
            return array('success' => false, 'reason' => 'too_fast');
        }

        // Check for spam patterns in content
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        if ($this->contains_spam_patterns($message) ||
            $this->contains_spam_patterns($name) ||
            $this->is_disposable_email($email)) {
            return array('success' => false, 'reason' => 'spam_content');
        }

        return array('success' => true, 'reason' => '');
    }

    /**
     * Check if content contains common spam patterns
     */
    private function contains_spam_patterns($content) {
        if (empty($content)) {
            return false;
        }

        $spam_patterns = array(
            // Common spam keywords
            '/\b(viagra|cialis|casino|poker|lottery|winner|prize|congratulations)\b/i',
            // Excessive URLs
            '/(https?:\/\/[^\s]+){3,}/i',
            // Suspicious HTML
            '/<(script|iframe|embed|object)/i',
            // Cyrillic spam (unless you expect Cyrillic input)
            '/[\x{0400}-\x{04FF}]{10,}/u',
            // Too many special characters
            '/[!@#$%^&*()]{5,}/',
            // Common spam phrases
            '/\b(click here|buy now|act now|limited time|free money|earn \$|make money fast)\b/i',
            // Suspicious link patterns
            '/\[url=|bb\s*code/i',
        );

        foreach ($spam_patterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if email is from a known disposable email service
     */
    private function is_disposable_email($email) {
        if (empty($email)) {
            return false;
        }

        // Extract domain from email
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return false;
        }

        $domain = strtolower($parts[1]);

        // Common disposable email domains
        $disposable_domains = array(
            'tempmail.com', 'throwaway.email', 'guerrillamail.com', 'mailinator.com',
            '10minutemail.com', 'trashmail.com', 'fakeinbox.com', 'tempinbox.com',
            'getnada.com', 'yopmail.com', 'sharklasers.com', 'spam4.me',
            'dispostable.com', 'maildrop.cc', 'mytemp.email', 'temp-mail.org',
            'emailondeck.com', 'mohmal.com', 'tempail.com', 'burnermail.io'
        );

        return in_array($domain, $disposable_domains);
    }

    /**
     * Handle consultation form submission
     */
    private function handle_consultation_submission() {
        // Verify nonce
        if (!isset($_POST['rbl_consultation_nonce']) ||
            !wp_verify_nonce($_POST['rbl_consultation_nonce'], 'rbl_consultation_form')) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Security check failed. Please refresh the page and try again.'
                ));
                exit;
            }
            wp_die('Security check failed');
        }

        // Validate anti-spam measures
        $antispam_result = $this->validate_antispam();

        if (!$antispam_result['success']) {
            // Log spam attempt for monitoring (optional)
            error_log('RBL Spam blocked: ' . $antispam_result['reason'] . ' - IP: ' . $this->get_client_ip());

            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Your submission could not be processed. Please try again.'
                ));
                exit;
            }
            wp_die('Your submission could not be processed. Please try again.');
        }

        // Sanitize and validate inputs
        $service = sanitize_text_field($_POST['service']);
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        $consultation_date = sanitize_text_field($_POST['consultation_date']);
        $consultation_time = sanitize_text_field($_POST['consultation_time']);

        // Validate required fields
        if (empty($service) || empty($name) || empty($email) || empty($message) ||
            empty($consultation_date) || empty($consultation_time)) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Please fill in all required fields.'
                ));
                exit;
            }
            wp_die('Please fill in all required fields.');
        }

        // Validate email
        if (!is_email($email)) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Please enter a valid email address.'
                ));
                exit;
            }
            wp_die('Please enter a valid email address.');
        }

        // Store in database
        $submission_id = $this->store_submission(array(
            'form_type' => 'consultation',
            'service' => $service,
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'consultation_date' => $consultation_date,
            'consultation_time' => $consultation_time,
            'ip_address' => $this->get_client_ip(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ));

        if ($submission_id) {
            // Send email notification
            $this->send_consultation_email(array(
                'service' => $service,
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'consultation_date' => $consultation_date,
                'consultation_time' => $consultation_time,
                'submission_id' => $submission_id
            ));

            // Return JSON response for AJAX
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_success(array(
                    'message' => 'Consultation request received! We\'ll confirm your appointment within 24 hours.'
                ));
                exit; // Ensure we exit after sending JSON
            }

            // Redirect with success message (for non-AJAX)
            wp_redirect(add_query_arg('consultation', 'success', wp_get_referer()));
            exit;
        } else {
            // Return JSON error for AJAX
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Error saving submission. Please try again.'
                ));
                exit;
            }
            wp_die('Error saving submission. Please try again.');
        }
    }

    /**
     * Handle contact form submission
     */
    private function handle_contact_submission() {
        // Verify nonce
        if (!isset($_POST['rbl_contact_nonce']) ||
            !wp_verify_nonce($_POST['rbl_contact_nonce'], 'rbl_contact_form')) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Security check failed. Please refresh the page and try again.'
                ));
                exit;
            }
            wp_die('Security check failed');
        }

        // Validate anti-spam measures
        $antispam_result = $this->validate_antispam();

        if (!$antispam_result['success']) {
            // Log spam attempt for monitoring (optional)
            error_log('RBL Spam blocked: ' . $antispam_result['reason'] . ' - IP: ' . $this->get_client_ip());

            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Your submission could not be processed. Please try again.'
                ));
                exit;
            }
            wp_die('Your submission could not be processed. Please try again.');
        }

        // Sanitize and validate inputs
        $service = sanitize_text_field($_POST['service']);
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validate required fields
        if (empty($service) || empty($name) || empty($email) || empty($message)) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Please fill in all required fields.'
                ));
                exit;
            }
            wp_die('Please fill in all required fields.');
        }

        // Validate email
        if (!is_email($email)) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Please enter a valid email address.'
                ));
                exit;
            }
            wp_die('Please enter a valid email address.');
        }

        // Store in database
        $submission_id = $this->store_submission(array(
            'form_type' => 'contact',
            'service' => $service,
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'ip_address' => $this->get_client_ip(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ));

        if ($submission_id) {
            // Send email notification
            $this->send_contact_email(array(
                'service' => $service,
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'submission_id' => $submission_id
            ));

            // Return JSON response for AJAX
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_success(array(
                    'message' => 'Thank you! We\'ll get back to you within 24 hours.'
                ));
                exit; // Ensure we exit after sending JSON
            }

            // Redirect with success message (for non-AJAX)
            wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
            exit;
        } else {
            // Return JSON error for AJAX
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                wp_send_json_error(array(
                    'message' => 'Error saving submission. Please try again.'
                ));
                exit;
            }
            wp_die('Error saving submission. Please try again.');
        }
    }

    /**
     * Store form submission in database
     */
    private function store_submission($data) {
        global $wpdb;

        $result = $wpdb->insert(
            $this->table_name,
            $data,
            array(
                '%s', // form_type
                '%s', // service
                '%s', // name
                '%s', // email
                '%s', // message
                '%s', // consultation_date
                '%s', // consultation_time
                '%s', // ip_address
                '%s'  // user_agent
            )
        );

        if ($result) {
            return $wpdb->insert_id;
        }

        return false;
    }

    /**
     * Send consultation email notification
     */
    private function send_consultation_email($data) {
        $to = $this->notification_email;
        $subject = 'New Consultation Request - ' . $data['name'];

        $message = "New consultation request received!\n\n";
        $message .= "Submission ID: " . $data['submission_id'] . "\n";
        $message .= "Service: " . $this->format_service_label($data['service']) . "\n";
        $message .= "Name: " . $data['name'] . "\n";
        $message .= "Email: " . $data['email'] . "\n";
        $message .= "Preferred Date: " . date('l, F j, Y', strtotime($data['consultation_date'])) . "\n";
        $message .= "Preferred Time: " . $this->format_time($data['consultation_time']) . " EST\n\n";
        $message .= "Message:\n" . $data['message'] . "\n\n";
        $message .= "---\n";
        $message .= "Submitted: " . current_time('mysql') . "\n";

        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: Random Bit Logic <noreply@randombitlogic.com>',
            'Reply-To: ' . $data['email']
        );

        wp_mail($to, $subject, $message, $headers);
    }

    /**
     * Send contact email notification
     */
    private function send_contact_email($data) {
        $to = $this->notification_email;
        $subject = 'New Contact Form Submission - ' . $data['name'];

        $message = "New contact form submission received!\n\n";
        $message .= "Submission ID: " . $data['submission_id'] . "\n";
        $message .= "Service: " . $this->format_service_label($data['service']) . "\n";
        $message .= "Name: " . $data['name'] . "\n";
        $message .= "Email: " . $data['email'] . "\n\n";
        $message .= "Message:\n" . $data['message'] . "\n\n";
        $message .= "---\n";
        $message .= "Submitted: " . current_time('mysql') . "\n";

        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: Random Bit Logic <noreply@randombitlogic.com>',
            'Reply-To: ' . $data['email']
        );

        wp_mail($to, $subject, $message, $headers);
    }

    /**
     * Format service label
     */
    private function format_service_label($service) {
        $labels = array(
            'strategy' => 'AI Strategy Session',
            'ai' => 'AI & Automation Implementation',
            'software' => 'Custom Software Development',
            'web' => 'Web Platform / Redesign',
            'other' => 'Other / General Inquiry'
        );

        return isset($labels[$service]) ? $labels[$service] : $service;
    }

    /**
     * Format time display
     */
    private function format_time($time) {
        return date('g:i A', strtotime($time));
    }

    /**
     * Get client IP address
     */
    private function get_client_ip() {
        $ip = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return sanitize_text_field($ip);
    }

    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            'Form Submissions',
            'Submissions',
            'manage_options',
            'rbl-form-submissions',
            array($this, 'admin_page'),
            'dashicons-email-alt',
            30
        );
    }

    /**
     * Admin page content
     */
    public function admin_page() {
        global $wpdb;

        // Handle delete action
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            if (check_admin_referer('delete_submission_' . $_GET['id'])) {
                $wpdb->delete($this->table_name, array('id' => intval($_GET['id'])), array('%d'));
                echo '<div class="notice notice-success"><p>Submission deleted successfully.</p></div>';
            }
        }

        // Get filter
        $filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : 'all';

        // Build query
        $where = '';
        if ($filter !== 'all') {
            $where = $wpdb->prepare(" WHERE form_type = %s", $filter);
        }

        // Get submissions
        $submissions = $wpdb->get_results(
            "SELECT * FROM {$this->table_name}{$where} ORDER BY submitted_at DESC LIMIT 100"
        );

        // Get counts
        $total_count = $wpdb->get_var("SELECT COUNT(*) FROM {$this->table_name}");
        $consultation_count = $wpdb->get_var("SELECT COUNT(*) FROM {$this->table_name} WHERE form_type = 'consultation'");
        $contact_count = $wpdb->get_var("SELECT COUNT(*) FROM {$this->table_name} WHERE form_type = 'contact'");

        ?>
        <div class="wrap">
            <h1>Form Submissions</h1>

            <ul class="subsubsub">
                <li>
                    <a href="?page=rbl-form-submissions&filter=all" class="<?php echo $filter === 'all' ? 'current' : ''; ?>">
                        All <span class="count">(<?php echo $total_count; ?>)</span>
                    </a> |
                </li>
                <li>
                    <a href="?page=rbl-form-submissions&filter=consultation" class="<?php echo $filter === 'consultation' ? 'current' : ''; ?>">
                        Consultations <span class="count">(<?php echo $consultation_count; ?>)</span>
                    </a> |
                </li>
                <li>
                    <a href="?page=rbl-form-submissions&filter=contact" class="<?php echo $filter === 'contact' ? 'current' : ''; ?>">
                        Contact Forms <span class="count">(<?php echo $contact_count; ?>)</span>
                    </a>
                </li>
            </ul>

            <table class="wp-list-table widefat fixed striped rbl-submissions-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Service</th>
                        <th>Consultation</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($submissions)): ?>
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 40px;">
                                No submissions found.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td><?php echo esc_html($submission->id); ?></td>
                                <td>
                                    <span class="rbl-badge rbl-badge-<?php echo esc_attr($submission->form_type); ?>">
                                        <?php echo esc_html(ucfirst($submission->form_type)); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo esc_html(date('M j, Y', strtotime($submission->submitted_at))); ?><br>
                                    <small><?php echo esc_html(date('g:i A', strtotime($submission->submitted_at))); ?></small>
                                </td>
                                <td><strong><?php echo esc_html($submission->name); ?></strong></td>
                                <td>
                                    <a href="mailto:<?php echo esc_attr($submission->email); ?>">
                                        <?php echo esc_html($submission->email); ?>
                                    </a>
                                </td>
                                <td><?php echo esc_html($this->format_service_label($submission->service)); ?></td>
                                <td>
                                    <?php if ($submission->consultation_date): ?>
                                        <?php echo esc_html(date('M j, Y', strtotime($submission->consultation_date))); ?><br>
                                        <small><?php echo esc_html($this->format_time($submission->consultation_time)); ?> EST</small>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="rbl-message-preview">
                                        <?php echo esc_html(wp_trim_words($submission->message, 15)); ?>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="button button-small rbl-view-details"
                                       data-id="<?php echo esc_attr($submission->id); ?>"
                                       data-name="<?php echo esc_attr($submission->name); ?>"
                                       data-email="<?php echo esc_attr($submission->email); ?>"
                                       data-service="<?php echo esc_attr($this->format_service_label($submission->service)); ?>"
                                       data-message="<?php echo esc_attr($submission->message); ?>"
                                       data-date="<?php echo esc_attr($submission->consultation_date ? date('M j, Y', strtotime($submission->consultation_date)) : ''); ?>"
                                       data-time="<?php echo esc_attr($submission->consultation_time ? $this->format_time($submission->consultation_time) : ''); ?>"
                                       data-ip="<?php echo esc_attr($submission->ip_address); ?>"
                                       data-submitted="<?php echo esc_attr(date('M j, Y g:i A', strtotime($submission->submitted_at))); ?>">
                                        View
                                    </a>
                                    <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=rbl-form-submissions&action=delete&id=' . $submission->id), 'delete_submission_' . $submission->id); ?>"
                                       class="button button-small button-link-delete"
                                       onclick="return confirm('Are you sure you want to delete this submission?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Details Modal -->
        <div id="rbl-details-modal" class="rbl-modal" style="display: none;">
            <div class="rbl-modal-overlay"></div>
            <div class="rbl-modal-content">
                <span class="rbl-modal-close">&times;</span>
                <h2>Submission Details</h2>
                <div id="rbl-modal-body"></div>
            </div>
        </div>

        <script>
        jQuery(document).ready(function($) {
            // View details
            $('.rbl-view-details').on('click', function(e) {
                e.preventDefault();

                var data = $(this).data();
                var html = '<table class="rbl-details-table">';
                html += '<tr><th>Name:</th><td>' + data.name + '</td></tr>';
                html += '<tr><th>Email:</th><td><a href="mailto:' + data.email + '">' + data.email + '</a></td></tr>';
                html += '<tr><th>Service:</th><td>' + data.service + '</td></tr>';

                if (data.date) {
                    html += '<tr><th>Consultation Date:</th><td>' + data.date + '</td></tr>';
                    html += '<tr><th>Consultation Time:</th><td>' + data.time + ' EST</td></tr>';
                }

                html += '<tr><th>Message:</th><td>' + data.message + '</td></tr>';
                html += '<tr><th>IP Address:</th><td>' + data.ip + '</td></tr>';
                html += '<tr><th>Submitted:</th><td>' + data.submitted + '</td></tr>';
                html += '</table>';

                $('#rbl-modal-body').html(html);
                $('#rbl-details-modal').fadeIn();
            });

            // Close modal
            $('.rbl-modal-close, .rbl-modal-overlay').on('click', function() {
                $('#rbl-details-modal').fadeOut();
            });
        });
        </script>
        <?php
    }

    /**
     * Admin styles
     */
    public function admin_styles($hook) {
        if ($hook !== 'toplevel_page_rbl-form-submissions') {
            return;
        }
        ?>
        <style>
            .rbl-submissions-table {
                margin-top: 20px;
            }

            .rbl-badge {
                display: inline-block;
                padding: 3px 8px;
                border-radius: 3px;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
            }

            .rbl-badge-consultation {
                background: #d4edff;
                color: #0066cc;
            }

            .rbl-badge-contact {
                background: #e0f7e9;
                color: #00a86b;
            }

            .rbl-message-preview {
                max-width: 250px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .rbl-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 100000;
            }

            .rbl-modal-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
            }

            .rbl-modal-content {
                position: relative;
                background: #fff;
                max-width: 600px;
                margin: 50px auto;
                padding: 30px;
                border-radius: 4px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            }

            .rbl-modal-close {
                position: absolute;
                top: 15px;
                right: 20px;
                font-size: 28px;
                cursor: pointer;
                color: #666;
            }

            .rbl-modal-close:hover {
                color: #000;
            }

            .rbl-details-table {
                width: 100%;
                margin-top: 20px;
            }

            .rbl-details-table th {
                text-align: left;
                padding: 10px;
                background: #f5f5f5;
                font-weight: 600;
                width: 180px;
            }

            .rbl-details-table td {
                padding: 10px;
                border-bottom: 1px solid #eee;
            }
        </style>
        <?php
    }
}

// Initialize plugin
new RBL_Form_Submissions();
