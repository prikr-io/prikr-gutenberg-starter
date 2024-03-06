<?php

/**
 * Project: prikr-gutenberg-starter
 * File: enqueue.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Enqueue scripts and styles
 */
function prikr_enqueue_scripts()
{
  wp_enqueue_script(PRIKR_THEME_PREFIX . '-scripts', prikr_get_asset(PRIKR_THEME_PUBLIC_URL . '/js/bundle.min.js'), array(), PRIKR_THEME_VERSION, true);

  wp_localize_script(PRIKR_THEME_PREFIX . '-scripts', 'globals', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'prefix' => PRIKR_THEME_PREFIX,
    'themeScripts' => array(
      'wpml'  => PRIKR_ENABLE_WPML,
      'accordion' => PRIKR_ENABLE_ACCORDION,
      'modal' => PRIKR_ENABLE_MODALS,
      'splide' => PRIKR_ENABLE_SPLIDE,
    )
  ));

}
add_action('wp_enqueue_scripts', 'prikr_enqueue_scripts');

/**
 * Enqueue styles
 */
function prikr_enqueue_styles()
{
  wp_enqueue_style(PRIKR_THEME_PREFIX . '-styles', prikr_get_asset(PRIKR_THEME_PUBLIC_URL . '/css/bundle.css'), array(), PRIKR_THEME_VERSION, 'all');

  add_editor_style(prikr_get_asset(PRIKR_THEME_PUBLIC_URL . '/css/bundle.css'));
}
add_action('wp_enqueue_scripts', 'prikr_enqueue_styles');
add_action('enqueue_block_editor_assets', 'prikr_enqueue_styles');

/**
 * Enqueue blocks only if they are present
 */
function prikr_enqueue_block_editor_assets() {
  global $post;

  // Checking if $post is an object
  if (!is_object($post)) {
      return;
  }

  $blocks = array(
    'custom-block'
  );
  $theme_version = wp_get_theme()->get('Version'); // Or use filemtime for script version

  foreach ($blocks as $block) {
    if (has_block(PRIKR_THEME_PREFIX . '/' . $block, $post) || is_admin()) {
      wp_enqueue_script(
        PRIKR_THEME_PREFIX . '-' . $block,
        prikr_get_asset(PRIKR_THEME_PUBLIC_URL . '/js/' . $block . '.min.js'),
        array('wp-blocks', 'wp-element', 'wp-editor'),
        $theme_version,
        true
      );

      wp_localize_script(PRIKR_THEME_PREFIX . '-' . $block, 'globals', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'prefix' => PRIKR_THEME_PREFIX,
      ));
    }
  }

  // Optionally enqueue styles for blocks here
}
add_action('enqueue_block_editor_assets', 'prikr_enqueue_block_editor_assets');