<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

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
define( 'AUTH_KEY',         '(Vl.`}oJwDem$ot CXeW&P0}9?XdY-@zz?$/?Xlw)k(ym~H64^;l7k_k U0 3HvR' );
define( 'SECURE_AUTH_KEY',  '/aG*3QKK^)+ vue4+%7<S<uqKTtDI(b-}X#^.=2BtxA8Ic$iKHoiGslJ|UPQ_;o%' );
define( 'LOGGED_IN_KEY',    'Bq7,?y-YQ}hB]}5+t@Je b:~v!U#_lg|L@J+j2`3V3e2Q|:tbId9)P43v`|H;T(}' );
define( 'NONCE_KEY',        'y1~_C;%7!9HVFfi]&?L+e}1|{u:4(Zr,YxwlNu(heQv}#dEzSt6NgybUPiT>2Jt3' );
define( 'AUTH_SALT',        'D0BI <)aZ@0,)izKn@`7rym%ntJw_i=a,eR5Q:m u~fUM(#SU]J&RcTyUV`4[UTB' );
define( 'SECURE_AUTH_SALT', '1(Z?J&SZxvxR9j1$M*k5Kw$9Aohk9<)(?D1*RWb^l]<Eu:X]]A<+0/W8@Au  p?5' );
define( 'LOGGED_IN_SALT',   '=9r1BZB}id,/[s,z^.}{c#urL6A2e:+Tl`eX/mf7]n+oZ>LTEmmFDbmOE,_/*|uM' );
define( 'NONCE_SALT',       'y-$g8rW)fVZ+]V;1C.&*3 l:o8n6]>@Lh0^Ri673;:.)mxOqB9s_242z~k()YhuS' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
