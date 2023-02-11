<?php
define( 'WP_CACHE', true );
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'dpsse' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'r}X4-<7]$YYED eCUbZFW/c#Z.)?^whM|YdSr:9I+VSUdU-v@AMN9d:,doL~u<v%' );
define( 'SECURE_AUTH_KEY',  'udiV1:@ %s3a]k qY?xz{FpGA`x8MVOg&d,|(J$R+k:N+KW-Mln #gCrXjI09~Zg' );
define( 'LOGGED_IN_KEY',    'l~->IyJbN1i{fxYqe#P)W!I8fjkxojd-f^Z<i`M/6 jXKl,cZpd{]=!N%uN&z2[J' );
define( 'NONCE_KEY',        ';)K<HnOZ=M;4X]O[PZ$]E^#4,U{f*%rvdkX6K?-?dUeTUJ$dbiydJC>j5zDiviiP' );
define( 'AUTH_SALT',        '-7Qu@Xueyfo6f9h|C/k4&R2ln%*GUHoI+3}A~Jb)qvGm]qk(LEfLinRC1ZHz^rC9' );
define( 'SECURE_AUTH_SALT', '`cpYW`j{@hr-lz[s9.QPvwXK}%dR&cAa:~`v$8h]Vem,-%O/0sq2H;.@KcA0[Z=)' );
define( 'LOGGED_IN_SALT',   'P!K,%6aKtJhnU|e5h/J]X[@BeO+O+`yx,R!YbS e^/(5WPaS`12 Bo<#Iz.v{/& ' );
define( 'NONCE_SALT',       '^wg$x,F#-XAUaN`cI*~*sdc5NzxqvqQug=B*}VNiPg3J}$a`_RR4<#D*r8q&)1]6' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
