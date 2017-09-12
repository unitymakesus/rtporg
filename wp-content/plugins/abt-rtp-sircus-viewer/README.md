[![Build Status](https://travis-ci.org/wp-cli/sample-plugin.png?branch=master)](https://travis-ci.org/wp-cli/sample-plugin)
AtlanticBT README
=================


Project Specifications
----------------------

This plugin implements the RTP.org SIRCUS (social media curation) viewer. This is an angular application for use
on the website's home page. It interacts with the SIRCUS web services to render the social media items.

Setting Up
-------------

Install the plugin...
	1. Upload files to the WordPress plugins directory.
	2. Login with your WordPress administrative login.
	3. Activate the plugin.
	4. Adjust settings via the SIRCUS Viewer Settings menu in the WordPress administrative dashboard.



Dependencies
------------

Currently the technological dependencies we are aware of are
* WordPress (3.8+)
* Angular-JS (2.1.4+) (included)



Additional Notes
----------------

Current settings as of 06/06/2014:

* Enable Caching
** Toggle to enable/disable caching. Caching is implemented using WordPress transients.

* Cache Lifetime (seconds)
** Number of seconds to cache results. For RTP.org, it's best to keep this
value low (i.e. 1 - 2 minutes max).

* SIRCUS List API Endpoint
** This is subject to being deprecated. For development purposes, I've included a setting to enter the
list endpoint within the SIRCUS API.
