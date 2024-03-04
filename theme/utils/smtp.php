<?php

/**
 * Project: prikr-gutenberg-starter
 * File: smtp.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class PRIKR_WPSMTP
{
	private $wp_smtp_options;

	public function __construct()
	{
		add_action('admin_menu', array($this, 'wp_smtp_add_plugin_page'));
		add_action('admin_init', array($this, 'wp_smtp_page_init'));
	}

	public function wp_smtp_add_plugin_page()
	{
		add_options_page(
			'E-mail', // page_title
			'E-mail', // menu_title
			'manage_options', // capability
			'wp-smtp', // menu_slug
			array($this, 'wp_smtp_create_admin_page') // function
		);
	}

	public function wp_smtp_create_admin_page()
	{
		$this->wp_smtp_options = get_option('wp_smtp_option_name'); ?>

		<div class="wrap">
			<h1>E-mail</h1>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
				settings_fields('wp_smtp_option_group');
				do_settings_sections('wp-smtp-admin');
				submit_button();
				?>
			</form>
		</div>
<?php }

	public function wp_smtp_page_init()
	{
		register_setting(
			'wp_smtp_option_group', // option_group
			'wp_smtp_option_name', // option_name
			array($this, 'wp_smtp_sanitize') // sanitize_callback
		);

		add_settings_section(
			'wp_smtp_setting_section', // id
			'Settings', // title
			array($this, 'wp_smtp_section_info'), // callback
			'wp-smtp-admin' // page
		);

		add_settings_field(
			'enable_smtp', // id
			'Enable SMTP', // title
			array($this, 'enable_smtp_callback'), // callback
			'wp-smtp-admin', // page
			'wp_smtp_setting_section' // section
		);

		add_settings_field(
			'smtp_host', // id
			'SMTP Host', // title
			array($this, 'smtp_host_callback'), // callback
			'wp-smtp-admin', // page
			'wp_smtp_setting_section' // section
		);

		add_settings_field(
			'smtp_port', // id
			'SMTP Port', // title
			array($this, 'smtp_port_callback'), // callback
			'wp-smtp-admin', // page
			'wp_smtp_setting_section' // section
		);

		add_settings_field(
			'smtp_username', // id
			'SMTP Username', // title
			array($this, 'smtp_username_callback'), // callback
			'wp-smtp-admin', // page
			'wp_smtp_setting_section' // section
		);

		add_settings_field(
			'smtp_password', // id
			'SMTP Password', // title
			array($this, 'smtp_password_callback'), // callback
			'wp-smtp-admin', // page
			'wp_smtp_setting_section' // section
		);

		add_settings_field(
			'smtp_secure', // id
			'SMTP Secure', // title
			array($this, 'smtp_secure_callback'), // callback
			'wp-smtp-admin', // page
			'wp_smtp_setting_section' // section
		);

		add_settings_field(
			'smtp_from_email', // id
			'SMTP From Email', // title
			array($this, 'smtp_from_email_callback'), // callback
			'wp-smtp-admin', // page
			'wp_smtp_setting_section' // section
		);

		add_settings_field(
			'smtp_from_name', // id
			'SMTP From Name', // title
			array($this, 'smtp_from_name_callback'), // callback
			'wp-smtp-admin', // page
			'wp_smtp_setting_section' // section
		);
	}

	public function wp_smtp_sanitize($input)
	{
		$sanitary_values = array();
		if (isset($input['enable_smtp'])) {
			$sanitary_values['enable_smtp'] = absint($input['enable_smtp']);
		}

		if (isset($input['smtp_host'])) {
			$sanitary_values['smtp_host'] = sanitize_text_field($input['smtp_host']);
		}

		if (isset($input['smtp_port'])) {
			$sanitary_values['smtp_port'] = sanitize_text_field($input['smtp_port']);
		}

		if (isset($input['smtp_username'])) {
			$sanitary_values['smtp_username'] = sanitize_text_field($input['smtp_username']);
		}

		if (isset($input['smtp_password'])) {
			$sanitary_values['smtp_password'] = sanitize_text_field($input['smtp_password']);
		}

		if (isset($input['smtp_secure'])) {
			$sanitary_values['smtp_secure'] = sanitize_text_field($input['smtp_secure']);
		}

		if (isset($input['smtp_from_email'])) {
			$sanitary_values['smtp_from_email'] = sanitize_text_field($input['smtp_from_email']);
		}

		if (isset($input['smtp_from_name'])) {
			$sanitary_values['smtp_from_name'] = sanitize_text_field($input['smtp_from_name']);
		}

		return $sanitary_values;
	}

	public function wp_smtp_section_info()
	{
	}

	public function enable_smtp_callback()
	{
		$checked = isset($this->wp_smtp_options['enable_smtp']) ? checked($this->wp_smtp_options['enable_smtp'], 1, false) : '';
		echo '<label><input type="checkbox" name="wp_smtp_option_name[enable_smtp]" value="1" ' . $checked . '> Enable SMTP</label>';
		echo '<p class="description">Check this box to enable SMTP settings for outgoing emails.</p>';
	}

	public function smtp_host_callback()
	{
		printf(
			'<input class="regular-text" type="text" name="wp_smtp_option_name[smtp_host]" id="smtp_host" value="%s">',
			isset($this->wp_smtp_options['smtp_host']) ? esc_attr($this->wp_smtp_options['smtp_host']) : ''
		);
	}

	public function smtp_port_callback()
	{
		printf(
			'<input class="regular-text" type="text" name="wp_smtp_option_name[smtp_port]" id="smtp_port" value="%s">',
			isset($this->wp_smtp_options['smtp_port']) ? esc_attr($this->wp_smtp_options['smtp_port']) : ''
		);
	}

	public function smtp_username_callback()
	{
		printf(
			'<input class="regular-text" type="text" name="wp_smtp_option_name[smtp_username]" id="smtp_username" value="%s">',
			isset($this->wp_smtp_options['smtp_username']) ? esc_attr($this->wp_smtp_options['smtp_username']) : ''
		);
	}

	public function smtp_password_callback()
	{
		printf(
			'<input class="regular-text" type="password" name="wp_smtp_option_name[smtp_password]" id="smtp_password" value="%s">',
			isset($this->wp_smtp_options['smtp_password']) ? esc_attr($this->wp_smtp_options['smtp_password']) : ''
		);
	}

	public function smtp_secure_callback()
	{
		printf(
			'<input class="regular-text" type="text" name="wp_smtp_option_name[smtp_secure]" id="smtp_secure" value="%s">',
			isset($this->wp_smtp_options['smtp_secure']) ? esc_attr($this->wp_smtp_options['smtp_secure']) : ''
		);
	}

	public function smtp_from_email_callback()
	{
		printf(
			'<input class="regular-text" type="text" name="wp_smtp_option_name[smtp_from_email]" id="smtp_from_email" value="%s">',
			isset($this->wp_smtp_options['smtp_from_email']) ? esc_attr($this->wp_smtp_options['smtp_from_email']) : ''
		);
	}

	public function smtp_from_name_callback()
	{
		printf(
			'<input class="regular-text" type="text" name="wp_smtp_option_name[smtp_from_name]" id="smtp_from_name" value="%s">',
			isset($this->wp_smtp_options['smtp_from_name']) ? esc_attr($this->wp_smtp_options['smtp_from_name']) : ''
		);
	}
}
if (is_admin())
	$wp_smtp = new PRIKR_WPSMTP();

/* 
 * Retrieve this value with:
 * $wp_smtp_options = get_option( 'wp_smtp_option_name' ); // Array of All Options
 * $smtp_host = $wp_smtp_options['smtp_host']; // SMTP Host
 * $smtp_port = $wp_smtp_options['smtp_port']; // SMTP Port
 * $smtp_username = $wp_smtp_options['smtp_username']; // SMTP Username
 * $smtp_password = $wp_smtp_options['smtp_password']; // SMTP Password
 * $smtp_secure = $wp_smtp_options['smtp_secure']; // SMTP Secure
 * $smtp_from_email = $wp_smtp_options['smtp_from_email']; // SMTP From Email
 * $smtp_from_name = $wp_smtp_options['smtp_from_name']; // SMTP From Name
 */

// Hook into the PHP mailer. Using the settings set above
add_action('phpmailer_init', 'prikr_send_smtp_email');
function prikr_send_smtp_email($phpmailer)
{
	$wp_smtp_options = get_option('wp_smtp_option_name');

	// Check if SMTP is enabled
	if (isset($wp_smtp_options['enable_smtp']) && $wp_smtp_options['enable_smtp']) {
		$smtp_host = $wp_smtp_options['smtp_host']; // SMTP Host
		$smtp_port = $wp_smtp_options['smtp_port']; // SMTP Port
		$smtp_username = $wp_smtp_options['smtp_username']; // SMTP Username
		$smtp_password = $wp_smtp_options['smtp_password']; // SMTP Password
		$smtp_secure = $wp_smtp_options['smtp_secure']; // SMTP Secure
		$smtp_from_email = $wp_smtp_options['smtp_from_email']; // SMTP From Email
		$smtp_from_name = $wp_smtp_options['smtp_from_name']; // SMTP From Name

		$phpmailer->isSMTP();
		$phpmailer->Host       = $smtp_host;
		$phpmailer->Port       = $smtp_port;
		$phpmailer->SMTPAuth   = true;
		$phpmailer->Username   = $smtp_username;
		$phpmailer->Password   = $smtp_password;
		$phpmailer->SMTPSecure = $smtp_secure;
		$phpmailer->From       = $smtp_from_email;
		$phpmailer->FromName   = $smtp_from_name;
	}
}
