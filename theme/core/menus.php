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
function prikr_register_menus()
{
  register_nav_menus(
    array(
      'primary' => __('Primary Menu', PRIKR_THEME_PREFIX),
      'footer' => __('Footer Menu', PRIKR_THEME_PREFIX),
    )
  );
}

/**
 * Add additional classes to anchors in menus
 */
function add_additional_class_on_a($classes, $item, $args)
{
  if (isset($args->add_a_class)) {
    $classes['class'] = $args->add_a_class;
  }
  return $classes;
}
add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);

/**
 * Add additional classes to list items in menu
 */
function add_additional_class_on_li($classes, $item, $args)
{
  if (isset($args->add_li_class)) {
    $classes[] = $args->add_li_class;
  }
  if (in_array('current-menu-item', $classes)) {
    $classes[] = '';
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


/**
 * Add custom attributes or classes to links in wp_nav_menu
 */
add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {


  if (property_exists($args, 'link_atts')) {
    $atts = array_merge($atts, $args->link_atts);
  }
  if (property_exists($args, "link_atts_$depth")) {
    $atts = array_merge($atts, $args->{"link_atts_$depth"});
  }

  if (empty($atts['class'])) {
    $atts['class'] = '';
  }

  $classes = explode(' ', $atts['class']);

  /**
   * Fix for tailwindcss classes that include ":" (colon)
   * Enter triple underscore hover___text-primary instaed of hover:text-primary
   *
   * Some filters provided so that you can customize your own replacements,
   * passed directly to preg_replace so supports array replacements as well.
   *
   * WordPress trac following the issue of escaping CSS classes:
   * @link https://core.trac.wordpress.org/ticket/33924
   */
  $patterns = apply_filters('nav_menu_css_class_unescape_patterns', '/___/');
  $replacements = apply_filters('nav_menu_css_class_unescape_replacements', ':');
  $classes = array_map(function ($cssclass) use ($patterns, $replacements) {
    return preg_replace($patterns, $replacements, $cssclass);
  }, $classes);

  if (property_exists($args, 'a_class')) {
    $arr_classes = explode(' ', $args->a_class);
    $classes = array_merge($classes, $arr_classes);
  }
  if (property_exists($args, "a_class_$depth")) {
    $arr_classes = explode(' ', $args->{"a_class_$depth"});
    $classes = array_merge($classes, $arr_classes);
  }

  $atts['class'] = implode(' ', $classes);

  return $atts;
}, 1, 4);

/**
 * Add custom classes to lis in wp_nav_menu
 */
add_filter('nav_menu_css_class', function ($classes, $item, $args, $depth) {
  if (property_exists($args, 'li_class')) {
    $arr_classes = explode(' ', $args->li_class);
    $classes = array_merge($classes, $arr_classes);
  }
  if (property_exists($args, "li_class_$depth")) {
    $arr_classes = explode(' ', $args->{"li_class_$depth"});
    $classes = array_merge($classes, $arr_classes);
  }

  return $classes;
}, 1, 4);

/**
 * Add custom classes to ul.sub-menu in wp_nav_menu
 */
add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
  if (property_exists($args, 'submenu_class')) {
    $arr_classes = explode(' ', $args->submenu_class);
    $classes = array_merge($classes, $arr_classes);
  }

  if (property_exists($args, "submenu_class_$depth")) {
    $arr_classes = explode(' ', $args->{"submenu_class_$depth"});
    $classes = array_merge($classes, $arr_classes);
  }

  return $classes;
}, 1, 3);

/**
 * Populate children for the wp_get_menu_array function
 */
function populate_children($menu_array, $menu_item)
{
  $children = array();
  if (!empty($menu_array)) {
    foreach ($menu_array as $k => $m) {
      if ($m->menu_item_parent == $menu_item->ID) {
        $children[$m->ID] = array();
        $children[$m->ID]['id'] = $m->ID;
        $children[$m->ID]['title'] = $m->title;
        $children[$m->ID]['url'] = $m->url;
        $children[$m->ID]['target'] = $m->target;
        $children[$m->ID]['classes'] = implode(' ', $m->classes);

        unset($menu_array[$k]);
        $children[$m->ID]['children'] = populate_children($menu_array, $m);
      }
    }
  };
  return $children;
}

/**
 * Return a fully editable array of the menu, usefull for Tailwind
 */
function wp_get_menu_array($current_menu)
{

  $menu_array = wp_get_nav_menu_items($current_menu);

  $menu = array();

  foreach ($menu_array as $m) {
    if (empty($m->menu_item_parent)) {
      $menu[$m->ID] = array();
      $menu[$m->ID]['id'] = $m->ID;
      $menu[$m->ID]['title'] = $m->title;
      $menu[$m->ID]['url'] = $m->url;
      $menu[$m->ID]['target'] = $m->target;
      $menu[$m->ID]['classes'] = implode(' ', $m->classes);
      $menu[$m->ID]['children'] = populate_children($menu_array, $m);
    }
  }

  return $menu;
}
