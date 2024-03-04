<?php

/**
 * Project: prikr-gutenberg-starter
 * File: post_types.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Set up custom post types and taxonomies
 */
add_action('init', function () {
  $args = [
    'supports'              => ['thumbnail', 'title', 'editor', 'excerpt', 'custom-fields', 'revisions', 'author', 'page-attributes', 'post-formats', 'comments', 'trackbacks', 'sticky', 'template', 'taxonomy', 'tags', 'category'],
    'hierarchical'          => false,
    'show_in_rest'          => true, // disables or enables the block editor
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  ];
  dd_register_custom_post_type($args, 'case', 'Case', 'Cases');

   $taxonomy_args = [
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => false,
  ];
  // dd_register_custom_taxonomies($taxonomy_args, 'werknemer', 'Categorie', 'Categorieën');
});

/**
 * Register a Custom Post Type with all labels pre-defined
 */
function dd_register_custom_post_type($args, $post_type, $singular_name, $plural_name, $taxonomies = [])
{
  $labels = [
    'label'                 => __($singular_name),
    'description'           => __($singular_name . ' Description'),
    'labels'                => [
      'name'                  => _x($plural_name, $singular_name . ' General Name'),
      'singular_name'         => _x($singular_name, $singular_name . ' Singular Name'),
      'menu_name'             => __($plural_name),
      'name_admin_bar'        => __($singular_name),
      'archives'              => __('Item Archives'),
      'attributes'            => __('Item Attributes'),
      'parent_item_colon'     => __('Parent Item:'),
      'all_items'             => __('All Items'),
      'add_new_item'          => __('Add New Item'),
      'add_new'               => __('Add New'),
      'new_item'              => __('New Item'),
      'edit_item'             => __('Edit Item'),
      'update_item'           => __('Update Item'),
      'view_item'             => __('View Item'),
      'view_items'            => __('View Items'),
      'search_items'          => __('Search Item'),
      'not_found'             => __('Not found'),
      'not_found_in_trash'    => __('Not found in Trash'),
      'featured_image'        => __('Featured Image'),
      'set_featured_image'    => __('Set featured image'),
      'remove_featured_image' => __('Remove featured image'),
      'use_featured_image'    => __('Use as featured image'),
      'insert_into_item'      => __('Insert into item'),
      'uploaded_to_this_item' => __('Uploaded to this item'),
      'items_list'            => __($plural_name . ' list'),
      'items_list_navigation' => __($plural_name . ' list navigation'),
      'filter_items_list'     => __('Filter ' . $plural_name . ' list'),
    ],
  ];

  $args = array_merge($args, $labels);
  $args['taxonomies'] = $taxonomies;

  register_post_type($post_type, $args);
}

/**
 * Register a custom taxonomy with all labels pre-defined
 */
function dd_register_custom_taxonomies($args, $post_type, $singular, $plural)
{
  $taxonomy_labels = [
    'name'              => _x($singular, 'taxonomy general name'),
    'singular_name'     => _x($singular, 'taxonomy singular name'),
    'search_items'      => __('Search ' . $post_type . ' Taxonomies'),
    'all_items'         => __('All ' . $post_type . ' Taxonomies'),
    'parent_item'       => __('Parent ' . $singular),
    'parent_item_colon' => __('Parent ' . $singular),
    'edit_item'         => __('Edit ' . $singular),
    'update_item'       => __('Update ' . $singular),
    'add_new_item'      => __('Add New ' . $singular),
    'new_item_name'     => __('New ' . $singular . ' Name'),
    'menu_name'         => __($plural),
  ];

  $taxonomy_args = [
    'labels'            => $taxonomy_labels,
  ];
  $taxonomy_args = array_merge($args, $taxonomy_args);

  register_taxonomy($post_type . '_taxonomy', [$post_type], $taxonomy_args);
}
