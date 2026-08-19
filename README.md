# bromade-woocommerce-snippets

Custom PHP and CSS snippets running in production on [bromade.eu](https://www.bromade.eu/),
a WooCommerce store built on WordPress with the Brizy page builder and Polylang
for multilingual support.

Each snippet solves a concrete problem that came up while building and running
the shop. They are documented here as a reference, not as a drop-in plugin —
selectors and hooks are tied to this specific theme and plugin stack.

## Stack

WordPress · WooCommerce · Brizy · Polylang · Code Snippets

## Contents

### PHP

| Snippet | Problem it solves |
|---|---|
| `discount-percentage.php` | Calculates and displays the discount percentage on sale items in product cards |
| `cart-widget-i18n.php` | Fixes untranslated strings in the cart widget when Polylang is active |
| `product-filter-i18n.php` | Keeps the product filter working across language versions |

### CSS

| Snippet | Problem it solves |
|---|---|
| `product-grid-centering.php` | Centers the last row when the catalog returns three products |
| `sale-price-colors.css` | Restores the strikethrough colour on the old price after a theme update |
| `polylang-switcher.css` | Restyles the language switcher to match the site design |
| `brizy-slider-height.css` | Fixes slider height on the custom engraving landing section |
| `woo-thumbnail-columns.css` | Adjusts product gallery thumbnail columns on mobile |

## Notes

Written against WooCommerce 8.x / WordPress 6.x. Snippets are managed through
the Code Snippets plugin rather than a child theme, so the store stays
update-safe.

## License

MIT
