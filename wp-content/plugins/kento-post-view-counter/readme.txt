=== Kento Post View Counter ===
Contributors: kentothemes
Donate link: 
Tags:  Kento Post View Counter, post view by city, post view by country, page view counter, view counter, Post View Counter
Requires at least: 3.7
Tested up to: 3.8.1
Stable tag: 2.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Post View Counter by City or Country or by Date.

== Description ==

Real post view counter for wordpress post, page or custome post type






Plugin details and support:<br />
http://kentothemes.com/items/plugins/kento-post-view-counter/





Plugin Features

* Choose Unique or Non-unique Post View Counter(NEW).
* Display Geo Stats via short-code for top 20 city or country.
* Top 20 Country By Map.
* Top 20 City By Map.
* Referrer site hit count.
* Display Post View Counter to your Language.
* Top 10 City List by visitors.
* Top 10 Country list by visitors.
* Top 10 Referrer site list.
* Display via short-code only today's count or total count or both.
* Referrer site list where visitors come from.
* Filter post type to trace count.
* hide stats on content but still can trace view count.
* Total Post View Count.
* Total Post View Count Daily.
* Top Viewed Post List on Admin.
* Top Viewed By Date on Admin.
* Recent Viewed by City on Admin.
* Recent Viewed Post by City with real time and date.

<br />
<h3>Pro Version available with more feature</h3>

Pro Version Demo:
http://www.youtube.com/watch?v=tXm0GOSrMMI

Pro Version Link:
http://kentothemes.com/items/plugins/kento-wordpress-analytics/








== Installation ==

1. Install as regular WordPress plugin.
2. Go your Pluings setting via WordPress Dashboard and activate it.
3. After Activate Visit your Single Post.
4. and after activate you will see menu on dashboard "Kento PVC" will get stats.
<br /><br />

<strong>How to use short-code?</strong><br />
To display views count manually via short-code you can display only today's view count or total view count on single post.
Before use short-code you need to <strong>"Hide Count on Post"</strong> checked and <strong>"Trace These Post Type Only"</strong> checked for custom post type<br /><br />

And use these short-code as your need<br />

<strong>Display whithout customize</strong><br />
`[kpvc_single]` <br />
`<?php echo do_shortcode("[kpvc_single]"); ?>` Anywhere on single.php or custom post type single.php
Also same way you can php code for bellow shortcodes<br />
<strong>Display only today views count or hide total views count.</strong><br />
`[kpvc_single total="no"]`<br />

<strong>Display only total views count or hide today views count.</strong><br />
`[kpvc_single today="no"]`<br />

<strong>Display Custom text for today or total views count</strong><br />
Go "Kento Post View Counter Settings" page and add text for "Text For Today View" and "Text For Total View" and save.



<br />

<strong>How to use short-codes in loop or excerpt mode ?</strong><br />
To display views count manually via short-codes in loop or excerpt mode you can use short-code bellow<br />

N.B. We have removed custom text adding feature via short-code you can do same this by saving custom text via "Kento Post View Counter Settings" page

<strong>Display whitout customize</strong><br />
`<?php do_shortcode('[kpvc_loop post_id='.get_the_ID().']'); ?>`

<strong>Display only total views count or hide today views count.</strong><br />
`<?php do_shortcode('[kpvc_loop post_id='.get_the_ID().' today="no" ] '); ?>`<br />
same way you can hide total count by adding today="no"<br />

<strong>Display Custom text for today or total views count</strong><br />
`<?php do_shortcode('[kpvc_loop post_id='.get_the_ID().' ] '); ?>`<br />

<br />
<strong>Display post view counter number to your language</strong><br />
You can display post view counter to your language, please go "Kento Post View Counter Settings" page and <strong>"Numbers Language"</strong> box fill numbers as following 0,1,2,3,4,5,6,7,8,9

Like for Bangle: ০,১,২,৩,৪,৫,৬,৭,৮,৯
or for Arabic/Persian: ۰,۱,۲,۳,۴,۵,۶,۷,۸,۹

** Please do not change the numbers orders otherwise it will wrong result for post view counter. 

<br /><br />
<strong>How to display Geo Stats Via Short-codes ?</strong><br />

To Display GEO Stats on page or post.<br />
`[kpvc_widget_geo  geo="city" width="500px" height="300px"]`<br />

parameter:<br />
geo >> city, country.<br />
width >> width for map area(use px or %).<br />
height >> height for map area(use px or %).<br />






== Screenshots ==

1. View Counter on post.
2. Admin - Top viewed post and Top Viewed By Date.
3. Admin - Recent Viewed by City and Recent Viewed Post by City with time.
4. Settings page.
5. Top 10 City And Country List.
6. Top 10 Referrer site list.
7. Top 20 City And Country By Map.

== Changelog ==

= 2.7 =
* fixed bug.


= 2.6 =
* Added pagination to recent views.
* Timezone update.

= 2.5 =
* Color Style added.


= 2.4 =
* fixed problem header already sent.


= 2.3 =
* Select Unique or Non-unique Post View Counter(NEW).
* Some Spelling correction(Thanks to Mr. Brian)


= 2.2 =
* Add Widget Via short-code to display Top 20 City or Country Geo Stats anywhere post or page

= 2.1 =
* Added New Stats Page.
* Top 20 Country By Map.
* Top 20 City By Map.
* Count visitors from City And Country.

= 2.0 =
* Referrer site hit count.
* Top 10 Referrer site list by Date.
* Problem fix rank count start from 0 to 1.

= 1.9 =
* Fix WP_DEBUG Error.
* Added Top 10 City on Stats Page.
* Custom text for total and today view count via setting page.
* Removed custom text via shortcodes.
* Display Post View Count to your Language. 

= 1.8 =
* Added Top 10 Country on Stats Page.

= 1.7 =
* Display Post view Counter on loop or excerpt mode.

= 1.6 =
* Add Top 10 refer site list.

= 1.5 =
* Add Shortcode support to display single post.

= 1.4 =
* Added refer site to details report.
* Added send us feedback link.

= 1.3 =
* Added icon for total and daily counter.
* Added New Page for setting.
* Filter post type.
* Simply hid on post stats but still can trcae.
* Added different stats page on admin.

= 1.2 =
* Fixing problem with Pagination

= 1.1 =
* Added Paginate "Recent Viewed By City & Country

= 1.0 =
* Initial release
