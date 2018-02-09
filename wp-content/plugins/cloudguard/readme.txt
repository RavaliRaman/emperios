=== CloudGuard ===
Contributors: pipdig
Tags: security, cloudflare, login, geolocation, ip, block, restrict, access, country
Requires at least: 4.2
Tested up to: 4.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use Cloudflare's free geolocation service to restrict access to your site's login page.

== Description ==

Use the power of the cloud and a global CDN to restrict access to your login page.

CloudGuard brings global and cloud driven protection to your login page. Using Cloudflare's free Geolocation service, this super lightweight plugin restricts access to your login page, allowing access to only your chosen countries.  This means that any login attempts from the rest of the world will be automatically blocked.

Additionally, this plugin tracks any unauthorized login attempts and displays them on a [world map](https://wordpress.org/plugins/cloudguard/screenshots/) in your dashboard.

### Main Features

* Protect your login page globally.
* Reduce server load.
* Country based IP ranges constantly updated by Cloudflare.
* Track login attempt statistics via your dashboard.
* Block other countries or redirect to a URL.

### Why Cloudflare's Geolocation?

There are other plugins which can **restrict your login page by geographic location**. However, these plugins use your server to detect the IP and compare this to a geographic location. This adds extra overhead to your site, takes up space on your server, and requires frequent updates to keep the IP list relevant.

CloudGuard is different. Since we leverage Cloudflare's geolocation service, your server simply has to read the data, rather than compute and store it locally. Cloudflare does the grunt work, leaving your site safe, secure and optimized.

Note: This plugin requires that you have an account (either free or premium) on [Cloudflare](https://www.cloudflare.com) with [Geolocation](https://support.cloudflare.com/hc/en-us/articles/200168236-What-does-Cloudflare-IP-Geolocation-do-) enabled.

Has this free plugin helped you? Please consider [leaving a rating](https://wordpress.org/support/view/plugin-reviews/cloudguard?rate=5#postform) :)

== Installation ==

1. Go to the "Plugins > Add New" page in your WordPress dashboard.
2. Search for "CloudGuard" and click the install button.
3. Once installed, go to "Settings > CloudGuard" to complete the setup.

== Screenshots ==

1. Track login attempts from your dashboard.
2. Global view of login attempts.

== Changelog ==

= 1.4.0 =
* Option to redirect blocked countries to a URL. Props [@LGRIS](https://wordpress.org/support/topic/added-redirect-option/).

= 1.3.3 =
* Fix issue with new lower case geolocation country codes from Cloudflare.

= 1.3.1 =
* No longer requires Cloudflare plugin to operate.
* Update country list.
* Minor refactoring.

= 1.3 =
* Add your own custom message if someone is blocked.

= 1.2 =
* Add option to reset stats in dashboard widget.

= 1.1 =
* Track login attempts on a global map.

= 1.0 =
* Initial release!