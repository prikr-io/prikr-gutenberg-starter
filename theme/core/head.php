<?php

/**
 * Project: prikr-gutenberg-starter
 * File: head.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Add tags to head
 */
function prikr_add_tags_to_head() {
  $color = PRIKR_PROJECT_COLOR;
  echo '<meta name="theme-color" content="' . $color . '">';
  echo '<meta name="msapplication-TileColor" content="' . $color . '">';
  
  $name = PRIKR_PROJECT_NAME;
  echo '<meta name="application-name" content="' . $name . '">';
}
add_action('wp_head', 'prikr_add_tags_to_head');