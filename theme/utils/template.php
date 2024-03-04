<?php

/**
 * Project: prikr-gutenberg-starter
 * File: template.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

define('WPSE_PAGE_TEMPLATE_SUB_DIR', 'php/templates');

/**
 * Add subdirectory to page templates
 */
function prikr_page_template_add_subdir($templates = array())
{
  if (empty($templates) || !is_array($templates) || count($templates) < 3)
    return $templates;

  $page_tpl_idx = 0;
  $cnt = count($templates);
  if ($templates[0] === get_page_template_slug()) {
    $page_tpl_idx = 1;
  }

  for ($i = $page_tpl_idx; $i < $cnt - 1; $i++) {
    $templates[$i] = WPSE_PAGE_TEMPLATE_SUB_DIR . '/' . $templates[$i];
  }

  return $templates;
}
add_filter('page_template_hierarchy', 'prikr_page_template_add_subdir');