<?php

/**
 * Project: prikr-gutenberg-starter
 * File: menus.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Register menus
 */
function prikr_register_menus() {
  register_nav_menus(
    array(
      'primary' => __('Primary Menu', PRIKR_THEME_PREFIX),
      'footer' => __('Footer Menu', PRIKR_THEME_PREFIX),
    )
  );
}