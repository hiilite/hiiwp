# Hiilite Wordpress AMP theme

This is the first complete WordPress theme that can run fully in [Google's AMP framework](https://www.ampproject.org/). This theme is currently in Alpha testing and should not be installed without the support of the team at [Hiilite Creative Group](https://hiilite.com)

AMP is a way to build web pages for static content that render fast. AMP in action consists of three different parts:
- [AMP HTML](https://www.ampproject.org/docs/get_started/about-amp.html#amp-html)
- [AMP JS](https://www.ampproject.org/docs/get_started/about-amp.html#amp-js)
- [Google AMP Cache](https://www.ampproject.org/docs/get_started/about-amp.html#google-amp-cache)

AMP HTML is HTML with some restrictions for reliable performance and some extensions for building rich content beyond basic HTML. The AMP JS library ensures the fast rendering of AMP HTML pages. The Google AMP Cache (optionally) delivers the AMP HTML pages.

The Hiilite AMP theme also employs the latest in [Structured Data Markup](https://developers.google.com/structured-data/), with an easy to use interface for providing Google with all the information it needs to so show all your business information right in Google's search results page. 

## No Thirdparty Plugins
Because of how strict AMP is, any plugin that requires Javascript or CSS to load to the front-end will inherently not function, as no scripts are added to the WordPress queue when in AMP mode. You can however run font-end plugins within an iframe, allowing you to still run complex sliders and forms, though it should be avoided.
Form elements are also prohibited within AMP pages, but can also be loaded with an iframe. And all iframes must be at least 75% below the top of the screen on load, or the content simply will not be loaded.
To make this as easy as possible, any row within a page can be set to load its contents within an iframe. So you can put all your forms and other complex widgets into a single row that will load within the page content as an iframe.

Experiment with third-party plugins at your own risk. Generally any plugin that is just meant to modify the WordPress backend are fine.

Avoid SEO based plugins. The AMP theme is structured in such a way to be perfectly compliant with Google's new AMP tracking and Structured Data Markup, and other third-party SEO plugins can cause errors in the data that Google is getting, or create unnecessary duplicate data.

## How to Begin
### Step 1: Your Company Profile
This is where you can fill out all your company info that can then be distributed across the site and used as Structured Date in Google's SERP. Each field also has a shortcode attributed to it for easy distribution throughout your site content, such as using the shortcode \[business_phone\] to display the phone number. For a complete list of the shortcodes, see the "Help" tab on the Company Profile page.

## Change log
### v0.1.16
- Added Canonical field to blog posts
- Updated grid to support Safari flex

### v0.1.15
- Updated to Restaurant menu posts, changed layout to table based and grouped Addons

### v0.1.14
- Created new horizontal portfolio layout system
- Added portfolio isolation options to post
- Changed portfolio Medium to Work

### v0.1.13
- Added cmd2 to manage meta boxes
- Added Hiilite dashboard and branding
- Fixed media uploader in Company Profile
- Laying foundation for App framework

### v0.1.12
- Added blog layout customization
- Fixes to Open Graph data and social sharing

### v0.1.11
- Added Menu post type
- Added post and taxonomy reordering
- Added taxonomy images

### v0.1.10
- Added Social Share widget/shortcode with dynamic meta data
- Added deeper restaurant based snippet data
- Added Facebook Instant Article compatibility to blog
- Added Favicon to customizer

### v0.1.9
- Added SEO title and description editors for pages
- Added basic OpenGraph protocols to all pages

### v0.1.8
- Numerous bug fixes
- Adjustments to rich-snippet data for portfolio and blog articles
- Added Hiilite footer
- Change default headings for team and portfolio pages
- Added content-box class to title areas

### v0.1.7
- Added Team Member post type and template

### v0.1.6
- Fixed header_border_top color issues
- Fixed row iframes to allow popups

### v0.1.5
- Added Portfolio post type and templates
- Added hours and potentialAction scheme to business profile options