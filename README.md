# inti-foundation

[![GitHub version](https://badge.fury.io/gh/waqastudios%2Finti-foundation.svg)](https://badge.fury.io/gh/waqastudios%2Finti-foundation)

Inti Foundation is a WordPress parent theme that uses Foundation for Sites 6.6, the most advanced responsive front-end framework in the world. Foundation for Sites 6.6, unlike versions prior to 6.4, uses a flexbox based grid system called [XY Grid](https://get.foundation/sites/docs/xy-grid.html)

**As a theme** it is a starting point for you to build a WordPress/Foundation site from scratch.

**As a parent theme** it allows you to create unique child themes harnessing the functionality of the parent while still allowing you to upgrade the parent when new features are released.

**As a framework** it comes packed with tonnes of WordPress functionality baked-in and ready to expand upon, all neatly organized into easy to understand directories and files.

## Getting Started
### Gulp
Inti Foundation and its child themes come configured with a Gulp file that will compile your Sass and javascript changes for you with its watch function. (If your workflow doesn’t include Gulp, please review this file to see what library elements need to be compiled into a final CSS file with your own tools).

#### In a local environment with a web server, MySQL, PHP and Node:
 * Modify config.yml file for your setup, then run:
 * `npm install`
 * `gulp build`
 * `gulp default`, a new browser window will open pointing to a BrowserSync server displaying the WordPress installation (via BrowserSync).

### In a Docker environment:
Consider using this sample docker environment: [Inti-Foundation-Docker-Environment](https://github.com/waqastudios/inti-foundation-docker-environment)
 * Follow the instructions in the readme file
 * If you'll be editing the parent theme directly, change the theme name in docker-compose.yml and the volume mounts in the node: service

> The best way to customize Inti Foundation is to create a child theme. Consider doing that before making edits to the parent theme.

### Activating
Inti Foundation (and a child theme) should be uploaded to wp-content/themes and activated via the WordPress Dashboard.

On visiting the site with the new theme activated, you'll see the homepage is not displaying any content and that no menu is displayed. We need to run through an intial configuration to begin using the theme.

## Initial Settings
### Front Page and Blog Index
Most sites require a Home Page and a Blog Index page. In the WordPress Dashboard, publish a page called ‘Home’ and another called ‘Blog’. In Settings->Reading in the WordPress Dashboard, set ‘Home’ as the front page and ‘Blog’ as the blog page.

The theme has a template for the home page which contains two elements, 
- The content from the page set as ‘Home’
- A loop of posts underneath

This loop has been placed here as an example of how to add more custom elements to the front page. A theme options page has been added so that this element can be configured. Additional elements can be added in the same way.

> An example child theme has been created that expands on this idea. Numerous 'front page blocks' has been added with accompanying post types, metaboxes, taxonomies, widgetsa and shortcodes – all configured through the WordPress Customizer. [View the inti-kitchen-sink theme on GitHub](https://github.com/waqastudios/inti-kitchen-sink)

> If you use Advanced Custom Fields Pro you'll be looking for this child theme. [View the inti-acf-starter theme on GitHub](https://github.com/waqastudios/inti-acf-starter)

### Options
The theme can be configured, and more options can be added as you develop your own theme, with either an Options page or with Customizer in live preview mode. Both methods have been added by default in Inti Foundation so that you can choose which you'd prefer to you for your own options. By default, options that are more to do with global settings have been added to an Options page called "Inti Options" and options that are more to do with visual elements have been added in Customizer. Feel free to modify these as you see fit.

Have a look around and set the options activate elements in the theme. Perhaps the most important area is found in the Customizer and relates to the header area.

### Header / 'Site Banner'
In Inti Foundation we call the header area is made up of two parts. The menu and the 'site banner'. The site banner is a wrapper that is home to a number of elements that can be turned on and off, or customized in the Customizer. Upload a logo, turn on and off the site name and description, etc.

> The inti-kitchen-sink child theme expands on this with a number of template parts that contain variations of the header with different or additional elements or changes in position. Coupled with the numerous hooks before, after and inside each element wrapper, it's easy to change one of the most important parts of the site.

### Menus
The menu will appear in the theme when a menu is created and added to one of the three menu areas that exist by default in the theme. These are the main menu, the mobile menu (which is usually just the same menu) and the footer menu (which is usually single-level)

### Functionality switches
Each part of the theme, from default post types, to menu areas, to template files, to minor functions like the breadcrumps can be switched on and off with WordPress's `add_theme_support()` in functions.php

## Documentation
Slowly but surely more complete documentation is being set up at [here](http://inti.waqastudios.com).

## Contributing
Please do leave comments, post new issues and make pull requests. Any form of contribution is welcome. 
You can also get in touch here: _stuart (at) waqastudios.com_