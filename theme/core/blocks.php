<?php

/**
 * Project: prikr-gutenberg-starter
 * File: blocks.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Include all blocks
 */
add_action('init', 'prikr_include_blocks');
function prikr_include_blocks() {
  foreach (glob(PRIKR_THEME_DIR . '/blocks/**/*.php') as $block_file) {
    // check if is not index.php
    if (strpos($block_file, 'index.php') !== false) {
      continue;
    }
    require_once $block_file;
  }
}