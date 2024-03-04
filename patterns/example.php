<?php
/**
 * Title: Example Pattern
 * Slug: prikr-gutenberg-starter/example
 * Description: A simple pattern with a heading and a paragraph.
 */
if (function_exists('register_block_pattern')) {
  register_block_pattern(
    PRIKR_THEME_PREFIX . '/example', // This is the name of the pattern
    array(
      'title'       => __('Simple Pattern', PRIKR_THEME_PREFIX),
      'description' => _x('A simple pattern with a heading and a paragraph.', 'Block pattern description', PRIKR_THEME_PREFIX),
      'content'     => "<!-- wp:group -->
                              <div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\">
                              <!-- wp:heading {\"level\":3} -->
                              <h3>" . __('A Simple Heading', PRIKR_THEME_PREFIX) . "</h3>
                              <!-- /wp:heading -->

                              <!-- wp:paragraph -->
                              <p>" . __('This is a simple paragraph.', PRIKR_THEME_PREFIX) . "</p>
                              <!-- /wp:paragraph -->
                              </div></div>
                              <!-- /wp:group -->",
    )
  );
}
