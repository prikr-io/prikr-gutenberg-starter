<?php
/**
 * Title: Example Pattern
 * Slug: prikr-gutenberg-starter/example
 * Description: A simple pattern with a heading and a paragraph.
 * Category: text
 * Keywords: simple, heading, paragraph
 * Author: Jasper van Doorn
 */
if (function_exists('register_block_pattern')) {
  register_block_pattern(
    PRIKR_THEME_PREFIX . '/example', // This is the name of the pattern
    array(
      'title'       => __('Simple Pattern', PRIKR_THEME_PREFIX),
      'description' => _x('A simple pattern with a heading and a paragraph.', 'Block pattern description', PRIKR_THEME_PREFIX),
      'content'     => '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
      <div class="wp-block-group alignfull"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
      <div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"flex"}} -->
      <div class="wp-block-group"><!-- wp:site-logo /-->
      
      <!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
      <div class="wp-block-group"><!-- wp:site-title {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}}},"fontSize":"medium"} /--></div>
      <!-- /wp:group --></div>
      <!-- /wp:group -->
      
      <!-- wp:navigation {"ref":9,"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"}} /--></div>
      <!-- /wp:group -->
      
      <!-- wp:cover {"url":"https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/a017-eberhard-cco-the-after-rain.jpg?w=1200\u0026amp;h=1200\u0026amp;fit=clip\u0026amp;crop=default\u0026amp;dpr=1\u0026amp;q=75\u0026amp;vib=3\u0026amp;con=3\u0026amp;usm=15\u0026amp;cs=srgb\u0026amp;bg=F4F4F3\u0026amp;ixlib=js-2.2.1\u0026amp;s=e7b4ca0a0edcc84ba48c1f7ebf02dd5a","id":61,"dimRatio":0,"overlayColor":"black","isUserOverlayColor":true,"focalPoint":{"x":0.5,"y":0.5},"minHeight":40,"minHeightUnit":"vw","contentPosition":"center center","isDark":false,"align":"full","style":{"spacing":{"margin":{"top":"0"}}}} -->
      <div class="wp-block-cover alignfull is-light" style="margin-top:0;min-height:40vw"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-61" alt="" src="https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/a017-eberhard-cco-the-after-rain.jpg?w=1200&amp;h=1200&amp;fit=clip&amp;crop=default&amp;dpr=1&amp;q=75&amp;vib=3&amp;con=3&amp;usm=15&amp;cs=srgb&amp;bg=F4F4F3&amp;ixlib=js-2.2.1&amp;s=e7b4ca0a0edcc84ba48c1f7ebf02dd5a" style="object-position:50% 50%" data-object-fit="cover" data-object-position="50% 50%"/><div class="wp-block-cover__inner-container"><!-- wp:spacer {"height":"50px"} -->
      <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
      <!-- /wp:spacer --></div></div>
      <!-- /wp:cover --></div>
      <!-- /wp:group -->',
    )
  );
}
