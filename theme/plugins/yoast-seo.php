<?php

/**
 * Project: prikr-gutenberg-starter
 * File: yoast-seo.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Add Yoast SEO support
 */
add_theme_support('yoast-seo-breadcrumbs');

function get_breadcrumbs($class)
{
  if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<p class="breadcrumbs ' . $class . '" id="breadcrumbs">', '</p>');
  }
}

/**
 * Unbind Yoast's awful constant upsell notifications whenever you trash/delete anything
 *
 * @ref: https://github.com/Yoast/wordpress-seo/blob/0742e9b6ba4c0d6ae9d65223267a106b92a6a4a1/admin/watchers/class-slug-change-watcher.php#L18
 * @see: https://wordpress.stackexchange.com/a/352509
 */
function unbind_yoast_slug_change_watchers()
{
  $priority = 10;
  $actions_methods = [
    'wp_trash_post'        => 'detect_post_trash',
    'before_delete_post'   => 'detect_post_delete',
    'delete_term_taxonomy' => 'detect_term_delete',
  ];

  global $wp_filter;
  foreach ($actions_methods as $action => $method) {
    if (isset($wp_filter[$action]->callbacks[$priority]) and (!empty($wp_filter[$action]->callbacks[$priority]))) {
      $wp_filter[$action]->callbacks[$priority] = array_filter($wp_filter[$action]->callbacks[$priority], function ($v, $k) use ($method) {
        return (stripos($k, $method) === false);
      }, ARRAY_FILTER_USE_BOTH);
    }
  }
}
add_action('plugins_loaded', 'unbind_yoast_slug_change_watchers', 20);

/*
 * Hide Yoast SEO alert from everywhere
 */

if (defined('WPSEO_VERSION')) {
  if (defined('WPSEO_VERSION')) {
    add_action('wp_head', function () {
      ob_start(function ($o) {
        return preg_replace('/\n?<.*?yoast seo plugin.*?>/mi', '', $o);
      });
    }, ~PHP_INT_MAX);
  }

  // Disable Yoast SEO Notifications.
  function ntp_disable_yoast_notifications()
  {
    if (class_exists('Yoast_Notification_Center')) {
      $ync = Yoast_Notification_Center::get();
      remove_action('admin_notices', array($ync, 'display_notifications'));
      remove_action('all_admin_notices', array($ync, 'display_notifications'));
    }
  }
  add_action('admin_init', 'ntp_disable_yoast_notifications');

  // Yoast SEO Low Priority.
  function ntp_yoast_bottom()
  {
    return 'low';
  }
  add_filter('wpseo_metabox_prio', 'ntp_yoast_bottom');

  // Disable screen after update.
  function ntp_filter_yst_wpseo_option($option)
  {
    if (is_array($option)) {
      $option['seen_about'] = true;
    }
    return $option;
  }
  add_filter('option_wpseo', 'ntp_filter_yst_wpseo_option');

  // Remove Node in Toolbar.
  function ntp_remove_yoast_bar($wp_admin_bar)
  {
    $wp_admin_bar->remove_node('wpseo-menu');
  }
  add_action('admin_bar_menu', 'ntp_remove_yoast_bar', 99);


  add_action('admin_init', 'wpse_136058_remove_menu_pages', 999);

  function wpse_136058_remove_menu_pages()
  {
    remove_submenu_page('wpseo_dashboard', 'wpseo_licenses');
    remove_submenu_page('wpseo_dashboard', 'wpseo_workouts');
  }
  add_action('admin_head', 'seo_admin_styles');
  function seo_admin_styles()
  {
    echo '<style>.yoast-alert { display: none !important; } .yoast-notification { display: none !important; } .toplevel_page_wpseo_dashboard .plugin-count, .toplevel_page_wpseo_dashboard .update-plugins { display: none !important; } </style>';
  }
}


//add class to yoast breadcrumb link
add_filter('wpseo_breadcrumb_single_link', 'prikr_change_breadcrumb_link_class');
function prikr_change_breadcrumb_link_class($link)
{
  return str_replace('<a', '<a class="hover-anchor"', $link);
}

/**
 * Filter the SEO by Yoast breadcrumb.
 *
 * Adding wrapper `<span class="separator">` for separator.
 * 
 * @since 1.0.0
 */
if (!function_exists('prefix_add_wrap_for_breadcrumb_separator')) :
  function prefix_add_wrap_for_breadcrumb_separator($separator)
  {
    $separator = '<span>></span>';
    return $separator;
  }
  add_filter('wpseo_breadcrumb_separator', 'prefix_add_wrap_for_breadcrumb_separator');
endif;
