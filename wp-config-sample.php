<?php

/**

 * The base configurations of the WordPress.

 *

 * This file has the following configurations: MySQL settings, Table Prefix,

 * Secret Keys, WordPress Language, and ABSPATH. You can find more information

 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing

 * wp-config.php} Codex page. You can get the MySQL settings from your web host.

 *

 * This file is used by the wp-config.php creation script during the

 * installation. You don't have to use the web site, you can just copy this file

 * to "wp-config.php" and fill in the values.

 *

 * @package WordPress

 */



// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define('DB_NAME', ‘your_db_name’);



/** MySQL database username */

define('DB_USER', ‘your_db_user’);



/** MySQL database password */

define('DB_PASSWORD', ‘your_db_password’);



/** MySQL hostname */

define('DB_HOST', 'localhost');



/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8');



/** The Database Collate type. Don't change this if in doubt. */

define('DB_COLLATE', '');



/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define('AUTH_KEY',         '7kUqH,%kp-7 IOlj,q_=?;P{?}U1t-=`c_SJ~C5DRKorkA|(iI(M6+gJs5f) zMU');

define('SECURE_AUTH_KEY',  ':h?6)pP&_,|QhPq`CF-mLLJ!.8YEP5<n8HT^QL@e0!$R}yb*4V-;e*-o@hDn=>,z');

define('LOGGED_IN_KEY',    'ZhC7LU)l*x%l^(@wTs7RE.q[QaCR^+qr[<o0AL($1KNg4H~wS*{SD%V{+?IyY|M-');

define('NONCE_KEY',        '|DAO#B69-nc2gC+mo9%.Y@Q/eFT/1$Gq,pl/zW<bi{FE:3d++NRZMktbm!b2+uF(');

define('AUTH_SALT',        ';3+Z$1p{!5`,w]QxG||!vXY//v-w]=!Qi{W)|5cZ{BL3-(#-nI_QGSzFNc1|<hDA');

define('SECURE_AUTH_SALT', 'U>Vo-ZSZ|H#I4h iADB^x:e/%&8*iU!`{4pR3Y{+=Jh=t(++p:*|X~VIe97CZokv');

define('LOGGED_IN_SALT',   'AHbrT%lQB./G|8)s$<n;^/5ca(3B-k!UnSt b8Bwy5>V=5|>N-Q.B@_R4tJ1)#W7');

define('NONCE_SALT',       'Yq_jaL(KF#*9}|)m@BPM8!}}x ym+/}LH#h3m|>GJNm0DrAXgnOFWqdihoR4|Q!`');



/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each a unique

 * prefix. Only numbers, letters, and underscores please!

 */

$table_prefix  = 'wp_';



/**

 * WordPress Localized Language, defaults to English.

 *

 * Change this to localize WordPress. A corresponding MO file for the chosen

 * language must be installed to wp-content/languages. For example, install

 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German

 * language support.

 */

define('WPLANG', '');



/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 */

define('WP_DEBUG', false);



/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');
