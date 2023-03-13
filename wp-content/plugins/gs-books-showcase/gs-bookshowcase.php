<?php
/**
 *
 * @package   GS_Bookshowcase
 * @author    GS Plugins <hello@gsplugins.com>
 * @license   GPL-2.0+
 * @link      https://www.gsplugins.com
 * @copyright 2016 GS Plugins
 *
 * @wordpress-plugin
 * Plugin Name:         GS Book Showcase Lite
 * Plugin URI:          https://www.gsplugins.com/wordpress-plugins
 * Description:         Best Responsive Book Showcase plugin for Wordpress to display Book Cover, Author, Reviews, Rating & many more. Display anywhere at your site using shortcode like [gs_book_showcase theme="gs_book_theme1"] & widgets. Check more shortcode examples and documentation at <a href="https://bookshowcase.gsplugins.com">GS Bookshowcase PRO Demos & Docs</a>
 * Version:             1.3.1
 * Author:              GS Plugins
 * Author URI:          https://www.gsplugins.com
 * Text Domain:         gsbookshowcase
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( ! defined( 'GSBOOKSHOWCASE_HACK_MSG' ) ) define( 'GSBOOKSHOWCASE_HACK_MSG', __( 'Sorry cowboy! This is not your place', 'gsbookshowcase' ) );

// Protect direct access
if ( ! defined( 'ABSPATH' ) ) die( GSBOOKSHOWCASE_HACK_MSG );

// Defining constants
if( ! defined( 'GSBOOKSHOWCASE_VERSION' ) ) define( 'GSBOOKSHOWCASE_VERSION', '1.3.1' );
if( ! defined( 'GSBOOKSHOWCASE_MENU_POSITION' ) ) define( 'GSBOOKSHOWCASE_MENU_POSITION', 41 );
if( ! defined( 'GSBOOKSHOWCASE_PLUGIN_DIR' ) ) define( 'GSBOOKSHOWCASE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'GSBOOKSHOWCASE_PLUGIN_URI' ) ) define( 'GSBOOKSHOWCASE_PLUGIN_URI', plugins_url( '', __FILE__ ) );
if( ! defined( 'GSBOOKSHOWCASE_FILES_DIR' ) ) define( 'GSBOOKSHOWCASE_FILES_DIR', GSBOOKSHOWCASE_PLUGIN_DIR . 'gs-bookshowcase-files' );
if( ! defined( 'GSBOOKSHOWCASE_FILES_URI' ) ) define( 'GSBOOKSHOWCASE_FILES_URI', GSBOOKSHOWCASE_PLUGIN_URI . '/gs-bookshowcase-files' );

require_once GSBOOKSHOWCASE_FILES_DIR . '/includes/gs-bookshowcase-cpt.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/includes/gs-bookshowcase-meta-fields.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/includes/gs-bookshowcase-column.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/includes/gs-bookshowcase-shortcode.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/gs-bookshowcase-scripts.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/admin/class.settings-api.php';
require_once GSBOOKSHOWCASE_FILES_DIR . '/admin/gs_bookshowcase_options_config.php';

require_once GSBOOKSHOWCASE_FILES_DIR . '/gs-common-pages/gs-books-common-pages.php';

if( !function_exists( 'remove_admin_notices' ) ) {
    function remove_admin_notices( ) {
        if ( isset( $_GET['post_type'] ) && 'gs_bookshowcase' === $_GET['post_type'] ) {
            remove_all_actions( 'network_admin_notices' );
            remove_all_actions( 'user_admin_notices' );
            remove_all_actions( 'admin_notices' );
            remove_all_actions( 'all_admin_notices' );
        }
    }
}

add_action( 'in_admin_header',  'remove_admin_notices' );

if ( ! function_exists('gs_bookshowcase_pro_link') ) {
    function gs_bookshowcase_pro_link( $gsBookshowcase_links ) {
        $gsBookshowcase_links[] = '<a class="gs-pro-link" href="https://www.gsplugins.com/product/wordpress-books-showcase-plugin" target="_blank">Go Pro!</a>';
        $gsBookshowcase_links[] = '<a href="https://www.gsplugins.com/wordpress-plugins" target="_blank">GS Plugins</a>';
        return $gsBookshowcase_links;
    }
    add_filter( 'plugin_action_links_' .plugin_basename(__FILE__), 'gs_bookshowcase_pro_link' );
}

/**
 * Activation redirects
 *
 * @since v1.0.0
 */
function gsbook_activate() {
    add_option('gsbook_activation_redirect', true);
}
register_activation_hook(__FILE__, 'gsbook_activate');

/**
 * Redirect to options page
 *
 * @since v1.0.0
 */
function gsbook_redirect() {
    if (get_option('gsbook_activation_redirect', false)) {
        delete_option('gsbook_activation_redirect');
        if(!isset($_GET['activate-multi'])) {
            wp_redirect( "edit.php?post_type=gs_bookshowcase&page=gs-books-plugins-help" );
        }
    }
}
add_action('admin_init', 'gsbook_redirect');

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_gs_books_showcase() {

    if ( ! class_exists( 'Appsero\Client' ) ) {
      require_once GSBOOKSHOWCASE_FILES_DIR . '/appsero/src/Client.php';
    }

    $client = new Appsero\Client( 'f8265887-01c2-4841-9716-d45eed199345', 'GS Books Showcase', __FILE__ );

    // Active insights
    $client->insights()->init();

}

appsero_init_tracker_gs_books_showcase();

/**
 * @gsbookshowcase_review_dismiss()
 * @gsbookshowcase_review_pending()
 * @gsbookshowcase_review_notice_message()
 * Make all the above functions working.
 */
function gsbookshowcase_review_notice(){

    gsbookshowcase_review_dismiss();
    gsbookshowcase_review_pending();

    $activation_time    = get_site_option( 'gsbookshowcase_active_time' );
    $review_dismissal   = get_site_option( 'gsbookshowcase_review_dismiss' );
    $maybe_later        = get_site_option( 'gsbookshowcase_maybe_later' );

    if ( 'yes' == $review_dismissal ) {
        return;
    }

    if ( ! $activation_time ) {
        add_site_option( 'gsbookshowcase_active_time', time() );
    }
    
    $daysinseconds = 259200; // 3 Days in seconds.
   
    if( 'yes' == $maybe_later ) {
        $daysinseconds = 604800 ; // 7 Days in seconds.
    }

    if ( time() - $activation_time > $daysinseconds ) {
        add_action( 'admin_notices' , 'gsbookshowcase_review_notice_message' );
    }
}
add_action( 'admin_init', 'gsbookshowcase_review_notice' );

/**
 * For the notice preview.
 */
function gsbookshowcase_review_notice_message(){
    $scheme      = (parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY )) ? '&' : '?';
    $url         = $_SERVER['REQUEST_URI'] . $scheme . 'gsbookshowcase_review_dismiss=yes';
    $dismiss_url = wp_nonce_url( $url, 'gsbookshowcase-review-nonce' );

    $_later_link = $_SERVER['REQUEST_URI'] . $scheme . 'gsbookshowcase_review_later=yes';
    $later_url   = wp_nonce_url( $_later_link, 'gsbookshowcase-review-nonce' );
    ?>
    
    <div class="gslogo-review-notice">
        <div class="gslogo-review-thumbnail">
            <img src="<?php echo GSBOOKSHOWCASE_FILES_URI . '/assets/img/icon-128x128.png'; ?>" alt="">
        </div>
        <div class="gslogo-review-text">
            <h3><?php _e( 'Leave A Review?', 'gsbookshowcase' ) ?></h3>
            <p><?php _e( 'We hope you\'ve enjoyed using <b>GS Book Showcase</b>! Would you consider leaving us a review on WordPress.org?', 'gsbookshowcase' ) ?></p>
            <ul class="gslogo-review-ul">
                <li>
                    <a href="https://wordpress.org/support/plugin/gs-books-showcase/reviews/" target="_blank">
                        <span class="dashicons dashicons-external"></span>
                        <?php _e( 'Sure! I\'d love to!', 'gsbookshowcase' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $dismiss_url ?>">
                        <span class="dashicons dashicons-smiley"></span>
                        <?php _e( 'I\'ve already left a review', 'gsbookshowcase' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $later_url ?>">
                        <span class="dashicons dashicons-calendar-alt"></span>
                        <?php _e( 'Maybe Later', 'gsbookshowcase' ) ?>
                    </a>
                </li>
                <li>
                    <a href="https://www.gsplugins.com/contact/" target="_blank">
                        <span class="dashicons dashicons-sos"></span>
                        <?php _e( 'I need help!', 'gsbookshowcase' ) ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $dismiss_url ?>">
                        <span class="dashicons dashicons-dismiss"></span>
                        <?php _e( 'Never show again', 'gsbookshowcase' ) ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <?php
}

/**
 * For Dismiss! 
 */
function gsbookshowcase_review_dismiss(){

    if ( ! is_admin() ||
        ! current_user_can( 'manage_options' ) ||
        ! isset( $_GET['_wpnonce'] ) ||
        ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'gsbookshowcase-review-nonce' ) ||
        ! isset( $_GET['gsbookshowcase_review_dismiss'] ) ) {

        return;
    }

    add_site_option( 'gsbookshowcase_review_dismiss', 'yes' );   
}

/**
 * For Maybe Later Update.
 */
function gsbookshowcase_review_pending() {

    if ( ! is_admin() ||
        ! current_user_can( 'manage_options' ) ||
        ! isset( $_GET['_wpnonce'] ) ||
        ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'gsbookshowcase-review-nonce' ) ||
        ! isset( $_GET['gsbookshowcase_review_later'] ) ) {

        return;
    }
    // Reset Time to current time.
    update_site_option( 'gsbookshowcase_active_time', time() );
    update_site_option( 'gsbookshowcase_maybe_later', 'yes' );

}

/**
 * Remove Reviews Metadata on plugin Deactivation.
 */
function gsbookshowcase_deactivate() {
    delete_option('gsbookshowcase_active_time');
    delete_option('gsbookshowcase_maybe_later');
    delete_option('gsadmin_maybe_later');
}
register_deactivation_hook(__FILE__, 'gsbookshowcase_deactivate');



if(! function_exists('gs_admin_tickr_notice')){

    function gs_admin_tickr_notice(){
        global $current_user ;
        $user_id = $current_user->ID;
        if ( ! get_user_meta($user_id, 'gstickr_nag_ignore') ) {
            $protocol = is_ssl() ? 'https' : 'http';
            $promo_content = wp_remote_get( $protocol . '://gsplugins.com/gs_plugins_list/admin_notice.php' );

            ?>
            <div class="notice notice-info" style="position: relative;">
                <?php  echo $promo_content['body'];

                printf(__('<a href="%1$s" style="text-decoration: none; background: #fff;right:6px;top: 10px; float:right;position: absolute;"><span class="dashicons dashicons-dismiss"></span> </a>'),  admin_url( 'index.php?&gstickr_nag_ignore=0' ));
            ?>
            </div>
            <?php 
        }
    }

    // add_action('admin_notices', 'gs_admin_tickr_notice');

    function gstickr_nag_ignore() {

        global $current_user;
        $user_id = $current_user->ID;
            /* If user clicks to ignore the notice, add that to their user meta */
            if ( isset($_GET['gstickr_nag_ignore']) && '0' == $_GET['gstickr_nag_ignore'] ) {
                add_user_meta($user_id, 'gstickr_nag_ignore', 'true', true);
                add_site_option( 'gstickr_active_time', time() );
            }

            $daysinseconds = 259200; // 3 Days in seconds.
            $activation_time    = get_site_option( 'gstickr_active_time' );

            if ( time() - $activation_time > $daysinseconds ) {
                delete_option('gstickr_active_time');
                delete_user_meta($user_id, 'gstickr_nag_ignore');
            }
    }
    // add_action('admin_init', 'gstickr_nag_ignore');
}

if ( ! function_exists('gsbookshowcase_row_meta') ) {
    function gsbookshowcase_row_meta( $meta_fields, $file ) {
  
      if ( $file != 'gs-books-showcase/gs-bookshowcase.php' ) {
          return $meta_fields;
      }
    
        echo "<style>.gsbookshowcase-rate-stars { display: inline-block; color: #ffb900; position: relative; top: 3px; }.gsbookshowcase-rate-stars svg{ fill:#ffb900; } .gsbookshowcase-rate-stars svg:hover{ fill:#ffb900 } .gsbookshowcase-rate-stars svg:hover ~ svg{ fill:none; } </style>";
  
        $plugin_rate   = "https://wordpress.org/support/plugin/gs-books-showcase/reviews/?rate=5#new-post";
        $plugin_filter = "https://wordpress.org/support/plugin/gs-books-showcase/reviews/?filter=5";
        $svg_xmlns     = "https://www.w3.org/2000/svg";
        $svg_icon      = '';
  
        for ( $i = 0; $i < 5; $i++ ) {
          $svg_icon .= "<svg xmlns='" . esc_url( $svg_xmlns ) . "' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>";
        }
  
        // Set icon for thumbsup.
        $meta_fields[] = '<a href="' . esc_url( $plugin_filter ) . '" target="_blank"><span class="dashicons dashicons-thumbs-up"></span>' . __( 'Vote!', 'gscs' ) . '</a>';
  
        // Set icon for 5-star reviews. v1.1.22
        $meta_fields[] = "<a href='" . esc_url( $plugin_rate ) . "' target='_blank' title='" . esc_html__( 'Rate', 'gscs' ) . "'><i class='gsbookshowcase-rate-stars'>" . $svg_icon . "</i></a>";
  
        return $meta_fields;
    }
    add_filter( 'plugin_row_meta','gsbookshowcase_row_meta', 10, 2 );
  }


if( ! function_exists('gsadmin_signup_notice')){
    function gsadmin_signup_notice(){

        gsadmin_signup_pending() ;
        $activation_time    = get_site_option( 'gsadmin_active_time' );
        $maybe_later        = get_site_option( 'gsadmin_maybe_later' );
    
        if ( ! $activation_time ) {
            add_site_option( 'gsadmin_active_time', time() );
        }
        
        if( 'yes' == $maybe_later ) {
            $daysinseconds = 604800 ; // 7 Days in seconds.
            if ( time() - $activation_time > $daysinseconds ) {
                add_action( 'admin_notices' , 'gsadmin_signup_notice_message' );
            }
        }else{
            add_action( 'admin_notices' , 'gsadmin_signup_notice_message' );
        }
    
    }
    // add_action( 'admin_init', 'gsadmin_signup_notice' );
    /**
     * For the notice signup.
     */
    function gsadmin_signup_notice_message(){
        $scheme      = (parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY )) ? '&' : '?';
        $_later_link = $_SERVER['REQUEST_URI'] . $scheme . 'gsadmin_signup_later=yes';
        $later_url   = wp_nonce_url( $_later_link, 'gsadmin-signup-nonce' );
        ?>
        <div class=" gstesti-admin-notice updated gsteam-review-notice">
            <div class="gsteam-review-text">
                <h3><?php _e( 'GS Plugins Affiliate Program is now LIVE!', 'gst' ) ?></h3>
                <p>Join GS Plugins affiliate program. Share our 80% OFF lifetime bundle deals or any plugin with your friends/followers and earn up to 50% commission. <a href="https://www.gsplugins.com/affiliate-registration/?utm_source=wporg&utm_medium=admin_notice&utm_campaign=aff_regi" target="_blank">Click here to sign up.</a></p>
                <ul class="gsteam-review-ul">
                    <li style="display: inline-block;margin-right: 15px;">
                        <a href="<?php echo $later_url ?>" style="display: inline-block;color: #10738B;text-decoration: none;position: relative;">
                            <span class="dashicons dashicons-dismiss"></span>
                            <?php _e( 'Hide Now', 'gst' ) ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <?php
    }

    /**
     * For Maybe Later signup.
     */
    function gsadmin_signup_pending() {

        if ( ! is_admin() ||
            ! current_user_can( 'manage_options' ) ||
            ! isset( $_GET['_wpnonce'] ) ||
            ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'gsadmin-signup-nonce' ) ||
            ! isset( $_GET['gsadmin_signup_later'] ) ) {

            return;
        }
        // Reset Time to current time.
        update_site_option( 'gsadmin_maybe_later', 'yes' );
    }
}