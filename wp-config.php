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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'KuEwTAaMYrcRglvZQ29N/Poi9FRtXaYN6gx7D2zNssx3AiabuV7ZfG32gU8usPSzrB3/qpqhtk1iYP9JOcPEtQ==');
define('SECURE_AUTH_KEY',  'VmfF5NOJROJI34ZvkLu6u6re9p316H16ZMbOmdKTtxKaREhx4M7PDiC3eAqpZJdIEOi2MrVo4u6dXJRTMqtvXQ==');
define('LOGGED_IN_KEY',    'SUMGMmGis3lcBApvcO9RbUCEfRZlIp0brpgS/L0/PuGPp5othAHtJtL6oUvyVRfv5voCwmCih3uq5/l7JoN6iQ==');
define('NONCE_KEY',        '5FzmQ9VHQ5dltyDo3KMuU6776VW0POl2GkaFfqOVfgOFlitRRouwcUlnO8ojKxwUmrli6Ruu5LSTpjv0a1VRSA==');
define('AUTH_SALT',        'l9QPYlXdB6CJdWNQjGLMnK4xP8JF4RekoT7OFep44kCAOiBxUmjj3F/Z72AxLHrz+kW/cYWQx41/0dk85P6qCQ==');
define('SECURE_AUTH_SALT', 'NEo3AVio5s4OokvGnM0/tzAeGICsp2IPaJVDMKxK6Kue/hxQS1bT+2H3gAC8bmDhVasiGB5tq9Vu6X2ZzFTg7g==');
define('LOGGED_IN_SALT',   'A5eJJgqtUhPaFOsPQYxgl2Yj/xmG+XAn7888QRVUDCNEI22rKVoHH2CK67JQFecDjdNAme/ruDV0dsPYhsXJQQ==');
define('NONCE_SALT',       'CPpIww3z+VOJhpZBdjSVMomm2Sv4jmvBYL/ST/OeCgzVnpUs1g481AvsFtOhc2NafdvptgqCHdEhnSoSmTxPIA==');

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

define( 'WP_DEBUG', true );




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
