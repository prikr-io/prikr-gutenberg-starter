<?php

/**
 * Project: prikr-gutenberg-starter
 * File: patterns.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Include all patterns
 */
foreach (glob(get_template_directory() . '/patterns/*.php') as $pattern_file) {
  // check if is not index.php
  if (strpos($pattern_file, 'index.php') !== false) {
    continue;
  }
  require_once $pattern_file;
}