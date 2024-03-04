<?php

/**
 * Project: prikr-gutenberg-starter
 * File: header.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

?>

<!DOCTYPE html>
<!-- Designed & Developed with ♥ and ☕ by Daan Boot & prikr. -->
<html <?php language_attributes(); ?>>

<?php get_template_part('/src/php/parts/head'); ?>

<body <?php body_class(); ?>>
  
  <main class="bg-white rounded-t-3xl mt-20 lg:mt-28 mx-auto border-b border-blue-25">