<?php 
// function async_scripts( $url ) {
// 	if ( strpos( $url, '#asyncload' ) === false ) {
// 		return $url;
// 	} else if ( is_admin() ) {
// 		return str_replace( '#asyncload', '', $url );
// 	} else {
// 		return str_replace( '#asyncload', '', $url ) . "' async='async";
// 	}
// }
// add_filter( 'clean_url', 'async_scripts', 11, 1 );
// function defer_scripts( $url ) {

//     if ( strpos( $url, '#deferload' ) === false ) {
// 		return $url;
// 	} else if ( is_admin() ) {
// 		return str_replace( '#deferload', '', $url );
// 	} else {
// 		return str_replace( '#deferload', '', $url ) . "' defer='defer";
// 	}
// }
// add_filter( 'clean_url', 'defer_scripts', 11, 1 );


function prefix_remove_unnecessary_tags() {
	// REMOVE WP EMOJI
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );


	// remove all tags from header
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );

	// language
	add_filter( 'multilingualpress.hreflang_type', '__return_false' );
}
// add_action('init', 'prefix_remove_unnecessary_tags');

// remove in wordpress jquery-migrate.min.js?ver=3.3.2:2 JQMIGRATE: Migrate is installed, version 3.3.2
add_action('wp_default_scripts', function ($scripts) {
    if (!empty($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
    }
});
add_filter('wpcf7_autop_or_not', '__return_false');
