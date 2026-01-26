# RBL Form Submissions Plugin

WordPress plugin to handle form submissions for Random Bit Logic website.

## Features

- **Database Storage**: Stores all form submissions in a custom WordPress database table
- **Email Notifications**: Sends email to sgs@randombitlogic.com for every submission
- **Two Form Types**:
  - Consultation requests (with date/time scheduling)
  - General contact form submissions
- **Admin Dashboard**: View and manage all submissions from WordPress admin
- **Security**: Nonce verification, input sanitization, and validation
- **AJAX Support**: Forms can submit without page reload

## Installation

1. Upload the `rbl-form-submissions` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Database table will be created automatically on activation

## Database Schema

The plugin creates a table `wp_rbl_form_submissions` with the following fields:

- `id` - Auto-increment primary key
- `form_type` - 'consultation' or 'contact'
- `service` - Selected service type
- `name` - Submitter name
- `email` - Submitter email
- `message` - Form message
- `consultation_date` - Preferred consultation date (consultation only)
- `consultation_time` - Preferred consultation time (consultation only)
- `ip_address` - IP address of submitter
- `user_agent` - Browser user agent
- `submitted_at` - Timestamp of submission

## Admin Interface

Navigate to **Submissions** in the WordPress admin menu to:

- View all submissions
- Filter by form type (All, Consultations, Contact Forms)
- View detailed submission information
- Delete submissions
- See submission counts

## Email Notifications

Each submission triggers an email to `sgs@randombitlogic.com` with:

- Submission ID
- Service type
- Contact information
- Message content
- Consultation date/time (if applicable)
- Submission timestamp

## Form Integration

The plugin automatically handles form submissions with the following POST parameters:

### Consultation Form
- `rbl_consultation_submit` - Submit button name
- `rbl_consultation_nonce` - Security nonce
- `service` - Service selection
- `name` - User name
- `email` - User email
- `consultation_date` - Preferred date
- `consultation_time` - Preferred time
- `message` - Project description

### Contact Form
- `rbl_contact_submit` - Submit button name
- `rbl_contact_nonce` - Security nonce
- `service` - Service selection
- `name` - User name
- `email` - User email
- `message` - Inquiry message

## Version History

### 1.0.0
- Initial release
- Database table creation
- Form submission handling
- Email notifications
- Admin interface
