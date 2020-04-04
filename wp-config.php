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
define('DB_NAME', 'husqvarnjx410');

/** MySQL database username */
define('DB_USER', 'husqvarnjx410');

/** MySQL database password */
define('DB_PASSWORD', 'Motorcycle974974');

/** MySQL hostname */
define('DB_HOST', 'husqvarnjx410.mysql.db:3306');

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
define('AUTH_KEY',         'k7fYyuY5tZvLwDINTYq0fC1LTwsOzPQEhcvsAX3PI03PvSCGDqOThIV+16O1');
define('SECURE_AUTH_KEY',  'dBuBJtfAdDeDnDNO7iSqDyTeQd3PDtE9EtQKjlkQnZp447VkRla46FHU/1Tg');
define('LOGGED_IN_KEY',    'Da546+ZI8MZdyidpSgLn1zoBHBQ+qmTodJwKXL1rEYArVCgWEU7URK+RJUcj');
define('NONCE_KEY',        'FYKGp286kdteLhulx2i4T5mjXYWQ54zWf8GHs5Jw47xipfJmbnXWN0PbEefP');
define('AUTH_SALT',        'NBbxGj95m7lpEJlz8lAXnwPy+I/P0H5hPaqklNxedZ0/YKecSM/F4hL2LD/R');
define('SECURE_AUTH_SALT', 'NApyYpjZv0b7FD4V5XqKZwJ3wX5cMLauNef1CBMipGNNgzaKjj1OmI/JQI3D');
define('LOGGED_IN_SALT',   '7F2Fu+iowTM2kq1fZm4/H+/T6dc3JV1WMRtkg3h8kojjp6zat0LBGjySduYZ');
define('NONCE_SALT',       'w1KspcIaU6cv9ux4zVQPC5vsmohpxZLPta7dbz6FXsHd8BfZ9fnNjjUPrjss');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mod588_';

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

/* Fixes "Add media button not working", see http://www.carnfieldwebdesign.co.uk/blog/wordpress-fix-add-media-button-not-working/ */
define('CONCATENATE_SCRIPTS', false );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_MEMORY_LIMIT', '256M' );

