<?php

/**
 * Project: prikr-gutenberg-starter
 * File: head.php
 * Author: Jasper van Doorn
 * Copyright © Prikr 
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly
$current_url = home_url();
?>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="author" content="Prikr <info@prikr.io>">
	<meta name="copyright" content="<?php bloginfo('name'); ?>">
	<meta name="url" content="<?php echo $current_url; ?>">
	<meta name="identifier-URL" content="<?php echo $current_url; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="msapplication-TileImage" content="<?= PRIKR_THEME_PUBLIC_URL . '/favicons/mstile-150x150.png' ?>" />
	<link rel="shortcut icon" href="<?= PRIKR_THEME_PUBLIC_URL . '/favicons/favicon.ico' ?>">
	<link rel="icon" type="image/png" href="<?= PRIKR_THEME_PUBLIC_URL . '/favicons/favicon-16x16.png' ?>" sizes="16x16" />
	<link rel="icon" type="image/png" href="<?= PRIKR_THEME_PUBLIC_URL . '/favicons/favicon-32x32.png' ?>" sizes="32x32" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?= PRIKR_THEME_PUBLIC_URL . '/favicons/apple-touch-icon.png' ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= PRIKR_THEME_PUBLIC_URL . '/favicons/favicon-32x32.png' ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= PRIKR_THEME_PUBLIC_URL . '/favicons/favicon-16x16.png' ?>">
	<?php
	  wp_head();
	?>
</head>