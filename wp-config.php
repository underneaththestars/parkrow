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

// Define Local Server Flag
$_CONFIG['LOCAL_SERVER'] = (strpos(__FILE__, "MAMP") !== false);


if ($_CONFIG['LOCAL_SERVER'] === true)
{
	 define('WP_ENV', 'development');
     // ** MySQL settings - You can get this info from your web host ** //
     /** The name of the database for WordPress */
     define('DB_NAME', 'parkrow');

     /** MySQL database username */
     define('DB_USER', 'root');

     /** MySQL database password */
     define('DB_PASSWORD', 'root');

     /** MySQL hostname */
     define('DB_HOST', 'localhost:3307');

     /** Database Charset to use in creating database tables. */
     define('DB_CHARSET', 'utf8');

     /** The Database Collate type. Don't change this if in doubt. */
     define('DB_COLLATE', '');

     /** Debug on local **/
     define('WP_DEBUG', true);
}else{

	define('WP_ENV', 'production');
	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'parkrow');

	/** MySQL database username */
	define('DB_USER', 'parkrow');

	/** MySQL database password */
	define('DB_PASSWORD', 'H)(T,0Sg#1*}');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');

	/** Database Charset to use in creating database tables. */
	define('DB_CHARSET', 'utf8mb4');

	/** The Database Collate type. Don't change this if in doubt. */
	define('DB_COLLATE', '');

}
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cflftmxf5bhqdcxz42cooma2sdoabgysvcmrapyzmnxoxwdtz89kaattqkgne3a1');
define('SECURE_AUTH_KEY',  '8m5h1r2cnrzvobnmdfkfejlkiqyedg2go9mwh5bk5r9xsmvfpc67hvlzxbbkmzos');
define('LOGGED_IN_KEY',    'gw0wyp3galy9w4sawynvfodxdcwo5xg5frjsokw9kajv4v5o6akqyfdlsnzmqc70');
define('NONCE_KEY',        'yyant7cj0y7wztd7e1pwtuhe76vwto2gvgqmyfya12gvmietxez0uf4z29k6b6kq');
define('AUTH_SALT',        'hf7bvjjnuhcfgje7w4heafrwwmkxnoxgfynacbh4i3wdds3s7c8eixxvpwj2l19d');
define('SECURE_AUTH_SALT', '3buek5jniyjmn8irsvdheibdwz36ripkwrhxct1oxd4wa54pv8rc2glse41gf2gk');
define('LOGGED_IN_SALT',   'bcout29mvcd0cs6hofcyfjmkstlswxb25wgbkorzrw9mx6swceraqqvmpgowl66s');
define('NONCE_SALT',       'j2idhpgvogn8enmzavjlmcdwj1cdl0mekpbdpev71jfzq9hu86owlal1ibggfnjt');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpx_';

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
define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_AUTO_UPDATE_CORE', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
