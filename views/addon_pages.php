<?php
/**
 * Store/Design Page Functions
 *
 * @package     EMD
 * @copyright   Copyright (c) 2014,  Emarket Design
 * @since       WPAS 4.3
 */
if (!defined('ABSPATH')) exit;
/**
 * Show emdplugins plugins and extensions
 *
 * @since WPAS 4.3
 *
 * @return html page content
 */
function wpas_store_page() {
	global $title;
	wp_enqueue_script('jquery');
	ob_start(); ?>
		<div class="wrap">
		<h2><?php echo $title;?> &nbsp;&mdash;&nbsp;<a href="https://emdplugins.com/plugins?pk_source=wpas-store-page&pk_medium=plugin&pk_campaign=wpas-store&pk_content=browseall" class="button-primary" title="<?php esc_html_e( 'Browse All', 'wp-app-studio' ); ?>" target="_blank"><?php esc_html_e( 'Browse All', 'wp-app-studio' ); ?></a>
		</h2>
		<p><?php esc_html_e('The following plugins extend and expand the functionality of your app.','wp-app-studio'); ?></p>
		<?php //echo wpas_add_ons('addons'); ?>
		<?php echo wpas_add_ons('tabs'); ?>
		</div>
		<?php
		echo ob_get_clean();
}
/**
 * Show wpas designs
 *
 * @since WPAS 4.3
 *
 * @return html page content
 */
function wpas_design_page() {
	global $title;
	wp_enqueue_script('jquery');
	ob_start(); ?>
		<div class="wrap">
		<h2><?php echo $title;?> &nbsp;&mdash;&nbsp;<a href="<?php echo WPAS_URL . '/designs?pk_source=wpas-design-page&pk_medium=plugin&pk_campaign=wpas-design&pk_content=browseall';?>" class="button-primary" title="<?php esc_html_e( 'Browse All', 'wp-app-studio' ); ?>" target="_blank"><?php esc_html_e( 'Browse All', 'wp-app-studio' ); ?></a>
		</h2>
		<p><?php esc_html_e('The following plugin designs can be used as a template:','wp-app-studio');?>
		<ul><li><span class="dashicons dashicons-yes"></span>
		<?php esc_html_e('To customize the functionality of their corresponding plugins','wp-app-studio'); ?>
		</li>
		<li><span class="dashicons dashicons-yes"></span>
		<?php esc_html_e('To create your own plugin','wp-app-studio');?>
		</li>
		</ul>
		</p>
		<?php echo wpas_add_ons('tabs-designs'); ?>
		</div>
		<?php
		echo ob_get_clean();
}
/**
 * Show what's new on wpas
 *
 * @since WPAS 5.2
 *
 * @return html page content
 */
function wpas_getting_started_page(){
	wp_enqueue_style('wpas-splash', plugin_dir_url( __FILE__ ) . '../css/wpas-splash.css');
	wpas_welcome_message();
	wpas_tabs();
}
/**
 * Get plugin and extension list from emdplugins site and save it in a transient
 *
 * @since WPAS 4.3
 *
 * @return $cache html content
 */
function wpas_add_ons($type) {
	$feed = wp_remote_get(WPAS_ADDON_URL . $type . '.html');	
	if ( ! is_wp_error( $feed ) ) {
		if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
			$cache = wp_remote_retrieve_body( $feed );
		}
	} else {
		$cache = '<div class="error"><p>' . __( 'There was an error retrieving the extensions list from the server. Please try again later.', 'wp-app-studio' ) . '</div>';
	}
	return $cache;
}
function wpas_debug_page(){
	global $title,$wpdb;
	if ( get_bloginfo( 'version' ) < '3.4' ) {
		$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
		$theme      = $theme_data['Name'] . ' ' . $theme_data['Version'];
	} else {
		$theme_data = wp_get_theme();
		$theme      = $theme_data->Name . ' ' . $theme_data->Version;
	}
	$args = array(
		'sslverify'  => false,
		'timeout'   => 15,
	);
	$response = wp_remote_post(WPAS_SSL_URL,$args);
	if( !is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
		$wpas_remote = 'Works';
	} else {
		if(is_wp_error( $response )){
			$wpas_remote = "WP Error Msg -- " . $response->get_error_message();
		}
		else {
			$wpas_remote = "Returned -- " . $response['response']['message'];
		}
	}
	ob_start(); ?>
		<div class="wrap">
		<h2><?php echo $title;?></h2>
		<div id="wpas-debug" name="wpas-debug">
		<p>WPAS VERSION: <?php echo WPAS_VERSION;?></p>
		<p>WPAS DATA VERSION: <?php echo WPAS_DATA_VERSION;?></p>
		<p>SITE_URL: <?php echo site_url(); ?></p>
		<p>HOME_URL: <?php echo home_url(); ?></p>
		<p>Multisite: <?php echo is_multisite() ? 'Yes' : 'No' ?> </p>
		<p>WordPress Version: <?php echo get_bloginfo( 'version' ); ?></p>
		<p>Language: <?php echo ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ); ?></p>
		<p>Permalink Structure: <?php echo get_option( 'permalink_structure' );?> </p>
		<p>Active Theme: <?php echo $theme; ?></p>
		<p>WP_DEBUG: <?php echo ( defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' : 'Disabled' : 'Not set' ); ?></p>
		<p>Remote Post: <?php echo $wpas_remote; ?></p>
		<p>PHP Version:              <?php echo PHP_VERSION; ?>
		<p>MySQL Version:            <?php echo $wpdb->db_version(); ?></p>
		<p>Web Server Info:          <?php echo sanitize_text_field($_SERVER['SERVER_SOFTWARE']); ?></p>
		<p>PHP Post Max Size:        <?php echo ini_get( 'post_max_size' ); ?></p>
		<p>PHP Upload Max Filesize:  <?php echo ini_get( 'upload_max_filesize' ); ?></p>
		<p>cURL:                     <?php echo ( function_exists( 'curl_init' ) ? 'Supported' : 'Not Supported' ); ?></p>
		<?php // Must-use plugins
		$muplugins = get_mu_plugins();
	if( !empty($muplugins) ) {
		echo '<p>Must-Use Plugins:<br>';
		foreach( $muplugins as $plugin => $plugin_data ) {
			echo  $plugin_data['Name'] . ': ' . $plugin_data['Version'] . "<br>";
		}
		echo '</p>';
	}
	// WordPress active plugins
	echo  '<p>WordPress Active Plugins:<br>';
	$plugins = get_plugins();
	$active_plugins = get_option( 'active_plugins', array() );
	foreach( $plugins as $plugin_path => $plugin ) {
		if( !in_array( $plugin_path, $active_plugins ) )
			continue;
		echo $plugin['Name'] . ': ' . $plugin['Version'] . "<br>";
	}
	echo '</p>';
	if( is_multisite() ) {
		// WordPress Multisite active plugins
		echo '<p>Network Active Plugins:<br>';
		$plugins = wp_get_active_network_plugins();
		$active_plugins = get_site_option( 'active_sitewide_plugins', array() );
		foreach( $plugins as $plugin_path ) {
			$plugin_base = plugin_basename( $plugin_path );
			if( !array_key_exists( $plugin_base, $active_plugins ) )
				continue;
			$plugin  = get_plugin_data( $plugin_path );
			echo $plugin['Name'] . ': ' . $plugin['Version'] . "<br>";
		}
		echo '</p>';
	}
	?>
	</div>
	<?php
	echo ob_get_clean();
}
function wpas_welcome_message() {
	list( $display_version ) = explode( '-', WPAS_VERSION );
	?>
	<div id="wpas-about" class="wrap about-wrap">
	<div id="wpas-header">
		<h1><?php printf( esc_html__( 'Welcome to WP App Studio %s', 'wp-app-studio' ), $display_version ); ?></h1>
		<p class="about-text">
			<?php printf( esc_html__( 'Thank you for updating to the latest version! WP App Studio %s has everything you need to build Professional WordPress Plugins.', 'wp-app-studio' ), $display_version ); ?>
		<br>
		<?php esc_html_e('Be less busy. Stay on budget. Get more. Be independent.', 'wp-app-studio' ); ?>
		</p>
		<div style="background: black url('<?php echo  plugins_url('../img/WpAppStudioLogo.png',__FILE__); ?>') no-repeat scroll center center;" class="wp-badge"><span>Version <?php echo $display_version; ?></span></div>
	</div>
<?php
}
function wpas_tabs() {
	$tabs['getting-started'] = __('Getting Started', 'wp-app-studio');
	$tabs['whats-new'] = __('What\'s New', 'wp-app-studio');
	$tabs['resources'] = __('Resources', 'wp-app-studio');
	$active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'getting-started';
	echo '<h2 class="nav-tab-wrapper wp-clearfix">';
        foreach ($tabs as $ktab => $mytab) {
                $tab_url[$ktab] = esc_url(add_query_arg(array(
                                                'tab' => $ktab
                                                )));
                $active = "";
                if ($active_tab == $ktab) {
                        $active = "nav-tab-active";
                }
                echo '<a href="' . esc_url($tab_url[$ktab]) . '" class="nav-tab ' . $active . '" id="nav-' . $ktab . '">' . $mytab . '</a>';
        }
        echo '</h2>';
        foreach ($tabs as $ktab => $mytab) {
		echo '<div class="tab-content" id="tab-' . $ktab . '"';
		if($ktab != $active_tab) { echo 'style="display:none;"'; } 
		echo '>';
		echo wpas_add_ons($ktab); 
		echo '</div>';
	}
}
function wpas_support_page() {
	global $title;
	ob_start(); ?>
	<div class="wrap">
	<h2><?php echo $title;?></h2>
	<div id="support-header"><?php esc_html__('Thanks for installing WP App Studio.','wp-app-studio');?> &nbsp; <?php  printf(esc_html__('All support requests are accepted through <a href="%s" target="_blank">our support site.</a>','wp-app-studio'),'https://wpappstudio.com/wp-app-studio-knowledge-center/?pk_source=wpas-support-page&pk_medium=plugin&pk_campaign=wpas-support&pk_content=supportlink'); ?>
        <div id="plugin-review">
        <div class="plugin-review-text"><a href="https://wordpress.org/support/view/plugin-reviews/wp-app-studio" target="_blank"><?php esc_html_e('Like our plugin? Leave us a review','wp-app-studio'); ?></a>
        </div><div class="plugin-review-star"><span class="dashicons dashicons-star-filled"></span>
        <span class="dashicons dashicons-star-filled"></span>
        <span class="dashicons dashicons-star-filled"></span>
        <span class="dashicons dashicons-star-filled"></span>
        <span class="dashicons dashicons-star-filled"></span>
        </div>
        </div>
	</div>
	<?php 
	echo wpas_add_ons('wpas-support');
	echo '</div>';
	echo ob_get_clean();
}
