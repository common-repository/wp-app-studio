<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$edition_list = Array('freedev' => 'FreeDev',
			'small' => 'ProDev - Basic',
			'smedium' => 'ProDev - Developer',
			'medium' => 'ProDev - Business',
			'large' => 'ProDev - Enterprise');
$conn_list = Array('inc_email' => 'Incoming Email',
		'inline_entity' => 'Inline Entity',
		'calendar' => 'Calendar',
		'rating' => 'Rating',
		'woocommerce' => 'WooCommerce',
		'edd' => 'Easy Digital Downloads',
		'youtube_api' => 'YouTube');
function wpas_licenses_page(){
	echo '<div class="wpas">';
	wpas_branding_header();
	echo wpas_display_licenses_page();
	echo '</div>';
}	
function wpas_display_licenses_page(){
	$licenses = get_option('wpas_licenses',Array());
	?>
		<div id="was-container" class="container-fluid">
		<ul class="breadcrumb">
		<li id="first">
		<a href="<?php echo admin_url('admin.php?page=wpas_app_list'); ?>">
		<i class="icon-home"></i><?php esc_html_e("Home","wp-app-studio"); ?></a>
		<span class="divider">/</span>
		</li>
		<li id="second" class="inactive"><?php esc_html_e("Licenses","wp-app-studio"); ?></li>
		</ul>
		<div class="row-fluid">
		<form method="post" action="options.php">
		<div class="well" style="background-color:#f0f8ff;">
		<h3><?php esc_html_e("Plan Licenses","wp-app-studio"); ?></h3>
		<p><?php printf(__('Please enter your <b>plan license key</b>. If you don\'t have a license key join a <a href="%s" target="_blank">WPAS development edition plan</a>.','wp-app-studio'),WPAS_URL . '/wp-app-studio-pricing/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=join'); 
		echo '&nbsp;'; esc_html_e('You can enter multiple plan license keys.','wp-app-studio'); ?> 
		<table class="form-table">
		<tbody>
		<?php
		settings_fields('wpas_licenses');
		wpas_show_ed_license();
?>
		</tbody>
		</table>
	<?php 	submit_button(__('Save','wp-app-studio')); 
		echo '</form>';
	if(!empty($licenses['edition'])){
		global $edition_list;
		$license_list = '';
		foreach($licenses['edition'] as $lic_key => $lic_val){
			$license_list .= '<tr><td align="center"><input type="checkbox" id="wpas_use_edition_' . $lic_key . '" class="wpas-edition-lic" value=1';
			if(!empty($lic_val['use_for_generate']) && $lic_val['use_for_generate'] == 1){
				$license_list .= ' checked';	
			}
			$license_list .= '/></td>';
			$license_list .= '<td>' . $lic_key . '</td><td>' . $edition_list[$lic_val['name']] . '</td>';
			$license_list .= '<td>';
			$status = (!empty($lic_val['status'])) ? $lic_val['status'] : 'inactive'; 
			if($status == 'inactive'){
				$status_color = 'red';
			}
			elseif($status == 'deactivated'){
				$status_color = '#8a6d3b';
			}
			if ($status == 'valid') { 
				$license_list .= '<a href="' .  wp_nonce_url( admin_url('admin.php?page=wpas_licenses_page&action=deactivate&type=edition&key=' . $lic_key), 'deactivate_action' ) . '" class="btn btn-info">' . __( 'Deactivate License', 'wp-app-studio' ) . '</a>';
				$license_list .= '</td><td><span style="color:#228b22;font-weight:500;">' . strtoupper($status) . '&nbsp;<h3 style="display:inline">&check;</h3></span>';
			} else {
				$license_list .= '<a href="' .  wp_nonce_url( admin_url('admin.php?page=wpas_licenses_page&action=activate&type=edition&key=' . $lic_key), 'activate_action' ) . '" class="btn btn-info">' . __( 'Activate License', 'wp-app-studio' ) . '</a>';
				$license_list .= '</td><td><span style="color:' . $status_color . ';font-weight:500;">' .  strtoupper($status) . '&nbsp;<h3 style="display:inline">&#x2691;</h3></span>';
				if(!empty($lic_val['error'])){
					$license_list .= "<div style='padding:5px;'><span style='color:red;font-weight:500;background-color:white;'>" . __('Error:','wp-app-studio') . '&nbsp;' . $lic_val['error'] . "</span></div>";
				}
			}
			$license_list .= '</td><td><a href="' . wp_nonce_url(admin_url('admin.php?page=wpas_licenses_page&type=edition&action=delete&key=' . $lic_key),'delete') . '" class="btn btn-danger">' . __('Delete','wp-app-studio') . '</a></td></tr>';
		}
?>
		<p><?php esc_html_e('Please <b>activate</b> your license keys. You can use at most 1 license key for generation.','wp-app-studio'); ?></p>
		<table id="plan-list" class="licenses table table-striped table-bordered" cellspacing="0">
		<thead><tr class="theader">
		<th><?php esc_html_e("Use for generation","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Key","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Type","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Activate/Deactivate","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Last Status","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Delete","wp-app-studio"); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php echo $license_list; ?>
		</tbody>
		</table>
<?php
	}
?>
		</div>
		<form method="post" action="options.php">
		<div class="well" style="background-color:#fffafa;">
		<h3><?php esc_html_e("Connection Licenses","wp-app-studio"); ?></h3>
<p><?php printf(__('If your plan does not support <a href="%s" target="_blank">WPAS connections</a>, you need to purchase a connection license key and enter it below as well to be able to use that connection in your designs.', 'wp-app-studio'), WPAS_URL . '/connections/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=connections'); ?>
		<table class="form-table">
		<tbody>
		<?php
		settings_fields('wpas_licenses');
		wpas_show_conn_license_row();
	?>
		</tbody>
		</table>
	<?php submit_button(__('Save','wp-app-studio')); ?>
		</form>
	<?php if(!empty($licenses['connection'])){  ?>
		<p><?php esc_html_e('Please <b>activate</b> your license keys. You can use multiple license keys for generation.','wp-app-studio'); ?></p>
		<table id="connection-list" class="licenses table table-striped table-bordered" cellspacing="0">
		<thead><tr class="theader">
		<th><?php esc_html_e("Use for generation","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Key","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Type","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Activate/Deactivate","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Last Status","wp-app-studio"); ?></th>
		<th><?php esc_html_e("Delete","wp-app-studio"); ?></th>
		</tr>
		</thead>
		<tbody>
	<?php
		$conn_license_list = '';
		global $conn_list;
		foreach($licenses['connection'] as $lic_key => $lic_val){
			$conn_license_list .= '<tr><td align="center"><input type="checkbox" id="wpas_use_conn_' . $lic_key . '" class="wpas-conn-lic" value=1';
			if(!empty($lic_val['use_for_generate']) && $lic_val['use_for_generate'] == 1){
				$conn_license_list .= ' checked';	
			}
			$conn_license_list .= '/></td>';
			$conn_license_list .= '<td>' . $lic_key . '</td><td>' . $conn_list[$lic_val['name']] . '</td>';
			$conn_license_list .= '<td>';
			$status = (!empty($lic_val['status'])) ? $lic_val['status'] : 'inactive'; 
			if($status == 'inactive'){
				$status_color = 'red';
			}
			elseif($status == 'deactivated'){
				$status_color = '#8a6d3b';
			}
			if ($status == 'valid') { 
				$conn_license_list .= '<a href="' .  wp_nonce_url( admin_url('admin.php?page=wpas_licenses_page&type=connection&action=deactivate&key=' . $lic_key), 'deactivate_action' ) . '" class="btn btn-info">' . __( 'Deactivate License', 'wp-app-studio' ) . '</a>';
				$conn_license_list .= '</td><td><span style="color:#228b22;font-weight:500;">' . strtoupper($status) . '&nbsp;<h3 style="display:inline">&check;</h3></span>';
			} else {
				$conn_license_list .= '<a href="' .  wp_nonce_url( admin_url('admin.php?page=wpas_licenses_page&type=connection&action=activate&key=' . $lic_key), 'activate_action' ) . '" class="btn btn-info">' . __( 'Activate License', 'wp-app-studio' ) . '</a>';
				$conn_license_list .= '</td><td><span style="color:' . $status_color . ';font-weight:500;">' .  strtoupper($status) . '&nbsp;<h3 style="display:inline">&#x2691;</h3></span>';
				if(!empty($lic_val['error'])){
					$conn_license_list .= "<div style='padding:5px;'><span style='color:red;font-weight:500;background-color:white;'>" . __('Error:','wp-app-studio') . '&nbsp;' . $lic_val['error'] . "</span></div>";
				}
			}
			$conn_license_list .= '</td><td><a href="' . wp_nonce_url(admin_url('admin.php?page=wpas_licenses_page&type=connection&action=delete&key=' . $lic_key),'delete') . '" class="btn btn-danger">' . __('Delete','wp-app-studio') . '</a></td></tr>';
		}
		echo $conn_license_list; 
?>
		</tbody>
		</table>
<?php } ?>
		</div>
		</div>
		</div>
		<?php
}
function wpas_show_ed_license(){
	global $edition_list;
	$select_ed_conn = '<select id="wpas_license_name" name=wpas_licenses[edition][name]">';
	if(!empty($edition_list)){
		foreach($edition_list as $eckey => $ecval){
			$select_ed_conn .= '<option value="' . $eckey . '"';
			$select_ed_conn .= '>' . $ecval . '</option>';
		}
	}
	$select_ed_conn .= '</select>';
	?>
	<tr>
	<th scope="row">
	<?php echo $select_ed_conn; ?>
	</th>
	<td>
	<input id="wpas_license_key" name="wpas_licenses[edition][key]" type="text" class="input-xlarge" value="" />
	</td>
	</tr>
<?php
}
function wpas_show_conn_license_row(){
	global $conn_list;
	$select_ed_conn = '<select id="wpas_license_con_name" name=wpas_licenses[connection][name]">';
	if(!empty($conn_list)){
		foreach($conn_list as $eckey => $ecval){
			$select_ed_conn .= '<option value="' . $eckey . '"';
			$select_ed_conn .= '>' . $ecval . '</option>';
		}
	}
	$select_ed_conn .= '</select>';
	?>
	<tr>
	<th scope="row">
	<?php echo $select_ed_conn; ?>
	</th>
	<td>
	<input id="wpas_license_con_key" name="wpas_licenses[connection][key]" type="text" class="input-xlarge" value="" />
	</td>
	</tr>
<?php
}
add_action( 'admin_init', 'wpas_license_register', 15);
/**
 * Register license settings option
 *
 * @since WPAS 5.0
 *
 */
function wpas_license_register(){
        if ( false == get_option( 'wpas_licenses' ) ) {
                add_option( 'wpas_licenses' );
        }
	//if(!empty($_POST)){
        	register_setting('wpas_licenses','wpas_licenses','wpas_sanitize_license');
	//}
}
/**
 * Sanitize license settings
 *
 * @since WPAS 5.0
 * @param array $new
 *
 * @return array $new
 */
function wpas_sanitize_license($new){
	$licenses = get_option('wpas_licenses',Array());
	if(empty($licenses)){
		$licenses = Array('edition' => Array(), 'connection' => Array());
	}	
	if(!empty($_GET['action']) && !empty($_GET['_wpnonce'])) {
		return $new;
	}
	if(!empty($_POST['action']) && sanitize_text_field($_POST['action']) == 'wpas_use_license_key'){
		return $new;
	}
	if(!empty($new)){
		if(!empty($new['edition']) && empty($new['edition']['key']) && empty($new['edition']['name'])){
			unset($new['edition']);
		}
		if(!empty($new['connection']) && empty($new['connection']['key']) && empty($new['connection']['name'])){
			unset($new['connection']);
		}
		if(!empty($new['edition'])){
			$licenses['edition'][$new['edition']['key']]['name'] = $new['edition']['name'];
		}
		if(!empty($new['connection'])){
			$licenses['connection'][$new['connection']['key']]['name'] = $new['connection']['name'];
		}
	}
	return $licenses;
}
function wpas_activate_deactivate_license($license_action,$mylicense,$licenses){
	global $edition_list, $conn_list;
	$edition_conn_list = array_merge($edition_list,$conn_list);
	// data to send in our API request
	$api_params = array(
			'edd_action' => $license_action . '_license',
			'license' => $mylicense['key'],
			'item_name' => urlencode($edition_conn_list[$mylicense['name']]) , // the name of product
			'url' => home_url()
			);
	// Call the custom API.
	$response = wp_remote_post(WPAS_URL, array(
				'timeout' => 15,
				'sslverify' => false,
				'body' => $api_params
			));
	// make sure the response came back okay
	if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
		if(is_wp_error($response)) {
			$error = $response->get_error_message();
		} else {
			$error = __('An error occurred, please try again.','wp-app-studio');
		}
		$licenses[$mylicense['type']][$mylicense['key']]['error'] = $error;
		return $licenses;
	}
	$license_data = json_decode(wp_remote_retrieve_body($response));
	if($license_action == 'activate' && false === $license_data->success) {
		switch($license_data->error) {
			case 'expired':
				$error = sprintf(
					__('Your license key expired on %s.','wp-app-studio'),
					date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
				);
				break;
			case 'revoked':
				$error = __('Your license key has been disabled.','wp-app-studio');
				break;
			case 'missing':
				$error = __('Invalid license key.','wp-app-studio');
				break;
			case 'invalid':
			case 'site_inactive':
				$error = __('Your license key is not active for this URL.','wp-app-studio');
				break;
			case 'item_name_mismatch':
				$error = sprintf(__('This appears to be an invalid license key for %s.','wp-app-studio'), $edition_conn_list[$mylicense['name']]);
				break;
			case 'no_activations_left':
				$error = __('Your license key has reached its activation limit.','wp-app-studio');
				break;
			default :
				$error = __('We were unable to activate your license. Please check your license key and try again. If your license key is correct, please open a support ticket.','wp-app-studio');
				break;
		}
		$licenses[$mylicense['type']][$mylicense['key']]['error'] = $error;
		return $licenses;
	}
	elseif($license_action == 'deactivate' && false === $license_data->success){
		$error = __('We were unable to deactivate your license. Please check your license key and try again. If your license key is correct, please open a support ticket.','wp-app-studio');
		$licenses[$mylicense['type']][$mylicense['key']]['error'] = $error;
		return $licenses;
	}
	unset($licenses[$mylicense['type']][$mylicense['key']]['error']);
	// decode the license data
	if ($license_action == 'activate') {
		$licenses[$mylicense['type']][$mylicense['key']]['status'] = $license_data->license;
	} elseif ($license_action == 'deactivate' && $license_data->license == 'deactivated') {
		$licenses[$mylicense['type']][$mylicense['key']]['status'] = $license_data->license;
		$licenses[$mylicense['type']][$mylicense['key']]['use_for_generate'] = 0;
	}
	return $licenses;
}
add_action('wp_ajax_wpas_use_license_key','wpas_use_license_key');
function wpas_use_license_key(){
	if(empty($_POST['type']) && empty($_POST['key'])){
		echo false;
		die();	
	}
	$type = sanitize_text_field($_POST['type']);
	$key = sanitize_text_field($_POST['key']);
	$use = sanitize_text_field($_POST['use']);
	$key = preg_replace('/^wpas_use_edition_/','',$key);
	$key = preg_replace('/^wpas_use_conn_/','',$key);
	$licenses = get_option('wpas_licenses',Array());
	if($type == 'edition' && $use == 1 && $licenses['edition'][$key]['status'] == 'valid'){
		foreach($licenses['edition'] as $lic_key => $lic_val){
			if($lic_val['use_for_generate'] == 1){
				$licenses['edition'][$lic_key]['use_for_generate'] = 0;
			}
		}
		$licenses['edition'][$key]['use_for_generate'] = 1;
		update_option('wpas_licenses',$licenses);
		echo 'valid';
	}
	elseif($type == 'edition' && $use == 0){
		$licenses['edition'][$key]['use_for_generate'] = 0;
		update_option('wpas_licenses',$licenses);
		echo 'valid';
	}	
	elseif($type == 'connection' && $use == 1 && $licenses[$type][$key]['status'] == 'valid'){
		$licenses['connection'][$key]['use_for_generate'] = 1;
		update_option('wpas_licenses',$licenses);
		echo 'valid';
	}
	elseif($type == 'connection' && $use == 0){
		$licenses['connection'][$key]['use_for_generate'] = 0;
		update_option('wpas_licenses',$licenses);
		echo 'valid';
	}
	else {
		echo 'invalid';
	}
	die();
}
add_action('admin_init','wpas_license_actions');
function wpas_license_actions(){
	if(isset($_GET['page']) && $_GET['page'] == 'wpas_licenses_page'){
		$licenses = get_option('wpas_licenses',Array());
		if(!empty($_GET['action']) && !empty($_REQUEST['_wpnonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])), 'deactivate_action')) {
			$gkey = sanitize_text_field($_GET['key']);
			$mylicense['key'] = $gkey;
			$type = sanitize_text_field($_GET['type']);
			if(!empty($licenses[$type][$gkey])){
				$mylicense['name'] = $licenses[$type][$gkey]['name'];
				$mylicense['type'] = $type;
			}
			$licenses = wpas_activate_deactivate_license('deactivate',$mylicense,$licenses);	
			update_option('wpas_licenses',$licenses);
			wp_redirect(remove_query_arg(array('action', '_wpnonce','type','key')));
			exit;
		}
		elseif(!empty($_GET['action']) && !empty($_REQUEST['_wpnonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])), 'activate_action')) {
			$gkey = sanitize_text_field($_GET['key']);
			$mylicense['key'] = $gkey;
			$type = sanitize_text_field($_GET['type']);
			if(!empty($licenses[$type][$gkey])){
				$mylicense['name'] = $licenses[$type][$gkey]['name'];
				$mylicense['type'] = $type;
			}
			$licenses = wpas_activate_deactivate_license('activate',$mylicense,$licenses);
			update_option('wpas_licenses',$licenses);
			wp_redirect(remove_query_arg(array('action', '_wpnonce','type','key')));
			exit;
		}
		elseif(!empty($_GET['action']) && !empty($_REQUEST['_wpnonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])), 'delete')) {
			$gkey = sanitize_text_field($_GET['key']);
			$type = sanitize_text_field($_GET['type']);
			unset($licenses[$type][$gkey]);
			update_option('wpas_licenses',$licenses);
			wp_redirect(remove_query_arg(array('action', '_wpnonce','type','key')));
			exit;
		}
	}
}
