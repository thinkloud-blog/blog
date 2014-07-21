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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '4,C),uHiq4j@H_S_R3sw1M@FqAt %{8H,l?nst9;FJ?D<m@!Uube:9TY+k@&wdg2');
define('SECURE_AUTH_KEY',  'vl?a{u5)RwT{ZW6svqu3Ji/&hi8+<M|y{z8`G/z aXNH=8V_gZcI8CSN~x7oV^L-');
define('LOGGED_IN_KEY',    'QmVd/wFO%<s#Ag8[P0^f]HK-kMO{rEZ(!D{Gi+P saT<&j+2-/C$+gFf;4GiLu^@');
define('NONCE_KEY',        '&4C:U}$W5OC]tE`>%(aM%RC;7Fsou1%gZc}Ab|n)3H-K+5i?)QwkmIZ.][LzRRQq');
define('AUTH_SALT',        'J@1)W:gI}5DoPH7+%W|!Ju|5dR_oiC^Q#-[NJBCni7~H+}!S1]/jmNh#@n5>x8.b');
define('SECURE_AUTH_SALT', '2|Tp[79l_T[1,.WJ3t;5|cOnN`fsH!t2[EmX38wCp9MpyF`Xk`I+-mr[3NBKK+p/');
define('LOGGED_IN_SALT',   'nr{]7G^57Pr:un@YGdmMVE)tD$?8W>v}#F3WvyA=]p]tVUR|94A-hVY]2cloe36q');
define('NONCE_SALT',       'y3hQk(Op%b!D.`2w[IiL+|#~LmGU14RRo#!SP)-x+!UoM0,lGE2.BW`[I,%1[-qW');

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
define('WPLANG', 'fr_FR');

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
