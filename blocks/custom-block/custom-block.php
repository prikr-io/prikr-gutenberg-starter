<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$name = 'custom-block';

if (function_exists('register_block_type')) {
  register_block_type(PRIKR_THEME_PREFIX . '/' . $name, array(
    'editor_script' => PRIKR_THEME_PREFIX . $name,
  ));
}
