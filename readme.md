## Server Config

[Server Config](http://serverconfig.io/) is a project to help web developers use sensible server settings for web technologies. 

### Contributing

Given all the various web technologies and nuances in those technologies I have added this project to Github in the hopes to get the best info and the best settings for each technology. 

Note that this is not the full website. I have written the actual website in the php framework Laravel. However, the core functionality (currently) of Server Config does not need Laravel, so I did not want to hinder those without knowlegde of that particular framework from being discouraged from contributing. To that end, there is no need to make you setup a Laravel project to contribute to this repo.

I've tried to make it as easy as possible for anyone with HTML, jQuery, and Javascript knowledge to contribute. Fork this repo, download it to your machine and open /public/index.html in your web browser to test. All the functionality is in /public/js/serverConfig.js

Issues and Pull Requests are always welcome.

### Suggestions

- Add more important settings
- Add "best practices" settings
- Webservers to add
	- Nginx
- Languages to add
	- Python
	- Ruby
	- Node.js
- Datastores to add
	- MySQL Innodb
	- MongoDB
	- Postgres
- Add more OSes
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
