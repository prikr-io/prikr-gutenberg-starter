<?php

/**
 * Project: prikr-gutenberg-starter
 * File: mu-plugins.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require_once PRIKR_THEME_DIR . '/theme/vendor/tgmpa-plugins.php';

add_action('tgmpa_register', 'prikr_register_required_plugins');

function prikr_register_required_plugins()
{
  $plugins = [];

  /**
   * ACF
   */
  if (defined('PRIKR_ENABLE_ACF') && PRIKR_ENABLE_ACF) {
    $plugins[] = array(
      'name'               => 'Advanced Custom Fields Pro',
      'slug'               => 'advanced-custom-fields-pro',
      'source'             => PRIKR_THEME_DIR . '/theme/plugins/includes/advanced-custom-fields-pro.zip',
      'required'           => true,
      'force_activation'   => true
    );

    $plugins[] = array(
      'name'               => 'ACF Extended',
      'slug'               => 'acf-extended',
      'required'           => true,
      'force_activation'   => true
    );
  }

  /**
   * Yoast SEO
   */
  if (defined('PRIKR_ENABLE_YOAST_SEO') && PRIKR_ENABLE_YOAST_SEO) {
    $plugins[] = array(
      'name'               => 'Yoast SEO',
      'slug'               => 'wordpress-seo',
      'required'           => true,
      'force_activation'   => true
    );
  }

  /**
   * WPML
   */
  if (defined('PRIKR_ENABLE_WPML') && PRIKR_ENABLE_WPML) {
    $plugins[] = array(
      'name'               => 'WPML Multilingual CMS',
      'slug'               => 'sitepress-multilingual-cms',
      'required'           => true,
      'force_activation'   => true
    );

    $plugins[] = array(
      'name'               => 'WPML String Translation',
      'slug'               => 'wpml-string-translation',
      'required'           => true,
      'force_activation'   => true
    );

    $plugins[] = array(
      'name'               => 'WPML Translation Management',
      'slug'               => 'wpml-translation-management',
      'required'           => true,
      'force_activation'   => true
    );
  }

  /**
   * Gravity Forms
   */
  if (defined('PRIKR_ENABLE_GRAVITY_FORMS') && PRIKR_ENABLE_GRAVITY_FORMS) {
    $plugins[] = array(
      'name'               => 'Gravity Forms',
      'slug'               => 'gravityforms',
      'source'             => PRIKR_THEME_DIR . '/theme/plugins/includes/gravityforms.zip',
      'required'           => true,
      'force_activation'   => true
    );
  }

  /**
   * WooCommerce
   */
  if (defined('PRIKR_ENABLE_WOOCOMMERCE') && PRIKR_ENABLE_WOOCOMMERCE) {
    $plugins[] = array(
      'name'               => 'WooCommerce',
      'slug'               => 'woocommerce',
      'required'           => true,
      'force_activation'   => true
    );
  }

  /**
   * W3 Total Cache
   */
  if (defined('PRIKR_ENABLE_W3_TOTAL_CACHE') && PRIKR_ENABLE_W3_TOTAL_CACHE) {
    $plugins[] = array(
      'name'               => 'W3 Total Cache',
      'slug'               => 'w3-total-cache',
      'required'           => true,
      'force_activation'   => true
    );
  }

  /**
   * Image Offloader
   */
  if (defined('PRIKR_ENABLE_IMAGE_OFFLOADER') && PRIKR_ENABLE_IMAGE_OFFLOADER) {
    $plugins[] = array(
      'name'               => 'Prikr Image Offloader',
      'slug'               => 'prikr-image-offloader',
      'source'             => 'https://plugin.prikr.io/prikr-image-offloader/prikr-image-offloader.zip',
      'required'           => true,
      'force_activation'   => true
    );
  }

  $config = array(
    'id'                   => 'plugins',
    'default_path'         => '',
    'menu'                 => 'prikr-install-plugins',
    'parent_slug'          => prikr_user_has_prikr_email() ? 'plugins.php' : false,
    'capability'           => 'edit_theme_options',
    'has_notices'          => prikr_user_has_prikr_email(),
    'dismissable'          => true,
    'dismiss_msg'          => '',
    'is_automatic'         => true,
    'message'              => '',
    'strings'              => array(
      'page_title'                      => __('Required plugins', PRIKR_THEME_PREFIX),
      'menu_title'                      => __('Required plugins', PRIKR_THEME_PREFIX),
      'installing'                      => __('Installing plugin: %s', PRIKR_THEME_PREFIX),
      'updating'                        => __('Updating plugin: %s', PRIKR_THEME_PREFIX),
      'oops'                            => __('Something went wrong with the plugin API.', PRIKR_THEME_PREFIX),
      'notice_can_install_required'     => _n_noop(
          'This theme requires the following plugin: %1$s.',
          'This theme requires the following plugins: %1$s.',
          PRIKR_THEME_PREFIX
      ),
      'notice_can_install_recommended'  => _n_noop(
        'This theme recommends the following plugin: %1$s.',
        'This theme recommends the following plugins: %1$s.',
        PRIKR_THEME_PREFIX
      ),
      'notice_ask_to_update'            => _n_noop(
        'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
        'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
        PRIKR_THEME_PREFIX
      ),
      'notice_ask_to_update_maybe'      => _n_noop(
        'There is an update available for: %1$s.',
        'There are updates available for the following plugins: %1$s.',
        PRIKR_THEME_PREFIX
      ),
      'notice_can_activate_required'    => _n_noop(
        'The following required plugin is currently inactive: %1$s.',
        'The following required plugins are currently inactive: %1$s.',
        PRIKR_THEME_PREFIX
      ),
      'notice_can_activate_recommended' => _n_noop(
        'The following recommended plugin is currently inactive: %1$s.',
        'The following recommended plugins are currently inactive: %1$s.',
        PRIKR_THEME_PREFIX
      ),
      'install_link'                    => _n_noop(
        'Begin installing plugin',
        'Begin installing plugins',
        PRIKR_THEME_PREFIX
      ),
      'update_link'             => _n_noop(
        'Begin updating plugin',
        'Begin updating plugins',
        PRIKR_THEME_PREFIX
      ),
      'activate_link'                   => _n_noop(
        'Begin activating plugin',
        'Begin activating plugins',
        PRIKR_THEME_PREFIX
      ),
      'return'                          => __('Return to Required Plugins Installer', PRIKR_THEME_PREFIX),
      'plugin_activated'                => __('Plugin activated successfully.', PRIKR_THEME_PREFIX),
      'activated_successfully'          => __('The following plugin was activated successfully:', PRIKR_THEME_PREFIX),
      'plugin_already_active'           => __('No action taken. Plugin %1$s was already active.', PRIKR_THEME_PREFIX),
      'plugin_needs_higher_version'     => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', PRIKR_THEME_PREFIX),
      'complete'                        => __('All plugins installed and activated successfully. %1$s', PRIKR_THEME_PREFIX),
      'dismiss'                         => __('Dismiss this notice', PRIKR_THEME_PREFIX),
      'notice_cannot_install_activate'  => __('There are one or more required or recommended plugins to install, update or activate.', PRIKR_THEME_PREFIX),
      'contact_admin'                   => __('Please contact the administrator of this site for help.', PRIKR_THEME_PREFIX),
      'nag_type'                        => 'error', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
    ),
  );

  tgmpa($plugins, $config);
}
