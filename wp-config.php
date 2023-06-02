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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\xampp\htdocs\wordpress\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'Darusshifa' );

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
define( 'AUTH_KEY',         'K/e{BvsQqQ].l %(3{[/Ib&0(Ebg[n:!4f^uNIOL))<[*Fl+I,>B5_<RXW&>[<Zb' );
define( 'SECURE_AUTH_KEY',  '_j,gvG(D`eSgTmn63R{wR=<CGv(p((V{xBf!=J~W&|hiA<>iAv.(ZZZfoaR!BZ?v' );
define( 'LOGGED_IN_KEY',    '/mh/p*Q9R*Ea~2[E~$k4<s*7T)ioV]@8MN~&CD[6r%5J=+&z2Q4/nht`jQz@{{:?' );
define( 'NONCE_KEY',        'oWt3PA6kst[Cxw4B`?dlg42R+ @$fF0J)W>Zv,=AuG7+7k:1I/d3;)cb@%<BLg:}' );
define( 'AUTH_SALT',        'N,tfO}%ode}Is__=keL? g3 OrMWjU,E=Z=`C2LfUav4o2hcc@xFv@%}TEIN_SB=' );
define( 'SECURE_AUTH_SALT', '6zMY;/( f`nF/TK.|Qu#/-vA LCI$uoY!vi672Vf;IG]pR(W)Qe?mdiZK&}MUMaD' );
define( 'LOGGED_IN_SALT',   ' RX/*aa0Yy-tA%Q~DZC~`ge.sIxYO.$.G?K!bU0q.~~@DN#V(P](iC>><Wf3W>/}' );
define( 'NONCE_SALT',       'Ql9>gC$7w:P|e1:Y<Y) HzU>paJt:m!eD.p[0PMRQ1m[J0&5R:*sC91CF@/y_fcM' );

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
