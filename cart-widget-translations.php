<?php
/**
 * Supplies missing Latvian translations for WooCommerce cart widget strings.
 *
 * Problem: a few cart widget strings stayed in English on the Latvian version
 * of the site because the WooCommerce language pack did not cover them.
 * Solution: override them through the gettext filter, scoped to the
 * WooCommerce text domain only.
 *
 * The domain check runs first because gettext fires on every translatable
 * string on the page — hundreds of calls per request.
 *
 * Hook: gettext
 */

add_filter( 'gettext', 'bromade_translate_cart_strings', 10, 3 );

function bromade_translate_cart_strings( $translated, $original, $domain ) {

	// Cheapest possible check — discards almost every call.
	if ( 'woocommerce' !== $domain ) {
		return $translated;
	}

	// Language cannot change mid-request, so resolve it once.
	static $lang = null;

	if ( null === $lang ) {
		$lang = function_exists( 'pll_current_language' )
			? pll_current_language()
			: false;
	}

	if ( 'lv' !== $lang ) {
		return $translated;
	}

	static $strings = [
		'Subtotal'  => 'Starpsumma',
		'View cart' => 'Skatīt grozu',
		'Checkout'  => 'Noformēt pasūtījumu',
	];

	return $strings[ $original ] ?? $translated;
}
