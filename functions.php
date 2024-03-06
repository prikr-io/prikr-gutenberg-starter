<?php

/**
 * Project: prikr-gutenberg-starter
 * File: functions.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Include configuration based on wp_get_environment_type()
 */
if (function_exists('wp_get_environment_type')) {
  $environment = wp_get_environment_type();
  require_once get_template_directory() . '/config/' . $environment . '.php';
}

/**
 * Add CORS headers to development environment
 */
function prikr_allow_cors() {
  // If we're not in a development environment, bail
  if (PRIKR_THEME_ENV !== 'development') {
    return;
  }

  // Allow requests from the specific port your Webpack Dev Server is running on
  $allowed_origin = 'http://localhost:3000';

  // Add the CORS headers to WordPress's response
  header("Access-Control-Allow-Origin: $allowed_origin");
  header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept");
}

// Add the CORS headers for all WordPress responses
add_action('init', 'prikr_allow_cors');

/**
 * Setup theme
 */
require_once PRIKR_THEME_DIR . '/theme/core/setup.php';

/**
 * Add head meta tags based on project
 */
require_once PRIKR_THEME_DIR . '/theme/core/head.php';