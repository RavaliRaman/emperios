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
define('DB_NAME', 'dvishal_wp6');

/** MySQL database username */
define('DB_USER', 'dvishal_wp6');

/** MySQL database password */
define('DB_PASSWORD', 'N^utG@q#4IxXfGzSBu@70@~2');

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
define('AUTH_KEY',         'QlxSlpOQ2Gg7wxFT4wmKfNP4EBjUJ2Qclgd3n3EjnFkjmonBtgIAsLLuRNdXA3Nw');
define('SECURE_AUTH_KEY',  'N1DkKi1xFS3trRxrjifMKwlW2vVs5CaclyDUVKH4besP7A0p6N2AeRERWrUKTQO9');
define('LOGGED_IN_KEY',    'V2uGDx5bqqo0nxvrIUw4EKK2PjITv3ZF7eACsaV49TiM5BnqorCLm33Znlz7BcaQ');
define('NONCE_KEY',        'EmhnpzPyC66fG1Di3iFARR2Kcu6hqxiJ1rDZmHpiTSVKyKVwHRc3t2tWgBTsvfhN');
define('AUTH_SALT',        'hX5B67VmBbU09yOux0XFK8Rg7ew1dK7zMo9OLp9jKIqplkCuXKpjaHvhV9e9iNsc');
define('SECURE_AUTH_SALT', 'xD6friBab3SNpJXfKjSI1eQxL4xsVbcm1xkYFpOeOlCRAPzq4C6vf0SGSIZDcNje');
define('LOGGED_IN_SALT',   '1wDMtKUBsEGhEsKOa6CJQPawn45qVXl5DAX7BbO3nDUyOe39BTmlZQLxy5pucbn7');
define('NONCE_SALT',       'BSs8EtEvyiL5S80tTfcAbeMWIMhMhyapKBRdskuo5CaDo5IdX5AFX3Ltzr0PAObG');

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
