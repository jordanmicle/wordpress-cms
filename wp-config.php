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
define('DB_NAME', 'aldabra');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[:%-}=GRN<-g1b&^I^_9~IjoA5b_@YwD?mR+:-hJwTF9?)ml>3*|A8O@.l%rbNIi');
define('SECURE_AUTH_KEY',  ';p{.vqBf*Cq4i+@ae&|Q<r@Dk_!9[g}(|CFnr#<!bdmffRN`,C!ALZ8&:5JqC^69');
define('LOGGED_IN_KEY',    'vKw+$l,%L[S1rCjo;UO1lKDLu4*Lth66:Mq{-+;&7K:zq)3*8qqipBQ8fUPs_nAu');
define('NONCE_KEY',        'f$Oe!/_xN/Pe`9V@xyFWe1MRiAAbODo}tN2cj>fV,XLR+04e@PlR_~<BU8KF,y4R');
define('AUTH_SALT',        'rF0Bv:eHH)KWtbSzurk@OrpHzNgNP4!J`FM;<--~+*k~Y.ceQLE->>X;g.4},kH?');
define('SECURE_AUTH_SALT', 'MD2wO/iT.oa8^D.Dp_{7ck-4*L:F![o/rE&Z%GK+k:y$IS%SeFzfV60@FFw[z3P]');
define('LOGGED_IN_SALT',   '?;1F+uD_4o@K+A}dA:W!G`EdMzH02!u7-Us*l]2vwmVy:d6!(8A+5*n~73~K< ?<');
define('NONCE_SALT',       'W%,?sYrHDg+8wK57XR$*+1sn0[vqYj,!^^8{48E!{ o{HL`6Sk,[rC>+B(syq)f0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'db_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
