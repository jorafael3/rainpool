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
define( 'DB_NAME', 'rainpool_db2' );

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
define( 'AUTH_KEY',         '9$.3tb<upZ<_=aWl>?@.tV/m|Ki2 Q^IIF)&:1J9I5Rj8yAm|D-<E[}cB+!Sqzf{' );
define( 'SECURE_AUTH_KEY',  '=yT#*O+&Mck3k1YNY4+zG~kAm3KSY7]SQU&XwMEq2]ya3)>FXxk|*hYO>/KN+X<X' );
define( 'LOGGED_IN_KEY',    '5F2|I3y~l$KbE}N$2|dE@zLm|vg,UI*/CZV+93+kF$Y*S-7U6-,Y].e%fj_ae%Gr' );
define( 'NONCE_KEY',        'cxaUZ,_K^Tg,4[lGXP{bM|cHnS5RG9s`rn)y>g>$g.B&il^N8gcczC|J4,c6!49&' );
define( 'AUTH_SALT',        'tge>Gigug_PSgjLi-2&n#wvE6wk;Ef<&124e#?P[7R4G`Sw%*+w#%67yd;C[6Y.$' );
define( 'SECURE_AUTH_SALT', 'lslkgQL|]L/}(+/$~|w6&[]!h+0+tcT<FtwUFI%`;j9wnqQqwQ~DWY.q{l=Q&GLt' );
define( 'LOGGED_IN_SALT',   '9,3LX,##}D2pyAnU;%Xa&6#9y6Duhp#IfbKRrK+|[d8U]@znTP2qI1130N5dc)D4' );
define( 'NONCE_SALT',       'rne~M)$)_.qycAk-L0g);3}fO,(*]d~yJimVzqOvGg_Sbt4Hb.tOB.N`eL/+NjmN' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
