<?php

/**
 * Project: prikr-gutenberg-starter
 * File: acf.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Advanced Custom Fields
 */
define( 'MY_ACF_PATH', PRIKR_THEME_DIR. '/src/json/' );
define( 'MY_ACF_URL', PRIKR_THEME_URL . '/src/json/' );

/**
 * Hide ACF Admin
 */
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin($show_admin)
{
  $current_user_has_prikr_in_email = strpos(wp_get_current_user()->user_email, 'prikr') !== false;

  if(wp_get_environment_type() === 'production' && !$current_user_has_prikr_in_email) {
    return false;
  }
  return true;
}

/**
 * Hide ACF Templates
 */
function hide_acf_templates_menu_item () {
  if(wp_get_environment_type() === 'production') {
    remove_menu_page( 'edit.php?post_type=acf_template' );
  }
}
add_action( 'admin_init', 'hide_acf_templates_menu_item', 1 );

/**
 * Set Save JSON Path
*/
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    // update path
    $path = MY_ACF_PATH . 'json';
    // return
    return $path;
}

/**
 * Set Load JSON Path
*/
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = MY_ACF_PATH . 'json';
    // return
    return $paths;
}

// add default image setting to ACF image fields
// let's you select a defualt image
// this is simply taking advantage of a field setting that already exists
if (function_exists('acf_render_field_setting')) {
  add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');
  function add_default_value_to_image_field($field) {
    acf_render_field_setting( $field, array(
      'label'			      => __('Default image', PRIKR_THEME_PREFIX),
      'instructions'		=> __('Appears when creating a new post', PRIKR_THEME_PREFIX),
      'type'			      => 'image',
      'name'			      => 'default_value',
    ));
  }
}