<?php

/**
 * Project: prikr-gutenberg-starter
 * File: media.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Allow unfiltered uploads if administrator
 */
function restrict_upload_mimes()
{
  if (current_user_can('administrator') && !defined('ALLOW_UNFILTERED_UPLOADS')) {
    define('ALLOW_UNFILTERED_UPLOADS', true);
  }
}
add_action('admin_init', 'restrict_upload_mimes', 1);

/**
 * Allow SVG uploads for everyone
 */
function add_file_types_to_uploads($file_types)
{
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $new_filetypes['svg'] = 'image/svg+xmlns';
  $new_filetypes['woff'] = 'application/x-font-woff';
  $new_filetypes['woff2'] = 'application/x-font-woff2';
  $new_filetypes['ttf'] = 'application/x-font-ttf';
  $file_types = array_merge($file_types, $new_filetypes);
  return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

/**
 * Add meta data to SVG uploads
 */
function svg_meta_data($data, $id)
{
  $attachment = get_post($id); // Filter makes sure that the post is an attachment
  $mime_type = $attachment->post_mime_type; // The attachment mime_type
  if ($mime_type == 'image/svg+xml') {
    if (empty($data) || empty($data['width']) || empty($data['height'])) {
      $xml = simplexml_load_file(wp_get_attachment_url($id));
      $attr = $xml->attributes();
      $viewbox = explode(' ', $attr->viewBox);
      $data['width'] = isset($attr->width) && preg_match('/\d+/', $attr->width, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[2] : null);
      $data['height'] = isset($attr->height) && preg_match('/\d+/', $attr->height, $value) ? (int) $value[0] : (count($viewbox) == 4 ? (int) $viewbox[3] : null);
    }
  }
  return $data;
}
add_filter('wp_update_attachment_metadata', 'svg_meta_data', 10, 2);
