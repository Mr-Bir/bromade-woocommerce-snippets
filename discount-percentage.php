<?php
/**
 * Appends a discount percentage badge to sale prices.
 *
 * Problem: WooCommerce shows only a "Sale!" flash, but customers wanted to
 * see how large the discount actually is.
 * Solution: calculate the percentage from regular vs sale price and append a
 * badge to the price HTML. Styled by discount-badge.css.
 *
 * Variable and grouped products are skipped: they render a price range, so a
 * single percentage would be misleading.
 *
 * Hook: woocommerce_get_price_html
 */

add_filter( 'woocommerce_get_price_html', 'bromade_add_discount_badge', 10, 2 );

function bromade_add_discount_badge( $price_html, $product ) {

	// Keeps the badge out of admin screens and product feed exports.
	if ( is_admin() && ! wp_doing_ajax() ) {
		return $price_html;
	}

	if ( ! $product instanceof WC_Product || ! $product->is_on_sale() ) {
		return $price_html;
	}

	if ( $product->is_type( 'variable' ) || $product->is_type( 'grouped' ) ) {
		return $price_html;
	}

	$regular = (float) $product->get_regular_price();
	$sale    = (float) $product->get_sale_price();

	// is_on_sale() can be true while sale_price is empty (scheduled sales,
	// external products), which would otherwise produce "-100%".
	if ( $regular <= 0 || $sale <= 0 || $sale >= $regular ) {
		return $price_html;
	}

	$percent = (int) round( 100 - ( $sale / $regular * 100 ) );

	// A rounded 0% badge adds noise on very small discounts.
	if ( $percent < 1 ) {
		return $price_html;
	}

	return $price_html . sprintf(
		' <span class="discount-badge">-%d%%</span>',
		$percent
	);
}
