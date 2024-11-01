=== Thumbnails Anywhere ===
Contributors: ninanet
Donate link: http://ninanet.com/dev_thumbnails-anywhere.php
Tags: thumbnails, shortcode, anywhere, sidebar, footer
Requires at least: 2.9.0
Tested up to: 3.1.2
Stable tag: 1.0

== Description ==

If you ever wanted to insert a (random) thumbnail of another post or a gallery of thumbnails anywhere in your post(s), page(s) or even in your sidebar or footer without the use of a bulky gallery plugin that might not be compatible with your theme or another plugin you installed, thumbnails anywhere is for you.

Thumbnails anywhere can be inserted literally anywhere in your content without having to edit the code. And because it uses shortcodes, no PHP plugin is necessary either. 
We packaged it with timthumb (http://code.google.com/p/timthumb/) to give you utmost control over the output. 

Knowledge is power :)


#### Functionality

Thumbnails anywhere can display post or page thumbnails (Featured Images) OR an image referenced in a post or page via a custom field.
If you want to use WordPress's built in thumbnails, make sure your theme supports thumbnails or manually add the following line to your theme's functions.php file:
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
}

If you want to use thumbnails anywhere in your sidebar and footer as well, please make sure that your theme's functions.php file contains the following line (if it doesn't, simply add it):
add_filter('widget_text', 'do_shortcode');


If you want to use an image referenced via a custom field, simply create a field named full_image_value and enter the RELATIVE URL to your image into the value field e.g. /path/to/you-image-file.jpg.
Absolute URLs can cause issues especially on WordPress installations hosted on hostgator.

Note: If you are using a WordPress MU (Network installation), you must use the custom field option as mod_rewrite will not translate the path to your post thumbnail at that stage.


Thumbnails anywhere works by interpreting WordPress shortcodes and shortcode attributes.
[randomimg] - triggers execution of the plugin 
If not other arguments are given, thumbnails anywhere will display 2 thumbnails from randomly selected posts.
Default output size of the images (if no argument are given) is 100x100 px.
PrettyPhoto argument already built-in, requires PrettyPhoto to work properly.

Arguments:
w (in pixels) - the desired width of the image
h (in pixels) - the desired height of the image
cat (ID of the category(ies); e.g. cat="3" or cat="3,5,7") - one more categories to select thumbnails from
post (ID of the post to extract the image from; e.g. post="70") - select image from one particular post
css (e.g. "padding:5px; border:1px solid #efefef") - add your personal styles to the output
showlink (e.g. showlink="1" to show the link) - show the title of the post and create a link to the post underneath the thumbnail image.
num (e.g. num="5") - the number of images to display

Examples:
[randomimg post="70" w="250" h="170" showlink="1" css="padding:10px; border:1px solid #efefef"]
Shows 1 image taken from the post with the ID 70, 250x170 pixels with a link to the post and a style of "padding:10px; border:1px solid #efefef" applied.

[randomimg cat="18,20,24" num="6" w="50" h="50" showlink="1"]
Shows 6 images from categories 18,20 and 24, 50x50 pixels and a link to each post the images belong to.


The shortcode can be used anywhere, even in a simple text widget for your sidebar or footer.



== Installation ==

Follow the steps below to install the plugin.

1. Upload the thumbnails-anywhere directory to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Insert the shortcode anywhere you want - including into a simple text widget in your sidebar or footer


== Screenshots ==

1. 2 images, 250x170 pixels, with link to posts

2. 6 images, 50x50 pixels, with link to posts


== Frequently Asked Questions ==

= What to do if you get an error message that the temporary file can not be created? =

Please make sure you uploaded the cache folder within the plugin folder and that the cache folder is writable by the web server.


= What's the difference between relative and absolute URL? =

The easy explanation (not 100% correct, but should suffice): 
An absolute URL looks like this: http://yourdomain.com/path/to/your-file
A relative URL looks like this: /path/to/your-file


= What to do if the images do not display? =

Please mke sure that your path to the image is correct and that the image can be accessed via its own URL.
Try accessing the image via the browser's address bar by copying its URL, e.g. http://yourdomain.com/path/to/your-image-file.jpg


== Upgrade Notice ==
= 1.0 =
Hostgator fix 
Order of items for MU install fixed


== Changelog ==

= 1.0 =
* Added width & height attributes in img tag

= 0.9 =
* Switched order of full_image_value and thumbnail to address issues with MU installs

= 0.8 =
* Added replace function to resolve hostgator issues


== Help ==

For help and support, please write to nina [at] ninanet.com
