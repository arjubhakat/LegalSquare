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
define('DB_NAME', 'test');

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
define('AUTH_KEY',         'w`vS,Lg,u$!:v~V y%;MErZQ~<,jn,eFog&hYivK>%BJh{XX>ibM0qu)c,;&,4lo');
define('SECURE_AUTH_KEY',  '*Q?@>Jl/={k1m?Xi9+/*(<>Ul@rwf`$cNl/n~sex15$n#Qxt6&$ >4[c4]a?:W*M');
define('LOGGED_IN_KEY',    's~*r@-@?lN}H:WRBYUj]5X21VDIlCwMXgP>b4GGcS}oSoD;IpIyfG?MV}zuY#{=P');
define('NONCE_KEY',        'K4Nb4&w5<RUWO/siPf^E:MD$,nu6IUI24)xH[3,5n<d4Sy[Rk<44AZom?.GJj/j ');
define('AUTH_SALT',        ':O[2{Hay,$2p-0 ywW1lf%DZ;fNI3IB? ClMh K4%hFNe%D[nJJ<~%z3B3YSVmC-');
define('SECURE_AUTH_SALT', '`~VrscTu}2naM~bl&i[s[U{zzp_ Ghgg:z_bA;/5me}Bi}$PyA=7@%A5~43Ph]6%');
define('LOGGED_IN_SALT',   '&W{fu9],_wc`tG$@-fL)|ixKgxoUX/UL/e^4><JP(glq1IYZL}a(XpuOSkUPaPc]');
define('NONCE_SALT',       '-s.sGvrbt].us_uIk(>Hk!~_R`<AUa)k=7<]AhOo6nK=dIqt_`%GDVn^CU{)^bXw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_basic';

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
