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
define( 'FS_METHOD', 'direct' );
define( 'DB_NAME', 'tracecore' );

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
define( 'AUTH_KEY',         'H!a*7W04M>x#hl;6%zC!t6X|Wd-#%IhM}3>kZMQqy3G:jBS62Jnj=,}}#06`2.-a' );
define( 'SECURE_AUTH_KEY',  ',]bn%AE{6)/Hqf{$m7@ZN^UBGdh/9r!TNsKXk6 FFaYP6LQ59(uu>8)`Xl_ah.~W' );
define( 'LOGGED_IN_KEY',    'L{Ur`*5y,Uzh_]dfwgs@:WO>+Wz%<ti]0z_u#6]:84!h(!26HJPSF+/r|+)%f7aF' );
define( 'NONCE_KEY',        './v+#T$ooO>#Ox2m..)e=Y(RU2@A6@7tN=#WY}>|0T~IiVrPBh+1m|9}MvZ]F=$8' );
define( 'AUTH_SALT',        'X`#!Dp>t0+L.]5YaB(<fN6bA&tU9wHB2Pg@|/(WDTFp-9Zt }$+zMKQos,:CE|{6' );
define( 'SECURE_AUTH_SALT', '-xr{<knTl?(+yg.V)/1ez?ikh]4PTqwTau?URcrk RM@n4B`i?th9c7B~qS|Nou3' );
define( 'LOGGED_IN_SALT',   'eouL`lK3Um+6j6XbsvE2:w9(3xSi?/JJcp(k:eIV[,bDQ|6dWM65iG|1Dl2%[,Zu' );
define( 'NONCE_SALT',       'wIu[0og~o$XH2q+po~;vdg&0Q(l%[tV%[>G;>yQ,E-^JTS:=4As${AtE.ygH+CP_' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
