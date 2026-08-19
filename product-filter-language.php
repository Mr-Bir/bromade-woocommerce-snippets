<?php
/**
 * Forces WooCommerce product queries to respect the active Polylang language.
 *
 * Problem: the product filter returned items from all languages instead of
 * only the one the visitor was browsing in.
 * Solution: inject the active language into the query via pre_get_posts.
 *
 * Hook: pre_get_posts (priority 20, so it runs after Polylang's own handlers)
 */

add_action( 'pre_get_posts', 'bromade_filter_products_by_language', 20 );

function bromade_filter_products_by_language( $query ) {

	// Degrade silently if Polylang is deactivated.
	if ( ! function_exists( 'pll_current_language' ) ) {
		return;
	}

	// is_admin() is true for admin-ajax.php as well, so AJAX requests
	// coming from the front-end filter must not be excluded here.
	if ( is_admin() && ! wp_doing_ajax() ) {
		return;
	}

	// On product category and tag archives post_type is often empty,
	// so checking it alone would skip those pages.
	$post_type = $query->get( 'post_type' );

	$is_product_query = ( 'product' === $post_type )
		|| ( is_array( $post_type ) && in_array( 'product', $post_type, true ) )
		|| $query->is_post_type_archive( 'product' )
		|| $query->is_tax( get_object_taxonomies( 'product' ) );

	if ( ! $is_product_query ) {
		return;
	}

	$lang = pll_current_language();

	if ( $lang ) {
		$query->set( 'lang', $lang );
	}
}
