<?php

/**
 * Project: prikr-gutenberg-starter
 * File: wpml.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $sitepress;

if ( !is_admin() && null !== $sitepress ) {

  if (isset($_COOKIE['wp-wpml_current_language'])) {
    $sitepress->switch_lang($_COOKIE['wp-wpml_current_language']);
    do_action('wpml_switch_language', str_replace(' ', '', $_COOKIE['wp-wpml_current_language']));
  }
}

/**
 * Set config setting for wpml in acf 
 */

add_filter('acf/prepare_field', 'set_wpml_cf_preferences');

function set_wpml_cf_preferences($field)
{

  // bail early if no 'admin_only' setting
  if (empty($field['wpml_cf_preferences'])) $field['wpml_cf_preferences'] = 2;

  // return
  return $field;
}

/**
 * Enqueue scripts for AJAX
 */
function wpml_enqueue_scripts()
{
  wp_localize_script(
    'main',
    'wpml_ajax',
    array(
      'ajaxurl' => admin_url('admin-ajax.php'),
    )
  );
}
add_action('wp_enqueue_scripts', 'wpml_enqueue_scripts', 13);

/**
 * Set current language code
 */
function set_current_language_code($code = false)
{
  if (!function_exists('switch_lang')) return false;

  global $sitepress;
  if (isset($_COOKIE['lang'])) {
    $sitepress->switch_lang(str_replace(' ', '', $_COOKIE['lang']));
  } else if ($code !== false) {
    $sitepress->switch_lang(str_replace(' ', '', $code));
  } else {
    return false;
  }
}
add_action('init', 'set_current_language_code', 10);

/**
 * Get current language code
 */
function get_current_language_code()
{
  if (defined("ICL_LANGUAGE_CODE")) return constant('ICL_LANGUAGE_CODE');
}

/**
 * ACF Get_field customized function (if ACF is activated)
 */
if (function_exists('get_field')) {
  function get_mlfield($selector, $post_id = false, $format_value = true)
  {
    if (get_current_language_code() === 'en') { // set base language here
      if (!empty(get_field($selector, $post_id, $format_value))) :
        return get_field($selector, $post_id, $format_value);
      else :
        return '';
      endif;
    } else {
      if (is_object($post_id)) :
        if ($post_id->term_id) : // check if is term
          if (!empty(get_field($selector, $post_id->taxonomy . '_' . $post_id->term_id, $format_value))) :
            return get_field($selector, $post_id->taxonomy . '_' . $post_id->term_id, $format_value);
          else :
            return '';
          endif;
        elseif ($post_id->ID) : // else it is a post
          if (!empty(get_field($selector, $post_id->ID, $format_value))) :
            return get_field($selector, $post_id->ID, $format_value);
          else :
            return '';
          endif;
        endif;
      else :
        if (!empty(get_field($selector, $post_id, $format_value))) :
          return get_field($selector, $post_id, $format_value);
        else :
          return '';
        endif;
      endif; // is object
    }
  }
}

/** 
 * Alter every WP Query
 */
function modify_query_language($query)
{
  global $sitepress;
  if ( null === $sitepress ) return $query;

  if ( null !== $sitepress ) {
    $lang = get_current_language_code();
    $sitepress->switch_lang($lang);
    return $query;
  }
}
add_action('pre_get_posts', 'modify_query_language');

/**
 * AJAX Change language
 */
function change_current_language_page()
{
  global $sitepress;

  $payload = $_POST['payload'];
  $new_lang = $payload['newLang'];
  $old_lang = $payload['oldLang'];
  $currenturl = $payload['currentUrl'];
  $postid = $payload['postId'];
  $posttype = $payload['postType'];
  $pagetype = $payload['pageType'];

  // Check if action was fired via Ajax call. If yes, JS code will be triggered, else the user is redirected to the post page
  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    if (str_replace(' ', '', $new_lang) == str_replace(' ', '', $old_lang)) {
      wp_send_json(array(
        'message'  => __('Er heeft geen verandering plaatsgevonden', 'cpq'),
        'footer' => __( '<a href="/contact">Neem contact op</a>', 'cpq'),
        'type'     => 'Succes'
      ));
    } else {
      if (!method_exists($sitepress, 'switch_lang')) {
        wp_send_json(array(
          'message'  => __('Er ging iets fout bij het vertalen van deze pagina, misschien bestaat hij niet in een andere taal.', 'cpq'),
          'footer' => __( '<a href="/contact">Neem contact op</a>', 'cpq'),
          'type'     => 'Failed'
        ));
      } else {
        do_action('wpml_switch_language', str_replace(' ', '', $new_lang));

        $sitepress->switch_lang(str_replace(' ', '', $new_lang));
        // $languages = $sitepress->get_ls_languages();
        set_current_language_code();

        $url = '';
        if ($pagetype === 'front') {
          if ($new_lang !== 'en') { // set base language here
            $url = '/' . $new_lang . '/';
          } else {
            $url = '/';
          }

        } else if ($pagetype === 'page' || $pagetype === 'single' || $pagetype === 'attachment' || $pagetype === 'home') {
          
          $url = apply_filters('wpml_permalink', $currenturl, str_replace(' ', '', $new_lang), true);
          if ($url === $currenturl) {
            $newPostId = apply_filters( 'wpml_object_id', $postid, $posttype, TRUE, str_replace(' ', '', $new_lang) );
            $url = get_permalink($newPostId);
          }
          
        } else if ($pagetype === 'archive') {
          $url = get_post_type_archive_link($posttype);
        }

        if ($postid) {
          $oldpostid = $postid;
        } else {
          $oldpostid = url_to_postid($currenturl);
        }
        $newpostid = url_to_postid($url);
        $newpost = get_post($newpostid);

        if ($newpostid === 0 && $pagetype !== 'front') {
          $trid = apply_filters( 'wpml_element_trid', NULL, $oldpostid, 'post_' . $posttype );
          $translations = apply_filters( 'wpml_get_element_translations', NULL, $trid, 'post_' . $posttype );
          if ($translations[str_replace(' ', '', $new_lang)]) {
            $newpostid = $translations[str_replace(' ', '', $new_lang)]->element_id;
            $newpost = get_post($newpostid);
            $url = get_the_permalink($newpostid);
          }
        }

        if (($oldpostid === $newpostid) && $pagetype !== 'front' && $pagetype !== 'archive') {
          wp_send_json(array(
            'message'  => __('Er bestaat helaas geen vertaling voor deze pagina.', 'cpq'),
            'footer' => __( 'Kom je er niet uit? <a href="/contact">Neem contact op</a>', 'cpq'),
            'type'     => 'Failed',
            'oldpostid' => $oldpostid,
            'newpostid' => $newpostid,
          ));
        } else if ($newpost->post_status != 'trash' && $newpost->post_status != 'draft' && $currenturl !== $url) {
          wp_send_json(array(
            'message'  => __('De pagina is succesvol vertaald', 'cpq'),
            'footer' => false,
            'oldurl'   =>  $currenturl,
            'url'      =>  $url === '' ? '/' : $url,
            'type'     => 'Succes',
            'newpostid' => $newpostid
          ));
        } else {
          wp_send_json(array(
            'message'  =>  __('Deze pagina is hoogstwaarschijnlijk verwijderd of staat in de prullenbak.', 'cpq') ,
            'footer' => __( 'Kom je er niet uit? <a href="/contact">Neem contact op</a>', 'cpq'),
            'type'     => 'Failed'
          ));
        }
      }
    }
  } else {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die();
  }
}
add_action('wp_ajax_change_current_language_page', 'change_current_language_page');
add_action('wp_ajax_nopriv_change_current_language_page', 'change_current_language_page');

function get_current_page_type()
{
  global $wp_query;
  $loop = 'notfound';

  if ($wp_query->is_page) {
    $loop = is_front_page() ? 'front' : 'page';
  } elseif ($wp_query->is_home) {
    $loop = 'home';
  } elseif ($wp_query->is_single) {
    $loop = ($wp_query->is_attachment) ? 'attachment' : 'single';
  } elseif ($wp_query->is_category) {
    $loop = 'category';
  } elseif ($wp_query->is_tag) {
    $loop = 'tag';
  } elseif ($wp_query->is_tax) {
    $loop = 'tax';
  } elseif ($wp_query->is_archive) {
    if ($wp_query->is_day) {
      $loop = 'day';
    } elseif ($wp_query->is_month) {
      $loop = 'month';
    } elseif ($wp_query->is_year) {
      $loop = 'year';
    } elseif ($wp_query->is_author) {
      $loop = 'author';
    } else {
      $loop = 'archive';
    }
  } elseif ($wp_query->is_search) {
    $loop = 'search';
  } elseif ($wp_query->is_404) {
    $loop = 'notfound';
  }

  return $loop;
}
