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

define( 'DB_NAME', 'wordpress_app' );


/** Database username */

define( 'DB_USER', 'root' );


/** Database password */

define( 'DB_PASSWORD', 'root' );


/** Database hostname */

define( 'DB_HOST', 'mariadb:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         '?(Dkiz4.]4DNv=~R#/{4i1pnm bVe<qb5k?c%_CpoHo9y%!TUVANxeAc(XZ`Ml5V' );

define( 'SECURE_AUTH_KEY',  'khR0GYTCWF:n,]y9E-z53ke]bq5&VX2,6`nhYP>TkfM@,7ab?v/0YoP5;LVmxM @' );

define( 'LOGGED_IN_KEY',    'nJwLfdMml<ywVCV=Rf=M4>SlK3k Fo4F:FwjSd?_YR O[8PmP{VOxaJ~<.-U6<I$' );

define( 'NONCE_KEY',        'k3eZ0@}=vQV[6}sfF78<4z263vIo0Zw*OYaG5e,-!%lMUs{$M^Gb:hg7UL:c1A3e' );

define( 'AUTH_SALT',        'W@**|7Xwi,nq{zQ5jw8^Xj(XL1c8EmqZnS/;_:,ydiGQ?0<UfFOR`S>(Eii1X:Zg' );

define( 'SECURE_AUTH_SALT', '.Ly?~k2.J_*^;QW^dXv`00w4/*W*{b->#LS?Bnf+OHbP;f8&Vp%rc*`CY?wN-*_Y' );

define( 'LOGGED_IN_SALT',   'LdFxu^M`{C9`gOQI?LwGb-,:e#MCMIf##b<1 B:@+cO@T(Cp$)^^Pj^SN}({GxCj' );

define( 'NONCE_SALT',       'Nx]In)9>7UB<%u*f<6D|#31p6rQ~:I;76ICQ*)-h#I{,xV^EKA9f|!G_@8SUXq.n' );


/**#@-*/


/**

 * WordPress database table prefix.

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


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
