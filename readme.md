## Server Config

[Server Config](http://serverconfig.io/) is a project to help web developers use sensible server settings for web technologies. 

### Contributing

Given all the various web technologies and nuances in those technologies I have added this project to Github in the hopes to get the best info and the best settings for each technology. 

Although this uses the Laravel Framework, you can fork and use with no knowledge of Laravel by following the steps below

1. Clone the repo to your local machine
2. Setup MAMP/WAMP/other to point to the /public folder
3. Rename /.env.example as /.env.php
4. Make sure /app/storage is writable by your webserver (you may not have to do anything)

(no database is needed at this point)

That's it.

The HTML of the site is in /app/views/home.blade.php

All the data and functionality is in /public/js/serverConfig.js

Issues and Pull Requests are always welcome.

### Suggestions

- Add more important settings
- Add "best practices" settings
- Webservers to add
	- IIS
- Datastores to add
	- MongoDB
	- Postgres
	- MSSQL
- Add OSes
	- Change configuration file locations for each OS
- Add better defaults for CMSes
	- Wordpress
	- Drupal
- Add caches (I'm not sure how to calculate the memory impact of these...)
	- Memcache
	- Varnish
- Advanced Calculator
	- Allow users to change individual values and recommend a server size
- Let users separate the technologies to different servers
- Downloadable script to change the settings on a server (https)
- Look into using APIs to generate servers based on values in the calculator
	- Digital Ocean
	- Linode
	- Google Cloud
	- AWS
