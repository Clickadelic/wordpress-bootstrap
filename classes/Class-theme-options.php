<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Start Theme Options Class, look at: http://www.wpexplorer.com/wordpress-theme-options/
if (!class_exists('Custom_Theme_Options')) {
    class Custom_Theme_Options {

        /**
         * Start things up
         *
         * @since 1.0.0
         */
        public function __construct() {

            // We only need to register the admin panel on the back-end
            if ( is_admin() ) {
                add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
                add_action( 'admin_init', array( $this, 'register_settings' ) );
            }
        }

        /**
         * Returns all theme options
         *
         * @since 1.0.0
         */
        public static function get_theme_options() {
            return get_option( 'theme_options' );
        }

        /**
         * Returns single theme option
         *
         * @since 1.0.0
         */
        public static function get_theme_option( $id ) {
            $options = self::get_theme_options();
            if ( isset( $options[$id] ) ) {
                return $options[$id];
            }
        }

        /**
         * Add sub menu page
         *
         * @since 1.0.0
         */
        public static function add_admin_menu() {
            add_theme_page(
                esc_html__('Theme-Settings', 'bootstrap'),
                esc_html__('Theme-Settings', 'bootstrap'),
                'manage_options',
                'theme-settings',
                array('Custom_Theme_Options', 'create_admin_page')
            );
        }

        /**
         * Register a setting and its sanitization callback.
         *
         * We are only registering 1 setting so we can store all options in a single option as
         * an array. You could, however, register a new setting for each option
         *
         * @since 1.0.0
         */
        public static function register_settings() {
            register_setting('theme_options', 'theme_options', array('Custom_Theme_Options', 'sanitize'));
        }

        /**
         * Sanitization callback
         *
         * @since 1.0.0
         */
        public static function sanitize( $options ) {

            // If we have options lets sanitize them
            if ( $options ) {

                // Debug Mode
                if (!empty( $options['debug_mode'] ) ) {
                    $options['debug_mode'] = 'on';
                } else {
                    unset( $options['debug_mode'] );
                }
                // Script Loading
                if (!empty( $options['load_scripts_in_header'] ) ) {
                    $options['load_scripts_in_header'] = 'on';
                } else {
                    unset( $options['load_scripts_in_header'] );
                }
                // Backend Ad-Blocker
                if (!empty( $options['ad_blocker'] ) ) {
                    $options['ad_blocker'] = 'on';
                } else {
                    unset( $options['ad_blocker'] );
                }
                // Disable Gutenberg Tips
                if (!empty( $options['disable_tips'] ) ) {
                    $options['disable_tips'] = 'on';
                } else {
                    unset( $options['disable_tips'] );
                }

                // Enable Headless mode
                if (!empty( $options['headless_mode'] ) ) {
                    $options['headless_mode'] = 'on';
                } else {
                    unset( $options['headless_mode'] );
                }

            }    

            // Return sanitized options
            return $options;
        }

        /**
         * Settings page output
         *
         * @since 1.0.0
         */
        public static function create_admin_page() { ?>

            <div class="wrap">
                <h1><?php esc_html_e('Theme-Settings', 'bootstrap' ); ?></h1>
                <form method="post" action="options.php">
                    <?php settings_fields('theme_options'); ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="settings-tabs">
                                            <nav>
                                                <div class="nav nav-tabs nav-pills" id="bootstrap-options-tabs" role="tablist">
                                                    <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="false"><?php _e('General settings', 'bootstrap'); ?></a>
                                                    <a class="nav-item nav-link" id="nav-frontend-tab" data-toggle="tab" href="#nav-frontend" role="tab" aria-controls="nav-frontend" aria-selected="false"><?php _e('Frontend settings', 'bootstrap'); ?></a>
                                                    <a class="nav-item nav-link" id="nav-backend-tab" data-toggle="tab" href="#nav-backend" role="tab" aria-controls="nav-backend" aria-selected="false"><?php _e('Backend settings', 'bootstrap'); ?></a>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <!-- General Options Tab -->
                                                <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h2 class="settings-title">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-headset-vr" viewBox="0 0 16 16">
                                                                            <path d="M8 1.248c1.857 0 3.526.641 4.65 1.794a4.978 4.978 0 0 1 2.518 1.09C13.907 1.482 11.295 0 8 0 4.75 0 2.12 1.48.844 4.122a4.979 4.979 0 0 1 2.289-1.047C4.236 1.872 5.974 1.248 8 1.248z"/>
                                                                            <path d="M12 12a3.988 3.988 0 0 1-2.786-1.13l-.002-.002a1.612 1.612 0 0 0-.276-.167A2.164 2.164 0 0 0 8 10.5c-.414 0-.729.103-.935.201a1.612 1.612 0 0 0-.277.167l-.002.002A4 4 0 1 1 4 4h8a4 4 0 0 1 0 8z"/>
                                                                        </svg>
                                                                        <?php _e('Headless Mode', 'bootstrap'); ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                   <div class="settings-text">
                                                                       <p><?php esc_html_e('Enable headless mode and redirect all requests to the login page', 'bootstrap' ); ?>.</p>
                                                                   </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php $value = self::get_theme_option('headless_mode'); ?>
                                                                    <div class="input-group settings-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><?php _e('off', 'bootstrap'); ?></span>
                                                                        </div>
                                                                        <div class="wrap-switch">
                                                                            <div class="switch">
                                                                                <input type="checkbox" name="theme_options[headless_mode]" id="theme_options[headless_mode]" <?php checked($value,'on'); ?>> 
                                                                                <label for="theme_options[headless_mode]"></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><?php _e('on', 'bootstrap'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Frontend Options Tab -->
                                                <div class="tab-pane fade" id="nav-frontend" role="tabpanel" aria-labelledby="nav-frontend-tab">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h2 class="settings-title">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11 1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/><path fill-rule="evenodd" d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
                                                                        <?php _e('Debug mode', 'bootstrap'); ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                   <div class="settings-text">
                                                                       <p><?php esc_html_e('Enable Bootstrap 4 media query debug mode', 'bootstrap' ); ?>.</p>
                                                                   </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php $value = self::get_theme_option('debug_mode'); ?>
                                                                    <div class="input-group settings-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><?php _e('off', 'bootstrap'); ?></span>
                                                                        </div>
                                                                        <div class="wrap-switch">
                                                                            <div class="switch">
                                                                                <input type="checkbox" name="theme_options[debug_mode]" id="theme_options[debug_mode]" <?php checked($value,'on'); ?>> 
                                                                                <label for="theme_options[debug_mode]"></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><?php _e('on', 'bootstrap'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="emtpy-box">
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h2 class="settings-title">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-file-code" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/><path fill-rule="evenodd" d="M8.646 5.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 8 8.646 6.354a.5.5 0 0 1 0-.708zm-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 8l1.647-1.646a.5.5 0 0 0 0-.708z"/></svg>
                                                                        <?php _e('Script Loading', 'bootstrap'); ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                   <div class="settings-text">
                                                                       <p><?php esc_html_e('Load the Bootstrap scripts in the head', 'bootstrap' ); ?>?&nbsp;<?php _e('Default is footer', 'bootstrap'); ?>.</p>
                                                                   </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php $value = self::get_theme_option('load_scripts_in_header'); ?>
                                                                    <div class="input-group settings-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><?php _e('off', 'bootstrap'); ?></span>
                                                                        </div>
                                                                        <div class="wrap-switch">
                                                                            <div class="switch">
                                                                                <input type="checkbox" name="theme_options[load_scripts_in_header]" id="theme_options[load_scripts_in_header]" <?php checked($value,'on'); ?>> 
                                                                                <label for="theme_options[load_scripts_in_header]"></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><?php _e('on', 'bootstrap'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Backend Options Tab -->
                                                <div class="tab-pane fade" id="nav-backend" role="tabpanel" aria-labelledby="nav-advanced-tab">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h2 class="settings-title">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-shield-shaded" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z"/><path d="M8 2.25c.909 0 3.188.685 4.254 1.022a.94.94 0 0 1 .656.773c.814 6.424-4.13 9.452-4.91 9.452V2.25z"/></svg>
                                                                        <?php _e('Backend Ad-Blocker', 'bootstrap'); ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                   <div class="settings-text">
                                                                       <p><?php esc_html_e('Activate the back-end ad-blocker', 'bootstrap' ); ?>.</p>
                                                                   </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php $value = self::get_theme_option('ad_blocker'); ?>
                                                                    <div class="input-group settings-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><?php _e('off', 'bootstrap'); ?></span>
                                                                        </div>
                                                                        <div class="wrap-switch">
                                                                            <div class="switch">
                                                                                <input type="checkbox" name="theme_options[ad_blocker]" id="theme_options[ad_blocker]" <?php checked($value,'on'); ?>> 
                                                                                <label for="theme_options[ad_blocker]"></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><?php _e('on', 'bootstrap'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="emtpy-box">
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h2 class="settings-title">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/><path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                                                                        <?php _e('Gutenberg-Tips', 'bootstrap'); ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                   <div class="settings-text">
                                                                       <p><?php esc_html_e('Disable annoying Gutenberg-Tips', 'bootstrap' ); ?>.</p>
                                                                   </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php $value = self::get_theme_option('disable_tips'); ?>
                                                                    <div class="input-group settings-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><?php _e('off', 'bootstrap'); ?></span>
                                                                        </div>
                                                                        <div class="wrap-switch">
                                                                            <div class="switch">
                                                                                <input type="checkbox" name="theme_options[disable_tips]" id="theme_options[disable_tips]" <?php checked($value,'on'); ?>> 
                                                                                <label for="theme_options[disable_tips]"></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><?php _e('on', 'bootstrap'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Ende Tabs -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php submit_button(); ?>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        <?php }
    }
}
$themeoptions = new Custom_Theme_Options();

/* Helper function to use in your theme to return a theme option value */
function get_theme_option($id = '') {
    return Custom_Theme_Options::get_theme_option( $id );
}