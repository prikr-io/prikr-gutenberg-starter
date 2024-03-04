<?php

/**
 * Project: prikr-gutenberg-starter
 * File: setup.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require_once PRIKR_THEME_PHP_DIR . '/utils/utils.php';

require_once PRIKR_THEME_PHP_DIR . '/core/enqueue.php';

/**
 * Theme setup
 */
function prikr_theme_setup () {

  require_once PRIKR_THEME_PHP_DIR . '/core/theme-support.php';
  
}
add_action('after_setup_theme', 'prikr_theme_setup');


require_once PRIKR_THEME_PHP_DIR . '/core/security.php';