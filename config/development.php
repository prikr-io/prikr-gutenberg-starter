<?php

/**
 * Project: prikr-gutenberg-starter
 * File: development.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * VERSION & ENVIRONMENT
 */
if (!defined('PRIKR_THEME_VERSION')) { define('PRIKR_THEME_VERSION', '1.0.0'); }
if (!defined('PRIKR_THEME_ENV')) { define('PRIKR_THEME_ENV', 'development'); }

/**
 * DEBUG MODUS
 */
if (!defined('WP_DEBUG')) { define('WP_DEBUG', true); }
if (!defined('WP_DEBUG_DISPLAY')) { define('WP_DEBUG_DISPLAY', true); }
if (!defined('WP_DEBUG_LOG')) { define('WP_DEBUG_LOG', true); }
if (!defined('SCRIPT_DEBUG')) { define('SCRIPT_DEBUG', true); }

/**
 * PATHS & URLS
 */
if (!defined('PRIKR_THEME_DIR')) { define('PRIKR_THEME_DIR', get_template_directory()); }
if (!defined('PRIKR_THEME_URL')) { define('PRIKR_THEME_URL', get_template_directory_uri()); }
if (!defined('PRIKR_THEME_PHP_DIR')) { define('PRIKR_THEME_PHP_DIR', PRIKR_THEME_DIR . '/src/php'); }
if (!defined('PRIKR_THEME_PHP_URL')) { define('PRIKR_THEME_PHP_URL', PRIKR_THEME_URL . '/src/php'); }
if (!defined('PRIKR_THEME_CSS_DIR')) { define('PRIKR_THEME_CSS_DIR', PRIKR_THEME_DIR . '/dist/css'); }
if (!defined('PRIKR_THEME_CSS_URL')) { define('PRIKR_THEME_CSS_URL', PRIKR_THEME_URL . '/dist/css'); }
if (!defined('PRIKR_THEME_JS_DIR')) { define('PRIKR_THEME_JS_DIR', PRIKR_THEME_DIR . '/dist/js'); }
if (!defined('PRIKR_THEME_JS_URL')) { define('PRIKR_THEME_JS_URL', PRIKR_THEME_URL . '/dist/js'); }
if (!defined('PRIKR_THEME_PUBLIC_URL')) { define('PRIKR_THEME_PUBLIC_URL', PRIKR_THEME_URL . '/public'); }
if (!defined('PRIKR_THEME_PUBLIC_DIR')) { define('PRIKR_THEME_PUBLIC_DIR', PRIKR_THEME_DIR . '/public'); }