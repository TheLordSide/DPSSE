<?php
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
define( 'AUTH_KEY',         '@`JlJg:w=Lk@Ek`v%4QHhfa=CbaiOojfv:]iDvQ^bi*+.Asx}9;99>iM_I6m,pm-' );
define( 'SECURE_AUTH_KEY',  'JJTg+D1 /L%w$i)CjD?79}Tq>SaZ%u1Ea$Mwa#)%UX5q~?W9},MdQ(So0a6cF7Jb' );
define( 'LOGGED_IN_KEY',    'QfF([pF(]aJ[&L2CDnm [__[,x;rl$=!@!N~BEEYO))9.FTXI=@Kt:()@EW9/t $' );
define( 'NONCE_KEY',        'Ql$_-</)[YA7#MgCJT#?xh?s&XqH<H#&beXVP(_=&S,Wx!j$%(tPc-NB~B(,{gw_' );
define( 'AUTH_SALT',        'h=$5fpc^p@x2<kF`3*YM[i{%Yvol) ;e$rkm~.8o$YEP+2<-h.6M7/fDi%{FC-Q/' );
define( 'SECURE_AUTH_SALT', 'EQM/ddh V|?9`?0P+=K2nxd`tPma3_~<K.3pc!lWt^J!-TW}C-&Vxg~LaY#M]/|l' );
define( 'LOGGED_IN_SALT',   'QhfW7wPhIck@[p2;B$*NQ{{E}zK}HSD4Upn#&}+r@ (Q}/d)0&JA.oa](>rR3sWo' );
define( 'NONCE_SALT',       'TTe+^X+!rq*% #Ut3HX! W]m$jF;QP|Wd8.cL;3e4m6Ur5|l%$dMz.}ekZ@gG7$L' );
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
