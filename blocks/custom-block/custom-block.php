<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

$name = 'custom-block';

if (function_exists('register_block_type')) {
  register_block_type(PRIKR_THEME_PREFIX . '/' . $name, array(
    'editor_script' => PRIKR_THEME_PREFIX . $name,
    'render_callback' => 'render_custom_block'
  ));
}

function render_custom_block($block_attributes, $content) {
  $recent_posts = wp_get_recent_posts( array(
    'numberposts' => 1,
    'post_status' => 'publish',
  ) );
  if ( count( $recent_posts ) === 0 ) {
      return 'No posts';
  }
  $post = $recent_posts[ 0 ];
  $post_id = $post['ID'];
  return sprintf(
      '<a class="wp-block-my-plugin-latest-post" href="%1$s">%2$s</a>',
      esc_url( get_permalink( $post_id ) ),
      esc_html( get_the_title( $post_id ) )
  );
}