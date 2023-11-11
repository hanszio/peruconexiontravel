<?php
if (file_exists( ABSPATH . "wp-content/advanced-headers.php")) {
	require_once ABSPATH . "wp-content/advanced-headers.php";
}

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'peruconexiontravel' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'l$^xZmy<KMIf54s0m|7^X*#~UG.z XM3YDUx-G3&N7OJ9&|Jusx0]zaB63WT 3du' );
define( 'SECURE_AUTH_KEY',  ',)10^_>FN[ K:NOx8~Igd14anj7W-%m`Z^)TIEiax#@cA@&VAdTU# @BxEJ+0M}E' );
define( 'LOGGED_IN_KEY',    'pqqHoN66/2vGk|Ds[oW=,4zuhdqWM!<Oa@!7ui?b8,)NJl!>lRlgPH*1::GvDOFn' );
define( 'NONCE_KEY',        '<E9qXDb2@]0-^R:>5[,vu!+Mt,- <*V83OO p/h)z0>h^-z9~2b#(7><6kvJL J4' );
define( 'AUTH_SALT',        '5?1MC(g`fr__qP?GEaR.?m[X}hO{VPa*.]s:j)sw=S!wgUo#j;KH+:wP0+UX?$Gk' );
define( 'SECURE_AUTH_SALT', 'uL;bT,LFLHq60w]KPg:RaJ)DF4Rd#C_brR]P&2;QUO;CJtD)cPT`Z2.)s+=mg=B?' );
define( 'LOGGED_IN_SALT',   ')eXBH5J;x8q#sX8BgN<HoN8ub9=2gNTkn0]>]*N4e4eKJZ:*Q)=!0Pgu&9GpgUlX' );
define( 'NONCE_SALT',       'SDMlU>GCRUT,03he}miYL-gi$ 2HZXFH!#p>>d6ruwwbe3n[Mno:n4VNKw|n h~Z' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pcta_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
