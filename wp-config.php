<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'olaplexlocal_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'H[4Yh4dyD)xaZ:7-th~+~FBK/}p=0ryt]&Yu(ett^kAp31>0S,aK&}KK%2!jaD8#');
define('SECURE_AUTH_KEY',  'U8Y=LSns[!/P,#p8onLBw+D0xJZnPA1Gw,*,kA*0sm72/Bx^ku%4D(e522S[HGwo');
define('LOGGED_IN_KEY',    ' 5|HTLH]f.L]3GKjxV2A7uTL.q(oqP6]+|J{~B8;uJA=9.QWqBTJHKLi<GC/`&HW');
define('NONCE_KEY',        'qECZ(B&S1laJ4:,_j+F4VA}vB1FV8[*{0Z,-&sfHYBHSnf(RL&n4TE6n3=;4I-&6');
define('AUTH_SALT',        'MdT@4P-j;*fz=HC|WqcrvktF;}SU#gQhhCB[X+,z`JHQ/2 ?k~kx%Gg,WB:ATp`#');
define('SECURE_AUTH_SALT', 'r3B$TSz>7tBG%04AcVvRBi4$-G-mf%2IC<a$O@y1([rO;7x_Y?ORcL$/q}1>+Lg}');
define('LOGGED_IN_SALT',   'N*#Q2&@|REsV&NxkqE5Wj(_;@s~r1Q:~HiKx<GJ@7]f.%/|2$mnxPc/Lzq+.iBt4');
define('NONCE_SALT',       'fQc51F9VchiE3wJe)b1zwQ!]-p28_q,3!@d0*;.zPyA-XCDg8t4Zn_)w*KU #hM3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
