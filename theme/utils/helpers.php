<?php

/**
 * Project: prikr-gutenberg-starter
 * File: helpers.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Get asset
 * 
 * @param string $path
 * @return string
 */
function prikr_get_asset($path)
{
  if (PRIKR_THEME_ENV === 'production') {
    return $path;
  }

  return add_query_arg('t', time(), $path);
}
