<?php

/**
 * Project: prikr-gutenberg-starter
 * File: theme-support.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Disable full-site editing support.
 *
 * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
 */
remove_theme_support('block-templates');

/**
 * Register the navigation menus.
 *
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
register_nav_menus([
  'primary_navigation' => __('Primary Navigation', 'sage'),
]);

/**
 * Disable the default block patterns.
 *
 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
 */
remove_theme_support('core-block-patterns');

/**
 * Enable plugins to manage the document title.
 *
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
 */
add_theme_support('title-tag');

/**
 * Enable post thumbnail support.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support('post-thumbnails');

/**
 * Enable responsive embed support.
 *
 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
 */
add_theme_support('responsive-embeds');

/**
 * Enable HTML5 markup support.
 *
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
 */
add_theme_support('html5', [
  'caption',
  'comment-form',
  'comment-list',
  'gallery',
  'search-form',
  'script',
  'style',
]);

/**
 * Enable selective refresh for widgets in customizer.
 *
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
 */
add_theme_support('customize-selective-refresh-widgets');
