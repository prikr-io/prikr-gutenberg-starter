<?php

/**
 * Project: prikr-gutenberg-starter
 * File: setup.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

require_once PRIKR_THEME_DIR . '/theme/utils/utils.php';

require_once PRIKR_THEME_DIR . '/theme/core/security.php';

require_once PRIKR_THEME_DIR . '/theme/core/enqueue.php';

require_once PRIKR_THEME_DIR . '/theme/core/post-types.php';

require_once PRIKR_THEME_DIR . '/theme/core/templates.php';

function prikr_theme_setup () {

  require_once PRIKR_THEME_DIR . '/theme/core/theme-support.php';

  require_once PRIKR_THEME_DIR . '/theme/core/menus.php';
  
}
add_action('after_setup_theme', 'prikr_theme_setup');

require_once PRIKR_THEME_DIR . '/theme/core/patterns.php';