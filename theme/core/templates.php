<?php

/**
 * Project: prikr-gutenberg-starter
 * File: templates.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Block template pattern for a custom post type
 * Type: case
 */
function mytheme_register_block_templates() {
  $post_type_object = get_post_type_object('case');
  $post_type_object->template = array(
      array('core/paragraph', array(
          'placeholder' => 'Add a root-level paragraph',
      )),
      array('core/columns', array(), array(
          array('core/column', array(), array(
              array('core/image', array()),
          )),
          array('core/column', array(), array(
              array('core/paragraph', array(
                  'placeholder' => 'Add a nested paragraph',
              )),
          )),
      )),
      // Add more blocks as needed
  );
  $post_type_object->template_lock = 'all'; // Optional: Lock the template to prevent adding/removing blocks
}
add_action('init', 'mytheme_register_block_templates');