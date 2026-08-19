# bromade-woocommerce-snippets

Custom PHP and CSS snippets running in production on [bromade.eu](https://www.bromade.eu/),
a WooCommerce store built on WordPress with the Brizy page builder and Polylang
for multilingual support.

Each snippet solves a concrete problem that came up while building and running
the shop. They are documented here as a reference, not as a drop-in plugin —
selectors and hooks are tied to this specific theme and plugin stack.

## Stack

WordPress · WooCommerce · Brizy · Polylang · Code Snippets

## Sale price display

| File | Problem it solves |
|---|---|
| `discount-percentage.php` | Calculates the discount percentage from regular vs sale price and appends a badge to the price HTML. Skips variable and grouped products, which render a price range |
| `discount-badge.css` | Styles the badge output by the snippet above |
| `sale-price-colors.css` | Restores the strikethrough and colour separation between old and current price after a theme update overwrote them |

## Multilingual (Polylang)

| File | Problem it solves |
|---|---|
| `product-filter-language.php` | Keeps the product filter and category archives within the language the visitor is browsing in, including AJAX requests |
| `cart-widget-translations.php` | Supplies Latvian strings the WooCommerce language pack does not cover, scoped to the WooCommerce text domain |
| `polylang-switcher.css` | Restyles the language switcher inside a Brizy menu and removes leftover menu chrome |

## Layout

| File | Problem it solves |
|---|---|
| `product-gallery-thumbnails.css` | Lays out FlexSlider gallery thumbnails as a centred square grid instead of uneven floated rows |
| `brizy-instagram-feed-responsive.css` | Stops the Instagram feed block from overflowing its section on mobile |

## Notes

Written against WooCommerce 8.x / WordPress 6.x.

Snippets are managed through the Code Snippets plugin rather than a child theme,
so the store stays update-safe and the overrides survive theme changes.

The cart widget translations are deliberately kept in code rather than in
Polylang's string translation UI, so they stay in version control and survive
plugin updates. Trade-off: they cannot be edited without deploying.

## License

MIT
