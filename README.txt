=== Phone Call Tracker ===
Contributors: RocketLift
Tags: tracking, phone, shortcode, google
Requires at least: 3.5
Tested up to: 4.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shortcode for rendering phone numbers in 'tel:' links, with Google Analyitcs tracking.

== Description ==

This plugin uses a simple settings page and shortcode to easily interface with an existing Google AdWords campaign. This allows you to record instances of a conversion that you've set up in your Google Adwords account.

== Installation ==

1. Install & activate the plugin through the \"Plugins\" menu in WordPress.
1. Add the `[phonenumber]` shortcode to your content.

= Configuration =

Go to the \"Settings > Phone Call Tracker\" menu.

To track clicks using Google Analytics
1. Choose \"Enable Google Code Output\"
1. Match the \"Conversion ID\", \"Conversion Label\", and the \"remarketing only\" settings to your Google AdWords configuration.
1. Click \"Save Settings\"

= Usage =

Wherever you want your phone number to be shown and clickable, insert this shortcode into your content:

`[phonenumber](555)-555-6789[/phonenumber]`

== Proposed Features ==

1. Create native WordPress (non-Google dependant) Call Tracking support
1. Allow for multiple AdWords Campaigns within one site
1. Store phone numbers in database to allow for easy repetition

== Changelog ==

= 0.2 =
* Misc. tweaks & fixes.

= 0.1 =
* Initial release.

