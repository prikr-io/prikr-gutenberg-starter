<?php

/**
 * Project: prikr-gutenberg-starter
 * File: production.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * DEBUG MODUS
 */
if (!defined('WP_DEBUG')) { define('WP_DEBUG', false); }
if (!defined('WP_DEBUG_DISPLAY')) { define('WP_DEBUG_DISPLAY', false); }
if (!defined('WP_DEBUG_LOG')) { define('WP_DEBUG_LOG', false); }
if (!defined('SCRIPT_DEBUG')) { define('SCRIPT_DEBUG', false); }

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