<?php

/**
 * Project: prikr-gutenberg-starter
 * File: theme-support.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
add_theme_support('wp-block-styles');
add_theme_support('align-wide');
add_theme_support('editor-styles');
add_theme_support('responsive-embeds');

