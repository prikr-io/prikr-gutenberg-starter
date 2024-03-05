<?php

/**
 * Project: prikr-gutenberg-starter
 * File: security.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Remove X-Pingback
 */
function prikr_remove_x_pingback($headers)
{
  if (defined('PRIKR_REMOVE_X_PINGBACK') && PRIKR_REMOVE_X_PINGBACK) {
    unset($headers['X-Pingback']);
    return $headers;
  }
  return $headers;
}
add_filter('wp_headers', 'prikr_remove_x_pingback');

/**
 * Remove WP Version
 */
function prikr_remove_wp_version($version)
{
  if (defined('PRIKR_REMOVE_WP_VERSION') && PRIKR_REMOVE_WP_VERSION) {
    return '';
  }
  return $version;
}
add_filter('the_generator', 'prikr_remove_wp_version');

/**
 * Disable XMLRPC Server Class
 */
add_filter('wp_xmlrpc_server_class', function() {
  if (defined('PRIKR_DISABLE_XMLRPC') && PRIKR_DISABLE_XMLRPC) {
    return false;
  }
  return true;
});

/**
 * Disable XMLRPC Client Class
 */
add_filter('xmlrpc_enabled', function() {
  if (defined('PRIKR_DISABLE_XMLRPC') && PRIKR_DISABLE_XMLRPC) {
    return false;
  }
  return true;
});

/**
 * Disable REST API
 */
add_filter('rest_authentication_errors', function() {
  if (defined('PRIKR_DISABLE_REST_API') && PRIKR_DISABLE_REST_API) {
    return false;
  }
  return true;
});

/**
 * Remove REST API from <head></head>
 */
if (defined('PRIKR_DISABLE_REST_API') && PRIKR_DISABLE_REST_API) {
  remove_action('wp_head', 'rest_output_link_wp_head', 10);
  remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
  remove_action('template_redirect', 'rest_output_link_header', 11, 0);
}

/**
 * Remove Manifest from <head></head>
 */
if (defined('PRIKR_DISABLE_MANIFEST') && PRIKR_DISABLE_MANIFEST) {
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');
}

/**
 * Disable Emojicons
 */
add_action('init', function() {
  if (defined('PRIKR_DISABLE_EMOJICONS') && PRIKR_DISABLE_EMOJICONS) {
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
  }
});