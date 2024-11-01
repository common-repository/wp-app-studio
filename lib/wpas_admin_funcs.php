<?php
defined( 'ABSPATH' ) OR exit;
add_filter('plugin_row_meta','wpas_plugin_row_meta', 10, 2);
add_action('admin_init','wpas_welcome', 11);
add_filter( 'plugin_action_links', 'wpas_plugin_action_links', 10, 2 );

add_action('wp_ajax_wpas_send_deactivate_reason', 'wpas_send_deactivate_reason');

global $pagenow;
if('plugins.php' === $pagenow) {
	add_action('admin_footer', 'wpas_deactivation_feedback_box');
}

function wpas_plugin_action_links($links, $file){
	if($file != 'wp-app-studio/wp-app-studio.php') return $links;
	foreach($links as $key => $link){
		if('deactivate' === $key){
			$links[$key] =  $link . '<i class="wpas-slug" data-slug="wpas-slug"></i>';
		}
	}
	$new_links['join'] = '<a href="' . WPAS_URL . '/wp-app-studio-pricing/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=plugin-page' . '">' . __('Join Development Plan', 'wp-app-studio') . '</a>';
	$new_links['license'] = '<a href="' . admin_url('admin.php?page=wpas_licenses_page') . '">' . __('Licenses', 'wp-app-studio') . '</a>';
	$links = array_merge($new_links,$links);
	return $links;
}
function wpas_plugin_row_meta($input, $file){
	if($file != 'wp-app-studio/wp-app-studio.php') return $input;

	$wpas_link = WPAS_URL . '/designs/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=plugin-page';
	$links = array(
		'<a href="' . admin_url('admin.php?page=wpas-getting-started') . '">' . __('Getting Started', 'wp-app-studio') . '</a>',
		'<a href="' . $wpas_link . '">' . __('Designs', 'wp-app-studio') . '</a>',
		'<a href="' . WPAS_URL . '/become-a-selldev-author/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=plugin-page' . '">' . __('SellDev', 'wp-app-studio') . '</a>',
	      );
	$input = array_merge($input,$links);
	return $input;
}
function wpas_welcome(){
	if(!get_transient('_wpas_activation_redirect')) return;
	
	delete_transient('_wpas_activation_redirect');

	//return if activating from network, or bulk
	if(is_network_admin() || isset($_GET['activate-multi'])) return;

	$version = get_option('wpas_version');
	//echo $version; exit;

	if(!$version) { // First time install
		wp_safe_redirect(admin_url('admin.php?page=wpas-getting-started')); exit;
	} else { // Update
		wp_safe_redirect(admin_url('admin.php?page=wpas-getting-started&tab=whats-new')); exit;
	}
}
function wpas_deactivation_feedback_box(){
	wp_enqueue_style("emd-modal", plugin_dir_url( __FILE__ ) . '../css/emd-modal.css');
	$feedback_vars['submit'] = __('Submit & Deactivate', 'wp-app-studio');
	$feedback_vars['skip'] = __('Skip & Deactivate', 'wp-app-studio');
	$feedback_vars['cancel'] = __('Cancel', 'wp-app-studio');
	$feedback_vars['ask_reason'] = __('Kindly tell us the reason so we can improve', 'wp-app-studio');
	$reasons[1] = __('I no longer need the plugin','wp-app-studio');
	$reasons[2] = __('I found a better plugin','wp-app-studio');
	$reasons[3] = __('I only needed the plugin for a short period','wp-app-studio');
	$reasons[4] = __('The plugin broke my site','wp-app-studio');
	$reasons[5] = __('The plugin suddenly stopped working','wp-app-studio');
	$reasons[6] = __('It\'s a temporary deactivation. I\'m just debugging an issue','wp-app-studio');
	$reasons[7] = __('Other','wp-app-studio');
	$feedback_vars['msg'] = __('If you have a moment, please let us know why you are deactivating', 'wp-app-studio');
	$feedback_vars['disclaimer'] = __('No private information is sent during your submission. Thank you very much for your help improving our plugin.','wp-app-studio');	
	$feedback_vars['reasons'] = '';	
	foreach($reasons as $key => $reason){
		$feedback_vars['reasons'] .= '<li class="reason';
		if($key == 2 || $key == 7){
			$feedback_vars['reasons'] .= ' has-input';
		}	
		$feedback_vars['reasons'] .= '"';
		if($key == 2 || $key == 7){
			$feedback_vars['reasons'] .= 'data-input-type="textfield"';
			if($key == 2){
                		$feedback_vars['reasons'] .= 'data-input-placeholder="' . __('What\'s the plugin\'s name?','wp-app-studio') . '"';
			}	
		}
		$feedback_vars['reasons'] .= '><label><span>
					<input type="radio" name="selected-reason" value="' . $key . '"/>
                    			</span><span>' . $reason . '</span></label></li>';
	}
	wp_enqueue_script('wpas-feedback', plugin_dir_url( __FILE__ ) . '../js/wpas-feedback.js');
	wp_localize_script("wpas-feedback", 'feedback_vars', $feedback_vars);
}
function wpas_send_deactivate_reason(){
	if (!isset($_POST['reason_id'])) {
		exit;
	}
	$reason_info = isset( $_POST['reason_info'] ) ? trim( stripslashes( sanitize_text_field($_POST['reason_info'] )) ) : '';

	$postfields['reason_id'] = sanitize_text_field($_POST['reason_id']);
	$postfields['plugin_name'] = sanitize_text_field($_POST['plugin_name']);
	if(!empty($reason_info)){
		$postfields['reason_info'] = $reason_info;
	}
	$resp = wpas_remote_request('deactivate_info',$postfields); 
	// Print '1' for successful operation.
	echo 1;
	exit;
}
