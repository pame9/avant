=== Flickrpress ===
Donate link: http://michael.tyson.id.au/wordpress/plugins/flickrpress/
Tags: flickr
Requires at least: 2.6
Tested up to: 2.9.1
Stable tag: 1.0.2
Display Flickr items in the sidebar, or within pages and posts.
== Description ==
This is a widget to display items from Flickr in the sidebar or within pages and posts.  This widget supports:
 * Flickr RSS feeds
 * Photostream
 * Filtering by tag
 * One or more photosets
 * Favorites
 * Displaying random items
Other features:
 * Choose from three different thumbnail types
 * Lightbox/Thickbox are supported
 * Data is cached locally to lower server load
 * Secure Flickr API used, to eliminate the risk of damage to your server, unlike some other Flickr widgets
 * Flickrpress is a multi-widget, so you can use more than one instance (e.g., one in your sidebar, one in your footer)
 * Use as a shortcode to insert into posts and pages -- multiple instances supported in the one entry
Flickrpress uses the excellent phpFlickr library.
== Installation ==
1. Unzip the package, and upload `flickrpress` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add the 'Flickr Widget' to your sidebar and configure, or see the 'Shortcodes' section for information on use in pages and posts
If you wish to use content from anything but an RSS feed, you will need a Flickr API key.  This can be obtained
from [Flickr](http://www.flickr.com/services/api/keys/apply)
If you wish to use Lightbox, you must first install the [Lightbox plugin](http://stimuli.ca/lightbox/).
== Shortcode ==
Shortcodes are snippets of text that can be inserted into pages and posts.  These snippets are replaced by various generated content.
Flickrpress provides a 'flickrpress' shortcode to display images from Flickr within a page/post.
Available parameters:
      type        One of: 'rss', 'photostream', 'sets', 'favorites'
      url         URL for RSS feed
      api_key     API Key for types other than RSS
      account     Account name, email or ID
      sets        Comma-separated list of photoset titles
      tags        Comma-separated list of tags to filter by (for photostream view)
      view        One of: 'squares' (view as squares), 'proportional' (proportional thumbnails) , 'large' (large thumbnails)
      count       Number of thumbnails to display
      paging      'true' to show page navigation, to move back and forward through pages of images (implemented using AJAX)
      random      'true' to display randomly
      lightbox    'true' to use Lightbox
      columns     Number of columns of images to display
Example:
      [flickrpress type="photostream" api_key="xxxxxxxxxxxxxxxxxxxxxx" account="michaeltyson" count="30" paging="true" lightbox="true"]
== Styling ==
Flickrpress comes with CSS styling, but if you wish to modify its appearance, such as adding frame borders, simply style the
"`flickrpress-container`" class.  See `style.css` for more.
== Changelog ==
= 1.0.2 =
 * Added Thickbox support
 * Compatibility fix for PHP 4
= 1.0.1 =
 * Bugfix in navigation javascript encountered when Lightbox isn't installed
= 1.0 =
 * Implemented AJAX-based navigation through pages of images
 * Added shortcode documentation
 * Caching for shortcode and php calls
 * Removed 'css' option in favour of always including CSS
 * Fixed conflict between shortcode and widget versions
 * Fixed bug in loading all photostream items
= 0.3.2 =
 * Fixed a warning when using shortcode
= 0.3.1 =
 * Fixed a packaging snafu
= 0.3 =
 * Support for use outside of sidebar
= 0.2.1 =
 * Bugfix for displaying random favourites
= 0.2 =
 * Now able to be styled as described in http://www.webdesignerwall.com/tutorials/css-decorative-gallery/. See style.css for more info.
= 0.1.1 =
 * Bugfix for when only 1 random image shown
= 0.1 =
 * Initial release
== Upgrade Notice ==
= 1.0.2 =
Introduces support for Thickbox and fixes issues for users using PHP 4
= 1.0.1 =
If you are using Flickrpress without Lightbox installed, you should install this update, which fixes a Javascript bug caused by the absence of Lightbox
= 1.0 =
Version 1.0 is a significant release, and introduces navigation through pages of images, as well as better shortcode support and numerous bugfixes.
== Screenshots ==
1. Photoset configuration
2. Flickr RSS feed configuration
3. Plugin display
4. Plugin display with custom styling
