<?php

/**
 * Project: prikr-gutenberg-starter
 * File: footer.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Append SVG icon symbols to footer HTML
 */
function prikr_render_svg_symbols () {
  get_template_part('/theme/utils/icons');
}
add_action('wp_footer', 'prikr_render_svg_symbols', 0, 0);