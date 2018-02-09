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
define('DB_NAME', 'dvishal_wp8');

/** MySQL database username */
define('DB_USER', 'dvishal_wp8');

/** MySQL database password */
define('DB_PASSWORD', 'E^PGePFTJfZEO^A]Gk~17&(6');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'oNehXP0kgzONfoFlLlfUdZAq45mTurMcV36M3iSN88oAaJh02ujHJVWZCOTGfyY9');
define('SECURE_AUTH_KEY',  'cHmVVp8TpbtHwAakCcoy5QtNYyQCYtANQPCF159JD8VlKfIX7QsTfCBLT5jYK8s4');
define('LOGGED_IN_KEY',    '2Qr5iiAix4vDIIwGuDQLlQSSEEDii5kR9PSi4e5B1pu6za131idjESdd7jgrTDDr');
define('NONCE_KEY',        'VgiTHKUYxik0txQHGy5Pg1ClQqqy3MrIDxguu7fbD5luLe6TuaJhm6C8hajlEFcf');
define('AUTH_SALT',        'CsxwGLnIYgweZFwjXEzOSBjEBrdgggquRqZoGO3NexTvfZbqdvcwxk6NTbKyZo7z');
define('SECURE_AUTH_SALT', 'PfpZnxyXl9DPa1MK7uiEQsKVb5GD5x09jtjTAgdQaTwpAHI3r1zTZoaOkqcGV8Ls');
define('LOGGED_IN_SALT',   '1TdfSODksVP5uq0e0UQVeJre6UNylTmG1zDIjEHMtHva9Tc9sTHbT6ciKeVcfyzi');
define('NONCE_SALT',       '27yKtFQ3IMR9kNSK32GgconEsnscnOpsGHOpe9GgO1dfscKLTPHyLLiSof4w7W7o');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
