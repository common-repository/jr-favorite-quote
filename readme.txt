=== Plugin Name ===
Contributors: jacobras
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=F8RVLT4RZTVJY&lc=NL&item_name=Jacob%20Ras&item_number=JR%20Favorite%20Quote%20for%20Wordpress&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: post, image, gallery
Requires at least: 2.0
Tested up to: 2.8.4
Stable tag: 1.1

JR Favorite Quote shows one or more (rotating, or static) of your favorite quotes in your theme's sidebar (or anywhere you like).

== Description ==

JR Favorite Quote shows one or more (rotating, or static) of your favorite quotes in your theme's sidebar (or anywhere you like). Colors, quotes and other settings are easily changeable in the configuration page.


**Features:**

*   Up to 3 quotes can be entered
*   You can select which quote should be showed, or random
*   All colors are customizable in the configuration page

**Demo:**
Check out my website [NatalGaming.nl](http://www.natalgaming.nl/ "JR Favorite Quote Demo"), the plugin is used in the sidebar.

== Installation ==

Installation is very easy:

1. Upload `jr-favorite-quote.php` to the `/wp-content/plugins/` directory and activate the plugin
1. Place `<?php jr_favorite_quote(); ?>` in your theme's `sidebar.php` file, that's where the quote(s) will show up.

That's it! You can change additional settings under Settings -> JR Post Image.

== Frequently Asked Questions ==

= How do I know which colors in the configuration page I should change? =

Please take a look at the image under 'Color settings' at the [Plugin page](http://www.jacobras.nl/wordpress/favorite-quote/ "JR Favorite Quote for Wordpress plugin page). Or, look at screenshot #4.

== Screenshots ==

1. Default colors.
2. Blue colors.
3. Configuration page preview.
4. Color settings.

== Changelog ==

= 1.1 =
* Fixed bug where plugins showed 'Fatal error'
* Now ignores empty quotes
* Fixed empty quotes problem (when using less than 3 quotes)
* Now shows default text when there is no quote entered

= 1.01 =
* Small fixes.

= 1.0 =
* First final release.