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
define( 'DB_NAME', 'genius' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'MySQL-8.4' );

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
define( 'AUTH_KEY',         'Q_mbKMJD9*c9lilR~RR<!u>5~Z+h1pq2c3$/^;oH/O+_?$( )p!rUT)d RCryEVH' );
define( 'SECURE_AUTH_KEY',  'JkMxAX0xEO$|0r:vokil1-a*y%rynq6nU1qiVDM<TEY+@ks0ds>?87wfI6hE|.Yb' );
define( 'LOGGED_IN_KEY',    ' `-]w(F+IX@?k&gDnpV^`pxxyP@HQZ2bj){H5 ~Lexdx=iM*G|}On,dc;i(%;c1W' );
define( 'NONCE_KEY',        'Z]nbD~hX!w|YFR4LC-{]9weou#}vJb5PHoA:_.y~L9P~hY3];t[%Oouk0}W5U$mo' );
define( 'AUTH_SALT',        'PQi)S}el6D8xYp/tO]z^HJj:E.@!D3jpWdK>*0F#+GuG;)Mr39kIL/H]WR)r p{&' );
define( 'SECURE_AUTH_SALT', 'GIyx7zaOKLLvS$N# emrtq (nwG5PluQc!CRh.@wBm&u!=#/danXw2a}&Fiv{;k=' );
define( 'LOGGED_IN_SALT',   'G0u/YD|Uk-<<Lj##=dxYroRSyE?P_}x&T:k>Pyjh-:dXvf?vWJzlk5L7O!&oyy!F' );
define( 'NONCE_SALT',       '}pn1GiB+?`$]Pqm%JPV%#xD+|C(H</@G`ejP^;pZFTEe9f6fl/}!M-za#DlHV:6q' );

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
$table_prefix = 'geni_';

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
