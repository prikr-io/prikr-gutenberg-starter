<?php

/**
 * Project: prikr-gutenberg-starter
 * File: enqueue.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Enqueue scripts and styles
 */
function prikr_enqueue_scripts()
{
  wp_enqueue_style('prikr-gutenberg-starter', prikr_get_asset(PRIKR_THEME_PUBLIC_URL . '/css/bundle.css'), array(), PRIKR_THEME_VERSION, 'all');
  wp_enqueue_script('prikr-gutenberg-starter', prikr_get_asset(PRIKR_THEME_PUBLIC_URL . '/js/bundle.min.js'), array(), PRIKR_THEME_VERSION, true);
}
add_action('wp_enqueue_scripts', 'prikr_enqueue_scripts');
