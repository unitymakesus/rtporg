AtlanticBT README
=================


Project Specifications
----------------------

This is a wordpress plugin which provides a back-end interface for attaching Location post types to a MapBox feature. And a front end shortcode to display a mixture of MapBox and Location type data.

Setting Up
-------------
You will need to enable this plugin in the admin panel. It does not have configurations of its own.

You will need to set up a custom post type through the Types plugin called *location*

The app can be modified by setting theme option values:
* *abt_mapbox_api_domain*: should be MapBox API domain eg: `http://api.tiles.mapbox.com/v4`
* *abt_mapbox_api_token*: should be the MapBox account's API token (public or private)
* *abt_mapbox_map_id*: should be the MapBox account's Map ID to be used

When displaying the shortcode on the front end, the plugin requires a custom page template which invokes `get_header('abt-mapbox');` so that the angularJS tags can be added to the <html> tag before shortcode rendering. Otherwise the page will fail to load.

Dependencies
------------
* wordpress 3.9
* angularjs
* Types plugin
* Theme Options plugin
* MapBox account


Dev Dependencies
----------------
* Gulp  [http://gulpjs.com/](http://gulpjs.com)


How To Update
-------------

The plugin relies heavily on Javascript for functionality of the frontend map application. We're using Gulp to concatenate and minify scripts, this means ...

 - If you are modifying existing Javascript files, you need to run gulp from within the plugin directory
 - If you are adding or deleting existing Javascript files, you need to update the gulp file (gulpfile.js) and possibly the package.json (npm package list) if you need other modules.

To run Gulp, open a terminal on your machine (command line), cd to this directory (~/wp-content/plugins/abt-mapbox), run the command: `gulp`

When you run gulp, it will use files in the abt-mapbox/js/src directory as the source, and will output the processed assets into the abt-mapbox/js/dist directory.

Be sure to commit the changed dist files, those are what get served up.