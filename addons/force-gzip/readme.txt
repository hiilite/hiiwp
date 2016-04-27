=== Force gzip ===
Contributors: jshreve
Tags: server, compression, gzip
Requires at least: 2.0
Tested up to: 3.0
Stable tag: 2.2.9

Implements gzip output compression to speed up load times and does a check to see if browsers are incorrectly saying that they do not support GZIP when they actually do. 

== Description ==

This plugin implements gzip output compression to speed up load times.

The plugin also does a check to see if browsers are incorrectly saying that they do not support GZIP when they actually do. This can speed up load times for a significant portion of users.

`For requests with missing or mangled Accept-Encoding headers, inspect the User-Agent to identify browsers that should understand gzip.
* Test their ability to decompress gzip.
* If successful, send them gzipped content!`

See:

* http://www.stevesouders.com/blog/2010/07/12/velocity-forcing-gzip-compression/
* http://en.oreilly.com/velocity2010/public/schedule/detail/14334
* http://wpdevel.wordpress.com/2010/07/13/forcing-gzip-httpwww-stevesouders-co/

== Installation ==

* Upload the plugin folder to your blog
* Activate it.

You're done!

== Changelog ==

= 1.0.1 =

* Less aggressive with the cookie (uses a session cookie as Google does)
* Do not do a check if we find Accept-Encoding: identity.
* Match browser versions instead of just greater than (To catch IE6, etc)

= 1.0.0 =

* Initial Plugin
