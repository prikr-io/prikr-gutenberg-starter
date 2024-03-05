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
if (!defined('PRIKR_THEME_PREFIX')) { define('PRIKR_THEME_PREFIX', 'prikr-gutenberg-starter'); }
if (!defined('PRIKR_PROJECT_NAME')) { define('PRIKR_PROJECT_NAME', 'prikr-gutenberg-starter'); }
if (!defined('PRIKR_PROJECT_COLOR')) { define('PRIKR_PROJECT_COLOR', '#123123'); }

/**
 * CONTENT
 */
if (!defined('PRIKR_ENABLE_ACCORDION')) { define('PRIKR_ENABLE_ACCORDION', true); }
if (!defined('PRIKR_ENABLE_MODALS')) { define('PRIKR_ENABLE_MODALS', false); }

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
if (!defined('PRIKR_THEME_PUBLIC_URL')) { define('PRIKR_THEME_PUBLIC_URL', PRIKR_THEME_URL . '/public'); }
if (!defined('PRIKR_THEME_PUBLIC_DIR')) { define('PRIKR_THEME_PUBLIC_DIR', PRIKR_THEME_DIR . '/public'); }

/**
 * PLUGINS
 */
if (!defined('PRIKR_ENABLE_YOAST_SEO')) { define('PRIKR_ENABLE_YOAST_SEO', true); }
if (!defined('PRIKR_ENABLE_WPML')) { define('PRIKR_ENABLE_WPML', false); }
if (!defined('PRIKR_ENABLE_ACF')) { define('PRIKR_ENABLE_ACF', true); }
if (!defined('PRIKR_ENABLE_WOOCOMMERCE')) { define('PRIKR_ENABLE_WOOCOMMERCE', true); }
if (!defined('PRIKR_ENABLE_GRAVITY_FORMS')) { define('PRIKR_ENABLE_GRAVITY_FORMS', true); }
if (!defined('PRIKR_ENABLE_W3_TOTAL_CACHE')) { define('PRIKR_ENABLE_W3_TOTAL_CACHE', true); }
if (!defined('PRIKR_ENABLE_IMAGE_OFFLOADER')) { define('PRIKR_ENABLE_IMAGE_OFFLOADER', true); }

/**
 * SECURITY
 */
if (!defined('PRIKR_REMOVE_X_PINGBACK')) { define('PRIKR_REMOVE_X_PINGBACK', true); }
if (!defined('PRIKR_REMOVE_WP_VERSION')) { define('PRIKR_REMOVE_WP_VERSION', true); }
if (!defined('PRIKR_DISABLE_XMLRPC')) { define('PRIKR_DISABLE_XMLRPC', true); }
if (!defined('PRIKR_DISABLE_REST_API')) { define('PRIKR_DISABLE_REST_API', false); }
if (!defined('PRIKR_DISABLE_MANIFEST')) { define('PRIKR_DISABLE_MANIFEST', true); }
if (!defined('PRIKR_DISABLE_EMOJICONS')) { define('PRIKR_DISABLE_EMOJICONS', true); }