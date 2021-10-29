### HEAD

### 1.0.0 (December 15, 2015)

### 1.0.1 (December 23, 2015)

### 1.0.2 (December 28, 2015)

### 1.0.3 (December 29, 2015)

### 1.0.4 (December 30, 2015)

### 1.0.5 (January 11, 2016)

### 1.0.6 (January 18, 2016)

### 1.0.7 (January 19, 2016)

### 1.0.8 (January 20, 2016)

### 1.0.9 (January 28, 2016)

### 1.0.10 (February 02, 2016)

### 1.1.0 (February 15, 2016)

### 1.2.0 (February 24, 2016)

### 1.2.1 (March 2, 2016)

### 1.2.2 (March 3, 2016)

### 1.2.3 (March 3, 2016)

### 1.2.4 (March 23, 2016)

### 1.2.5 (April 12, 2016)

### 1.2.6 (May 4, 2016)

### 1.2.7 (May 22, 2016)

### 1.2.8 (Jul 22, 2016)

### 1.2.9 (Aug 9, 2016)
- [#3](https://github.com/waqastudios/inti-foundation/pull/3) Removed stray PHP short tag in Inti Options, replaced with complete <?php. (@joffcrabtree)
- Removed PHP closing tags for anything likely to get include-d, a stray newline found in the process.
- Fixed Inti Options version of the font-awesome library after fixing the bower packagename in last version. Name and file location fixed, wasn't getting loaded before.
- Fixed incorrect description on one of the Inti Options page tab's callbacks

### 1.2.10 (Dec 10, 2016)
- Updated Foundation for Sites to 6.2.4
- Updated Font Awesome to 4.7.0
- Switched Off Canvas to right hand side by default

### 1.2.11 (Dec 12, 2016)
- Minor bug fixes

### 1.3.0 (Dec 21, 2016)
- Happy Holidays!
- Upgraded to Foundation for Sites 6.3.0, with support for new off-canvas
- Combined _off-canvas and _top-bar into _navigation.scss
- Added responsive-embed widget and shortcode

### 1.3.1 (Dec 26, 2016)
- Minor bug fixes

### 1.3.2 (Apr 11, 2017)
- Minor bug fixes

### 1.3.3 (Apr 15, 2017)
- Fixing FB comments showing up on loops they shouldn't be
- Fixed accrodion shortcode by adding data-accordion-item
- Updated Foundation for Sites to 6.3.1

### 1.3.4 (Apr 15, 2017)
- Fixed double title on single post navigation

### 1.3.5 (Jun 19, 2017)
- Improvements for translation
- Renaming Inti's Image widget to Image Link to better reflect what it does compared to WP 4.8s new Image widget
- Set up the theme support in theme options for Front Page template and for Breadcrumbs

### 1.4.0 (Jun 25, 2017)
- Zurb sticky added to navigation by default
- Customize option added for miniature logo to be used on small-screen navigation and sticky navigation (perfect for inti-kitchen-sink changes)

### 1.5.0 (July 12, 2017)
- Updated for Foundation 6.4.1
- All template files updated for XY Grid
- Completely reworked gulp file and build process
- Vendor files come from and are managed by npm

### 1.5.1 (July 28, 2017)
- [#5](https://github.com/waqastudios/inti-foundation/issues/5) Footer sidebar columns can now never be more than 12 columns
- FontAwesome issue in WPEditor for child themes fixed

### 1.5.2 (Aug 14, 2017)
- Less confusion on how front-page loops work, and a tweak to options to remove a fetching of the loop
- Limit footer widget columns to 4 columns – anything more and you can't see anything

### 1.5.3 (Aug 24, 2017)
- Bug fixes to unfinished code

### 1.5.4 (Oct 16, 2017)
- PHP 7.1 bug fix
- Page template bug fix

### 1.5.5 (Dec 13, 2017)
- Minor bug fix

### 1.6.0 (Apr 19, 2018)
- Updated Foundation for Sites to 6.4.3
- Transitioned from grid-padding to grid-margin layouts as per (https://github.com/zurb/foundation-sites/pull/10371)
- Added two social media link options

### 1.6.1 (Jun 1, 2018)
- Added basic tool for GDPR cookie compliance. Allows overall setting and removing of cookies by the visitor, for the site owner to categorize cookie-setting JS into one of three (or more) types and the visitor to allow/disallow each cookie category individually.

### 1.6.2 (Aug 24, 2018)
- Upgraded to FontAwesome 5
- Improve Vertical Tabs shortcode 

### 1.6.3 (Sep 7, 2018)
- Bug fixes

### 1.6.4 (Sep 11, 2018)
- Bug fixes

### 1.6.5 (Nov 12, 2018)
- Bug fixes

### 1.7.0 (Mar 13, 2019)
- Updated Foundation for Sites to 6.5.3
- Bug fixes for PHP 7.2
- Tweaks for image captions
- Fixed bug that changes focus on Cookie Manager link
- [#9](https://github.com/waqastudios/inti-foundation/pull/9) Fix npm gulp dependency, since there is no longer a 4.0 branch of gulpjs

### 1.8.0 (Dec 17, 2019)
- Bug fixes
- Removing G+

### 1.9.0 (Mar 10, 2020)
- Updated Foundation for Sites to 6.6.1

### 1.9.1 (Aug 16, 2020)
- Refactored old JS

### 1.10.0 (Apr 12, 2021)
- Moved archive headers into a function in /framework/content
- Moved inti_hook_inner_content_before() directly inside the content wrapper and inti_hook_inner_content_after() directly before the close because we don't want to inject any html inside a Foundation XY Grid opening in the hook inti_hook_grid_open()
- Added options for social sharing (Telegram)
- Added 'primary' class name to interted shortcodes… makes them longer, but preferable to have the class name there

### 1.10.1 (Oct 18, 2021)
- Minor updates

### 1.11.0 (Oct 29, 2021)
- Updated Foundation for Sites to 6.7.3