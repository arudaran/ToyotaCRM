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
define('DB_NAME', 'wp');

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
define('AUTH_KEY',         '=eN}F0Yd-O9pE)+[jF={$630Yh;PvQ#ls-2hp-jE)Q7?eN8dx,nve^_^gwlE@NY ');
define('SECURE_AUTH_KEY',  ' yob4$$rT6|sE7,U90)@qaD(6#.mj1o!2ht-!<!m]/x*<BR`a!;XW[ay7w23n,Q;');
define('LOGGED_IN_KEY',    'XBtcP-5) (ryGYWDa,*w:TzSY+*MQE&gts_X$5?S5(|U]sx#PguR}Fk%Ky6pruc^');
define('NONCE_KEY',        '&t^!|p@wDS$&n|On-MmGA|jeHmn03bu 5rn_&s)>bCFb_{&8m+4_j||v(>k~^^Z ');
define('AUTH_SALT',        'L=)s$:1monpRJ@6vwsIsr<fS#R{c.&owL.Tg B#ljBC| jxjF^&XH.Mo)HL0+vEG');
define('SECURE_AUTH_SALT', '9hq6-gTRiBZ$ivy!rAbXX`9W8}0ME/0I{bec1k-@.a)60.X=BY{+syd7:do_DC{;');
define('LOGGED_IN_SALT',   'eDgo0qd&XB&R38|a.zrtMQGQJdMUEx *`42kgEK=<!MGD6MZL:*MZomw?i=*JB+c');
define('NONCE_SALT',       'e|lQ*(LZ_N })^CZ(%c*o=$Zu/P+x>5MEg<Q{>Kl^XT_2xHi_Q?fb $/5QzH!>:!');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
