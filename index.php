<?php

/**
 * Project: prikr-gutenberg-starter
 * File: index.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

get_header();

?>
<div class="bg-pink text-blue-600">
  hallo
</div>
<?php

if (have_posts()) {
  while (have_posts()) {
    the_post();
    the_content();
  }
}

get_footer();