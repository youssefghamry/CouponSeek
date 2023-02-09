<?php
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'CouponSeek' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '|_5NT`2wF9t%cUj`.rxd3:uCGF!0opaSq#u5|Pc2DvvrSEYNzoRl2Xin+Ee[h8CZ' );
define( 'SECURE_AUTH_KEY',  '[@Q53I%bq m#vE|z0r/HquZmgp;0X2K%{`@|X%zh6/9<1N)or67|,MdQ;w.q>LW2' );
define( 'LOGGED_IN_KEY',    '&I))^yPp<*GK&r{tLhg^$l^yx`GWgA;%9g& j7AYwZN{?_@&FShbZ`Qc!A@)>|SI' );
define( 'NONCE_KEY',        'wTSob?tE]B)uQii.rj )2VEFn;V#Li)$W)G1;#Bk]SUPpa8ZA()8p_3s,3(.yyE]' );
define( 'AUTH_SALT',        'q7!/YxEVyE=Q*/ 2lm(rv0f%_~E:c{[=8-m#Di5{hwxj)U~W#gsT6fb_2$vem6Sv' );
define( 'SECURE_AUTH_SALT', '7&1D+q4A#&T6J ]p3hDTzeweMHp)Ab:L1iQqwD8IKmdx:xC5M(AYG/B<%M^{fl ;' );
define( 'LOGGED_IN_SALT',   '%oK6SgK- _,d@I3I|}oMQS;Qt~x>*]^.mAf|e]Ce7oKM3;(>V$SE)9gl#bmQ4(W^' );
define( 'NONCE_SALT',       'z07mrDpJ0|2G1X4F^&cskbT*]Z[[H:(5Gr<T=KNidwUVZaQz,_t4D^4CUC}ZT:!2' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_CouponSeek';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
