=== Plugin Name ====
Contributors: Pratik Tambekar
Donate link: https://ensivosolutions.com
Tags: Like, Dislike, Post Like, Post Dislike, Post Like/Dislike
Requires at least: 4.6
Tested up to: 4.9.8
Stable tag: 4.3
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin is use to like/dislike for post. after successfully activation of the plugin WPLD Settings will be activated at admin side where you can change label of like and dislike (for ex: instead of like suppose you want I loved it so you can change it from admin panel) on click of like it increases count by one and on click of dislike it removes like count. after liking it it shows like count message
== Installation ==
This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


== Frequently Asked Questions ==

1)	How to change the label of like and dislike?
2)	Can I able to install it on lowest verion of wordpress?
       
== An answer to that question. ==
Ans: Go to at admin panel activate plugin after activation WPLD-Settings will be generated click on it and change the label
Ans: Yes, Requires at least: 4.6



= What about foo bar? =
PHP
wordpress
mysql

== Screenshots ==
1)	Screenshot1.png
This screen shot is regarding to change the label of like and dislike it will be reflected at frontend
/assets/img/screenshot1.png
2)	Screentshot2.png
This screen shot is regarding the like and dislike button at front end side
/assets/img/screenshot2.png
3)	Screenshot3.png
This screen shot is regarding backend entry after click on like button like count become 1 for that particular user and post and same for dislike (on click of dislike it removes the entry of like from database suppose first you like then like count become 1 but now your mood change and you want to dislike the post then clicking dislike it removes the like count from the table and added the dislike count 1 and like count become 0
/assets/img/screenshot3.png


== Changelog ==

= 1.0 =
	 Change in the size of like and dislike button
	on hover change the button color
	on dislike button like count delete
	added the setting panel at admin side for to change the label of buttons
== Upgrade Notice ==

= 1.0 =
To change the look and feel of the buttons it would more attractive 
Unauthenticated user unable to access it.
== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1.	Button label change facility
2.	Unlike button facility
3.	Like count show facility
4.	One user can like only one time not more than one
5.	Unauthenticated user can’t use it

 Something else about the plugin
Plugin is fully bug free and open source to all now everywhere we require like/dislike button for keeping this thing in mind we developed this plugin

Unordered list:

* screenshot
* ajax
* css
* javascript

* https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/
* https://wordpress.org/support/welcome/
* https://wordpress.org/plugins/simple-tags/



`<?php code(); // goes in backticks ?>`
