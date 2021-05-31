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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'beautyandthevince-db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Ta+OzMT_#BJrkT_,[IYlz{jhkk_d+V$pT=Dc*ahsJQubJLf3pd+TeC|8dhGWaUiI' );
define( 'SECURE_AUTH_KEY',  'I[~(%?:`.vKDq1**i|9j!(b_A[qTD]MQ%N #hjh<SFK||nAW^uSM?$L?u{vY:2jK' );
define( 'LOGGED_IN_KEY',    'krF.MHxbj%}P6=/08u%SDXO,>*VRel)xk3-z<-n&kqz0h8ywJH>dR0nDj_KC3[c*' );
define( 'NONCE_KEY',        '(dj*{57[7{/ZJS_AZOGq.m0N_?{ShVu`/f{SUfm3Ne*=EDaw .|p$M{+xJqV~ErB' );
define( 'AUTH_SALT',        '7mU$Ly@Fe1tfHqNEz5L{jY@A1#xP]S-~{hHyI<Q<= {tH.BqX7gKQp^[|1*UNdc&' );
define( 'SECURE_AUTH_SALT', '#rI{_yR1uj%O>cu$uqU(1Fxx{J~F.j|O~Eu:bqrDpr[CA{B(C_Vhi^X,(_z3Bt^X' );
define( 'LOGGED_IN_SALT',   'r[;0vrSa3)Dcv5Ho./${[-aAEi!m2)._&QNVSlAQXE5c<0Xa5--We2Slsqx72mY*' );
define( 'NONCE_SALT',       '[_-M,1f?[#GUQF{/T L_4*kaxHcXDR1]&X+?5L_N$b5r<`{<H-{7-X0H$|pN{&=1' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
