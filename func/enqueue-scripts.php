<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

function enqueue_scripts()
{
	wp_enqueue_script('go-bootstrap', get_template_directory_uri() . '/assets/js/plugins/bootstrap.min.js', array('jquery'), '3', true);
	wp_enqueue_script('go-paroller', get_template_directory_uri() . '/assets/js/plugins/paroller.min.js', array('jquery'), '3', true);
	wp_enqueue_script('go-select2', get_template_directory_uri() . '/assets/js/plugins/select2.min.js', array('jquery'), '3', true);
	wp_enqueue_script('go-range-slider', get_template_directory_uri() . '/assets/js/plugins/ion.rangeSlider.min.js', array('jquery'), '3', true);
	wp_enqueue_script('go-fancybox', get_template_directory_uri() . '/assets/js/plugins/fancybox.min.js', array('jquery'), '3', true);
	wp_enqueue_script('go-datatabel', 'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', array('jquery'), '3', true);
	wp_enqueue_script('go-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '3', true);
	// wp_enqueue_script('go-filters', get_template_directory_uri() . '/assets/js/filters.js', array('jquery'), '3', true);

	if (is_singular('lokale')):
		wp_enqueue_script('go-gallery-js', get_template_directory_uri() . '/assets/js/local-gallery.js', array('jquery'), null, true);
		wp_localize_script('go-gallery-js', 'go_gallery_ajax', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		));
	endif;
	if (is_page('ulubione-lokale')) {
		wp_enqueue_script('go-wishlist', get_template_directory_uri() . '/assets/js/wishlist.js', array('jquery'), '3', true);
	}

	if (is_singular('projekty')) {
		wp_enqueue_script('go-slick', get_template_directory_uri() . '/assets/js/plugins/slick.min.js', array('jquery'), '3', true);
		wp_enqueue_script('go-projekty-slider', get_template_directory_uri() . '/assets/js/project.js', array('jquery'), '3', true);
	}

	wp_enqueue_script('go-archive-filters', get_template_directory_uri() . '/assets/js/archive-filters.js', array('jquery'), null, true);
	wp_localize_script('go-archive-filters', 'ajax_vars', [
		'ajax_url' => admin_url('admin-ajax.php')
	]);
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');
