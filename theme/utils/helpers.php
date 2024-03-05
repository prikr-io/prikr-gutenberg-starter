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

/**
 * Check if PRIKR email-address
 */
function prikr_check_email_domain($email) {
  $email_domain = substr(strrchr($email, "@"), 1);
  if ($email_domain === 'prikr.io') {
    return true;
  }
  return false;
}

/**
 * Check if user has PRIKR email-address
 */
function prikr_user_has_prikr_email() {
  $user = wp_get_current_user();
  $email = $user->user_email;
  return prikr_check_email_domain($email);
}