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
 * Setup theme
 */
require_once PRIKR_THEME_PHP_DIR . '/core/setup.php';

/**
 * Add head meta tags based on project
 */
require_once PRIKR_THEME_PHP_DIR . '/core/head.php';