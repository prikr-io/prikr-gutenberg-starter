<?php

/**
 * Project: prikr-gutenberg-starter
 * File: setup.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Utils
 */
require_once PRIKR_THEME_DIR . '/theme/utils/utils.php';

/**
 * Core
 */
require_once PRIKR_THEME_DIR . '/theme/core/security.php';
require_once PRIKR_THEME_DIR . '/theme/core/enqueue.php';
require_once PRIKR_THEME_DIR . '/theme/core/post-types.php';
require_once PRIKR_THEME_DIR . '/theme/core/templates.php';
require_once PRIKR_THEME_DIR . '/theme/core/media.php';

/**
 * Content
 */
require_once PRIKR_THEME_DIR . '/theme/core/blocks.php';
require_once PRIKR_THEME_DIR . '/theme/core/patterns.php';


function prikr_theme_setup () {

  require_once PRIKR_THEME_DIR . '/theme/core/theme-support.php';
  require_once PRIKR_THEME_DIR . '/theme/core/menus.php';
  
}
add_action('after_setup_theme', 'prikr_theme_setup');



/**
 * Plugins
 */
require_once PRIKR_THEME_DIR . '/theme/plugins/mu-plugins.php';
if (defined('PRIKR_ENABLE_YOAST_SEO') && PRIKR_ENABLE_YOAST_SEO) { require_once PRIKR_THEME_DIR . '/theme/plugins/yoast-seo.php'; }
if (defined('PRIKR_ENABLE_WPML') && PRIKR_ENABLE_WPML) { require_once PRIKR_THEME_DIR . '/theme/plugins/wpml.php'; }
if (defined('PRIKR_ENABLE_ACF') && PRIKR_ENABLE_ACF) { require_once PRIKR_THEME_DIR . '/theme/plugins/acf.php'; }
if (defined('PRIKR_ENABLE_GRAVITY_FORMS') && PRIKR_ENABLE_GRAVITY_FORMS) { require_once PRIKR_THEME_DIR . '/theme/plugins/gravity-forms.php'; }
if (defined('PRIKR_ENABLE_WOOCOMMERCE') && PRIKR_ENABLE_WOOCOMMERCE) { require_once PRIKR_THEME_DIR . '/theme/plugins/woocommerce.php'; }
