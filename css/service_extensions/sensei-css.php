<?php if(false): ?><style><?php endif; ?>
/*
Theme Name: Learn
Theme URI: http://demo.vegatheme.com/learn
Author: OceanThemes Team
Author URI: http://vegatheme.com
Description: In 2014, our default theme lets you create a responsive magazine website with a sleek, modern design. Feature your favorite homepage content in either a grid or a slider. Use the three .widget_tag_cloud li areas to customize your website, and change your content's layout with a full-width page template and a contributor page to show off your authors. Creating a magazine website with WordPress has never been easier.
Version: 1.0.8
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: black, green, white, light, dark, two-columns, three-columns, left-sidebar, right-sidebar, fixed-layout, responsive-layout, custom-background, custom-header, custom-menu, editor-style, featured-images, flexible-header, full-width-template, microformats, post-formats, rtl-language-support, sticky-post, theme-options, translation-ready, accessibility-ready
Text Domain: learn

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/
/* CSS STRUCTURE:

  1. SITE STRUCTURE and TYPOGRAPHY
  2. PAGES AND CONTENT
  3. FORMS
  4. COMMON
  5. MEDIA QUERIES
  - - - - - - - - -
*/
.subscribe {
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.4);
}
.subscribe h1 {
  font-size: 46px;
  margin-top: 45px;
}
#main_content h2,
#main_content_gray h2 {
  text-transform: uppercase;
  font-weight: 400;
  font-size: 36px;
  margin-top: 0;
}

.sub-header-features h1,
.sub-header-features-2 h1 {
  text-transform: uppercase;
  font-weight: 400;
  font-size: 72px;
  margin: 20px 0 0 0;
  padding: 0;
}
.sub-header-features h2,
.sub-header-features-2 h2 {
  font-size: 20px;
  font-weight: 700;
}
#main_content h2.plan-title {
  font-size: 18px;
  font-weight: 600;
}
#sub-header-features p {
  font-size: 15px;
  color: #75807d;
  font-weight: 600;
}
.sub-header-features-2 p {
  font-size: 15px;
  font-weight: 600;
}
#sub-header-features p strong,
#sub-header-features ul li strong {
  color: #5b6462;
}
#sub-header-features ul {
  font-size: 14px;
  color: #fff;
  font-weight: 600;
  list-style: none;
  padding: 0;
  margin: 0;
  margin-bottom: 20px;
}
#sub-header-features p strong,
.sub-header-features-2 p strong {
  color: #fff;
}
#testimonials h2 {
  text-transform: uppercase;
  color: #fff;
  font-size: 60px;
  font-weight: normal;
  letter-spacing: 5px;
}
#main-features h2,
#main-features_green h2 {
  text-transform: uppercase;
  color: #fff;
  font-size: 48px;
  font-weight: normal;
  letter-spacing: 5px;
  margin-top: 0;
  padding-top: 0;
}
#main-features p.lead {
  font-size: 18px;
}
#main_content_gray p.lead {
  font-size: 18px;
}
.feature h3 {
  font-size: 18px;
  font-weight: 700;
}
.light.feature h3 {
  color: #fff;
}
.feature p {
  font-weight: 600;
  color: #888;
}
.light.feature p {
  color: #8c8c8c;
}
.question_box h3 {
  font-size: 18px;
  text-align: left;
  line-height: 22px;
  margin-bottom: 10px;
}
#main-contact h3 {
  margin-top: 0;
  padding-top: 0;
}
.box-wp h3 {
  font-size: 36px;
  font-weight: 400;
}
.box-wp p.lead {
  font-weight: 600;
}
footer h3 {
  font-size: 30px;
}
#nav-footer h4 {
  text-transform: uppercase;
  font-size: 18px;
}
ul.latest_news h5 {
  margin: 0 0 0 25px;
  padding: 0;
}

/* Buttons */
a.button_top {
  border: none;
  margin-top: 5px;
  background: #292929;
  color: #fff;
  font-size: 11px;
  padding: 5px 16px 2px 16px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  cursor: pointer;
  outline: none;
  font-weight: 700;
  text-transform: uppercase;
  -webkit-font-smoothing: antialiased;
}
a.button_top#apply {
  border: none;
  margin-top: 5px;
  background: #F66;
}
a.button_top:hover {
  background: #30d9a4;
  color: #fff;
}
a.button_medium,
.button_medium,
.comment-respond .submit {
  border: none;
  background: #30d9a4;
  color: #fff;
  padding: 7px 12px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  cursor: pointer;
  outline: none;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 20px;
  -webkit-font-smoothing: antialiased;
}
a.button_medium:hover,
.button_medium:hover,
.comment-respond .submit:hover {
  background: #262c2d;
}
a.button_subscribe,
.button_subscribe {
  border: none;
  background: #ffd200;
  color: #fff;
  padding: 12px 20px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  cursor: pointer;
  outline: none;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 20px;
  -webkit-font-smoothing: antialiased;
}
a.button_subscribe:hover,
.button_subscribe:hover {
  background: #262c2d;
}
a.button_subscribe_green,
.button_subscribe_green {
  border: none;
  background: #30d9a4;
  color: #fff;
  padding: 12px 20px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  cursor: pointer;
  outline: none;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 20px;
  -webkit-font-smoothing: antialiased;
}
a.button_subscribe_green:hover,
.button_subscribe_green:hover {
  background: #262c2d;
}
a.button_medium_outline,
.button_medium_outline {
  border: none;
  background: none;
  color: #1dd7b2;
  border: 2px solid #1dd7b2;
  padding: 5px 10px;
  text-decoration: none;
  transition: .5s ease;
  -moz-transition: .5s ease;
  -webkit-transition: .5s ease;
  -o-transition: .5s ease;
  display: inline-block;
  cursor: pointer;
  outline: none;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 20px;
  -webkit-font-smoothing: antialiased;
}
a.button_medium_outline:hover,
.button_medium_outline:hover {
  color: #262c2d;
  border: 2px solid #262c2d;
}
a.button_big,
.button_big {
  border: none;
  background: #30d9a4;
  color: #fff;
  font-size: 30px;
  line-height: 32px;
  padding: 20px 50px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  cursor: pointer;
  outline: none;
  font-weight: 800;
  text-transform: uppercase;
  -webkit-font-smoothing: antialiased;
}
a.button_big:hover,
.button_big:hover {
  background: #262c2d;
}
.button_red_small,
a.button_red_small {
  border: none;
  background: #ff6666;
  color: #fff;
  outline: none;
  padding: 2px 8px;
  margin-bottom: 15px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  cursor: pointer;
  font-weight: 700;
  font-size: 11px;
  -webkit-font-smoothing: antialiased;
}
.button_red_small:hover,
a.button_red_small:hover {
  background: #262c2d;
}
a.button_fullwidth,
.button_fullwidth {
  border: none;
  background: #30d9a4;
  color: #fff;
  outline: none;
  padding: 7px 12px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: block;
  width: 100%;
  cursor: pointer;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 5px;
  text-align: center;
  -webkit-font-smoothing: antialiased;
}
a.button_fullwidth:hover,
.button_fullwidth:hover {
  background: #262c2d;
}
a.button_fullwidth-2,
.button_fullwidth-2 {
  border: none;
  background: #eafbf6;
  color: #333;
  outline: none;
  text-align: center;
  padding: 7px 12px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: block;
  width: 100%;
  cursor: pointer;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 5px;
  -webkit-font-smoothing: antialiased;
}
a.button_fullwidth-2:hover,
.button_fullwidth-2:hover {
  background: #262c2d;
  color: #fff;
}
a.button_fullwidth-3,
.button_fullwidth-3 {
  border: none;
  background: #eafbf6;
  color: #333;
  outline: none;
  text-align: center;
  padding: 15px 12px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  font-size: 16px;
  display: block;
  width: 100%;
  cursor: pointer;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 15px;
  -webkit-font-smoothing: antialiased;
}
.cart .single_add_to_cart_button {
  border: 5px solid #fbfbfc;
  box-shadow: inset 0 0 0 1px #e0e5e9;
}
a.button_fullwidth-3:hover,
.button_fullwidth-3:hover {
  background: #262c2d;
  color: #fff;
}
.button_outline,
a.button_outline {
  border: 2px solid #1dd7b2;
  background: none;
  color: #1dd7b2;
  padding: 13px 24px 13px 24px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  cursor: pointer;
  font-weight: 600;
  font-size: 16px;
  text-transform: uppercase;
  -webkit-font-smoothing: antialiased;
  outline: none;
}
.button_outline:hover,
a.button_outline:hover {
  background: #1dd7b2;
  color: #fff;
}
.btn-filter {
  border: none;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background: #09C;
  text-transform: uppercase;
  color: #fff;
  outline: none;
  padding: 2px 8px 0 8px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  cursor: pointer;
  font-weight: 600;
  font-size: 11px;
  -webkit-font-smoothing: antialiased;
}
.btn-filter:hover {
  background: #262c2d;
}
/** Wizard Buttons **/
.backward,
.forward {
  border: none;
  color: #fff;
  padding: 7px 20px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  cursor: pointer;
  font-weight: 600;
  text-transform: uppercase;
  outline: none;
  background: #282828;
  position: relative;
}
.backward {
  padding: 7px 20px 7px 30px;
}
button[disabled].backward,
button[disabled].forward {
  border: none;
  background: #ccc;
  outline: none;
}
.backward:before {
  content: "\f053";
  font-family: FontAwesome;
  text-decoration: inherit;
  position: absolute;
  font-weight: normal;
  top: 8px;
  left: 20px;
  text-transform: none;
  font-size: 9px;
}
.forward {
  padding: 7px 30px 7px 20px;
}
.forward:before {
  content: "\f054";
  font-family: FontAwesome;
  text-decoration: inherit;
  position: absolute;
  font-weight: normal;
  top: 8px;
  right: 20px;
  text-transform: none;
  font-size: 9px;
}
.backward:hover,
.forward:hover {
  background: #00aeef;
  color: #fff;
}
/*============================================================================================*/
/* 2.  PAGES AND CONTENT */
/*============================================================================================*/
/* #home ========== */
.bannercontainer {
  width: 100%;
  position: relative;
  padding: 0;
}
.divider_top_black {
  background: url(images/top_divider_black.png) repeat-x center bottom;
  width: 100%;
  height: 37px;
  position: absolute;
  top: -30px;
  left: 0;
  z-index: 2;
}
.divider_top_green {
  background: url(images/top_divider_green.png) repeat-x center bottom;
  width: 100%;
  height: 37px;
  position: absolute;
  top: -30px;
  left: 0;
  z-index: 999;
}
.feature {
  padding-left: 95px;
  position: relative;
}
.feature i {
  position: absolute;
  top: 0;
  left: 0;
  padding: 0;
  margin: 0;
  width: 65px;
  height: 65px;
  line-height: 60px;
  text-align: center;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  border: 2px solid #000;
  font-size: 26px;
  color: #1abc9c;
}
.light.feature i {
  border-color: #fff;
}
#main-features_green .feature i {
  position: absolute;
  top: 0;
  left: 0;
  padding: 0;
  margin: 0;
  width: 65px;
  height: 65px;
  line-height: 60px;
  text-align: center;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  border: 2px solid #fff;
  font-size: 26px;
  color: #fff;
}
#testimonials {
  background: #1abc9c url(images/users_bg.jpg) repeat 0 0;
  padding: 60px 0;
  color: #fff;
}
.container_count {
  width: 60px;
  display: inline-block;
  margin-right: 5px;
  text-align: center;
}
.container_count.last {
  margin-right: 0;
}
#countdown_wp {
  text-align: center;
  margin: 30px 0 20px 0;
}
#days,
#hours,
#minutes,
#seconds {
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  border: 1px solid #fff;
  text-align: center;
  width: 60px;
  height: 60px;
  font-size: 24px;
  line-height: 56px;
  font-family: "Helvetica Neue", Arial, sans-serif;
  font-weight: 300;
}
/*LATEST COURSES*/
.cat_row {
  background: #f8f8f8;
  padding: 7px 7px 5px 7px;
  font-size: 12px;
  font-weight: 600;
  overflow: hidden;
}
.cat_row .pull-right {
  color: #999;
}
.cat_row i {
  font-size: 14px;
  margin-left: 5px;
  margin-right: 2px;
}
.cat_row a:hover {
  text-decoration: none;
}
.ribbon_course {
  position: absolute;
  left: -5px;
  top: -5px;
  display: block;
  width: 99px;
  height: 97px;
  background: url(images/ribbon.png) no-repeat;
}
.col-item {
  border: 1px solid #ededed;
  background: #FFF;
  margin-bottom: 25px;
  position: relative;
}
.col-item .photo img {
  margin: 0 auto;
  width: 100%;
}
.col-item .info {
  padding: 10px;
  border-radius: 0 0 5px 5px;
  margin-top: 1px;
}
.col-item .course_info {
  /*width: 50%;*/
  float: left;
  margin-top: 5px;
}
.col-item .course_info h4 {
  line-height: 20px;
  margin: 0 0 10px 0;
}
.course_info p {
  font-size: 13px;
  line-height: 18px;
}

.col-item .photo {
    position: relative;
    padding-top: 60%;
    overflow: hidden;
}
.col-item .photo img{
    position: absolute;
    top: 0;
}
.col-item .info .rating {
  color: #1777;
}
.col-item .rating {
  float: left;
  font-size: 17px;
  text-align: left;
  margin-bottom: 20px;
}
.col-item .separator {
  border-top: 1px solid #ededed;
}
.col-item .separator p {
  line-height: 20px;
  margin-bottom: 0;
  margin-top: 10px;
  text-align: center;
  margin-right: 5px;
}
.col-item .btn-add {
  width: 50%;
  float: left;
}
.col-item .btn-add {
  border-right: 1px solid #ededed;
}
.col-item .btn-details {
  width: 45%;
  float: left;
  padding-left: 10px;
}

/* #about us ======== */

.project-item-image-container {
  border: none;
  cursor: pointer;
  height: 100%;
  position: relative;
  width: 100%;
}
.project-item-image-container:hover,
.project-item :hover .project-item-image-container {
  filter: alpha(opacity=100);
  -moz-transition: background-color 0.2s ease-out, color 0.1s ease-out;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  opacity: 1;
  -o-transition: background-color 0.2s ease-out, color 0.1s ease-out;
  transition: background-color 0.2s ease-out, color 0.1s ease-out;
  -webkit-transition: background-color 0.2s ease-out, color 0.1s ease-out;
}
.project-item-image-container > img {
  width: 100%!important;
}
.phone-info {
  display: inline-block;
  margin: 5px 0px 0 0;
  width: 100%;
  text-align: center;
}
ul.social-bookmarks.team {
  float: none;
  margin: 0;
  padding: 0;
  margin: auto;
  display: inline-block;
}
.question_box {
  padding-left: 40px;
  position: relative;
  margin-bottom: 30px;
}
.question_box:before {
  content: "\ec7e";
  font-family: 'fontello';
  font-style: normal;
  font-weight: normal;
  text-decoration: inherit;
  font-size: 30px;
  position: absolute;
  color: #999;
  top: 5px;
  left: 0;
}
/* #course grid page
================================================ */
ul.submenu-col,
.widget_sensei_course_categories ul {
  list-style: none;
  margin: 0;
  padding: 0;
  font-weight: 600;
  font-size: 14px;
}
ul.submenu-col li a,
.widget_sensei_course_categories li a {
  text-decoration: none;
  padding: 4px 10px;
  display: block;
  margin-bottom: 3px;
}
.widget_sensei_course_categories li.current-cat a,
.widget_sensei_course_categories li.current-cat a:hover {
  background: #0cbdaa url(images/arrow.png) no-repeat 96% center;
  color: #fff;
}
ul.submenu-col li a:hover,
.widget_sensei_course_categories li a:hover {
  background: #efefef;
  color: #111;
}
.filterable .panel-heading .pull-right {
  margin-top: -20px;
}
.filterable .filters input[disabled] {
  background-color: transparent;
  border: none;
  cursor: auto;
  box-shadow: none;
  padding: 0;
  height: auto;
  margin: 0;
  font-weight: 600;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
  color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
  color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
  color: #333;
}
.panel-info {
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
}
/* #login and register
================================================ */
#login_bg {
  background: #0cbdaa url(images/bg_sub-header.png) repeat 0 0;
  padding: 100px 0;
}
#wizard_bg {
  background: #0cbdaa url(images/bg_sub-header.png) repeat 0 0;
  padding: 60px 0;
}
#login {
  background-color: #fff;
  -moz-box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
  -webkit-box-shadow: 0 0 5 rgba(0, 0, 0, 0.4);
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
  padding: 30px;
}
/* #lwizard apply */
#top-wizard {
  text-align: center;
  padding: 15px 120px;
  background-color: #f3f3f3;
  border-bottom: 1px solid #e7e7e7;
  position: relative;
  text-transform: uppercase;
  font-size: 11px;
}
.ui-widget-content {
  background: #fff;
  color: #222222;
}
.ui-widget-content a {
  color: #222222;
}
.ui-widget-header {
  background: #f68e56;
}
.ui-widget-header a {
  color: #222222;
}
.ui-progressbar {
  height: 2em;
  text-align: left;
}
.ui-progressbar .ui-progressbar-value {
  margin: -1px;
  height: 100%;
}
#survey_container {
  background-color: #fff;
  -moz-box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
  -webkit-box-shadow: 0 0 5 rgba(0, 0, 0, 0.4);
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
  margin-top: 0px;
}
.ie8 #survey_container {
  background-color: #fff;
  border: 1px solid #ddd;
  margin-top: 60px;
  margin-bottom: 60px;
}
#middle-wizard {
  padding: 50px 125px 35px 125px;
}
#middle-wizard h3 {
  padding-top: 0;
  margin-top: 0;
}
#bottom-wizard {
  text-align: center;
  padding: 15px 120px;
  border-top: 1px solid #e7e7e7;
  background-color: #f3f3f3;
}
#complete {
  text-align: center;
  padding: 0 45px 35px 45px;
}
#complete h3 {
  text-align: center;
  margin-bottom: 40px;
}
#complete i {
  color: #cacaca;
  margin: 0 0 10px 0;
  font-size: 160px;
  padding: 0;
}
#complete button {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  font-size: 18px;
  border: 2px solid  #8dc63f;
  color: #8dc63f;
  padding: 15px 35px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  display: inline-block;
  cursor: pointer;
  font-weight: 600;
  text-transform: uppercase;
  outline: none;
  background: #fff;
}
#complete button:hover {
  background: #00aeef;
  color: #fff;
  border: 2px solid  #00aeef;
}
/** Floated inputs: ex the gender radio ==================== **/
ul.floated {
  padding: 0;
  margin: 0 0 0 0;
}
ul.floated li {
  float: left;
  margin: 0;
  padding: 0;
  width: 27%;
}
label.label_gender {
  padding-left: 50px;
  line-height: 42px;
}
ul.floated li#age {
  width: 100px;
  margin-right: 55px;
}
ul.data-list {
  padding: 0;
  margin: 0;
  list-style: none;
  margin-bottom: 30px;
}
ul.data-list-2 {
  list-style: none;
  padding-left: 0;
  margin-left: 0;
}
ul.data-list li {
  position: relative;
}
ul.data-list-2 li {
  position: relative;
  height: 42px;
  margin-bottom: 15px;
  width: 100%;
  display: block;
}
ul.data-list-2 li label {
  float: left;
  margin-left: 60px;
  font-size: 18px;
  font-weight: 400;
  margin-top: 9px;
  line-height: 22px;
}
ul.data-list#terms {
  font-weight: 400;
  line-height: 22px;
  margin: 0;
  font-size: 12px;
  padding: 0;
  text-align: center;
}
/** Errors validation styles and position ==================== **/
/** Common style**/
label.error {
  font-size: 11px;
  position: absolute;
  top: -28px;
  right: -15px;
  z-index: 99;
  height: 25px;
  line-height: 25px;
  background-color: #e34f4f;
  color: #fff;
  font-weight: normal;
  padding: 0 6px;
}
label.error:after {
  content: '';
  position: absolute;
  border-style: solid;
  border-width: 0 6px 6px 0;
  border-color: transparent #e34f4f;
  display: block;
  width: 0;
  z-index: 1;
  bottom: -6px;
  left: 20%;
}
.styled-select label.error {
  overflow: visible;
}
ul.floated li#age label.error {
  right: -15px;
}
ul.floated li label.error {
  right: -50px;
}
ul.data-list#terms li label.error {
  left: 45%;
  display: inline-block;
  width: 80px;
}
/** Error styles for survey questions**/
ul.data-list-2 li label.error {
  font-size: 11px;
  position: absolute;
  top: -30px;
  right: -10px;
  margin: 0;
  z-index: 99;
  height: 25px;
  line-height: 25px;
  background-color: #e34f4f;
  color: #fff;
  font-weight: normal;
  padding: 0 6px;
}
/* #teachers
================================================ */
ul.teacher_courses {
  list-style: none;
  margin: 0;
  padding: 0;
  margin-bottom: 20px;
}
/* #course details
================================================ */
.video_course {
  width: 100%;
  height: 400px;
}
#strips-course {
  padding: 60px 0;
}
#strips-course article h3 {
  font-size: 28px;
  font-weight: 800;
  text-transform: uppercase;
}
#strips-course article h3 em {
  font-size: 21px;
  font-weight: 400;
  text-transform: none;
  font-style: normal;
  display: block;
  color: #999;
}
#strips-course article {
  padding: 30px 0;
}
#strips-course.style_2 article {
  padding: 30px 0;
  border-bottom: 1px dashed #ededed;
}
#strips-course.shadow article:nth-of-type(odd) {
  background-color: #fdfdfd;
  box-shadow: inset 0px 11px 8px -10px #f8f8f8, inset 0px -11px 8px -10px #f8f8f8;
}
ul.data-lessons {
  margin-left: 0;
  padding-left: 0;
  margin-bottom: 30px;
}
ul.data-lessons li {
  display: inline-block;
  margin-right: 5px;
  padding-right: 8px;
  border-right: 1px solid #ccc;
  line-height: 16px;
  color: #777;
  zoom: 1;
  *display: inline;
}
ul.data-lessons li a {
  color: #777;
}
ul.data-lessons li a:hover {
  color: #111;
}
ul.data-lessons li:last-child {
  border-right: none;
}
ul.data-lessons li a.button_red_small {
  color: #fff;
}
/* #Blog
================================================ */
.widget > ul {
  list-style: none;
  padding-left: 0;
}
.widget_recentpost_widget li div {
  font-weight: 600;
  padding-left: 25px;
  font-style: normal;
}
.widget_recentpost_widget li div a {
  display: block;
}
.widget_recentpost_widget li {
  padding: 0 0 8px 0;
  margin-bottom: 15px;
  border-bottom: 1px #e7e7e7 dotted;
  color: #313131;
  list-style: none;
  line-height: 18px;
  padding-bottom: 15px;
  color: #888;
  font-style: italic;
}
.widget_recentpost_widget li:last-child {
  border-bottom: 0;
  margin-bottom: 0;
}
.tagcloud a {
  display: inline-block;
  margin: 5px 14px 10px 0;
  height: 33px;
  font-size: 13px!important;
  line-height: 33px;
  background: #ededed url(images/tag_bg.png) no-repeat 91% center;
  padding: 0 28px 0 11px;
  color: #646464;
  -webkit-border-top-right-radius: 20px;
  -webkit-border-bottom-right-radius: 20px;
  -moz-border-radius-topright: 20px;
  -moz-border-radius-bottomright: 20px;
  border-top-right-radius: 20px;
  border-bottom-right-radius: 20px;
  transition: background .5s ease;
}
.tagcloud a:hover {
  background-color: #099ad1;
  color: #fff;
  text-decoration: none;
}
.post {
  margin-bottom: 45px;
}
#main_content .post h2 {
  font-size: 18px;
  line-height: 22px;
}
#main_content .single-post h2 {
  font-weight: bold;
}
.post img {
  margin-bottom: 18px;
}
.post_info {
  padding: 10px 0;
  border-bottom: 1px #e7e7e7 solid;
  border-top: 1px #e7e7e7 solid;
  margin-bottom: 12px;
  color: #555;
}
.post_info span {
  color: #ff6666;
}
.post-left {
  float: left;
}
.post-left ul {
  margin-left: 0;
  padding-left: 0;
}
.post-left ul li {
  float: left;
  margin-right: 10px;
  list-style: none;
}
.post-right {
  float: right;
}
#comments {
  padding: 10px 0 0px 0;
  margin-bottom: 15px;
}
#comments ul {
  padding: 0;
  margin: 0;
  list-style: none;
}
#comments ol {
  padding: 0;
  margin: 0;
  list-style: none;
}
#comments li {
  padding: 0 0 40px 0;
  list-style: none;
}
#comments > ol > li:last-child {
  padding-bottom: 10px;
}
.comment-body {
  overflow: hidden;
}
.comment-body .avatar {
  float: left;
  margin-right: 15px;
}
.comment-body .avatar img {
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
}
.comment_right {
  display: table;
}
.comment_info {
  padding-bottom: 7px;
}
.comment_info span {
  padding: 0 12px;
}
#comments ol ul {
  padding-left: 40px;
  margin: 0;
}
/* #Contact
================================================ */
#map {
  width: 100%;
  height: 450px;
}
#directions {
  background-color: #0cbdaa;
  padding: 22px 0 0 0;
}
ul#contact-info {
  list-style: none;
  margin: 0 0 20px 0;
  padding: 0;
}
ul#follow_us_contacts {
  list-style: none;
  padding: 0;
  margin: 10px 0 20px 0;
}
ul#follow_us_contacts li {
  position: relative;
  padding-left: 45px;
  height: 34px;
  line-height: 34px;
  margin-bottom: 15px;
}
ul#follow_us_contacts li a i {
  position: absolute;
  left: 0;
  top: 0;
  width: 34px;
  height: 34px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  border: 2px solid #c6c6c7;
  color: #c6c6c7;
  display: block;
  line-height: 32px;
  font-size: 18px;
  text-align: center;
  font-weight: normal;
}
ul#follow_us_contacts li a:hover i {
  border: 2px solid #333;
  color: #333;
}
.box_style_2 {
  background: #f9f9f9;
  border: 1px solid #f3f3f3;
  padding: 30px;
  position: relative;
}
.tape {
  position: absolute;
  left: 0;
  top: -20px;
  height: 45px;
  width: 100%;
  background: url(images/tape.png) no-repeat center top;
  display: block;
}
/* #News
================================================ */
.media.list_news {
  border-top: 1px dashed #ededed;
  padding-top: 20px;
}
/*============================================================================================*/
/* 3.  FORMS */
/*============================================================================================*/
/** Drop down select: ex Country select ==================== **/
.styled-select select {
  background: transparent;
  width: 107%;
  padding: 5px;
  padding-left: 15px;
  border: 0;
  border-radius: 0;
  height: 41px;
  margin: 0;
  font-weight: 400;
  -moz-appearance: window;
  -webkit-appearance: none;
  cursor: pointer;
  color: #999;
}
.styled-select {
  width: 100%;
  overflow: hidden;
  height: 44px;
  background: #fff url(images/down_arrow_select.png) no-repeat right center;
  border: 1px solid #ededed;
  margin-bottom: 25px;
}
.styled-select select::-ms-expand,
.styled-select-2 select::-ms-expand {
  display: none;
}
/** VERSION 1.3 CSS Updated ==================== **/
.input-icon {
  position: absolute;
  right: 8px;
  top: 10px;
  width: 32px;
  height: 24px;
  background-color: #fff;
  text-align: right;
  border-left: 1px solid #ececec;
  color: #ccc;
  font-size: 18px;
  line-height: 24px;
  text-shadow: none;
}
/**  End Version 1.3 Updated  **/
.input-icon i {
  color: #ccc;
  font-size: 18px;
  line-height: 24px;
}
.form-group {
  position: relative;
  margin-bottom: 20px;
}
.loader {
  margin-left: 5px;
  position: absolute;
}
.error_message {
  color: #F33;
  font-weight: 600;
  margin-bottom: 4px;
}
.input-group {
  margin-bottom: 20px;
}
.form-control {
  height: 38px;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-appearance: none;
}
.form-control.style-2 {
  height: 45px;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-appearance: none;
  border: none;
  background-color: #fff;
}
.ie8 .form-control.style-2 {
  height: 45px;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-appearance: none;
  border: none;
  background-color: #fff;
  line-height: 45px;
}
.input-group button {
  height: 44px;
  border: none;
  background-color: #333;
  color: #fff;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
}
.input-group button:hover {
  background-color: #006db8;
  color: #fff;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 0px;
  border: none;
}
.input-group button:focus {
  outline: none;
  border: none;
}
.form-control::-moz-placeholder {
  color: #999;
  opacity: 1;
}
.form-control::-webkit-input-placeholder {
  color: #999;
}
input.form-control,
textarea.form-control {
  background: none;
  background-color: #fff;
  border: 1px solid #ececec;
  border-radius: 0;
  -webkit-appearance: none;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
  -webkit-transition: none;
  color: #a0a0a0;
  height: 44px;
  font-size: 14px;
  font-weight: 400;
  margin-bottom: 25px;
  font-family: 'Raleway', Arial, sans-serif;
  line-height: 1.428571429;
  padding: 6px 12px;
}
textarea.form-control {
  height: 120px;
}
input.form-control:focus,
textarea.form-control:focus,
select.form-control:focus {
  border-color: none;
  outline: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
  color: #555;
}
/* Newsletter */
input.form-control#email_newsletter {
  margin-bottom: 0;
  background-color: #262626;
  border: none;
  height: 52px;
  width: 380px;
  padding-left: 25px;
  color: #676767;
  margin-top: -3px;
}
input.form-control#email_newsletter:focus {
  border-color: none;
  outline: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
  color: #fff;
}
label {
  font-weight: 600;
}
label.error {
  font-size: 11px;
  position: absolute;
  top: -28px;
  right: -15px;
  z-index: 9;
  height: 25px;
  line-height: 25px;
  background-color: #e34f4f;
  color: #fff;
  font-weight: 600;
  padding: 0 6px;
}
label.error:after {
  content: '';
  position: absolute;
  border-style: solid;
  border-width: 0 6px 6px 0;
  border-color: transparent #e34f4f;
  display: block;
  width: 0;
  z-index: 1;
  bottom: -6px;
  left: 20%;
}
.login-or {
  position: relative;
  font-size: 18px;
  color: #aaa;
  margin-top: 10px;
  margin-bottom: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
}
.login_social {
  margin-bottom: 5px;
}
.span-or {
  display: block;
  position: absolute;
  left: 50%;
  top: -2px;
  margin-left: -25px;
  background-color: #fff;
  width: 50px;
  text-align: center;
}
.hr-or {
  height: 1px;
  margin-top: 0px !important;
  margin-bottom: 0px !important;
}
#pass-info {
  width: 98.5%;
  margin-bottom: 15px;
  color: #829CBD;
  text-align: center;
  font: 12px/25px Arial, Helvetica, sans-serif;
}
#pass-info.weakpass {
  border: 1px solid #FF9191;
  background: #FFC7C7;
  color: #94546E;
  text-shadow: 1px 1px 1px #FFF;
}
#pass-info.stillweakpass {
  border: 1px solid #FBB;
  background: #FDD;
  color: #945870;
  text-shadow: 1px 1px 1px #FFF;
}
#pass-info.goodpass {
  border: 1px solid #C4EEC8;
  background: #E4FFE4;
  color: #51926E;
  text-shadow: 1px 1px 1px #FFF;
}
#pass-info.strongpass {
  border: 1px solid #6ED66E;
  background: #79F079;
  color: #348F34;
  text-shadow: 1px 1px 1px #FFF;
}
#pass-info.vrystrongpass {
  border: 1px solid #379137;
  background: #48B448;
  color: #CDFFCD;
  text-shadow: 1px 1px 1px #296429;
}
/* Plans price style =============================*/
.plans {
  margin: 0px auto 50px ;
  zoom: 1;
}
.plans:before,
.plans:after {
  content: '';
  display: table;
}
.plans:after {
  clear: both;
}
.plan {
  margin: 10px 0;
  padding: 20px;
  text-align: center;
  background: #fafafa;
  background-clip: padding-box;
  border: solid #dddddd;
  border-width: 1px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  background-color: #fff;
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}
.plan-title {
  position: relative;
  margin: -20px -10px 20px;
  padding: 20px;
  line-height: 1;
  font-size: 18px;
  text-transform: uppercase;
  font-weight: bold;
  border-bottom: 1px dotted #ccc;
}
.plan-title:before {
  content: '';
  position: absolute;
  bottom: -1px;
  left: 0;
  right: 0;
  height: 1px;
}
.plan-price {
  margin: 0 auto 20px;
  width: 110px;
  height: 110px;
  line-height: 110px;
  font-size: 30px;
  font-weight: bold;
  color: white;
  background: #4b4b4b;
  border-radius: 100px;
  -webkit-border-radius: 100px;
  -moz-border-radius: 100px;
  display: inline-block;
  text-align: center;
}
.plan-price > span {
  font-size: 12px;
  font-weight: normal;
  color: rgba(255, 255, 255, 0.9);
}
.plan-features {
  margin-bottom: 20px;
  line-height: 2;
  font-size: 12px;
  text-align: center;
}
.plan-features ul {
  padding: 0;
  margin: 0 0 30px 0;
}
.plan-features li {
  list-style: none;
}
.plan-tall {
  margin: 0;
  background: #fff;
  border-radius: 4px;
  z-index: 100;
  border: 3px solid #1abc9c;
  position: relative;
}
.plan-tall a {
  margin-bottom: 0;
}
.ribbon {
  width: 99px;
  height: 97px;
  position: absolute;
  left: -7px;
  top: -7px;
  display: block;
  background: url(images/ribbon.png) no-repeat 0 0;
  z-index: 101;
}
.plan-tall > .plan-title {
  font-size: 18px;
}
.plan-tall > .plan-price {
  margin: 0 auto 20px;
  height: 130px;
  width: 130px;
  line-height: 130px;
  font-size: 30px;
  font-weight: bold;
  color: white;
  background: #f26d7d;
  border-radius: 130px;
  -webkit-border-radius: 130px;
  -moz-border-radius: 130px;
  display: inline-block;
  text-align: center;
}
.plan-tall > .plan-features {
  font-size: 14px;
}
.plan-tall > .plan-button {
  padding: 0 16px;
  line-height: 32px;
}
.plan-tall + .plan {
  border-left: 0;
}
/** VERSION 1.3 CSS New ==================== **/
/* Pricing tables */
#pricing_2 {
  margin-top: 20px;
}
.ribbon_2 {
  width: 99px;
  height: 97px;
  position: absolute;
  left: -5px;
  top: -5px;
  display: block;
  background: url(images/ribbon.png) no-repeat 0 0;
  z-index: 101;
}
.pricing-table {
  text-align: center;
  font-weight: 400;
  border: 2px solid #1ABC9C;
  background: #fff;
  -webkit-transition: all 0.2s ease-in-out;
  -moz-transition: all 0.2s ease-in-out;
  -o-transition: all 0.2s ease-in-out;
  -ms-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
  position: relative;
}
.pricing-table:hover {
  -moz-box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.5);
  -webkit-box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.5);
  box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.5);
}
.pricing-table.green {
  text-align: center;
  font-weight: 400;
  border: 1px solid #0cbdaa;
}
.pricing-table.black {
  text-align: center;
  font-weight: 400;
  border: 1px solid #333;
}
.pricing-table-sign-up {
  border-top: 1px solid #ededed;
  padding: 10px 10px 5px 10px;
  text-align: center;
  margin-top: 30px;
}
.pricing-table-features li {
  padding: 10px 20px;
  text-align: center;
  margin: 10px 0;
}
.pricing-table-features li:nth-child(2n) {
  background: #f8f8f8;
  padding: 10px 0;
}
.pricing-table-features,
.pricing-table-space {
  background: #fff;
}
.pricing-table-features > p {
  margin-bottom: 0;
}
.pricing-table ul {
  padding-left: 0;
}
.pricing-table li {
  padding: 5px;
  margin-top: 5px;
  font-size: 110%;
  font-weight: 400;
  background: #fff;
  list-style: none;
}
.pricing-table li strong {
  font-weight: 600;
}
.pricing-table .pricing-table-header {
  color: #fff;
  padding: 0px;
}
.pricing-table-header .heading {
  display: inline-block;
  width: 100%;
  padding: 15px 0px;
  text-transform: uppercase;
  font-weight: 800;
  font-size: 18px;
}
.pricing-table.green .heading {
  background: #0cbdaa;
}
.pricing-table.black .heading {
  background: #333;
}
.pricing-table .pricing-table-header .price-value {
  background: #fff;
}
.pricing-table.green .pricing-table-header .price-value {
  background: #fff;
}
.pricing-table.black .pricing-table-header .price-value {
  background: #fff;
}
.pricing-table-header .price-value {
  display: inline-block;
  width: 100%;
  padding: 10px 0px;
  background: #1ABC9C;
  font-family: "Helvetica Neue", Arial;
  font-weight: bold;
  color: #555;
  border-bottom: 1px solid #ededed;
  margin-bottom: 15px;
}
.pricing-table-header .price-value span {
  font-weight: 800;
  font-size: 36px;
  line-height: 36px;
}
.pricing-table-header .price-value span.mo {
  font-size: 22px;
  font-weight: 400;
}
/**User logged panel on header  **/
ul.user_panel {
  list-style: none;
  margin: 10px 0 0 0;
  padding: 0;
  font-size: 12px;
}
ul.user_panel a.dropdown-toggle {
  color: #fff;
}
.rating_2 {
  color: #FC0;
}
/** Member page +  teacher profile  **/

.profile ul {
  text-transform: none;
  font-size: 14px;
  list-style: none;
  padding: 0;
  margin: 0 0 20px 0;
}
.profile ul li {
  border-bottom: 1px solid #ededed;
  padding: 13px 0;
}
.profile ul li:last-child {
  border-bottom: none;
}
#payment_opt {
  padding-top: 25px;
  padding-bottom: 15px;
}
#payment_opt .radio-inline {
  margin-bottom: 15px;
  margin-left: 0;
}
.payment_logos {
  margin: -10px 15px 0 0;
}
#profile,
#agenda {
  padding-top: 20px;
}
ul.social_teacher {
  list-style: none;
  padding: 0;
  margin: 5px 0 15px 0;
  font-size: 16px;
  text-align: center;
}
ul.social_teacher li {
  display: inline-block;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  border: 1px solid #ededed;
  width: 30px;
  height: 30px;
  line-height: 20px;
  text-align: center;
  padding: 5px 0;
}
ul.list_3 {
  list-style: none;
  margin: 0;
  padding: 0;
}
ul.list_3 li {
  margin-bottom: 0;
  position: relative;
  padding-left: 20px;
}
ul.list_3 li:before {
  font-family: "fontello";
  content: "\ea3e";
  position: absolute;
  left: 0;
  top: 0;
}
html #boxed {
  width: 1170px;
  margin: auto;
  -moz-box-shadow: 0 0 5px #000;
  -webkit-box-shadow: 0 0 5px#000;
  box-shadow: 0 0 5px #000;
}
body#boxed {
  background: #999 url(images/pattern_1.png) repeat;
}
/**  End Version 1.3 New ====================== **/
/** VERSION 1.5 CSS Updated ==================== **/
/* Revolution slider fix */
ul.sliderwrapper {
  display: none;
}
/* Gallery page */
.picture {
  margin-bottom: 20px;
  position: relative;
}
.picture img {
  padding: 5px;
  box-shadow: inset 0 0 0 1px #e0e5e9;
  border: 5px solid #fbfbfc;
  background-color: #fff;
}
.photo_icon {
  display: none;
  left: 30px;
  position: absolute;
  top: 20px;
  width: 100%;
  z-index: 1;
  width: 30px;
  height: 30px;
}
.photo_icon i {
  color: #fff;
  font-size: 24px;
  font-weight: normal;
}
nav.sticky {
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  z-index: 1000;
}
/**  End Version 1.5 CSS Updated  ====================== **/
/*============================================================================================*/
/* 4.  COMMON */
/*============================================================================================*/
.add_bottom_30 {
  margin-bottom: 30px;
}
.add_bottom_45 {
  margin-bottom: 45px;
}
.add_bottom_60 {
  margin-bottom: 60px;
}
.breadcrumb {
  background: none;
  padding: 0;
  font-size: 12px;
  margin-top: 30px;
  overflow: hidden;
}
.breadcrumb > li {
    display: inline-block;
}
.breadcrumb > li + li:before {
    padding: 0 5px;
    color: #ccc;
    content: "/\00a0";
}
#content .breadcrumb {
  margin-top: 30px;
  margin-bottom: 10px;
}
#join {
  background: url(images/pattern_2.png) repeat 0 0;
  padding: 60px 0;
  -moz-box-shadow: inset 0 0 10px #000000;
  -webkit-box-shadow: inset 0 0 10px #000000;
  box-shadow: inset 0 0 10px #000000;
}
ul.list_po_body {
  padding: 0 0 0 0;
  margin: 0;
  list-style: none;
}
p.no_margin {
  padding: 0;
  margin: 0;
}


img.speaker {
  width: 50px;
  height: 50px;
  margin-left: 15px;
  border: 1px solid #fff;
}
.box_style_3 {
  position: relative;
  margin: 0 0 2em 0;
  text-align: center;
  background: #fff;
  padding: 30px 30px 10px 30px;
  border: 1px solid #ededed;
}
/* carousel */
.quote-carousel {
  padding: 0 10px 30px 10px;
  margin-top: 30px 0px 0px;
  font-weight: 600;
  color: #333;
}
.quote-carousel small {
  color: #333;
  font-style: italic;
}
.quote-carousel .light small,
.quote-carousel .light p {
  color: #fff;
}
/* Control buttons  */
.quote-carousel .carousel-contro {
  background: none;
  color: #222;
  font-size: 3em;
  text-shadow: none;
  margin-top: 30px;
}
/* Previous button  */
.quote-carousel .carousel-control.left {
  left: -12px;
}
/* Next button  */
.quote-carousel .carousel-control.right {
  right: -12px !important;
}
/* Changes the position of the indicators */
.quote-carousel .carousel-indicators {
  right: 50%;
  top: auto;
  bottom: 0px;
  margin-right: -19px;
}
/* Changes the color of the indicators */
.quote-carousel .carousel-indicators li {
  background: #fff;
  border: none;
}
.quote-carousel .carousel-indicators .active {
  background: #1c1c1c;
}
.quote-carousel img {
  width: 100px;
  height: 100px;
}
/* End carousel */
.item blockquote {
  border-left: none;
  margin: 0;
}
.item blockquote img {
  margin-bottom: 10px;
}
.item blockquote p:before {
  content: "\ebe7";
  font-family: 'fontello';
  float: left;
  margin-right: 10px;
}
#toTop {
  width: 40px;
  height: 40px;
  line-height: 28px;
  background: #333;
  text-align: center;
  padding: 5px;
  position: fixed;
  bottom: 20px;
  right: 20px;
  cursor: pointer;
  display: none;
  color: #fff;
  font-size: 15px;
  border-radius: 50%;
  opacity: 0.8;
}
#toTop:hover {
  opacity: 1;
}
.img-circle.styled {
  background-color: #ededed;
  -moz-box-shadow: 0px 0px 0px 5px #ededed;
  -webkit-box-shadow: 0px 0px 0px 5px #ededed;
  box-shadow: 0px 0px 0px 5px #ededed;
  margin: auto;
}
/** Collapse **/
.panel-title a {
  display: block;
}
/** tabs **/
.tab-content {
  padding-top: 15px;
}
/** List styles **/
ul.latest_news {
  list-style: none;
  margin: 0 0 0 0;
  padding: 0;
}
ul.latest_news li {
  margin-bottom: 15px;
}
ul.list_ok {
  list-style: none;
  margin: 0;
  padding: 0;
}
ul.list_ok li {
  margin-bottom: 0;
  position: relative;
  padding-left: 20px;
  line-height: 30px;
}
.sub-header-features-2 ul.list_ok li {
  line-height: 24px;
}
ul.list_ok li:before {
  font-family: "fontello";
  content: "\e81a";
  position: absolute;
  left: 0;
  top: 0;
}
ul.list_1 {
  list-style: none;
  margin: 0 0 20px 0;
  padding: 0;
  font-weight: 700;
  font-size: 14px;
}
ul.list_1 li a {
  text-decoration: none;
  padding: 4px 10px;
  display: block;
  margin-bottom: 0;
  border-bottom: 1px solid #efefef;
}
ul.list_1 li a:after {
  font-family: "fontello";
  content: "\e89b";
  float: right;
}
ul.list_1 li a:hover {
  background: #efefef;
  color: #326e99;
}
ul.list_2 {
  list-style: none;
  margin: 0 0 20px 0;
  padding: 0;
  font-weight: 700;
  font-size: 14px;
}
ul.list_2 li a {
  text-decoration: none;
  padding: 4px 10px;
  display: block;
  margin-bottom: 0;
  border-bottom: 1px solid #efefef;
}
ul.list_2 li a:after {
  font-family: "fontello";
  content: "\ee1c";
  float: right;
}
ul.list_2 li a:hover {
  background: #efefef;
  color: #326e99;
}
.circ-wrapper h3 {
  margin: 0;
  padding: 15px 0 0 0;
  font-weight: bold;
}
.circ-wrapper.course_detail h3 {
	margin: 0;
    padding: 0;
    font-weight: bold;
    font-size: 20px;
    line-height: 40px;
}
.circ-wrapper + .media-body {
	float:left;
    max-width: calc(100% - 50px);
    border-bottom: 1px dotted #ccc;
}
.media-body .media-heading {
	margin-top: 10px;
}
.course img.thumbnail.alignleft {
	display: none;	
}
.circ-wrapper {
	width: 40px;
	height: 40px;
    text-align: center;
	background: #0cbdaa;
	color: #FFF;
	overflow: hidden;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	float: left;
	margin-top: 10px;
	border-radius: 20px;
}
.circ-wrapper.red {
  width: 40px;
  height: 40px;
  text-align: center;
  background: #f26965;
  color: #FFF;
  overflow: hidden;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
.circ-wrapper.blue {
  width: 40px;
  height: 40px;
  text-align: center;
  background: #00aeef;
  color: #FFF;
  overflow: hidden;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  
}
.circ-wrapper i.icon-4x {
  font-size: 40px;
}
.label-warning {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 11px;
  padding: 5px 7px 4px 7px;
  background-color: #ffcc00;
}
.media-body {
  padding-left: 10px;
}
/*============================================================================================*/
/* 5.  MEDIA QUERIES */
/*============================================================================================*/
@media (min-width: 1201px) and (max-width: 1400px) {
  #middle-wizard {
    padding: 40px 60px 35px 60px;
  }
}
@media (min-width: 768px) and (max-width: 1200px) {
  #middle-wizard {
    padding: 40px 60px 35px 60px;
  }
  ul.floated li#age {
    margin-right: 20px;
  }
  /** VERSION 1.3 CSS New ==================== **/
  #boxed {
    width: 980px;
  }
  /**  End Version 1.3 New  **/
}
@media (min-width: 768px) and (max-width: 979px) {
  .quote-carousel {
    margin-bottom: 0;
    padding: 0 40px 30px 40px;
    margin-top: 30px;
  }
  /** VERSION 1.3 CSS New ==================== **/
  .plan-tall + .plan {
    border: solid #dddddd 1px;
  }
  .plan-tall {
    margin-right: 0;
  }
  .col-md-4.plan:first-child {
    margin-right: 0;
    margin-left: 0;
    border-right: solid #dddddd 1px;
  }
  html #boxed {
    width: 760px;
  }
  /**  End Version 1.3 New  **/
}
@media (max-width: 991px) {
  .ot-plan .vc_column-inner {
    margin: 0 0 20px 0!important;
    padding: 0!important;
  }
  .pricing-table {
    margin-bottom: 20px;
  }
}
/* From tablet portrait to mobile */
@media (max-width: 767px) {
  .quote-carousel .carousel-indicators {
    bottom: -20px !important;
  }
  input.form-control#email_newsletter {
    width: 80%;
    margin: auto;
    margin-bottom: 15px;
  }
  #apply {
    margin-right: 40px;
  }
  #login_top {
    margin-right: 40px;
  }
  #top-wizard {
    padding: 15px 6s0px;
  }
  #middle-wizard {
    padding: 20px 30px 20px 30px;
  }
  ul.floated li#age {
    margin-bottom: -10px;
  }
  ul.floated li {
    float: none;
    margin: 0;
    padding: 0;
    width: 50%;
    padding-bottom: 10px;
  }
  .col-md-4.plan:first-child,
  .col-md-4.plan:last-child {
    margin-right: 0px;
    margin-left: 0px;
    border-width: 1px 1px 1px 1px;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  .plan-tall + .plan {
    border-left: 1px;
    border: solid #dddddd;
  }
  .plan-tall {
    margin-right: 0;
  }
  #main_content .post h2 {
    font-size: 20px;
    line-height: 22px;
  }
  .post-right {
    float: none;
  }
  .post-left ul li {
    float: none;
    margin-right: 0;
    margin-bottom: 3px;
  }
  #strips-course {
    padding: 30 0 30px 0;
  }
  /* Typography*/
  p.lead.boxed {
    font-size: 22px;
    line-height: 24px;
    padding: 8px;
  }
  .subscribe {
    background: none;
    padding-bottom: 0;
  }
  #subscribe h1 {
    font-size: 50px;
    margin-top: 0;
  }
  /** VERSION 1.3 CSS New ==================== **/
  ul.user_panel {
    margin: 8px 45px 0 0;
  }
  html #boxed {
    width: 100%;
  }
  nav.sticky {
    position: static;
  }
  /**  End Version 1.3 New  **/
}
/* Mobile portrait */
@media (max-width: 480px) {
  a#logo {
    width: 37px;
    height: 36px;
    background: url(images/logo_mobile.png) no-repeat 0 0;
  }
  #subscribe {
    background: none;
    padding-bottom: 0;
  }
  /* Typography*/
  h1 {
    font-size: 36px;
    line-height: 38px;
    margin-bottom: 10px;
  }
  #subscribe h1 {
    font-size: 30px;
    margin-top: 15px;
    margin-bottom: 0;
    text-align: center;
  }
  #subscribe h2 {
    font-size: 30px;
  }
  #main-features h2,
  #main-features_green h2 {
    font-size: 28px;
  }
  #main-features p.lead,
  #main-features_green p.lead {
    font-size: 14px;
    margin-bottom: 30px;
  }
  #main_content h2,
  #main_content_gray h2 {
    font-size: 24px;
  }
  #testimonials h2 {
    font-size: 28px;
  }
  p.lead.boxed {
    font-size: 14px;
    line-height: 16px;
    padding: 8px;
  }
  footer h3 {
    font-size: 22px;
    line-height: 24px;
  }
  #top-wizard {
    padding: 15px 30px;
  }
  #bottom-wizard {
    padding: 15px 30px;
  }
  .backward,
  .forward,
  button[disabled].backward,
  button[disabled].forward {
    text-indent: -9999px;
    width: 50px;
    padding: 0;
    height: 40px;
  }
  .backward:before,
  .forward:before,
  button[disabled].backward:before,
  button[disabled].forward:before {
    text-indent: 0;
    top: 12px;
    font-size: 16px;
  }
  #complete {
    padding: 0 25px 15px 25px;
  }
  #complete h3 {
    font-size: 18px;
    margin-bottom: 20px;
  }
  #complete i {
    font-size: 80px;
    padding: 0;
  }
  #map {
    height: 200px;
  }
  #login_bg {
    padding: 30px 0;
  }
  .video_course {
    width: 100%;
    height: 200px;
  }
  #sub-header {
    padding: 10px 0 60px 0;
  }
  #sub-header-features p {
    font-size: 14px;
  }
  .sub-header-features-2 p {
    font-size: 14px;
  }
  /** VERSION 1.5 CSS New ==================== **/
  nav.sticky {
    position: static;
  }
  /** End 1.5 CSS New ==================== **/
}
/* Mobile Portrait */
@media only screen and (max-width: 320px) {
  .step h3 {
    font-size: 18px;
    line-height: 22px;
    margin-bottom: 20px;
  }
  #complete h3 {
    font-size: 18px;
    margin-bottom: 20px;
  }
  #complete {
    padding: 0 15px 15px 15px;
  }
}
/*EDIT*/
body.boxed {
  background: #e9e9e1;
}
.boxed nav.sticky {
  background: transparent;
}
.boxed nav.sticky .nav-inner {
  width: 1200px;
  margin: auto;
  background: #1c1c1c;
}
@media (max-width: 1220px) {
  body.boxed {
    width: auto;
  }
  .boxed nav.sticky .nav-inner {
    width: auto;
  }
}
.wrapper {
  background-color: #fff;
}
.boxed .wrapper {
  background-color: #fff;
  max-width: 1200px;
  margin: auto;
  -webkit-box-shadow: -3px 0px 5px 0px rgba(0, 0, 0, 0.1), 3px 0px 5px 0px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: -3px 0px 5px 0px rgba(0, 0, 0, 0.1), 3px 0px 5px 0px rgba(0, 0, 0, 0.1);
  box-shadow: -3px 0px 5px 0px rgba(0, 0, 0, 0.1), 3px 0px 5px 0px rgba(0, 0, 0, 0.1);
}
.top50 {
  padding-top: 50px;
}
.top-0 {
  margin-top: 0px;
}
div.wpcf7-response-output {
  margin: 0;
}
.btn.no-radius {
  border-radius: 0;
}
section.buttons .btn {
  margin-bottom: 15px;
}
div.wpb_column {
  min-height: auto;
}
.container .container {
  width: 100%;
  padding: 0;
}
div.wpb_content_element {
  margin-bottom: 0;
}
.course.row .col-8, .lesson.post .col-8, .quiz .in_grid {
	padding:1em;
}
.vc-row-full-width .row {
  margin: 0;
}
.vc-row-full-width .vc_col-sm-12 .vc_column-inner,
.vc-row-full-width .vc_col-md-12 .vc_column-inner {
  padding: 0;
}
.box_style_2 textarea {
  height: 260px;
}
.wpcf7 br,
#subscribe_home .ajax-loader {
  display: none;
}
#subscribe_home .wpcf7-validation-errors {
  color: #fff;
  margin: 0;
  margin-top: 20px;
}
.wpcf7 .wpcf7-not-valid {
  border-color: red;
}
.wpcf7 span.wpcf7-not-valid-tip {
  display: none;
}
.input-group-btn:last-child > .btn,
.input-group-btn:last-child > .btn-group {
  margin: 0;
}
.padd-top {
  padding-top: 60px;
}
.height-0 .wpb_column {
  min-height: auto;
}
.logos {
  text-align: center;
}
.post iframe {
  border: none;
}
.post a.button_medium {
  font-size: 12px;
}
.post blockquote p {
  font-style: italic;
  font-size: 15px;
}
.nav-links {
  overflow: hidden;
}
.nav-links .nav-previous {
  float: left;
}
.nav-links .nav-next {
  float: right;
}
.comment-respond h3 {
  font-size: 22px;
}
.carousel-indicators .active {
  width: 10px;
  height: 10px;
  margin: 1px;
}
.circ-wrapper {
  display: inline-block;
}
div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a {
  background: transparent;
  border: none;
  font-size: 14px;
}
div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a span {
  color: #488dc6;
}
div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a span {
  color: inherit;
}
div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a {
  border: 1px solid #ddd;
}
div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a {
  background: transparent;
}
div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:hover {
  background: #eee;
}
div.vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-panels {
  background: transparent;
  border: none;
}
div.vc_tta-color-grey.vc_tta-style-classic.vc_tta-tabs .vc_tta-panels .vc_tta-panel-body {
  padding: 15px 0;
}
div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-body {
  background: #fff;
}
/*Sensei*/
.sensei-breadcrumb {
  background: transparent;
  font-size: 13px;
  font-style: normal;
  padding-left: 0;
}
.courses-list .breadcrumb {
  margin: 20px 0;
}
.courses-list .woocommerce {
  padding-bottom: 100px;
}
.courses-list .col-item {
	margin:10px;
}
.course header h1,
.lesson header h1 {
  font-size: 32px;
  font-weight: 400;
  margin: 0 0 15px;
  text-transform: none;
}
.lesson header h1 {
  text-transform: uppercase;
}
.course span.progress {
  height: auto;
  margin: 0;
  display: inline-block;
  background: none;
  box-shadow: none;
}
.course .meter {
  margin-top: 0;
  border-radius: 4px;
  height: 20px;
  overflow: hidden;
  background: #f5f5f5;
  margin-right: 40px;
  margin-bottom: 1em;
}
.course .meter > span {
  border-radius: 4px;
  background: #7cbe31;
  box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
  font-size: 12px;
  text-align: center;
  font-weight: 300;
  vertical-align: text-top;
}
.course-lessons > header {
  display: none;
}
.post.module header h2 {
  background: #f8f8f8;
  padding: 10px;
  font-size: 18px;
  line-height: 20px;
  margin-top: 25px;
  margin-bottom: 0;
  border: 1px solid #e0e5e9;
  border-bottom: 2px solid #e0e5e9;
  font-weight: 600;
}
.post.module header h2 a {
  color: #333;
}
.module-lessons > header {
  display: none;
}
.course i.icon-trophy {
  float: right;
  margin-top: -46px;
  font-size: 26px;
  color: #ccc;
}
.box_style_1 h4 {
    border-bottom: 1px solid #eaeff3;
    padding-bottom: 10px;
}
.box_style_1 .media .avatar {
  border-radius: 50%;
  float: none;
  margin-right: 0;
}
.thumb-related {
  width: 70px;
}
.related-course .media {
  margin-top: 20px;
}
#lesson_complete.lesson-meta {
  margin-top: 30px;
}
.post-entries {
  margin-bottom: 40px;
  margin-top: 20px;
  border-top: 1px dotted #ccc;
  padding-top: 20px;
  overflow: hidden;
  width: 100%;
  font-weight: bold;
}
.post-entries .nav-prev.fl:before {
    content: "Previous Lesson";
    color: #767676;
    display: block;
    font-size: 11px;
    font-size: 0.6875rem;
    letter-spacing: 0.1818em;
    margin-bottom: 1em;
    text-transform: uppercase;
}
.post-entries .nav-next.fr:before {
    content: "Next Lesson";
    color: #767676;
    display: block;
    font-size: 11px;
    font-size: 0.6875rem;
    letter-spacing: 0.1818em;
    margin-bottom: 1em;
    text-transform: uppercase;
}
.post-entries .nav-next {
	float: right;
}
.post-entries .nav-prev {
	float: left;
}
.post-entries .nav-prev a:before {
	    content: "\f104";
	display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
        margin-right: 0.5em;
}
.post-entries .nav-next a:after {
	    content: "\f105";
	display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
        margin-left: 0.5em;
}
.module .module-lessons ul > li {
  margin-right: 10px!important;
}
.module .module-lessons > ul > li a {
  border: none;
  font-size: 16px;
  font-weight: 600;
  line-height: 18px;
  color: #2d4050;
}
.module .module-lessons .strip_single_course ul {
  padding-left: 45px!important;
  margin-bottom: 10px!important;
}
.module .module-lessons > ul > li a:before {
  background: #fff;
  line-height: 14px;
}
.module .module-lessons > ul > li a:hover {
  border: none;
}
#main .module .module-status {
  padding: 5px 10px;
  top: 6px;
}
.comment-respond {
  overflow: hidden;
}
.comment-respond .stars {
  position: relative;
  display: block;
}
.comment-respond .stars a {
  color: #888888;
  display: inline-block;
  font-weight: 700;
  margin-right: 1em;
  text-indent: -9999px;
  position: relative;
  outline: 0;
  border-right: 1px solid #ccc;
}
.comment-respond .stars a:last-child {
  border-right-width: 0;
}
.comment-respond .stars a:after {
  font-family: FontAwesome;
  content: "\f005";
  text-indent: 0;
  position: absolute;
  top: 0;
  left: 0;
}
.comment-respond .stars a:hover,
.comment-respond .stars a.active {
  color: #ffb432;
}
.comment-respond .stars .star-1 {
  width: 2em;
}
.comment-respond .stars .star-2 {
  width: 3em;
}
.comment-respond .stars .star-2:after {
  content: "\f005\f005";
}
.comment-respond .stars .star-3 {
  width: 4em;
}
.comment-respond .stars .star-3:after {
  content: "\f005\f005\f005";
}
.comment-respond .stars .star-4 {
  width: 5em;
}
.comment-respond .stars .star-4:after {
  content: "\f005\f005\f005\f005";
}
.comment-respond .stars .star-5 {
  width: 6em;
}
.comment-respond .stars .star-5:after {
  content: "\f005\f005\f005\f005\f005";
}
.woocommerce-message {
  font-size: 0;
  height: 70px;
}
.woocommerce-message a.wc-forward {
  border: none;
  background: #F66;
  color: #fff;
  outline: none;
  text-align: center;
  padding: 15px 12px;
  text-decoration: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
  font-size: 16px;
  display: block;
  width: 100%;
  cursor: pointer;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 15px;
  -webkit-font-smoothing: antialiased;
}
.woocommerce-message a.wc-forward:hover {
  color: #fff;
  background: #333;
}
.col-item .course_info h4.black-color a {
  color: #333;
}
.col-item .course_info h4.black-color a:hover {
  color: #488dc6;
}
#main p.status.module-status,
.course-meta.course-enrolment,
.course > header > h2,
#main > #post-entries,
#main > .woocommerce-message,
.my-messages-link-container,
#sensei-user-courses .course-content .entry > a,
#sensei-user-courses .course-content .entry .course-excerpt {
  display: none;
}
.course .media-body p,
.post.lesson {
  margin-bottom: 10px;
}
.post.lesson footer {
  background: transparent;
  text-align: left;
  margin-bottom: 40px;
}
.lesson div.sensei-message a.next-lesson {
  margin-top: -5px;
}
#main .course,
#main .course-container {
  border: none;
}
.lesson.post blockquote p {
  font-size: 13px;
  font-style: normal;
}
.box_style_1.related-course ul {
  margin-bottom: 0;
}
#order_comments {
  padding: 7px 10px;
  height: 200px;
}
.col-md-8 .sensei-message.info.checkout-mess {
  margin: 0;
}
.sensei-message.info, .sensei-message.alert, .sensei-message.tick {
    width: 100%;
    clear: both;
    background: rgba(240,240,240,0.7);
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 1em;
}

.sensei-message.tick {
  border: 5px solid #fbfbfc!important;
  box-shadow: inset 0 0 0 1px #e0e5e9;
}
div.sensei-message.info a,
div.sensei-message.alert a,
div.sensei-message.tick a {
  color: #488dc6 !important;
  text-decoration: none;
  font-weight: 600;
}
.course a.comment-reply-link {
  background: transparent;
  font-size: 13px;
  font-weight: normal;
  padding: 0;
  text-transform: none;
  color: #428bca;
}
.course a.comment-reply-link:hover {
  background: none;
}
.course .comment_info {
  font-size: 13px;
}
.course .commentlist .avatar {
  border-radius: 50%;
}
.next-course.media {
  margin-top: 10px;
}
.next-course p {
  margin-bottom: 10px;
}
.profiles {
  margin-top: 60px;
  margin-bottom: 60px;
}
.profiles .avatar {
  border-radius: 50%;
  background-color: #ededed;
  -moz-box-shadow: 0 0 0 5px #ededed;
  -webkit-box-shadow: 0 0 0 5px #ededed;
  box-shadow: 0 0 0 5px #ededed;
  margin: auto;
}
.my-course {
  margin-bottom: 60px;
}
/*Login form*/
input[type="submit"] {
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
}
#loginform {
  border-radius: 5px;
  border: 1px solid #d3ced2;
  padding: 30px;
}
#my-courses.ui-tabs a {
  color: #488dc6;
}
#my-courses.ui-tabs h2 {
  text-transform: uppercase;
  font-weight: 400;
  font-size: 36px;
  margin-top: 0;
  margin-bottom: 20px;
}
#my-courses form#loginform input[type="text"],
#my-courses form#loginform input[type="password"] {
  height: 40px;
  width: 100%;
  padding: 0 10px;
  border: 1px solid #ececec;
}
#my-courses form#loginform input[type="submit"] {
  margin: 10px 0;
  padding: 10px 40px;
  background: #30d9a4;
  color: #fff;
  text-transform: uppercase;
  font-weight: bold;
  border: none;
  transition: background .5s ease;
  -moz-transition: background .5s ease;
  -webkit-transition: background .5s ease;
  -o-transition: background .5s ease;
}
#my-courses form#loginform input[type="submit"]:hover {
  background: #333;
}
.remember_me {
  margin-bottom: 0;
}
#user-course-status-toggle > a {
  padding: 8px 15px;
  bottom: 0!important;
  border: none;
  font-weight: 600;
  margin-right: 10px;
  text-transform: uppercase;
  font-size: 12px;
  display: inline-block;
}
#sensei-user-courses #user-course-status-toggle a.active {
  color: #aaa;
}
#sensei-user-courses ul {
  list-style: none;
  padding-left: 0;
}

#sensei-user-courses .course .meter {
  margin-bottom: 0;
  padding-left: 0;
  padding-bottom: 0;
}
#sensei-user-courses ul li{
  margin-bottom: 0;
  padding:1em;
  border-bottom: 1px dotted #ccc;
}
/*Quiz*/
.quiz {
    background: rgb(248,248,248);
}
.quiz header h1 {
  font-size: 30px;
  text-transform: none;
}
.quiz form ol#sensei-quiz-list {
  padding: 0 15px;
  overflow: hidden;
}
.quiz form ol#sensei-quiz-list > li {
  float: left;
     width: 100%;
    padding: 20px;
    background: white;
    margin: 10px;
    border-radius: 10px;
}
.quiz form span.question.question-title {
	font-weight: bold;
	padding-bottom: 1em;
	display: block;
}
.quiz form ol#sensei-quiz-list li ul {
  padding: 0;
  padding-right: 25px;
  list-style: none;
}
/*404*/
.error404 #sub-header {
  display: none;
}
.page404 {
  padding: 180px 0 220px;
}
.content_404 {
  padding: 30px 0;
  line-height: 25px;
}
.woocommerce #payment #place_order,
.woocommerce-page #payment #place_order {
  margin-bottom: 60px;
}
/*WPML*/
#lang_sel {
  height: 32px;
  position: relative;
  font-family: verdana, arial, sans-serif;
  display: inline-block;
}
/* remove all the bullets, borders and padding from the default list styling */
#lang_sel ul,
#lang_sel li {
  padding: 0 !important;
  margin: 0 !important;
  list-style-type: none !important;
}
#lang_sel li:before {
  content: '' !important;
}
#lang_sel ul ul {
  width: 149px;
}
/* float the list to make it horizontal and a relative positon so that you can control the dropdown menu positon */
#lang_sel li {
  float: left;
  width: 149px;
  position: relative;
}
/* style the links for the top level */
#lang_sel a,
#lang_sel a:visited {
  display: block;
  font-size: 11px;
  text-decoration: none !important;
  color: #444444;
  border: 1px solid #cdcdcd;
  background: #fff;
  padding-left: 10px;
  line-height: 24px;
}
/* hide the sub levels and give them a positon absolute so that they take up no room */
#lang_sel ul ul {
  visibility: hidden;
  position: absolute;
  height: 0;
  top: 25px;
  left: 0;
  width: 149px;
  border-top: 1px solid #cdcdcd;
}
/* style the table so that it takes no ppart in the layout - required for IE to work */
#lang_sel table {
  position: absolute;
  top: 0;
  left: 0;
  border-collapse: collapse;
}
/* style the second level links */
#lang_sel ul ul a,
#lang_sel ul ul a:visited {
  background: #ffffff;
  color: #444444;
  height: auto;
  line-height: 1em;
  padding: 5px 10px;
  border-width: 0 1px 1px 1px;
}
/* style the top level hover */
#lang_sel a:hover,
#lang_sel ul ul a:hover {
  color: #000;
  background: #eee;
}
#lang_sel :hover > a,
#lang_sel ul ul :hover > a {
  color: #000;
  background: #eee;
}
#lang_sel a.lang_sel_sel {
  background: url(../img/nav-arrow-down.png) #fff right no-repeat;
  color: #444;
}
#lang_sel a.lang_sel_sel:hover {
  text-decoration: none;
  color: #000;
}
/* make the second level visible when hover on first level list OR link */
#lang_sel ul li:hover ul,
#lang_sel ul a:hover ul {
  visibility: visible;
}
#lang_sel img.iclflag {
  width: 18px;
  height: 12px;
  position: relative;
  top: 1px;
}
#lang_sel_footer {
  margin: 0;
  padding: 7px;
  text-align: center;
  font: 11px Verdana, sans-serif;
  min-height: 15px;
  clear: both;
  background-color: #fff;
  border: 1px solid #cdcdcd;
}
#lang_sel_footer ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
#lang_sel_footer ul li img {
  position: relative;
  top: 1px;
  width: 18px;
  height: 12px;
}
#lang_sel_footer ul li {
  display: inline;
  margin: 0 1px 0 0;
  padding: 0;
  white-space: nowrap;
  line-height: 25px;
}
#lang_sel_footer ul li a,
#lang_sel_footer ul li a:visited {
  text-decoration: none;
  padding: 5px 10px;
}
#wpml_credit_footer {
  width: 100%;
  margin: 10px 0;
  padding: 0;
  text-align: center;
  font-size: 11px;
}
#lang_sel_list {
  height: 32px;
  position: relative;
  z-index: 99;
  font-family: verdana, arial, sans-serif;
}
#lang_sel_list.lang_sel_list_vertical {
  width: 149px;
}
/* remove all the bullets, borders and padding from the default list styling */
#lang_sel_list ul,
#lang_sel_list li {
  padding: 0 !important;
  margin: 0 !important;
  list-style-type: none !important;
}
#lang_sel_list li:before {
  content: '' !important;
}
#lang_sel_list ul.lang_sel_list_vertical {
  width: 149px;
}
/* float the list to make it horizontal and a relative positon so that you can control the dropdown menu positon */
#lang_sel_list li {
  float: left;
  position: relative;
}
#lang_sel_list.lang_sel_list_vertical li {
  width: 149px;
}
/* style the links for the top level */
#lang_sel_list a,
#lang_sel_list a:visited {
  display: block;
  font-size: 11px;
  text-decoration: none !important;
  color: #444444;
  background: #fff;
  line-height: 18px;
  padding-left: 5px;
}
#lang_sel_list.lang_sel_list_vertical a,
#lang_sel_list.lang_sel_list_vertical a:visited {
  border: 1px solid #cdcdcd;
  border-top-width: 0;
  padding-left: 10px;
}
/* hide the sub levels and give them a positon absolute so that they take up no room */
#lang_sel_list.lang_sel_list_vertical ul {
  /*visibility:hidden;position:absolute;*/
  height: 0;
  top: 19px;
  left: 0;
  border-top: 1px solid #cdcdcd;
}
/* style the table so that it takes no ppart in the layout - required for IE to work */
#lang_sel_list table {
  position: absolute;
  top: 0;
  left: 0;
  border-collapse: collapse;
}
/* style the second level links */
#lang_sel_list ul a,
#lang_sel_list_list ul a:visited {
  background: #ffffff;
  color: #444444;
  height: auto;
  line-height: 1em;
}
#lang_sel_list.lang_sel_list_vertical ul a,
#lang_sel_list_list ul a:visited {
  padding: 3px 10px;
}
#lang_sel_list a.lang_sel_sel {
  background-image: none;
  color: #444;
}
#lang_sel_list a.lang_sel_sel:hover {
  text-decoration: none;
  color: #000;
}
/* make the second level visible when hover on first level list OR link */
#lang_sel_list ul li:hover ul,
#lang_sel_list ul a:hover ul {
  visibility: visible;
}
#lang_sel_list img.iclflag {
  width: 18px;
  height: 12px;
  position: relative;
  top: 1px;
}
#lang_sel.icl_rtl {
  text-align: right;
  direction: rtl;
}
#lang_sel.icl_rtl .lang_sel_sel {
  padding-right: 14px;
}
/* reset menu img definitions */
.menu-item-language img.iclflag {
  height: 12px !important;
  width: 18px !important;
  margin-bottom: 0 !important;
  margin-right: 4px;
}
#lang_sel_list,
#lang_sel_click {
  height: auto;
  float: left;
  margin-top: 11px;
  margin-left: 10px;
}
#lang_sel_click {
  margin-top: 6px;
}
#lang_sel_click li {
  margin-left: 0;
}
#lang_sel_click img.iclflag {
  margin-right: 4px;
  top: -1px;
}
#lang_sel_list ul a,
#lang_sel_list_list ul a:visited {
  background: transparent;
}
@media (max-width: 768px) {
  #lang_sel_list,
  #lang_sel_click,
  .btn-login {
    margin-right: 50px;
  }
}
.opensan {
  font-family: "Open Sans";
  margin-top: 20px;
}
.btn-login {
  font-size: 12px;
  margin-top: 10px;
  margin-left: 25px;
  color: #ccc;
}
.btn-login a {
  color: #ccc;
}
.btn-login a.logout {
  color: #f66;
}
.btn-login a:hover {
  color: #fff;
}
.btn-login a i {
  margin-right: 4px;
}
#customer_login .lost_password {
  float: right;
  margin-bottom: 0;
  margin-top: 10px;
}
#customer_login .pull-left .inline {
  margin-left: 10px;
  font-size: 12px;
}
#customer_login .pull-left .inline input {
  margin-top: 0;
  vertical-align: middle;
}
#customer_login .button {
  padding: 10px 20px;
  text-transform: uppercase;
  letter-spacing: 1px;
  background: #30d9a4;
}
#customer_login .button:hover {
  background: #333;
  color: #fff;
}
.myaccount_user {
  font-size: 16px;
  line-height: 25px;
}

.tax-module .lesson-container h1 {
  font-size: 20px;
}
.tax-module .lesson-container h2 {
  font-size: 16px;
}
.tax-module .lesson-container .lesson-meta span {
  margin-right: 15px;
}
.widget.widget_sensei_course_progress {
  background: none;
}
.widget.widget_sensei_course_progress header {
  padding: 0;
}
.widget.widget_sensei_course_progress header h2 {
  margin-top: 0;
  font-size: 15px;
}
.widget.widget_sensei_course_progress header h3 {
  font-size: 14px;
  margin-top: 0;
}
.widget ul.course-progress-navigation {
  display: none;
}
.widget.widget_sensei_course_progress .course-progress-lessons .course-progress-lesson.current span,
.widget.widget_sensei_course_progress .course-progress-lessons .course-progress-lesson a {
  padding-left: 25px;
}
.widget.widget_sensei_course_progress .course-progress-lessons .course-progress-lesson.completed a {
  font-weight: 600;
}
.widget.widget_sensei_course_progress .course-progress-lessons .course-progress-lesson.current span:before,
.widget.widget_sensei_course_progress .course-progress-lessons .course-progress-lesson a:before {
  margin-top: 3px;
  left: 0;
}
/*Events*/
.single-tribe_events #main_content h1 {
  font-size: 22px;
}
#main_content .tribe-events-list .type-tribe_events h2 {
  font-size: 18px;
}
#main_content .tribe-events-schedule h2 {
  font-size: 18px;
  display: inline-block;
}
.tribe-events-calendar div[id*=tribe-events-event-] h3.tribe-events-month-event-title a {
  font-size: 88%;
}
#tribe-events .tribe-events-content p,
.tribe-events-after-html p,
.tribe-events-before-html p {
  font-size: 13px;
}
.tribe-events-event-meta address.tribe-events-address,
.tribe-events-list .tribe-events-venue-details {
  font-style: normal;
  line-height: 20px;
}
.single-tribe_events .tribe-events-schedule .tribe-events-cost {
  font-weight: bold;
  vertical-align: inherit;
}
.tribe-events-event-meta .tribe-events-meta-group {
  width: 50%;
  padding: 0 20px;
}
.tribe-events-event-meta .tribe-events-meta-group-gmap {
  width: 100%;
  float: none;
  display: block;
}
.single-tribe_events .tribe-events-venue-map {
  width: 50%;
  margin: 0;
}


/*Edit*/

.quiz form ol#sensei-quiz-list li > span span.grade{
  display: none;
}

.latest-course .col-md-3:nth-child(4n+1),
.latest-course .col-md-4:nth-child(3n+1),
.latest-course .col-md-6:nth-child(2n+1){
  clear: both;
}

@media (min-width: 1200px){
  .courses-list .col-lg-4:nth-child(3n+1){
    clear: both;
  }
}

.strip_single_course {
	border-bottom: 1px solid #e0e5e9;
		border-left: 1px solid #e0e5e9;
			border-right: 1px solid #e0e5e9;
	padding-top:10px;
	background:url(../images/line_bg_course.png) 29px top no-repeat;
}
.strip_single_course ul {
	margin-left:10px;
}
.strip_single_course ul li {
	display:inline-block;
	margin-right:10px!important;
}
.strip_single_course ul li i{
	font-size:16px;
	color:#ccc;
}
#end {
	font-size:26px;
	float:right;
	margin:17px -10px 0 15px;
	color:#ccc;
	padding:0;
} 
.strip_single_course h4 {
	line-height:18px;
	font-size:16px;
	padding:5px 10px 10px 50px;
	margin:0;
}
.strip_single_course h4 {
	background: url(../images/bullet_start.png) no-repeat 15px top;
}
.strip_single_course h4.completed {
	background:url(../images/bullet_complete.png) no-repeat 15px top;
}
h4.completed a{
	color:#2d4050;
}
h4.completed a:hover{
	color:#000;
}
h4.inprogress {
	background:url(../images/bullet_progress.png) no-repeat 15px top;
}
h4.inprogress a{
	color:#2d4050;
}
h4.inprogress a:hover{
	color:#000;
}

.chapter_course{
background:#f8f8f8;
padding:10px;
font-size:18px;
line-height:20px;
margin-top:0;
margin-bottom:0;
border: 1px solid #e0e5e9;
border-bottom:2px solid #e0e5e9;
font-weight:600;
}
.chapter_course.no_margin_rop{
margin-top:0px;
}
ul.legend_course{
	list-style:none;
	margin-left:0;
	padding-left:0;
	line-height:30px;
	font-size:14px;
}

ul.legend_course li#tostart{
	background:url(<?php echo get_template_directory_uri( );?>/images/bullet_start_2.png) no-repeat center left; color:#5394c9; padding-left:25px;
}
ul.legend_course li#inprogress{
	background: url(<?php echo get_template_directory_uri();?>/images/bullet_progress_2.png) no-repeat center left; color:#949494;padding-left:25px;
}
ul.legend_course li#completed{
	background: url(<?php echo get_template_directory_uri();?>/images/bullet_complete_2.png) no-repeat center left; color:#949494;padding-left:25px;
}

@-webkit-keyframes progress-bar-stripes {
  from {
    background-position: 40px 0;
  }
  to {
    background-position: 0 0;
  }
}

@-moz-keyframes progress-bar-stripes {
  from {
    background-position: 40px 0;
  }
  to {
    background-position: 0 0;
  }
}

@-o-keyframes progress-bar-stripes {
  from {
    background-position: 0 0;
  }
  to {
    background-position: 40px 0;
  }
}

@keyframes progress-bar-stripes {
  from {
    background-position: 40px 0;
  }
  to {
    background-position: 0 0;
  }
}

.progress {
  height: 20px;
  margin-bottom: 0;
  overflow: hidden;
  background-color: #f5f5f5;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
          box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}

.progress-bar {
  float: left;
  width: 0;
  height: 100%;
  font-size: 12px;
  color: #ffffff;
  text-align: center;
  background-color: #428bca;
  -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
          box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
  -webkit-transition: width 0.6s ease;
          transition: width 0.6s ease;
}

.progress.active .progress-bar {
  -webkit-animation: progress-bar-stripes 2s linear infinite;
     -moz-animation: progress-bar-stripes 2s linear infinite;
      -ms-animation: progress-bar-stripes 2s linear infinite;
       -o-animation: progress-bar-stripes 2s linear infinite;
          animation: progress-bar-stripes 2s linear infinite;
}

.progress-bar-info {
  background-color: #7cbe31;
}

.progress-striped .progress-bar-info {
  background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
}
ul#legend li {
	margin-bottom:5px;
}
ul#legend li.legend_completed{
	background:url(../images/bullet_complete_2.png) no-repeat center left; padding-left:25px;
}
ul#legend li.legend_inprogress{
	background:url(../images/bullet_progress_2.png) no-repeat center left; padding-left:25px;
}
ul#legend li.legend_start{
	background:url(../images/bullet_start_2.png) no-repeat center left; padding-left:25px;
}
.main-img-2 { 
	margin:-30px -30px 30px -30px; 
	overflow:hidden;
	position:relative;
	height:200px;
	padding-right:15px;
	background:url(../images/single_course.jpg) no-repeat top left;
	-webkit-border-top-left-radius: 4px;
	-webkit-border-top-right-radius: 4px;
	-moz-border-radius-topleft: 4px;
	-moz-border-radius-topright: 4px;
	border-top-left-radius: 4px;
	border-top-right-radius: 4px;
}
.main-img-2 p.lead {
	background-color:#000;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=70);
	opacity:0.7;
	position: absolute;
	bottom:-25px;
	padding:15px 20px;
	color:#fff;
	line-height:24px;
	display:block;
	width:100%;
}
.title-course-2 strong{
	text-transform:uppercase;
	font-size:32px;
	font-weight:800;
	display:block;
}
.title-course-2 {
	position: absolute;
	top:25%;
	left:25px;
	color:#fff;
	font-size:28px;
	line-height:30px;
	font-weight:600;
	text-shadow: 1px 1px 0px rgba(0,0,0,.3); 
}


.pagination, .comments-pagination {
	list-style: none;
}
.pagination, .comments-pagination li {
    display: block;
}