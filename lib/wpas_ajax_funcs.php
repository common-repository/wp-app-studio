<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//ajax functions
add_action('wp_ajax_nopriv_wpas_list_all','wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_edit','wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_save_form', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_save_field', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_update_form', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_delete', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_delete_field', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_list_fields', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_get_layout', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_edit_role', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_get_form_html', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_get_layout_tags', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_get_cond_list', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_get_cond_div', 'wpas_ajax_error_not_logged_in');
add_action('wp_ajax_nopriv_wpas_duplicate_item', 'wpas_ajax_error_not_logged_in');

function wpas_ajax_error_not_logged_in(){
	wp_die(__('Your WordPress session has been timed out. Please refresh your page and try again.','wp-app-studio'));
}
add_action('wp_ajax_wpas_get_app_options', 'wpas_get_app_options');
add_action('wp_ajax_wpas_save_form', 'wpas_save_form');
add_action('wp_ajax_wpas_save_option_form', 'wpas_save_option_form');
add_action('wp_ajax_wpas_save_field', 'wpas_save_field');
add_action('wp_ajax_wpas_update_form', 'wpas_update_form');
add_action('wp_ajax_wpas_list_all', 'wpas_list_all');
add_action('wp_ajax_wpas_delete', 'wpas_delete');
add_action('wp_ajax_wpas_edit', 'wpas_edit');
add_action('wp_ajax_wpas_edit_field', 'wpas_edit_field');
add_action('wp_ajax_wpas_delete_field', 'wpas_delete_field');
add_action('wp_ajax_wpas_list_fields', 'wpas_list_fields');
add_action('wp_ajax_wpas_save_layout', 'wpas_save_layout');
add_action('wp_ajax_wpas_get_layout', 'wpas_get_layout');
add_action('wp_ajax_wpas_get_entities', 'wpas_get_entities');
add_action('wp_ajax_wpas_edit_role', 'wpas_edit_role');

add_action('wp_ajax_wpas_check_unique', 'wpas_check_unique');
add_action('wp_ajax_wpas_check_help', 'wpas_check_help');
add_action('wp_ajax_wpas_check_status_generate', 'wpas_check_status_generate');
add_action('wp_ajax_wpas_get_roles','wpas_get_roles');
add_action('wp_ajax_wpas_get_email_attrs','wpas_get_email_attrs');
add_action('wp_ajax_wpas_get_form_layout', 'wpas_get_form_layout');
add_action('wp_ajax_wpas_get_form_text_html', 'wpas_get_form_text_html');
add_action('wp_ajax_wpas_get_form_html', 'wpas_get_form_html');
add_action('wp_ajax_wpas_form_layout_save', 'wpas_form_layout_save');

add_action('wp_ajax_wpas_get_search_forms','wpas_get_search_forms');
add_action('wp_ajax_wpas_get_ent_layout_attrs','wpas_get_ent_layout_attrs');
add_action('wp_ajax_wpas_check_email','wpas_check_email');
add_action('wp_ajax_wpas_get_tax_values','wpas_get_tax_values');
add_action('wp_ajax_wpas_get_ent_fields', 'wpas_get_ent_fields');
add_action('wp_ajax_wpas_get_date_ranges', 'wpas_get_date_ranges');
add_action('wp_ajax_wpas_get_table_cols', 'wpas_get_table_cols');
add_action('wp_ajax_wpas_check_app_dash', 'wpas_check_app_dash');

add_action('wp_ajax_wpas_get_notify_attach','wpas_get_notify_attach');


add_action('wp_ajax_wpas_get_layout_tags','wpas_get_layout_tags');
add_action('wp_ajax_wpas_clear_log_generate', 'wpas_clear_log_generate');

add_action('wp_ajax_wpas_get_inline_ent_attr','wpas_get_inline_ent_attr');
add_action('wp_ajax_wpas_get_default_vals','wpas_get_default_vals');
add_action('wp_ajax_wpas_get_orderby_fields','wpas_get_orderby_fields');
add_action('wp_ajax_wpas_get_cond_list','wpas_get_cond_list');
add_action('wp_ajax_wpas_get_cond_div','wpas_get_cond_div');

add_action('wp_ajax_wpas_update_glob_fields_order','wpas_update_glob_fields_order');
add_action('wp_ajax_wpas_get_org_types','wpas_get_org_types');
add_action('wp_ajax_wpas_get_org_vals','wpas_get_org_vals');
add_action('wp_ajax_wpas_duplicate_item','wpas_duplicate_item');
add_action('wp_ajax_wpas_get_chart_conn','wpas_get_chart_conn');
add_action('wp_ajax_wpas_get_connections','wpas_get_connections');
add_action('wp_ajax_wpas_admin_loc','wpas_admin_loc');
add_action('wp_ajax_wpas_get_submit_forms','wpas_get_submit_forms');
add_action('wp_ajax_wpas_get_form_taxs','wpas_get_form_taxs');

add_action('wp_ajax_wpas_create_def_views','wpas_create_def_views');

function wpas_create_def_views(){
        wpas_is_allowed();
	$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	$single_views = Array();
	$archive_views = Array();
	$tax_views = Array();
	$has_archive = Array();
	//check if single and archive created
	foreach($app['shortcode'] as $myshc){
		if($myshc['shc-view_type'] == 'single'){
			$single_views[] = $myshc['shc-attach'];
		}
		elseif($myshc['shc-view_type'] == 'archive'){
			$archive_views[] = $myshc['shc-attach'];
		}
		elseif($myshc['shc-view_type'] == 'tax'){
			$tax_views[$myshc['shc-attach_tax']][] = $myshc['shc-attach'];
		}
	}
	foreach($app['entity'] as $kent => $myent){
		if(!empty($myent['ent-has_archive'])){
			$has_archive[] = $kent;
		}
		if(!in_array($kent,$single_views) && (!in_array($myent['ent-name'],Array('post','page'))) && !empty($myent['ent-publicly_queryable'])){
			$new_shc_single = Array('base64_encoded' => 1, 'shc-label' => 'single_' . $myent['ent-name'], 'shc-view_type' => 'single', 'shc-attach' => $kent,
					'shc-theme_type' => 'Bootstrap', 'shc-font_awesome' => 1, 'shc-sc_layout' => base64_encode("CHANGE THIS LAYOUT"), 'shc-setup_page' => 0,
					'date' => date('Y-m-d H:i:s'), 'modified_date' => date('Y-m-d H:i:s')
					);
			$app['shortcode'][] = $new_shc_single;
			wpas_update_app($app,$app_id);
		}
		if(!in_array($kent,$archive_views) && (!in_array($myent['ent-name'],Array('post','page'))) && !empty($myent['ent-has_archive'])){
			$new_shc_archive = Array('base64_encoded' => 1, 'shc-label' => 'archive_' . $myent['ent-name'], 'shc-view_type' => 'archive', 'shc-attach' => $kent,
					'shc-theme_type' => 'Bootstrap', 'shc-font_awesome' => 1, 'shc-sc_layout' => base64_encode("CHANGE THIS LAYOUT"), 'shc-setup_page' => 0,
					'date' => date('Y-m-d H:i:s'), 'modified_date' => date('Y-m-d H:i:s')
					);
			$app['shortcode'][] = $new_shc_archive;
			wpas_update_app($app,$app_id);
		}
	}
	foreach($app['taxonomy'] as $ktax => $mytax){
		if(!in_array($ktax,array_keys($tax_views))){
			foreach($mytax['txn-attach'] as $txn_attach_ent){
				if(in_array($txn_attach_ent,$has_archive)){
					if(count($mytax['txn-attach']) == 1){
						$txn_name = 'tax_' . $mytax['txn-name'];
					}
					else {
						$txn_name = 'tax_' . $mytax['txn-name'] . '_' . $app['entity'][$txn_attach_ent]['ent-name'];
					}
					$new_shc_tax = Array('base64_encoded' => 1, 'shc-label' => $txn_name, 
					'shc-view_type' => 'tax', 'shc-attach_tax' => $ktax, 'shc-attach' => $txn_attach_ent,
					'shc-theme_type' => 'Bootstrap', 'shc-font_awesome' => 1, 'shc-sc_layout' => base64_encode("CHANGE THIS LAYOUT"), 'shc-setup_page' => 0,
					'date' => date('Y-m-d H:i:s'), 'modified_date' => date('Y-m-d H:i:s')
					);
					$app['shortcode'][] = $new_shc_tax;
					wpas_update_app($app,$app_id);
				}
			}
		}
	}
	echo true;
	die();
}
	
function wpas_admin_loc(){
        wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	$options = '<option value=""';
	if($value == ''){
		$options .= ' selected';
	}
	$options .= '>' . __('Please select','wp-app-studio') . '</option>';
	if(!empty($app['entity'][$ent_id]['layout'])){
		foreach($app['entity'][$ent_id]['layout'] as $klay => $myadmin_layout){
			if(!empty($myadmin_layout['tabs'])){
				foreach($myadmin_layout['tabs'] as $ktab => $mytab){
					$options .= '<option value="' . $klay . '__tab__' . $ktab . '"';
					if($value == $klay . '__tab__' . $ktab){
						$options .= ' selected';
					}
					$options .= '>' . $myadmin_layout['gr_title'] . ' - ' .  $mytab['tab_title'] . '</option>';
				}
			}	
			if(!empty($myadmin_layout['accs'])){
				foreach($myadmin_layout['accs'] as $kacc => $myacc){
					$options .= '<option value="' . $klay . '__acc__' . $kacc . '"';
					if($value == $klay . '__acc__' . $kacc){
						$options .= ' selected';
					}
					$options .= '>' . $myadmin_layout['gr_title'] . ' - ' .  $myacc['acc_title'] . '</option>';
				}
			}	
		}
	}
	else {
		$options .= '<option value="0"';
		if($value == 0){
			$options .= ' selected';
		}
		$options .= '>' . __('Default','wp-app-studio') . '</option>';
	}
	echo $options;
	die();
}	
function wpas_get_connections(){
        wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	$options = '<option value=""';
	if($value == ''){
		$options .= ' selected';
	}
	$options .= '>' . __('Please select','wp-app-studio') . '</option>';
	if(!empty($app['connection'])){
		foreach($app['connection'] as $kcon => $mycon){
			if($mycon['connection-type'] == 'woocommerce'){
				if($mycon['connection-entity'] == $ent_id){ 
					if($mycon['connection-woo_order_rel'] == 1){
						$con_options[$kcon . '_woo_order'] = $mycon['connection-woo_label'] . ' ' . __('Order','wp-app-studio');
					}		
					if($mycon['connection-woo_product_rel'] == 1){
						$con_options[$kcon . '_woo_product'] = $mycon['connection-woo_label'] . ' '  . __('Product','wp-app-studio');
					}
				}
			}
			if($mycon['connection-type'] == 'edd'){
				if($mycon['connection-entity'] == $ent_id){ 
					if($mycon['connection-edd_order_rel'] == 1){
						$con_options[$kcon . '_edd_order'] = $mycon['connection-edd_label'] . ' ' . __('Order','wp-app-studio');
					}		
					if($mycon['connection-edd_product_rel'] == 1){
						$con_options[$kcon . '_edd_product'] = $mycon['connection-edd_label'] . ' '  . __('Download','wp-app-studio');
					}
				}
			}
		}
	}
	if(!empty($con_options)){
		foreach($con_options as $kcon => $vcon){
			$options .= '<option value="' . $kcon . '"';
			if($value == $kcon){
				$options .= ' selected';
			}
			$options .= '>' . $vcon . '</option>';
		}
	}
	echo $options;
	die();
}
function wpas_get_chart_conn(){
        wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$func = isset($_GET['func']) ? sanitize_text_field($_GET['func']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	$axis_type = '<option value=""';
	if($value == ''){
		$axis_type .= ' selected';
	}
	$axis_type .= '>' . __('Please select','wp-app-studio') . '</option>';
	switch($func) {
		case 'uniq':
			$axis_vals['unique']  = __('Unique Attributes','wp-app-studio');
			break;
		case 'none':
		case 'sum':
		case 'avg':
		case 'max':
		case 'min':
			$axis_vals['attribute'] = __('Attribute Field','wp-app-studio');
			break;
		case 'count':
			$axis_vals['date'] = __('Date Field','wp-app-studio');
			$axis_vals['attribute'] = __('Attribute Field','wp-app-studio');
			$axis_vals['taxonomy'] = __('Taxonomy','wp-app-studio');
			$axis_vals['relationship'] = __('Relationship','wp-app-studio');		
			if(!empty($app['connection'])){
				foreach($app['connection'] as $mycon){
					if($mycon['connection-type'] == 'woocommerce'){
						if($mycon['connection-entity'] == $ent_id && $mycon['connection-woo_order_rel'] == 1 || $mycon['connection-woo_product_rel'] == 1){
							$axis_vals['connection'] = __('Connection','wp-app-studio');
							continue;
						}
					}
					if($mycon['connection-type'] == 'edd'){
						if($mycon['connection-entity'] == $ent_id && $mycon['connection-edd_order_rel'] == 1 || $mycon['connection-edd_product_rel'] == 1){
							$axis_vals['connection'] = __('Connection','wp-app-studio');
							continue;
						}
					}
				}
			}			
			break;
		case 'default':		
			$axis_vals['date'] = __('Date Field','wp-app-studio');
			$axis_vals['attribute'] = __('Attribute Field','wp-app-studio');
			$axis_vals['taxonomy'] = __('Taxonomy','wp-app-studio');
			$axis_vals['relationship'] = __('Relationship','wp-app-studio');		
			break;
	}
	foreach($axis_vals as $kval => $vval){
		$axis_type .= '<option value="' . $kval . '"';
		if($value == $kval){
			$axis_type .= ' selected';
		}
		$axis_type .= '>' . $vval . '</option>';
	}
	echo $axis_type;
	die();	
}
function wpas_duplicate_item(){
        wpas_is_allowed();
	$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
	$type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$item_id = isset($_POST['item_id']) ? sanitize_text_field($_POST['item_id']) : '';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	if(!empty($type) && $item_id != ''){
		$max_key = max(array_keys($app[$type]));
		$form_id = $max_key + 1;
		$app[$type][$form_id] = $app[$type][$item_id];
		switch($type){
			case 'form':
				$app[$type][$form_id]['form-name'] = $app[$type][$item_id]['form-name'] . "_copy";
				break;
			case 'shortcode':
				$app[$type][$form_id]['shc-label'] = $app[$type][$item_id]['shc-label'] . "_copy";
				break;
			case 'widget':
				$app[$type][$form_id]['widg-name'] = $app[$type][$item_id]['widg-name'] . "_copy";
				break;
		}
		$app[$type][$form_id]['modified_date'] = date("Y-m-d H:i:s");
		$app[$type][$form_id]['date'] = date("Y-m-d H:i:s");
                wpas_update_app($app,$app_id);
	}
	echo wpas_list($type,$app,$app_id,1);
	die();
}

function wpas_get_org_vals(){
        wpas_is_allowed();
	$return = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	if(!empty($app['relationship'])){
		foreach($app['relationship'] as $krel => $vrel){
			if($vrel['rel-from-name'] == $vrel['rel-to-name'] && empty($vrel['rel-reciprocal']) && $vrel['rel-type'] == 'one-to-many' && $vrel['rel-from-name'] == $ent_id){
				$return .= '<option value="' . $krel . '"';
				if($value == $krel){
					$return .= ' selected';
				}
				$return .= '>' . wpas_get_rel_full_name($vrel,$app) . '</option>';
			}
		}
	}
	echo $return;
	die();
}
function wpas_get_org_types(){
        wpas_is_allowed();
	$return = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	$return .= '<option value="rel"';
	if($value == 'rel'){
		$return .= ' selected';
	}
	$return .= '>' . __('Relationship','wp-app-studio') . '</option>';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	if(!empty($app['entity'][$ent_id]) && isset($app['entity'][$ent_id]['ent-hierarchical']) && $app['entity'][$ent_id]['ent-hierarchical'] == 1){
		$return .= '<option value="hier"';
		if($value == 'hier'){
			$return .= ' selected';
		}
		$return .= '>' . __('Hierarchical Entity','wp-app-studio') . '</option>';
	}
	echo $return;
	die();
}	

function wpas_update_glob_fields_order(){
        wpas_is_allowed();
	$new_arr = Array();
	$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
	$comp_id = isset($_POST['comp_id']) ? sanitize_text_field($_POST['comp_id']) : '';
	$type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : Array();
	$bl = isset($_POST['blt']) ? sanitize_text_field($_POST['blt']) : Array();
	$rstring = $type . '_';

	if(empty($app_id) || empty($order))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	foreach($order as $ord)
	{
		$ord = str_replace($rstring,'',$ord);
		switch($type){
			case 'glob':
				$new_arr[$ord] = $app[$type][$ord];
				break;
			case 'entity_fields':
				$new_arr[$ord] = $app['entity'][$comp_id]['field'][$ord];
				break;
			case 'rel_fields':
				$new_arr[$ord] = $app['relationship'][$comp_id]['field'][$ord];
				break;
			case 'help_fields':
				$new_arr[$ord] = $app['help'][$comp_id]['field'][$ord];
				break;
		}
	}
	if(!empty($bl)){
		foreach($bl as $blt){
			$blt = str_replace($rstring,'',$blt);
			$new_arr[$blt] = $app['entity'][$comp_id]['field'][$blt];
		}
	}	
	if($type == 'glob'){
		$app[$type] = $new_arr;
	}
	elseif($type == 'entity_fields'){
		$app['entity'][$comp_id]['field'] = $new_arr;
	}
	elseif($type == 'rel_fields'){
		$app['relationship'][$comp_id]['field'] = $new_arr;
	}
	elseif($type == 'help_fields'){
		$app['help'][$comp_id]['field'] = $new_arr;
	}
	wpas_update_app($app,$app_id);
	die();
}

function wpas_get_form_globals($app,$form_id,$value)
{
	$entity_filter_id = $app['form'][$form_id]['form-attached_entity'];
	$res = "";
	if(!empty($app['glob'])){
		foreach($app['glob'] as $glkey => $myglob){
			if(in_array($myglob['glob-type'],Array('text','textarea','wysiwyg'))){
				$res .= '<option value="' . $entity_filter_id . '__glb' . $glkey . '"';
				if($value == $entity_filter_id . '__glb' . $glkey){
					$res .= ' selected';
				}
				$res .= '>' . $myglob['glob-label'] . '</option>';
			}
		}
	}
	if($res != ''){
		$res = '<optgroup label="' . __("Globals","wp-app-studio") . '">' . $res . '</optgroup>';
	}
	return $res;
}

function wpas_get_cond_div()
{
        wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$field_id = isset($_GET['field_id']) ? sanitize_text_field($_GET['field_id']) : '';
	$from = isset($_GET['from']) ? sanitize_text_field($_GET['from']) : '';
	$count = isset($_GET['div_id']) ? sanitize_text_field($_GET['div_id']) : '';
	$attr_val = isset($_GET['attr_val']) ? sanitize_text_field($_GET['attr_val']) : '';
	$cond_check = isset($_GET['cond_check']) ? sanitize_text_field($_GET['cond_check']) : '';
	$val = isset($_GET['val']) ? sanitize_text_field($_GET['val']) : '';
	$val_type = isset($_GET['val_type']) ? sanitize_text_field($_GET['val_type']) : '';
	$relto_ent_id = isset($_GET['relto_ent_id']) ? sanitize_text_field($_GET['relto_ent_id']) : '';
	if($from == 'txn' || $from == 'rel'){
		$from = $from . '-';
	}
	else {
		$from = $from . '_';
	}
	if(is_array($ent_id)){
		$ent_id = $ent_id[0];
	}
       	$ret = '<table class="cond-div table" id="cond-' . $count . '">
                        <tr><td class="input-large">
                        <select name="' . $from . 'cond_attr_' . $count . '" id="' . $from . 'cond_attr_' . $count . '" class="cond-attr">
			<option value="">' . __('Please select','wp-app-studio') . '</option>';
	if(preg_match('/attr-/',$attr_val) && !preg_match('/__/',$attr_val)){	
		$attr_arr = explode("__",$attr_val);
		$attr_val = $attr_val . '__' . $ent_id;
	}
	if($from == 'fld_'){
		$ret .= wpas_entity_fields('cond',$app_id,$ent_id,$attr_val,$field_id);
	}
	else {
		$ret .= wpas_entity_fields('cond',$app_id,$ent_id,$attr_val);
	}
	if($from == 'rel-' && !empty($relto_ent_id)){
		$ret .= wpas_entity_fields('cond',$app_id,$relto_ent_id,$attr_val);
	}	
	if($attr_val == ''){
		if($from == 'txn-'){
			$ret .= wpas_entity_types($app_id,'cond',Array(),"",$field_id);
		}
		else {
			$ret .= wpas_entity_types($app_id,'cond',Array());
		}
	}
	else {
		if($from == 'txn-'){
			$ret .= wpas_entity_types($app_id,'cond',$attr_val,"",$field_id);
		}
		else {
			$ret .= wpas_entity_types($app_id,'cond',$attr_val);
		}
	}
        $ret .= '</select></td>
                        <td class="input-small"><select name="' . $from . 'cond_check_' . $count . '" id="' . $from . 'cond_check_' . $count . '">';
	$check_options = Array('is' => __('Is','wp-app-studio'),
				'is_not' => __('Is Not','wp-app-studio'),
				'greater' => __('Greater Than','wp-app-studio'),
				'less' => __('Less Than','wp-app-studio'),
				'contains' => __('Contains','wp-app-studio'),
				'starts' => __('Starts With','wp-app-studio'),
				'ends' => __('Ends With','wp-app-studio')
			);
	foreach($check_options as $kopt => $vopt){
		$ret .= '<option value="' . $kopt . '"';
		if($kopt == $cond_check){
			$ret .= ' selected';
		}
		$ret .= '>' .  $vopt . '</option>';
	}
        $ret .= '</select></td><td class="input-medium">';
	
	if($val_type == 'none'){
		$ret .= '<input name="' . $from . 'cond_value_' . $count . '" id="' . $from . 'cond_value_' . $count . '" type="text" class="input-medium cond-value" style="display:none;margin-left:3px;"></input>';
             	$ret .= '<select name="' . $from . 'cond_sel_value_' . $count . '" id="' . $from . 'cond_sel_value_' . $count . '" class="cond-value" style="display:none;margin-left:3px;"></select>';
	}
	elseif($val_type != 'select'){
		$ret .= '<input name="' . $from . 'cond_value_' . $count . '" id="' . $from . 'cond_value_' . $count . '" type="text" class="imput-medium cond-value" value="'.  $val . '" style="margin-left:3px;"></input>';
             	$ret .= '<select name="' . $from . 'cond_sel_value_' . $count . '" id="' . $from . 'cond_sel_value_' . $count . '" class="cond-value" style="display:none;margin-left:3px;">';
		$ret .= '</select>';
	}
	else {
		$ret .= '<input name="' . $from . 'cond_value_' . $count . '" id="' . $from . 'cond_value_' . $count . '" type="text" class="imupt-medium cond-value" style="display:none;margin-left:3px;"></input>';
             	$ret .= '<select name="' . $from . 'cond_sel_value_' . $count . '" id="' . $from . 'cond_sel_value_' . $count . '" class="cond-value" style="margin-left:3px;">';
		if(preg_match('/attr-/',$attr_val)){
			$attr_val = str_replace('attr-','',$attr_val);
			$attr_arr = explode("__",$attr_val);
			$ent_id = $attr_arr[1];
			$attr_id = $attr_arr[0];	
			$ret .= wpas_get_default_vals($app_id,$ent_id,$attr_id,$val);
		}
		elseif(preg_match('/tax-/',$attr_val)){
			$ret .= wpas_get_tax_values($app_id,str_replace('tax-','',$attr_val),$val,'cond');
		}
		$ret .= '</select>';
	}
        $ret .= '</td>
		<td id="cond-add-delete-' . $count . '" class="layout-edit-icons">
		<a class="add-cond"><i class="icon-plus-sign"></i></a>
		<a class="delete-cond"><i class="icon-minus-sign"></i></a>
		</td></tr>
        </table>';
	echo $ret;	
	die();
}
	

function wpas_get_cond_list()
{
        wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$field_id = isset($_GET['field_id']) ? sanitize_text_field($_GET['field_id']) : '';
	$from = isset($_GET['from']) ? sanitize_text_field($_GET['from']) : '';
	$cond_count = isset($_GET['cond_count']) ? sanitize_text_field($_GET['cond_count']) : '';
	$count = $cond_count + 1;
	$relto_ent_id = isset($_GET['relto_ent_id']) ? sanitize_text_field($_GET['relto_ent_id']) : '';
	if($from == 'txn' || $from == 'rel'){
		$from = $from . '-';
	}
	else {
		$from = $from . '_';
	}
       	$ret = '<table class="cond-div table" id="cond-' . $count . '">
                        <tr><td class="input-large"><select name="' . $from . 'cond_attr_' . $count . '" id="' . $from . 'cond_attr_' . $count . '" class="cond-attr">
			<option value="">' . __('Please select','wp-app-studio') . '</option>';
	if($from == 'fld_'){
		$ret .= wpas_entity_fields('cond',$app_id,$ent_id,'',$field_id);
	}
	else {
		$ret .= wpas_entity_fields('cond',$app_id,$ent_id,'');
	}
	if($from == 'rel-' && !empty($relto_ent_id)){
		$ret .= wpas_entity_fields('cond',$app_id,$relto_ent_id,'');
	}	
	if($from == 'txn-'){		
		$ret .= wpas_entity_types($app_id,'cond',Array(),'',$field_id);
	}
	else {
		$ret .= wpas_entity_types($app_id,'cond',Array());
	}
        $ret .= '</select></td>
                        <td class="input-small"><select name="' . $from . 'cond_check_' . $count . '" id="' . $from . 'cond_check_' . $count . '">
                        <option value="is">' .  __('Is','wp-app-studio') . '</option>
                        <option value="is_not">' . __('Is Not','wp-app-studio') . '</option>
                        <option value="greater">' . __('Greater Than','wp-app-studio') . '</option>
                        <option value="less">' . __('Less Than','wp-app-studio') . '</option>
                        <option value="contains">' . __('Contains','wp-app-studio') . '</option>
                        <option value="starts">' . __('Starts With','wp-app-studio') . '</option>
                        <option value="ends">' . __('Ends With','wp-app-studio') . '</option>
                        </select></td>
                        <td class="input-medium"><input name="' . $from . 'cond_value_' . $count . '" id="' . $from . 'cond_value_' . $count . '" type="text" class="input-medium cond-value" style="margin-left:3px;"></input>
                        <select name="' . $from . 'cond_sel_value_' . $count . '" id="' . $from . 'cond_sel_value_' . $count . '" class="cond-value" style="display:none;margin-left:3px;"></select></td>
			<td id="cond-add-delete-' . $count . '" class="layout-edit-icons">
                        <a class="add-cond"><i class="icon-plus-sign"></i></a>
                        <a class="delete-cond"><i class="icon-minus-sign"></i></a>
                        </td></tr>
        </table>';
	echo $ret;	
	die();
}

function wpas_get_orderby_fields()
{
        wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$form_id = isset($_GET['form_id']) ? sanitize_text_field($_GET['form_id']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	if(empty($app_id) || ($ent_id == '' && $form_id == ''))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	if($form_id != ''){
		$ent_id = $app['form'][$form_id]['form-attached_entity'];
	}
	$blt_options= Array('date' => __('Date','wp-app-studio'),
			  'ID' => __('ID','wp-app-studio'),
			'author' => __('Author','wp-app-studio'),
			'title' => __('Title','wp-app-studio'),
			'parent' => __('Post parent id','wp-app-studio'),
			'modified' => __('Last modified date','wp-app-studio'),  
			'menu_order' => __('Menu Order', 'wp-app-studio'),
			'rand' => __('Random','wp-app-studio'),
			'comment_count' => __('Number of comments','wp-app-studio'),
			'none' => __('None','wp-app-studio')
			);
	$ret = '';
	foreach($blt_options as $boptkey => $boptval){
		$ret .= '<option value="' . $boptkey . '"';
		if($value == $boptkey)
		{
			$ret .= ' selected';
		}		
		$ret .= ' >' . $boptval . '</option>';
	}
	$ret .= wpas_entity_fields('order',$app_id,$ent_id,$value);
	echo $ret;
	die();
}
function wpas_get_default_vals($app_id='',$ent_id='',$att_id='',$value='')
{
        wpas_is_allowed();
	$result_ret = 1;
	$ret = '';
	if($app_id == '' && $ent_id == '' && $att_id == '')
	{
		$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
		$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
		$att_id = isset($_GET['att_id']) ? sanitize_text_field($_GET['att_id']) : '';
		$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
		$result_ret = 0;
	}

	if(empty($app_id) || $ent_id == '' || $att_id == '')
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	
	$app = wpas_get_app($app_id);
	if(!empty($app['entity'][$ent_id]['field'][$att_id]) && $app['entity'][$ent_id]['field'][$att_id]['fld_type'] == 'checkbox'){
		$ret .= "<option value='checked'";
		if($value == 'checked'){
			$ret .= " selected";
		}
		$ret .= ">" . __('Checked','wp-app-studio') . "</option>";
		if($value == 'unchecked'){
			$ret .= " selected";
		}
		$ret .= "<option value='unchecked'>" . __('Unchecked','wp-app-studio') . "</option>";
	}
	elseif(!empty($app['entity'][$ent_id]['field'][$att_id]['fld_values'])){
		$fld_values = explode(";",$app['entity'][$ent_id]['field'][$att_id]['fld_values']);
		foreach($fld_values as $myval){
			$myval = trim($myval);
			if(strlen($myval) != 0) {
				preg_match('/\{(.*)\}(.*)/',$myval,$matches);
                                if(empty($matches))
                                {
                                        $myval_key = str_replace(" ","_",trim($myval));
                                        $myval_key = preg_replace("/[^A-Za-z0-9_]/", "",$myval_key);
					$ret .= "<option value='" . $myval_key . "'";
					if($value == $myval_key){
						$ret .= " selected";
					}
					$ret .= ">" . trim($myval) . "</option>";
                                }
                                else
                                {
                                        if(isset($matches[1]))
                                        {
                                                $myval_key = str_replace(" ","_",trim($matches[1]));
                                                $myval_key = preg_replace("/[^A-Za-z0-9_]/", "",$myval_key);
						$ret .= "<option value='" . $myval_key . "'";
						if($value == $myval_key){
							$ret .= " selected";
						}
						$ret .= ">" . trim($matches[2]) . "</option>";
                                        }
                                }
			}
		}
	}
	if($result_ret == 1){
		return $ret;
	}
	echo $ret;
	die();
}
	

function wpas_get_inline_ent_attr()
{
        wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$values = isset($_GET['values']) ? stripslashes_deep(array_map('sanitize_text_field',$_GET['values'])) : Array();
	if(empty($app_id) || $ent_id == '')
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	if(!is_array($values))
        {
                $values= Array("$values");
        }
	$app = wpas_get_app($app_id);
	if(!empty($app['entity'][$ent_id]['field'])){
		foreach($app['entity'][$ent_id]['field'] as $keyfield => $myfield){
			if(in_array($myfield['fld_name'],Array('blt_content','blt_excerpt')) || $myfield['fld_type'] == 'wysiwyg'){
				echo '<option value="' . $keyfield . '"';
				if(in_array($keyfield,$values)){
					echo ' selected';
				}
				echo '>' . $myfield['fld_label'] . '</option>';
			}
		}
		if(isset($app['entity'][$ent_id]['ent-supports_comments']) && $app['entity'][$ent_id]['ent-supports_comments'] == 1)
		{
			if(!empty($app['entity'][$ent_id]['ent-com_single_label'])){
				echo '<option value="cust_comment"';
				if(in_array('cust_comment',$values)){
					echo ' selected';
				}
				echo '>' . $app['entity'][$ent_id]['ent-com_single_label'] . "</option>";
			}
			else {
				echo '<option value="wp_comment"';
				if(in_array('wp_comment',$values)){
					echo ' selected';
				}
				echo '>' . esc_html__('Builtin Comment','wp-app-studio') . '</option>';
			}
		}
	}
	die();
}

function wpas_clear_log_generate()
{
        wpas_is_allowed();
        check_ajax_referer('wpas_clear_log_generate_nonce','nonce');
        update_option('wpas_apps_submit',Array());
	echo esc_url(add_query_arg(array('page'=>'wpas_generate_page'), admin_url('admin.php')));
	die();
}

function wpas_get_layout_tags(){
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$comp_id = isset($_GET['comp_id']) ? sanitize_text_field($_GET['comp_id']) : '';
	$fld_id = isset($_GET['fld_id']) ? sanitize_text_field($_GET['fld_id']) : '';
	$rel_id = isset($_GET['rel_id']) ? sanitize_text_field($_GET['rel_id']) : '';
	$shc = isset($_GET['shc']) ? sanitize_text_field($_GET['shc']) : '';
	$shc_id = isset($_GET['shc_id']) ? sanitize_text_field($_GET['shc_id']) : '';
	$ret = '';
	$shortcodes = Array();
	//if(($type != 'integration' && (empty($app_id) || $comp_id == '')) || empty($type))
	if($type != 'integration' && empty($app_id) || empty($type))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	if($type == 'integration' || $type == 'tag-nocount' || $type == 'tag-rel' || $type == 'rel'){
		if(!empty($app['shortcode'])){
			$shc_label = '';
			if(!empty($app['shortcode'][$shc_id])){
				$shc_label = $app['shortcode'][$shc_id]['shc-label'];
			}
			foreach($app['shortcode'] as $myview){
				if(in_array($myview['shc-view_type'],Array('std','chart','datagrid','autocomplete')) && $shc_label != $myview['shc-label']){ 
					$shortcodes[$myview['shc-label']] = $myview['shc-label'];
				}
			}
			if(!empty($app['connection'])){
				foreach($app['connection'] as $mycon){
					if($mycon['connection-type'] == 'calendar' || $mycon['connection-type'] == 'calendar_lite'){
						$shortcodes[$mycon['connection-name']] = $mycon['connection-calendar_label'];
					}
				}
			}	
			if(!empty($app['form'])){
				foreach($app['form'] as $myform){
					if(!empty($myform['form-setup_page_title'])){
						$shortcodes[$myform['form-name']] = $myform['form-setup_page_title'];
					}
					elseif(!empty($myform['form-form_title'])){
						$shortcodes[$myform['form-name']] = $myform['form-form_title'];
					}
					else {
						$shortcodes[$myform['form-name']]  = ucfirst(str_replace("_"," ",$myform['form-name']));
					}
				}
			}
		}
	}
	if($type == 'concat'){
		$builtins = Array(
			'title' => __('Title','wp-app-studio'),
			'entity_id' => __('Entity ID','wp-app-studio'),
			'permalink' => __('Permalink','wp-app-studio'),
			'edit_link' => __('Edit Link','wp-app-studio'),
			'delete_link' => __('Delete Link','wp-app-studio'),
			'excerpt' => __('Excerpt','wp-app-studio'),
			'content' => __('Content','wp-app-studio'),
			'author_dispname' => __('Author Display Name','wp-app-studio'),
			'author_nickname' => __('Author Nickname','wp-app-studio'),
			'author_fname' => __('Author Firstname','wp-app-studio'),
			'author_lname' => __('Author Lastname','wp-app-studio'),
			'author_login' => __('Author Login','wp-app-studio'),
			'modified_datetime' => __('Modified DateTime','wp-app-studio'),
			'created_datetime' => __('Created DateTime','wp-app-studio'),
			'site_url' => __('Site URL','wp-app-studio'),
		);
		if(!empty($app['entity'][$comp_id]['field'])){
			foreach($app['entity'][$comp_id]['field'] as $kattr => $myattr){
				if(($fld_id != '' && $fld_id != $kattr) || $fld_id == ''){
					if($myattr['fld_type'] != 'textarea'){
						$attrs[$myattr['fld_name']] = $myattr['fld_label'];
					}
				}
			}
		}
		$ret = "<div class='wpas-tags-wrapper'><div class='wpas-tags-row'><div class='wpas-tags-header'>";
		$ret .= __('Use tags below to concat your string.','wp-app-studio');
		$ret .= '</div></div>
			<div class="wpas-tags-row"><h4>' . __('Builtins', 'wp-app-studio') . '</h4>
			<div class="wpas-tags-cell">';
		foreach($builtins as $key => $value){
			$ret .= $value . ": <b>!#" . $key . "#</b>, ";
		}
		$ret .= '</div></div>';
		if(!empty($attrs)){
                        $ret .= '<div class="wpas-tag-title"><h4>' . __('Attributes', 'wp-app-studio') . '</h4></div>';
			foreach($attrs as $key => $value){
				$ret .= $value . ": <b>!#ent_" . $key . "#</b>, ";
			}
                	$ret .= '</div></div>';
		}
		$ret .= '</div>';
	}
	elseif($type == 'formula'){
		if(!empty($app['entity'][$comp_id]['field'])){
			foreach($app['entity'][$comp_id]['field'] as $kattr => $myattr){
				if(($fld_id != '' && $fld_id != $kattr) || $fld_id == ''){
					if($myattr['fld_type'] != 'textarea'){
						$attrs[$myattr['fld_name']] = $myattr['fld_label'];
					}
				}
			}
		}
		$ret = "<div class='wpas-tags-wrapper'><div class='wpas-tags-row'><div class='wpas-tags-header'>";
		$ret .= __('Use tags and functions below for your formula.','wp-app-studio');
		$ret .= '</div></div>
			<div class="wpas-tag-title"><h4>' . __('Functions', 'wp-app-studio') . '</h4>
			<div class="wpas-tags-cell"><b>SUM</b>(attr1,attr2,...), <b>DATEDIF</b>(start_date_attr,end_date_attr), <b>AVERAGE</b>(attr1,attr2,...), <b>IF</b>(condition,returnIfTrue,returnIfFalse), <b>NPV</b>(discount_rate, value1, [value2, ... value_n]), <b>CONCATENATE</b>( text1, text2, ... text_n ), <a href="' . WPAS_URL . '/articles/calculated-attribute-functions/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">More Functions</a></div></div>';
		if(!empty($attrs)){
                        $ret .= '<div class="wpas-tags-row"><h4>' . __('Attributes', 'wp-app-studio') . '</h4><div class="wpas-tag-cell">';
			foreach($attrs as $key => $value){
				$ret .= $value . ": <b>!#ent_" . $key . "#</b>, ";
			}
                	$ret .= '</div></div>';
		}
		$ret .= '</div>';
	}
	elseif($type == 'integration'){
		$ret = "<div class='wpas-tags-wrapper'><div class='wpas-tags-row'><div class='wpas-tags-header'>";
		$ret .= __('Use template tags below to customize your layout.','wp-app-studio');
		$ret .= '</div></div>
			<div class="wpas-tags-row"><h4>' . __('Functions', 'wp-app-studio') . '</h4>
			<div class="wpas-tags-cell">Translate : <b>!#trans[' . __('Text to translate','wp-app-studio') . ']#</b>, Control If: <b>!#control-if[\'Condition\',\'True Value\',\'False Value\']#</b></div></div>';
		if(!empty($shortcodes)){
                        $ret .= '<div class="wpas-tags-row"><h4>' . __('Shortcodes', 'wp-app-studio') . '</h4><div class="wpas-tags-cell">';
			foreach($shortcodes as $key => $value){
				$ret .= $value . ": <b>!#shortcode[" . $key . "]#</b>, ";
			}
                	$ret .= '</div></div>';
		}
		if(!empty($app['glob'])){
			$ret .= '<div class="wpas-tags-row"><h4>' . __('Globals', 'wp-app-studio') . '</h4><div class="wpas-tags-cell">';
			foreach($app['glob'] as $myglob){
				$ret .= $myglob['glob-label'] . ": <b>!#" . $myglob['glob-name'] . "#</b>, ";
			}
                	$ret .= '</div></div>';
		}
		$ret .= '</div>';
	}
	else {
		$comp_id_arr = Array();
		if(in_array($type,Array('notify-tag-rel','notify-rel'))){
			$from_permalink = $app['entity'][$app['relationship'][$comp_id]['rel-from-name']]['ent-name'];
			$to_permalink = $app['entity'][$app['relationship'][$comp_id]['rel-to-name']]['ent-name'];
			$builtins[$from_permalink . '_title'] = $app['entity'][$app['relationship'][$comp_id]['rel-from-name']]['ent-label'] .  ' ' .__('Title','wp-app-studio');
			$builtins[$to_permalink . '_title'] = $app['entity'][$app['relationship'][$comp_id]['rel-to-name']]['ent-label'] . ' ' .  __('Title','wp-app-studio');
		}
		else {
			$builtins['title'] = __('Title','wp-app-studio');
		}	
		$builtins = array_merge($builtins, Array(
			'edit_link' => __('Edit Link','wp-app-studio'),
			'delete_link' => __('Delete Link','wp-app-studio'),
			'excerpt' => __('Excerpt','wp-app-studio'),
			'content' => __('Content','wp-app-studio'),
			'site_url' => __('Site URL','wp-app-studio'),
			));
		if(in_array($type,Array('notify-tag-rel','notify-rel','tag-nocount','tag-rel','rel','tag'))){
			$builtins_auth = Array(
				'author_dispname' => __('Author DisplayName','wp-app-studio'),
				'author_nickname' => __('Author Nickname','wp-app-studio'),
				'author_fname' => __('Author Firstname','wp-app-studio'),
				'author_lname' => __('Author Lastname','wp-app-studio'),
				'author_login' => __('Author Login','wp-app-studio'),
				'author_bio' => __('Author Bio','wp-app-studio'),
				'author_googleplus' => __('Author Google Plus','wp-app-studio'),
				'author_twitter' => __('Author Twitter','wp-app-studio'),
			);
			if(!in_array($type,Array('notify-tag-rel','notify-rel'))){
				$builtins_auth['author_picture'] = __('Author Picture 96px','wp-app-studio');	
				$builtins_auth['author_picture_48px'] = __('Author Picture 48px','wp-app-studio');	
				$builtins_auth['author_email'] = __('Author Email','wp-app-studio');	
				$builtins_auth['author_website'] = __('Author Website','wp-app-studio');	
			}
			$builtins = array_merge($builtins,$builtins_auth);
		}
		if(in_array($type,Array('notify-tag-rel','notify-rel'))){
			$from_permalink = $app['entity'][$app['relationship'][$comp_id]['rel-from-name']]['ent-name'];
			$to_permalink = $app['entity'][$app['relationship'][$comp_id]['rel-to-name']]['ent-name'];
			$builtins[$from_permalink . '_permalink'] = $app['entity'][$app['relationship'][$comp_id]['rel-from-name']]['ent-label'] .  ' ' .__('Permalink','wp-app-studio');
			$builtins[$to_permalink . '_permalink'] = $app['entity'][$app['relationship'][$comp_id]['rel-to-name']]['ent-label'] . ' ' .  __('Permalink','wp-app-studio');
		}
		else {
			$builtins_others = Array(
				'entity_id' => __('Entity ID','wp-app-studio'),
				'entity_sing_label' => __('Entity Singular Label','wp-app-studio'),
				'entity_label' => __('Entity Plural Label','wp-app-studio'),
				'permalink' => __('Permalink','wp-app-studio'),
				'author' => __('Author','wp-app-studio'),
				'mod_author' => __('Modified Author','wp-app-studio'),
				'featured_img' => __('Featured Image','wp-app-studio'),
				'featured_img_large' => __('Featured Image Large','wp-app-studio'),
				'featured_img_medium' => __('Featured Image Medium','wp-app-studio'),
				'featured_img_thumb' => __('Featured Image Thumbnail','wp-app-studio'),
				'featured_img_url' => __('Featured Image URL','wp-app-studio'),
				'featured_img_large_url' => __('Featured Image Large URL','wp-app-studio'),
				'featured_img_medium_url' => __('Featured Image Medium URL','wp-app-studio'),
				'featured_img_thumb_url' => __('Featured Image Thumbnail URL','wp-app-studio'),
				'modified_date' => __('Modified Date','wp-app-studio'),
				'modified_datetime' => __('Modified DateTime','wp-app-studio'),
				'modified_time' => __('Modified Time','wp-app-studio'),
				'created_date' => __('Created Date','wp-app-studio'),
				'created_time' => __('Created Time','wp-app-studio'),
				'created_datetime' => __('Created DateTime','wp-app-studio'),
				'current_time' => __('Current Time','wp-app-studio'),
			);
			$builtins = array_merge($builtins,$builtins_others);
		}
		if(!empty($app['connection'])){
			foreach($app['connection'] as $conn){
				if($conn['connection-type'] == 'youtube_api' && $comp_id == $conn['connection-entity']){
					$youtube = Array(
						'youtube_video_duration' => __('Video Duration','wp-app-studio'),
						'youtube_video_published_at' => __('Video Published At','wp-app-studio'),
						'youtube_video_view_count' => __('Video View Count','wp-app-studio'),
						'youtube_video_like_count' => __('Video Like Count','wp-app-studio'),
						'youtube_video_dislike_count' => __('Video Dislike Count','wp-app-studio'),
						'youtube_video_favorite_count' => __('Video Favorite Count','wp-app-studio'),
						'youtube_video_comment_count' => __('Video Comment Count','wp-app-studio'),
					);
					if(!empty($conn['connection-youtube_username'])){
						$youtube['youtube_channel_published_at'] = __('Channel Published At','wp-app-studio');
						$youtube['youtube_channel_view_count'] = __('Channel View Count','wp-app-studio');
						$youtube['youtube_channel_comment_count'] = __('Channel Comment Count','wp-app-studio');
						$youtube['youtube_channel_subscriber_count'] = __('Channel Subscriber Count','wp-app-studio');
						$youtube['youtube_channel_video_count'] = __('Channel Video Count','wp-app-studio');
					}
					break;
				}
				elseif($conn['connection-type'] == 'rating' || $conn['connection-type'] == 'rating_lite'){
					$shortcodes[$conn['connection-name']] = $conn['connection-rating_label'];
					$shortcodes[$conn['connection-name'] . '_stats'] = $conn['connection-rating_label']. '&nbsp;' . __('Stats','wp-app-studio');
				}
				elseif($conn['connection-type'] == 'woocommerce'){
					if($conn['connection-woo_order_rel'] == 1){
						$woocommerce[$conn['connection-name'] . '_order_layout'] = $conn['connection-woo_label'] . ' ' .__('Order Layout','wp-app-studio');
						$woocommerce[$conn['connection-name'] . '_order_csv'] = $conn['connection-woo_label'] . ' ' .__('Order List(Comma Seperated)','wp-app-studio');
						$woocommerce[$conn['connection-name'] . '_order_ol'] = $conn['connection-woo_label'] . ' ' .__('Order List(Ordered)','wp-app-studio');
						$woocommerce[$conn['connection-name'] . '_order_ul'] = $conn['connection-woo_label'] . ' ' .__('Order List(Unordered)','wp-app-studio');
						$woocommerce[$conn['connection-name'] . '_order_div'] = $conn['connection-woo_label'] . ' ' .__('Order List(Standard)','wp-app-studio');
					}
					if($conn['connection-woo_product_rel'] == 1){
						$woocommerce[$conn['connection-name'] . '_product_layout'] = $conn['connection-woo_label'] . ' ' .__('Product Layout','wp-app-studio');
						$woocommerce[$conn['connection-name'] . '_product_csv'] = $conn['connection-woo_label'] . ' ' .__('Product List(Comma Seperated)','wp-app-studio');
						$woocommerce[$conn['connection-name'] . '_product_ol'] = $conn['connection-woo_label'] . ' ' .__('Product List(Ordered)','wp-app-studio');
						$woocommerce[$conn['connection-name'] . '_product_ul'] = $conn['connection-woo_label'] . ' ' .__('Product List(Unordered)','wp-app-studio');
						$woocommerce[$conn['connection-name'] . '_product_div'] = $conn['connection-woo_label'] . ' ' .__('Product List(Standard)','wp-app-studio');
					}	
				}	
				elseif($conn['connection-type'] == 'edd'){
					if($conn['connection-edd_order_rel'] == 1){
						$edd[$conn['connection-name'] . '_order_layout'] = $conn['connection-edd_label'] . ' ' .__('Order Layout','wp-app-studio');
						$edd[$conn['connection-name'] . '_order_csv'] = $conn['connection-edd_label'] . ' ' .__('Order List(Comma Seperated)','wp-app-studio');
						$edd[$conn['connection-name'] . '_order_ol'] = $conn['connection-edd_label'] . ' ' .__('Order List(Ordered)','wp-app-studio');
						$edd[$conn['connection-name'] . '_order_ul'] = $conn['connection-edd_label'] . ' ' .__('Order List(Unordered)','wp-app-studio');
						$edd[$conn['connection-name'] . '_order_div'] = $conn['connection-edd_label'] . ' ' .__('Order List(Standard)','wp-app-studio');
					}
					if($conn['connection-edd_product_rel'] == 1){
						$edd[$conn['connection-name'] . '_download_layout'] = $conn['connection-edd_label'] . ' ' .__('Download Layout','wp-app-studio');
						$edd[$conn['connection-name'] . '_download_csv'] = $conn['connection-edd_label'] . ' ' .__('Download List(Comma Seperated)','wp-app-studio');
						$edd[$conn['connection-name'] . '_download_ol'] = $conn['connection-edd_label'] . ' ' .__('Download List(Ordered)','wp-app-studio');
						$edd[$conn['connection-name'] . '_download_ul'] = $conn['connection-edd_label'] . ' ' .__('Download List(Unordered)','wp-app-studio');
						$edd[$conn['connection-name'] . '_download_div'] = $conn['connection-edd_label'] . ' ' .__('Download List(Standard)','wp-app-studio');
					}	
				}	
			}
		}
		if($type != 'tag-nocount' && $type != 'js' && $type != 'notify-tag-rel' && $type != 'notify-rel'){
			$builtins['layout_counter_id'] = __('Layout Counter Id','wp-app-studio');
			$builtins['shortcode_counter_id'] = __('Shortcode Counter Id','wp-app-studio');
		}
		$builtins_user = Array(
			'user_nicename' => __('User Nicename','wp-app-studio'),
			'user_email' => __('User Email','wp-app-studio'),
			'user_url' => __('User URL','wp-app-studio'),
			'user_registered' => __('User Registered','wp-app-studio'),
			'user_display_name' => __('User Display Name','wp-app-studio'),
			'user_login' => __('User Login','wp-app-studio')
		);
		if(in_array($type,Array('tag','tag-rel','tag-nocount','tag-form','rel','notify-tag-rel','notify-rel','js')) && isset($comp_id)){
			if($type == 'tag-form' && !empty($app['form']))
			{
				$comp_id_arr[] = $app['form'][$comp_id]['form-attached_entity'];
			}
			elseif($type == 'rel')
			{
				if($comp_id == 'user')
				{
					$builtins = array_merge($builtins,$builtins_user);
				}
				else
				{
					$comp_id_arr[] = $comp_id;
				}
			}
			elseif($type == 'notify-rel' && !empty($app['relationship'][$comp_id]))
			{
				if($app['relationship'][$comp_id]['rel-from-name'] == 'user')
				{
					$builtins = array_merge($builtins,$builtins_user);
				}
				else
				{
					$comp_id_arr[] = $app['relationship'][$comp_id]['rel-from-name'];
				}
				if($app['relationship'][$comp_id]['rel-to-name'] == 'user')
				{
					$builtins = array_merge($builtins,$builtins_user);
				}
				else
				{
					$comp_id_arr[] = $app['relationship'][$comp_id]['rel-to-name'];
				}
			}	
			else
			{
				$comp_id_arr[] = $comp_id;
			}
			foreach($comp_id_arr as $cid)
			{
				if(!empty($app['entity'][$cid]))
				{
					if(!empty($app['entity'][$cid]['ent-taxonomy_category']) && $app['entity'][$cid]['ent-taxonomy_category'] == 1)
					{
						$blt_tax['blt_tax_cat'] = __('Categories','wp-app-studio');
						$blt_tax['blt_tax_cat_NL'] = __('Categories NL','wp-app-studio');
					}
					if(!empty($app['entity'][$cid]['ent-taxonomy_post_tag']) && $app['entity'][$cid]['ent-taxonomy_post_tag'] == 1)
					{
						$blt_tax['blt_tax_tag'] = __('Tags','wp-app-studio');
						$blt_tax['blt_tax_tag_NL'] = __('Tags NL','wp-app-studio');
					}
					if(!empty($app['entity'][$cid]['field']))
					{
						foreach($app['entity'][$cid]['field'] as $myfield)
						{
							if(empty($myfield['fld_builtin']))
							{
								$comp_attrs['ent_'.$myfield['fld_name']] =  $myfield['fld_label'];
								if($myfield['fld_type'] == 'image' && $type != 'notify-tag-rel' && $type != 'notify-rel'){
									$comp_attrs['ent_'.$myfield['fld_name'].'_thumb'] =  $myfield['fld_label'] . "&nbsp;" . __('Thumbnail','wp-app-studio');
									$comp_attrs['ent_'.$myfield['fld_name'].'_medium'] =  $myfield['fld_label'] . "&nbsp;" . __('Medium','wp-app-studio');
									$comp_attrs['ent_'.$myfield['fld_name'].'_large'] =  $myfield['fld_label'] . "&nbsp;" . __('Large','wp-app-studio');
									$comp_attrs['ent_'.$myfield['fld_name'].'_url_1'] =  $myfield['fld_label'] . "&nbsp;" . __('URL','wp-app-studio');
									$comp_attrs['ent_'.$myfield['fld_name'].'_thumb_1'] =  $myfield['fld_label'] . "&nbsp;" . __('Thumbnail','wp-app-studio');
									$comp_attrs['ent_'.$myfield['fld_name'].'_medium_1'] =  $myfield['fld_label'] . "&nbsp;" . __('Medium','wp-app-studio');
									$comp_attrs['ent_'.$myfield['fld_name'].'_large_1'] =  $myfield['fld_label'] . "&nbsp;" . __('Large','wp-app-studio');
								}
								elseif(in_array($myfield['fld_type'],Array('radio','checkbox_list','select')) && $type != 'notify-tag-rel' && $type != 'notify-rel') {
									$attr_pairs['ent_' . $myfield['fld_name']] = $myfield['fld_label'];
								}
							}
						}
					}
				}
				if(!empty($app['taxonomy']))
				{
					foreach($app['taxonomy'] as $tkey => $mytax)
					{
						foreach($mytax['txn-attach'] as $mytxn_attach)
						{
							if($mytxn_attach == $cid)
							{
								$tax_attrs['tax_'.$mytax['txn-name']] =  $mytax['txn-label'];
								$tax_attrs['tax_'.$mytax['txn-name'] . '_NL'] =  $mytax['txn-label'] . " NL";
								$tax_attrs['tax_'.$mytax['txn-name'] . '_SL'] =  $mytax['txn-label'] . " Slug";
							}
						}
					}
				}
				if(($type == 'notify-tag-rel' || $type == 'notify-rel' || $type == 'tag-nocount') && !empty($app['relationship']))
				{
					foreach($app['relationship'] as $myrelation)
					{
						if($type == 'notify-tag-rel' || $type == 'notify-rel'){
							if($comp_id == $myrelation['rel-to-name']){
								$rel_attrs['rel_' . $myrelation['rel-name']] = $app['entity'][$myrelation['rel-from-name']]['ent-label'];
							}
							else {
								$rel_attrs['rel_' . $myrelation['rel-name']] = $app['entity'][$myrelation['rel-to-name']]['ent-label'];
							}
						}
						else
						{
							if(isset($myrelation['rel-connected-display']) && $myrelation['rel-connected-display'] == 1)
							{
								if($myrelation['rel-from-name'] == $myrelation['rel-to-name']  && $myrelation['rel-to-name'] == $cid && empty($myrelation['rel-reciprocal'])) {
									if(!empty($myrelation['rel-connected-display-from-title']))
									{
										$rel_attrs['entrelcon_from_' . $myrelation['rel-name']] = $myrelation['rel-connected-display-from-title'];
									}
									else {
										$label = $myrelation['rel-from-title'];
										if($myrelation['rel-from-title'] == $myrelation['rel-to-title']){
											$label = __('From','wp-app-studio') . ' ' . $label;
										}
										$rel_attrs['entrelcon_from_' . $myrelation['rel-name']] = $label;
									}
									if(!empty($myrelation['rel-connected-display-to-title']))
									{
										$rel_attrs['entrelcon_to_' . $myrelation['rel-name']] = $myrelation['rel-connected-display-to-title'];
									}
									else {
										$label = $myrelation['rel-to-title'];
										if($myrelation['rel-from-title'] == $myrelation['rel-to-title']){
											$label = __('To','wp-app-studio') . ' ' . $label;
										}
										$rel_attrs['entrelcon_to_' . $myrelation['rel-name']] = $label;
									}
								}
								elseif($myrelation['rel-from-name'] == $cid && !empty($myrelation['rel-con_from_layout']))
								{
									if(!empty($myrelation['rel-connected-display-from-title']))
									{
										$rel_attrs['entrelcon_' . $myrelation['rel-name']] = $myrelation['rel-connected-display-from-title'];
									}
									else
									{
										$rel_attrs['entrelcon_' . $myrelation['rel-name']] = $app['entity'][$myrelation['rel-to-name']]['ent-label'];
									}		
								}
								elseif($myrelation['rel-to-name'] == $cid && !empty($myrelation['rel-con_to_layout']))
								{
									if(!empty($myrelation['rel-connected-display-to-title']))
									{
										$rel_attrs['entrelcon_' . $myrelation['rel-name']] = $myrelation['rel-connected-display-to-title'];
									}
									else
									{
										$rel_attrs['entrelcon_' . $myrelation['rel-name']] = $app['entity'][$myrelation['rel-from-name']]['ent-label'];
									}
										
								}
							}
							if($myrelation['rel-type'] == 'many-to-many' && isset($myrelation['rel-related-display']) && $myrelation['rel-related-display'] == 1)
							{
								if($myrelation['rel-from-name'] == $cid && !empty($myrelation['rel-rel_from_layout']))
								{
									if(!empty($myrelation['rel-related-display-to-title']))
									{
										$rel_attrs['entrelrltd_' . $myrelation['rel-name']] = $myrelation['rel-related-display-to-title'];
									}
									else
									{
										$rel_attrs['entrelrltd_' . $myrelation['rel-name']] = $app['entity'][$myrelation['rel-to-name']]['ent-label'];
									}
								}
								elseif($myrelation['rel-to-name'] == $cid && !empty($myrelation['rel-rel_to_layout']))
								{
									if(!empty($myrelation['rel-related-display-from-title']))
									{
										$rel_attrs['entrelrltd_' . $myrelation['rel-name']] = $myrelation['rel-related-display-from-title'];
									}
									else
									{
										$rel_attrs['entrelrltd_' . $myrelation['rel-name']] = $app['entity'][$myrelation['rel-from-name']]['ent-label'];
									}
								}
							}
						}
					}
				}
				if($type == 'rel' && $rel_id != '' && !empty($app['relationship'][$rel_id]['field']))
				{
					foreach($app['relationship'][$rel_id]['field'] as $myfield)
					{
						$rel_fld_attrs['rel_'.$myfield['rel_fld_name']] =  $myfield['rel_fld_label'];
					}
				}
			}
		        $ret = "<div class='wpas-tags-wrapper'><div class='wpas-tags-row'><div class='wpas-tags-header'>";
			if($type == 'js'){
				$ret .= __('Use template tags below to customize your javascript.','wp-app-studio');
			}
			else {
				$ret .= __('Use template tags below to customize your layout. Taxonomy tags produce link(s) to the related record(s). For no link tag, add _nl to taxonomy tag. For example, for !#mytag_nl# tag produces a no link version of the tag.','wp-app-studio'); 
				if($type != 'notify-tag-rel' && $type != 'notify-rel'){
					$ret .= __('Functions can be used in header and footer sections as well.','wp-app-studio');
				}
			}
			$ret .= '</div></div>';
			if($type != 'js'){
				if($type != 'notify-tag-rel' && $type != 'notify-rel'){
					$ret .=	'<div class="wpas-tags-row"><h4>' . __('Functions', 'wp-app-studio') . '</h4>
					<div class="wpas-tags-cell"><div class="emdt-row"><div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . __('Translate','wp-app-studio') . '</div><div class="wpas-tag-code">!#trans[' . __('Text to translate','wp-app-studio') . ']#</div></div>';
					 $ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . __('Shortcode','wp-app-studio') . '</div><div class="wpas-tag-code">!#shortcode[' . __('Shortcode','wp-app-studio') . ']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">'. __('Oembed','wp-app-studio') . '</div><div class="wpas-tag-code">!#oembed[\'' . __('Video URL','wp-app-studio') . '\']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label"><a href="' . WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">Date Format</a></div><div class="wpas-tag-code">!#date-format[\'' . __('Format','wp-app-studio') . '\',' . __('Attribute Date Tag','wp-app-studio') . ']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label"><a href="' . WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">Human Time Diff to Now</a></div><div class="wpas-tag-code">!#human-diff[' . __('Attribute Date Tag','wp-app-studio') . ']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label"><a href="' . WPAS_URL . '/articles/formatting-date-and-time/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">Human Time Diff</a></div><div class="wpas-tag-code">!#human-diff[' . __('Attribute Date Tag From','wp-app-studio') . ',' . __('Attribute Date Tag To','wp-app-studio') . ']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . __('Human Datetime Range','wp-app-studio') . '</div><div class="wpas-tag-code">!#human-range[' . __('Start Date Attribute','wp-app-studio') . ',' . __('End Date Attribute','wp-app-studio') . ']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . __('WP Date Format','wp-app-studio') . '</div><div class="wpas-tag-code">!#wp-dateformat[' . __('Attribute Date Tag','wp-app-studio') . ']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . __('WP Datetime Format','wp-app-studio') . '</div><div class="wpas-tag-code">!#wp-datetimeformat[' . __('Attribute Datetime Tag','wp-app-studio') . ']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . __('WP Time Format','wp-app-studio') . '</div><div class="wpas-tag-code">!#wp-timeformat[' . __('Attribute Time Tag','wp-app-studio') . ']#</div></div>';
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . __('Control If','wp-app-studio') . '</div><div class="wpas-tag-code">!#control-if[\'Condition\',\'True Value\',\'False Value\']#</div></div>';
					if(!empty($app['entity'][$comp_id]['ent-supports_custom_fields']) && $app['entity'][$comp_id]['ent-supports_custom_fields'] == 1){
						$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label"><a href="' . WPAS_URL . '/articles/displaying-and-using-custom-fields-in-entity-view-layouts/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">' . __('Custom Attr','wp-app-studio') . '</a></div><div class="wpas-tag-code">!#custom-attr[\'' . __('Begin Html','wp-app-studio') . '\',\'' . __('Middle Html','wp-app-studio') . '\',\'' . __('End Html','wp-app-studio') . '\']#</div></div>';
					}
					$show_antispambot = 0;
					$show_gravatar = 0;
					$show_bs = 0;
					if($comp_id != ''  && !empty($app['entity'][$comp_id]['field'])){
						foreach($app['entity'][$comp_id]['field'] as $efield){
							if($efield['fld_type'] == 'email'){
								$show_antispambot = 1;
								$show_gravatar = 1;
							}
							elseif(in_array($efield['fld_type'],Array('image','plupload_image','thickbox_image'))){
								$show_bs = 1;
							}
						}
					}
					if($show_antispambot == 1){
						$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label"><a href="' . WPAS_URL . '/articles/how-to-block-email-spam-using-antispambot-function/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">' . __('Antispambot','wp-app-studio') . '</a></div><div class="wpas-tag-code">!#antispambot[' . __('Email Field','wp-app-studio') . ']#</div></div>';
					}
					if($show_gravatar == 1){
						$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label"><a href="' . WPAS_URL . '/articles/how-to-use-wordpress-gravatars-in-views/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">' . __('Gravatar','wp-app-studio') . '</a></div><div class="wpas-tag-code">!#gravatar[' . __('Email Field','wp-app-studio') . ',\'' . __('Class','wp-app-studio') . '\',\'' . __('Size','wp-app-studio') . '\',\'' . __('Height','wp-app-studio') . '\',\'' .  __('Width','wp-app-studio') . '\',\'' . __('Default','wp-app-studio') . '\',\'' . __('Alt','wp-app-studio') . '\',\'' . __('Rating','wp-app-studio') .'\']#</div></div>';
					}
					$ret .= '</div></div></div>';
					if($comp_id != ''){
						$ret .= '<div class="wpas-tags-row"><h4>' . __('Bootstrap', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
					}
					if($show_bs == 1){
						$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label"><a href="' . WPAS_URL . '/articles/how-to-create-bootstrap-3-carousel-in-view-layouts/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">' . __('Bootstrap Carousel','wp-app-studio') . '</a></div><div class="wpas-tag-code">!#bs-carousel[' . __('Image Attribute','wp-app-studio') . ', ' . __('Data Interval','wp-app-studio') . ', ' . __('Sliding Effect','wp-app-studio') . ', ' . __('Show Indicators','wp-app-studio') . ' , ' . __('Show Caption','wp-app-studio') . ' , ' . __('Show Controls','wp-app-studio') . ']#</div></div>';	
					}
					if($comp_id != ''){
						$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label"><a href="' . WPAS_URL . '/articles/how-to-create-twitters-bootstrap-modals-using-wp-app-studio/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=view-functions" target="_blank">' . __('Bootstrap Modal','wp-app-studio') . '</a></div><div class="wpas-tag-code">!#bs_modal[\'' . __('Triggering Button Title','wp-app-studio') . '\', \'' . __('Triggering Button Class','wp-app-studio') . '\', \'' . __('Modal Header Content','wp-app-studio') . '\', \'' . __('Modal Body Content','wp-app-studio') . '\', \'' . __('Modal Footer Content','wp-app-studio') . '\']#</div></div>';	
					}
					if($comp_id != ''){
						$ret .= '</div></div></div>';
					}
				}
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Builtin', 'wp-app-studio') . '</h4>
					<div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($builtins as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($app['glob'])){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Globals', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($app['glob'] as $myglob){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $myglob['glob-label'] . '</div><div class="wpas-tag-code">!#' . $myglob['glob-name'] . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($blt_tax)){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('WP Builtin Taxonomies', 'wp-app-studio') . '</h4><div class="wpas-tag-cell"><div class="emdt-row">';
				foreach($blt_tax as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($comp_attrs)){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Attributes', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($comp_attrs as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
					if(!empty($attr_pairs[$key])){
						$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $attr_pairs[$key] . ' ' . __('Key','wp-app-studio') . ' </div><div class="wpas-tag-code">!#' . $key . '_key#</div></div>';
					}
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($tax_attrs) && $type != 'js'){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Taxonomies', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($tax_attrs as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($rel_attrs) && $type != 'js'){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Relationships', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($rel_attrs as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($rel_fld_attrs) && $type != 'js'){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Relationship Attributes', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($rel_fld_attrs as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($youtube) && $type != 'js'){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Youtube', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($youtube as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($shortcodes) && $type != 'js' && $type != 'notify-tag-rel' && $type != 'notify-rel'){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Shortcodes', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($shortcodes as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#shortcode[' . $key . ']#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($woocommerce) && $type != 'js'){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('WooCommerce', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($woocommerce as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
			if(!empty($edd) && $type != 'js'){
				$ret .= '<div class="wpas-tags-row"><h4>' . __('Easy Digital Downloads', 'wp-app-studio') . '</h4><div class="wpas-tags-cell"><div class="emdt-row">';
				foreach($edd as $key => $value){
					$ret .= '<div class="wpas-tag-wrap emdt-row"><div class="wpas-tag-label">' . $value . '</div><div class="wpas-tag-code">!#' . $key . '#</div></div>';
				}
				$ret .= '</div></div></div>';
			}
				
			$ret .= '</div>';
		}
	}
	echo $ret;
        die();
}
function wpas_get_notify_attach()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	$app = wpas_get_app($app_id);
	if(!empty($app) && !empty($type))
	{
		echo "<option value=''>Please select</option>";
		switch ($type) {
			case 'entity':
			case 'tax':
				echo wpas_entity_types($app_id,$type,$value);
				break;
			case 'attr':
				foreach($app['entity'] as $kent => $myentity)
				{
					if(!empty($myentity['field']))
					{
						echo "<optgroup label='" . $myentity['ent-label'] . "'>";
						echo wpas_entity_fields('notify',$app_id,$kent,$value);
						echo "</optgroup>";
					}
				}
				break;
			case 'rel':
				foreach($app['relationship'] as $krel => $myrel)
				{
					echo "<option value='" . $krel . "'";
					if($krel == $value)
					{
						echo " selected";
					}
					echo ">" . wpas_get_rel_full_name($myrel,$app) . "</option>";
				}
				break;
			case 'com':
				foreach($app['entity'] as $kent => $myentity)
                                {
                                        if(!empty($myentity['ent-com_name']) && $myentity['ent-com_type'] == 'custom')
                                        {
                                                echo "<option value='" . $kent . "'";
						if($kent == $value)
						{
							echo " selected";
						}
						echo ">" . $myentity['ent-com_single_label'] . "</option>";
					}
				}
				break;
		}
	}
	die();
}
function wpas_check_app_dash()
{
	wpas_is_allowed();
	$resp = true;
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$layout = isset($_GET['layout']) ? wp_kses_post($_GET['layout']) : '';
	$app = wpas_get_app($app_id);
	$pattern = '/!#shortcode\[.*?\]#/';
	if(!empty($app) && !empty($app['shortcode']))
	{
		if(preg_match_all($pattern,$layout,$matches))
		{
			foreach($matches[0] as $mymatch)
			{
				$newmatch = preg_replace("/!#shortcode\[/","",$mymatch);
				$newmatch = preg_replace("/\]#/","",$newmatch);
				foreach($app['shortcode'] as $myshc)
				{
					if($myshc['shc-label'] == $newmatch && $myshc['shc-app_dash'] == 1)
					{
						$resp = false;
						break;
					}
				}

			}
		}
	}
	echo $resp;
	die();
}
function wpas_get_table_cols()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	if(is_array($_GET['chart_ent']) && !empty($_GET['chart_ent'])){
		$_GET['chart_ent'] = sanitize_text_field($_GET['chart_ent'][0]);
	}
	$chart_ent = isset($_GET['chart_ent']) ? sanitize_text_field($_GET['chart_ent']) : '';
	$table_cols = isset($_GET['table_cols']) ? array_map('sanitize_text_field',$_GET['table_cols']) : '';
	$conn = isset($_GET['conn']) ? sanitize_text_field($_GET['conn']) : 0;
	$return[0] = "";
	$return[1] = "";
	$app = wpas_get_app($app_id);
	if($table_cols != "" && $chart_ent != "" && !empty($app))
	{
		foreach($table_cols as $mycol)
		{
			if(preg_match('/__fld$/',$mycol))
			{
				$mycol_id = str_replace("__fld","",$mycol);
				if(!empty($app['entity'][$chart_ent]['field'][$mycol_id])){
					$return[1] .= "<option value='" . $mycol . "' selected>";
					$return[1] .= esc_html($app['entity'][$chart_ent]['field'][$mycol_id]['fld_label']) . "</option>";
				}
			}
			elseif(preg_match('/__tax__nl$/',$mycol))
			{
				$mycol_id = str_replace("__tax__nl","",$mycol);
				if(!empty($app['taxonomy'][$mycol_id])){
					$return[1] .= "<option value='" . $mycol . "' selected>";
					$return[1] .= esc_html($app['taxonomy'][$mycol_id]['txn-singular-label']) . " No Link</option>";
				}
			}
			elseif(preg_match('/__tax$/',$mycol))
			{
				$mycol_id = str_replace("__tax","",$mycol);
				if(!empty($app['taxonomy'][$mycol_id])){
					$return[1] .= "<option value='" . $mycol . "' selected>";
					$return[1] .= esc_html($app['taxonomy'][$mycol_id]['txn-singular-label']) . "</option>";
				}
			}
			elseif(preg_match('/__rel__nl$/',$mycol))
			{
				$mycol_id = str_replace("__rel__nl","",$mycol);
				if(!empty($app['relationship'][$mycol_id])){
					$return[1] .= "<option value='" . $mycol . "' selected>";
					$return[1] .= esc_html(wpas_get_rel_full_name($app['relationship'][$mycol_id],$app)) . " No Link</option>";
				}
			}
			elseif(preg_match('/__rel$/',$mycol))
			{
				$mycol_id = str_replace("__rel","",$mycol);
				if(!empty($app['relationship'][$mycol_id])){
					$return[1] .= "<option value='" . $mycol . "' selected>";
					$return[1] .= esc_html(wpas_get_rel_full_name($app['relationship'][$mycol_id],$app)) . "</option>";
				}
			}
		}
	}
	$vals = '';
	if(!empty($conn)){
		$vals = $table_cols;
	}
	$ret_attr = wpas_entity_fields('all',$app_id,$chart_ent,$vals);
	if(!empty($ret_attr))
	{
		$return[0] .= "<optgroup label='" . __('Attributes','wp-app-studio') . "'>" . $ret_attr . "</optgroup>";
	}
	$ret_tax = wpas_entity_types($app_id,'tax',$table_cols,"","",$chart_ent,0);
	if(!empty($ret_tax))
	{
		$return[0] .= "<optgroup label='" . __('Taxonomies','wp-app-studio')  . "'>" . $ret_tax . "</optgroup>";
	}
	$ret_rel = wpas_dependent_entities($app_id,$chart_ent,$vals,1);
	if(!empty($ret_rel))
	{
		$return[0] .= "<optgroup label='" .__('Relationships','wp-app-studio') . "'>" . $ret_rel . "</optgroup>";
	}
	echo wp_json_encode($return);
	die();
}
function wpas_get_date_ranges()
{
	wpas_is_allowed();
	$return = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	switch ($type){
		case 'month':
			$options = Array("cur" => "All Months in Current Year",
					 "prev" => "All Months in Previous Year");
			for($i=2;$i <= 5;$i++)
			{
				$options["last".$i] = "All Months in Last " . $i . " Years";
			}
			break;
		case 'day':
			$options = Array("cur" => "All Days in Current Week",
					 "prev" => "All Days in Previous Week");
			for($i=2;$i <= 10;$i++)
			{
				$options["last".$i] = "All Days in Last " . $i . " Weeks";
			}
			break;
	}
	foreach($options as $kopt => $vopt)
	{
		$return .= "<option value='" . $kopt . "'";
		if($value == $kopt)
		{
			$return .= " selected";
		}
		$return .= ">" . $vopt . "</option>";
	}
	echo $return;
	die();
}
function wpas_get_ent_fields()
{
	wpas_is_allowed();
	$return = Array();
	$return['pre'] = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	if($app_id == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$return['list'] = wpas_entity_fields($type,$app_id,$ent_id,$value);
	echo wp_json_encode($return);
	die();
}
function wpas_entity_fields($type,$app_id,$ent_id,$value,$curr_id='')
{
	$return = "";
	$date_types = Array('date','datetime','time');
	$hidden_date_types = Array('date_mm_dd_yyyy','date_dd_mm_yyyy','current_year','current_month','current_month_num','current_day','now','current_time');
	$num_types = Array('decimal','integer');
	$not_allowed_types = Array('password','textarea','wysiwyg','file','image','hidden_function');
	$not_allowed_order_types = Array('password','textarea','wysiwyg','file','image','hidden_function','color');
	$not_allowed_all = Array('password');
	$body_types =  Array('textarea','wysiwyg');
	$attach_types = Array('file','image');
	$name_types = Array('text','letters_only','letters_with_punc');
	$not_cond_types = Array('date','datetime','time','file','image','hidden_function');
	if($type == 'date')
	{
		$post_dates = Array("post_date"=> __('Post Date','wp-app-studio'),"post_date_gmt"=>__('Post Date GMT','wp-app-studio'),"post_modified"=>__('Post Modified','wp-app-studio'),"post_modified_gmt"=>__('Post Modified GMT','wp-app-studio'));
		foreach($post_dates as $kpdate=> $vpdate)
		{
			$return .= "<option value='" . $kpdate . "'";
			if($kpdate == $value)
			{
				$return .= " selected";
			}
			$return .= ">" . $vpdate . "</option>";
		}
	}
	if($type == 'pdate')
	{
		$return .= "<option value='post_date'";
		if(!empty($value) && in_array('post_date',$value))
		{
			$return .= " selected";
		}
		$return .= ">" . __('Post Date','wp-app-studio') . "</option>";
	}
		
	$app = wpas_get_app($app_id);
	if($app !== false && $ent_id != '' && !empty($app['entity'][$ent_id]['field']))
	{
		foreach($app['entity'][$ent_id]['field'] as $keyfield => $myfield)
		{	
			$show_field = 0;
			if($type == 'order' && (!in_array($myfield['fld_type'],$not_allowed_order_types) && empty($myfield['fld_builtin'])))
			{
				$show_field = 1;
			}
			elseif(($type == 'all' || $type == 'notify') && !in_array($myfield['fld_type'],$not_allowed_all))
			{
				$show_field = 1;
			}
			else if($type == 'date' && (in_array($myfield['fld_type'],$date_types) || ($myfield['fld_type'] == 'hidden_function' && in_array($myfield['fld_hidden_func'],$hidden_date_types))))
			{
				$show_field = 1;
			}
			else if($type == 'attribute' && !in_array($myfield['fld_type'],$not_allowed_types) && !in_array($myfield['fld_type'],$date_types))
			{
				$show_field = 1;
			}
			else if($type == 'attribute' && $myfield['fld_type'] == 'hidden_function' && !in_array($myfield['fld_hidden_func'],$hidden_date_types))
			{
				$show_field = 1;
			}
			else if($type == 'num_attribute' && in_array($myfield['fld_type'],$num_types))
			{
				$show_field = 1;
			}
			else if($type == 'body' && in_array($myfield['fld_type'],$body_types))
			{
				$show_field = 1;
			}
			else if($type == 'attach' && in_array($myfield['fld_type'],$attach_types))
			{
				$show_field = 1;
			}
			else if($type == 'email' && $myfield['fld_type'] == 'email')
			{
				$show_field = 1;
			}
			else if($type == 'name' && in_array($myfield['fld_type'],$name_types))
			{
				$show_field = 1;
			}
			else if($type == 'map' && ($myfield['fld_type'] == 'text' || ($myfield['fld_type'] == 'calculated' && $myfield['fld_formula_return_type'] == 'text')))
			{
				$show_field = 1;
			}
			else if($type == 'country' && $myfield['fld_type'] == 'country')
			{
				$show_field = 1;
			}
			else if($type == 'state' && $myfield['fld_type'] == 'state')
			{
				$show_field = 1;
			}
			else if($type == 'url' && $myfield['fld_type'] == 'url')
			{
				$show_field = 1;
			}
			else if($type == 'color' && $myfield['fld_type'] == 'color')
			{
				$show_field = 1;
			}
			else if($type == 'pdate' && in_array($myfield['fld_type'],$date_types))
			{
				$show_field = 1;
			}
			else if($type == 'cond' && !in_array($myfield['fld_type'],$not_cond_types) && $curr_id !== $keyfield && empty($myfield['fld_builtin']))
			{
				$show_field = 1;
			}
			
			if($show_field == 1)
			{
				if($type == 'all')
				{
					$keyfield_val = $keyfield;
					$keyfield = $keyfield . "__fld";
				}
				elseif($type == 'notify')
				{
					$keyfield = $keyfield . "__" . $ent_id;
				}
				$return .= "<option value='";
				if($type == 'cond'){
					$return .= "attr-" . $keyfield . "__" . $ent_id . "'";
					$return .= " att-type='" . $myfield['fld_type'] . "'";
				}
				else{
					$return .= $keyfield . "'";
				}
				if($type == 'pdate')
				{	
					if(!empty($value) && in_array($keyfield,$value))
					{
						$return .= " selected";
					}
				}
				else
				{
					if($type == 'cond')
					{
						$keyfield = 'attr-' . $keyfield . "__" . $ent_id;
					}
					if($value == '0' && $keyfield == '0'){
						$return .= " selected";
					}
					elseif(!is_array($value) && $value != "" && $keyfield == $value && $keyfield != '0' && $value != '0')
					{
						$return .= " selected";
					}
 					elseif(is_array($value) && in_array($keyfield_val,$value))
					{
						$return .= " selected";
					}
				}
                                $return .= ">";
				if($type == 'cond'){
					$return .= $app['entity'][$ent_id]['ent-label'] . ' - ';
				}
				$return .= esc_html($myfield['fld_label']) . "</option>";
			}
		}
	}
	return $return;
}	
	

function wpas_get_tax_values($app_id,$tax_id,$value='',$type='')
{
	wpas_is_allowed();
	$result_ret = 1;
	if($app_id == '' && $tax_id == '')
        {
		$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
		$tax_id = isset($_GET['tax_id']) ? sanitize_text_field($_GET['tax_id']) : '';
		$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
		$value = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
		$result_ret = 0;
        }
	$return = '';
	if($app_id == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	if($type == 'conn'){
		$return = "<select><option value=''>" . __("Please select","wp-app-studio") . "</option>";
	}	
	elseif($type != 'cond'){
		$return = "<select><option value=''>" . __("Apply to all","wp-app-studio") . "</option>";
	}
	$app = wpas_get_app($app_id);
        if($app !== false && !empty($app['taxonomy'][$tax_id]['txn-values']))
        {
		$tax_values = explode(";",$app['taxonomy'][$tax_id]['txn-values']);
		foreach($tax_values as $tax_val)
		{
			if(!empty($tax_val)){
				preg_match('/(.*)\{(.*)\}/',$tax_val,$matches);
				if(empty($matches))
				{
					$tval = str_replace("$","",$tax_val);
				}
				elseif(!empty($matches[1]))
				{
					$tval = str_replace("$","",$matches[1]);
				}
				$return .= "<option value='". $tval . "'";
				if($value == $tval)
				{
					$return .= " selected";
				}
				$return .= ">" . $tval . "</option>";
			}
		}
	}
	else if($type == 'cond'){
		$return = "<option value=''>" . __("Please define values","wp-app-studio") . "</option>";
	}
	if($type != 'cond'){
		$return .= "</select>";
	}
	if($result_ret == 1){
		return $return;
	}
	echo $return;
	die();
}
function wpas_check_email()
{
	wpas_is_allowed();
	$emails = isset($_GET['email_list']) ? explode(",",sanitize_text_field($_GET['email_list'])) : Array();
	if(!empty($emails))
	{
		foreach($emails as $myemail)
		{
			if(!is_email($myemail))
			{
				echo false;
				die();
			}
		}
	}
	echo true;
	die();
}

	
function wpas_get_ent_layout_attrs()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$return = "<select><option value=''>" . __("Please select","wp-app-studio") . "</option></select>";
	if($app_id != null)
	{
		$app = wpas_get_app($app_id);
		if($app !== false && !empty($app['entity'][$ent_id]['field']))
		{
			$return =  wpas_get_select_attrs($app['entity'][$ent_id]['field']);
		}
	}
	echo $return;
	die();
}

function wpas_get_select_attrs($field,$val="")
{
	$options = "<select class='attr-sel span10'><option value=''>" . __("Please select","wp-app-studio") . "</option>";
	foreach($field as $keyfield=>$myfield)
	{
		if(!isset($myfield['fld_builtin']) || $myfield['fld_builtin'] == 0)
		{ 
			$options .= "<option value='" . $keyfield . "'";
			if($val != '' && $keyfield == $val)
			{
				$options .= " selected";
			}
			$options .= ">" . $myfield['fld_label'] . "</option>";
		}
	}
	$options .= "</select>";
	$return = "<div class=\"span2 layout-edit-icons\">";
	$return .= "<a class=\"delete-attr\">
		<i class=\"icon-minus-sign pull-right\"></i></a>";
	$return .= "</div>" . $options;			
	return $return;
}	

function wpas_get_search_forms()
{
	wpas_is_allowed();
	$return = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$val = isset($_GET['val']) ? sanitize_text_field($_GET['val']) : '';
	if($app_id == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	if($app !== false && !empty($app['form']))
	{
		foreach($app['form'] as $keyform => $myform)
		{
			if($myform['form-form_type'] == 'search')
			{
				$return .= '<option value="' . $keyform . '"'; 
				if($val == $keyform)
				{
					$return .= " selected";
				}
				$return .= '>' . $myform['form-name'] . '</option>';
			}
		}
	}
	echo $return;
	die();
}
function wpas_get_submit_forms()
{
	wpas_is_allowed();
	$return = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	$val = isset($_GET['val']) ? sanitize_text_field($_GET['val']) : '';
	if($app_id == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	if($app !== false && !empty($app['form']))
	{
		foreach($app['form'] as $keyform => $myform)
		{
			if($myform['form-attached_entity'] == $ent_id && $myform['form-form_type'] == 'submit')
			{
				$return .= '<option value="' . $keyform . '"'; 
				if($val != '' && $val == $keyform)
				{
					$return .= " selected";
				}
				$return .= '>' . $myform['form-name'] . '</option>';
			}
		}
	}
	echo $return;
	die();
}
function wpas_get_form_taxs()
{
	wpas_is_allowed();
	$return = ""; 
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$form_id = isset($_GET['form_id']) ? sanitize_text_field($_GET['form_id']) : '';
	$values = isset($_GET['values']) ? array_map('sanitize_text_field',$_GET['values']) : Array();
	if($app_id == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$app = wpas_get_app($app_id);
	if($app !== false && !empty($app['form']) && !empty($app['form'][$form_id]))
	{
		if(!empty($app['form'][$form_id]['form-layout'])){
			$form_layout = $app['form'][$form_id]['form-layout'];
			foreach($form_layout as $layout_rows){
				foreach($layout_rows as $layout_parts){
					if($layout_parts['obtype'] == 'tax' && $layout_parts['tax'] != ''){
						$return .= '<option value="' . $layout_parts['tax']  . '"';
						if(in_array($layout_parts['tax'],$values))
						{
							$return .= " selected";
						}
						$return .= '>' . $app['taxonomy'][$layout_parts['tax']]['txn-label'] . '</option>';
					}
				}
			}
		}			
	}
	echo $return;
	die();
}
function wpas_form_layout_save()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_save_form_layout_nonce','nonce');
	$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
	$form_id = isset($_POST['form_id']) ? sanitize_text_field($_POST['form_id']) : '';
	$data = isset($_POST['data']) ? sanitize_text_field($_POST['data']) : '';
	if(empty($app_id) || $form_id == null || empty($data))
        {
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
        }
	$app = wpas_get_app($app_id);	
	if($app !== false && !empty($app['form'][$form_id]))
	{
		$resp = false;
		$req_fields = Array();
		$req_taxs = Array();
		$req_rels = Array();
		$attr_fields = Array();
		$taxs = Array();
		$rels = Array();
		$post_array = explode("&", stripslashes($data));
		$counter = 0;
		$prev_seq = 0;
		$total_size = 0;
		$next_seq = 1;
		$layout_fields = Array();
		$entkey = $app['form'][$form_id]['form-attached_entity'];
		$dependent_arr = wpas_get_dependent_arr($app,$entkey);
		
		foreach($app['entity'][$entkey]['field'] as $keyfld => $fld)
		{
			if(!in_array($keyfld,$req_fields))
			{
				if($app['form'][$form_id]['form-form_type'] == 'submit')
				{
 					if(isset($fld['fld_required']) && $fld['fld_required'] == 1 ||
						$fld['fld_hidden_func'] == 'autoinc' || $fld['fld_hidden_func'] == 'unique_id' ||
						$fld['fld_uniq_id'] == 1){
							$req_fields[] =  $keyfld;
					}
				}
				elseif($app['form'][$form_id]['form-form_type'] == 'search' && isset($fld['fld_srequired']) && $fld['fld_srequired'] == 1)
				{
					$req_fields[] =  $keyfld;
				}
			}
		}
		if(!empty($app['taxonomy'])){
			foreach($app['taxonomy'] as $keytax => $tax)
			{
				if(in_array($entkey,$tax['txn-attach']))
				{
					if(!in_array($keytax,$req_taxs))
					{
						if($app['form'][$form_id]['form-form_type'] == 'submit' && isset($tax['txn-required']) && $tax['txn-required'] == 1)
						{
							$req_taxs[] = $keytax;
						}
						elseif($app['form'][$form_id]['form-form_type'] == 'search' && isset($tax['txn-srequired']) && $tax['txn-srequired'] == 1 )
						{
							$req_taxs[] = $keytax;
						}
					}
				}
			}
		}
		if(!empty($app['form'][$form_id]['form-dependents']) && !empty($dependent_arr))
		{
			foreach($dependent_arr as $keyrel => $rel)
			{
				$myrel = $app['relationship'][$keyrel];
				if(!in_array($keyrel,$req_rels) && in_array($keyrel,$app['form'][$form_id]['form-dependents']))
				{
					if($app['form'][$form_id]['form-form_type'] == 'submit' && isset($myrel['rel-required']) && $myrel['rel-required'] == 1)
					{
						$req_rels[] = $keyrel;
					}
					elseif($app['form'][$form_id]['form-form_type'] == 'search' && isset($myrel['rel-srequired']) && $myrel['rel-srequired'] == 1)
					{
						$req_rels[] = $keyrel;
					}
				}
			}
		}
		$multiple_submits = 0;
		foreach($post_array as $mypost)
		{
			$form_field = explode("=",$mypost);
			$form_field_value = urldecode(str_replace($form_field[0]."=","",$mypost));
			if($form_field_value == "")
			{
				$resp = 4; //empty field
				echo $resp;
				die();
			}
			if(!in_array($form_field[0],Array('form','app','form-field-count')))
			{
				$key_arr = explode("-",$form_field[0]);
				if(isset($key_arr[3]) && $prev_seq != $key_arr[3])
				{
					if($total_size > 12)
					{
						$resp = 5;
						echo $resp;
						die();
					}
					$total_size = 0;
					$counter++;
				}
				elseif(!isset($key_arr[3]) && $prev_seq != $key_arr[2])
				{
					if($total_size > 12)
					{
						$resp = 5;
						echo $resp;
						die();
					}
					$total_size = 0;
					$counter++;
				}
				if($key_arr[2] == 'size')
				{
					if($total_size > 12)
                                        {
                                                $resp = 5;
                                                echo $resp;
                                                die();
                                        }
					$layout_fields[$counter][$key_arr[4]]['size'] = $form_field_value;
					$prev_seq = $key_arr[3];
					$total_size += $form_field_value;
				}
				elseif($key_arr[1] == 'text' && $key_arr[2] == 'desc')
				{
					$layout_fields[$counter]['obtype'] = 'text';
					$layout_fields[$counter]['desc'] = sanitize_text_field($form_field_value);
					$prev_seq = $key_arr[2];
				}
				elseif($key_arr[1] == 'hr')
				{
					$layout_fields[$counter]['obtype'] = 'hr';
					$prev_seq = $key_arr[2];
				}		
				elseif($key_arr[2] == 'select')
				{
					if($form_field_value == 'submit')
					{
						$layout_fields[$counter][$key_arr[4]]['entity'] = 0;
						$layout_fields[$counter][$key_arr[4]]['attr'] = 0;
						$layout_fields[$counter][$key_arr[4]]['obtype'] = 'btn-std';
						$multiple_submits ++;
						$prev_seq = $key_arr[3];
					}
					else
					{
						$val_arr = explode("__",$form_field_value);
						if(in_array($val_arr[1],$attr_fields) || in_array($val_arr[1],$taxs) 
							|| in_array($val_arr[1],$rels))
						{
							$resp = 3; //dupe field send error
							echo $resp;
							die();
						}
						$layout_fields[$counter][$key_arr[4]]['entity'] = $val_arr[0];
						$ent = $app['entity'][$val_arr[0]];
						if(preg_match('/fld/',$val_arr[1]))
						{
							$fld_id = str_replace('fld','',$val_arr[1]);
							$fld = $ent['field'][$fld_id];
							$attr_fields[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['attr'] = $fld_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'attr';
						}
						elseif(preg_match('/blttax/',$val_arr[1]))
						{
							$tax_id = str_replace('blttax_','',$val_arr[1]);
							$taxs[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['tax'] = $tax_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'tax';
						}
						elseif(preg_match('/tax/',$val_arr[1]))
						{
							$tax_id = str_replace('tax','',$val_arr[1]);
							$tax = $app['taxonomy'][$tax_id];
							$taxs[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['tax'] = $tax_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'tax';
						}
						elseif(preg_match('/rel/',$val_arr[1]))
						{
							$rel_id = str_replace('rel','',$val_arr[1]);
							$rel = $app['relationship'][$rel_id];
							$rels[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['relent'] = $rel_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'relent';
						}
						elseif(preg_match('/woo_ord/',$val_arr[1]))
						{
							$conn_id = str_replace('woo_ord','',$val_arr[1]);
							$conn = $app['connection'][$conn_id];
							$conns[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['conn'] = $conn_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'conn';
							$layout_fields[$counter][$key_arr[4]]['ext'] = 'woo_ord';
						}
						elseif(preg_match('/woo_prd/',$val_arr[1]))
						{
							$conn_id = str_replace('woo_prd','',$val_arr[1]);
							$conn = $app['connection'][$conn_id];
							$conns[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['conn'] = $conn_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'conn';
							$layout_fields[$counter][$key_arr[4]]['ext'] = 'woo_prd';
						}
						elseif(preg_match('/edd_ord/',$val_arr[1]))
						{
							$conn_id = str_replace('edd_ord','',$val_arr[1]);
							$conn = $app['connection'][$conn_id];
							$conns[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['conn'] = $conn_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'conn';
							$layout_fields[$counter][$key_arr[4]]['ext'] = 'edd_ord';
						}
						elseif(preg_match('/edd_prd/',$val_arr[1]))
						{
							$conn_id = str_replace('edd_prd','',$val_arr[1]);
							$conn = $app['connection'][$conn_id];
							$conns[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['conn'] = $conn_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'conn';
							$layout_fields[$counter][$key_arr[4]]['ext'] = 'edd_prd';
						}
						elseif(preg_match('/mailchimp/',$val_arr[1]))
						{
							$conn_id = str_replace('mailchimp','',$val_arr[1]);
							$conn = $app['connection'][$conn_id];
							$conns[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['conn'] = $conn_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'conn';
							$layout_fields[$counter][$key_arr[4]]['ext'] = 'mailchimp';
						}
						elseif(preg_match('/glb/',$val_arr[1]))
						{
							$glb_id = str_replace('glb','',$val_arr[1]);
							$glb = $app['glob'][$glb_id];
							$glbs[] = $val_arr[1];
							$layout_fields[$counter][$key_arr[4]]['glb'] = $glb_id;
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'glb';
						}
						elseif(preg_match('/custom_fields/',$val_arr[1]))
						{
							$layout_fields[$counter][$key_arr[4]]['obtype'] = 'custom_fields';
						}
						$prev_seq = $key_arr[3];
					}
				}
			}	
		}
		if(!empty($layout_fields))
		{
			if($multiple_submits > 1)
			{
				$resp = 6;
				echo $resp;
				die();
			}
			foreach($req_fields as $myreq_field)
			{
				if(!in_array('fld'.$myreq_field,$attr_fields))
				{
					$resp = 2; // required ent fields missing
					echo $resp;
					die();
				}
			}
			foreach($req_taxs as $myreq_tax)
			{
				if(!in_array('tax'.$myreq_tax,$taxs))
				{
					$resp = 2;
					echo $resp;
					die();
				}
			}
			foreach($req_rels as $myreq_rel)
			{
				if(!in_array('rel'.$myreq_rel,$rels))
				{
					$resp = 2;
					echo $resp;
					die();
				}
			}
		}

		$app['form'][$form_id]['form-layout'] = $layout_fields;
		$app['form'][$form_id]['modified_date'] = date("Y-m-d H:i:s");
		wpas_update_app($app,$app_id);
		$resp = 1;  //complete , layout saved
	}
	echo $resp;
	die();
}
function wpas_get_form_layout_select($app,$form_id,$count,$value)
{
	$ret_option = "";
	$entity_filter_id = $app['form'][$form_id]['form-attached_entity'];
	$myentity = $app['entity'][$entity_filter_id];
	$tax_selects = "";
	$conn_selects = "";
	if(!empty($myentity))
	{
		if(!empty($myentity['ent-taxonomy_category']) && $myentity['ent-taxonomy_category'] == 1)
		{
			$key1 = $entity_filter_id . "__blttax_cat";
			$tax_selects .= "<option value='" . esc_attr($key1) . "'";
			if($value == $key1)
			{
				$tax_selects .= " selected";
			}
			$tax_selects .= ">Categories</option>";
		}
		if(!empty($myentity['ent-taxonomy_post_tag']) && $myentity['ent-taxonomy_post_tag'] == 1)
		{
			$key1 = $entity_filter_id . "__blttax_tag";
			$tax_selects .= "<option value='" . esc_attr($key1) . "'";
			if($value == $key1)
			{
				$tax_selects .= " selected";
			}
			$tax_selects .= ">Tags</option>";
		}
		if(!empty($myentity['field']))
		{
			$ret_option .="<optgroup label='" . esc_html($myentity['ent-label']) . " Attributes'>";
			foreach($myentity['field'] as $keyfield => $myfield)
			{
				if($count > 1 && $app['form'][$form_id]['form-form_type'] == 'submit' && in_array($myfield['fld_type'],Array('hidden_constant','hidden_function')))
				{
					continue;
				}
				$fval = $entity_filter_id . "__fld" . $keyfield;
				$ret_option .= "<option value='" . esc_attr($fval) . "'";
				if($value == $fval)
				{
					$ret_option .= " selected";
				}
				if(in_array($myfield['fld_type'],Array('hidden_constant','hidden_function')))
				{
					$ret_option .= " ftype='hidden'";
				}
				$ret_option .= ">";
				if($app['form'][$form_id]['form-form_type'] == 'submit'){
 					if(isset($myfield['fld_required']) && $myfield['fld_required'] == 1 || 
						$myfield['fld_uniq_id'] == 1 || $myfield['fld_hidden_func'] == 'unique_id' || 
						$myfield['fld_hidden_func'] == 'autoinc'){
							$ret_option .= "* ";
					}
				}
				elseif($app['form'][$form_id]['form-form_type'] == 'search' && isset($myfield['fld_srequired']) && $myfield['fld_srequired'] == 1)
				{
					$ret_option .= "* ";
				}
				$ret_option .= esc_html($myfield['fld_label']). "</option>";
			}
			$ret_option .= "</optgroup>";
		}
		if($myentity['ent-supports_custom_fields']){
			$ret_option .="<optgroup label='" . esc_html($myentity['ent-label']) . " Custom Fields'>";
			$ret_option .= "<option value='" . $entity_filter_id . "__custom_fields'";
			if($value == $entity_filter_id . '__custom_fields')
			{
				$ret_option .= " selected";
			}
			$ret_option .= " ftype='custom'";
			$ret_option .= '>' . __('Custom Fields','wpas') . "</option>";
		}
	}
	if(!empty($app['taxonomy']))
	{
		foreach($app['taxonomy'] as $keytax => $mytax)
		{
			$val_req = "";
			foreach($mytax['txn-attach'] as $mytxn_attach)
			{
				if($mytxn_attach == $entity_filter_id)
				{
					if($app['form'][$form_id]['form-form_type'] == 'submit' && isset($mytax['txn-required']) && $mytax['txn-required'] == 1)
					{
						$val_req = "* ";
					}
					elseif($app['form'][$form_id]['form-form_type'] == 'search' && isset($mytax['txn-srequired']) && $mytax['txn-srequired'] == 1)
					{
						$val_req = "* ";
					}
					$key1 = $entity_filter_id . "__tax" . $keytax;
					$tax_selects .= "<option value='" . esc_attr($key1) . "'";
					if($value == $key1)
					{
						$tax_selects .= " selected";
					}
					$tax_selects .= ">" . $val_req . esc_html($mytax['txn-singular-label']) . "</option>";
				}
			}
		}
	}
	if(!empty($tax_selects))
	{
		$ret_option .="<optgroup label='" . esc_html($myentity['ent-label']) . " Taxonomies'>" . $tax_selects . "</optgroup>";
	}
	if(!empty($app['form'][$form_id]['form-dependents']))
	{
		if(!is_array($app['form'][$form_id]['form-dependents']))
		{
			$form_dependents = Array($app['form'][$form_id]['form-dependents']);
		}
		else
		{
			$form_dependents = $app['form'][$form_id]['form-dependents'];
		}
		$ret_option .="<optgroup label='" . __('Relationships','wp-app-studio') . "'>";
		foreach($form_dependents as $mydep)
		{
			$rel_req = "";
			$valr = $entity_filter_id . "__rel" . $mydep;
			$ret_option .= "<option value='" . esc_attr($valr) . "'"; 
			if($value == $valr)
			{
				$ret_option .= " selected";
			}
			$rel = $app['relationship'][$mydep];
			if($app['form'][$form_id]['form-form_type'] == 'submit' && isset($rel['rel-required']) && $rel['rel-required'] == 1)
			{
				$rel_req = "* ";
			}
			elseif($app['form'][$form_id]['form-form_type'] == 'search' && isset($rel['rel-srequired']) && $rel['rel-srequired'] == 1)
			{
				$rel_req = "* ";
			}
			$ret_option .= ">" . $rel_req . esc_html(wpas_get_rel_full_name($rel,$app)) . "</option>";
		}
		$ret_option .= "</optgroup>";
	}
	if(!empty($app['connection']))
	{
		foreach($app['connection'] as $keycon => $mycon)
		{
			if($mycon['connection-type'] == 'mailchimp' && $mycon['connection-mailchimp_form'] == $form_id){
				$keyc = $entity_filter_id . "__mailchimp" . $keycon;
				$conn_selects .= "<option value='" . esc_attr($keyc) . "'";
				if($value == $keyc)
				{
					$conn_selects .= " selected";
				}
				$conn_selects .= ">" . esc_html($mycon['connection-mailchimp_label']) . "</option>";
			}
			elseif($mycon['connection-type'] == 'woocommerce' && $mycon['connection-entity'] == $entity_filter_id){
				if($mycon['connection-woo_order_rel'] == 1){
					$keyc = $entity_filter_id . "__woo_ord" . $keycon;
					$conn_selects .= "<option value='" . esc_attr($keyc) . "'";
					if($value == $keyc)
					{
						$conn_selects .= " selected";
					}
					$conn_selects .= ">" . esc_html($mycon['connection-woo_label']) . " Order</option>";
				}
				if($mycon['connection-woo_product_rel'] == 1){
					$keyc = $entity_filter_id . "__woo_prd" . $keycon;
					$conn_selects .= "<option value='" . esc_attr($keyc) . "'";
					if($value == $keyc)
					{
						$conn_selects .= " selected";
					}
					$conn_selects .= ">" . esc_html($mycon['connection-woo_label']) . " Product </option>";
				}	
			}
			elseif($mycon['connection-type'] == 'edd' && $mycon['connection-entity'] == $entity_filter_id){
				if($mycon['connection-edd_order_rel'] == 1){
					$keyc = $entity_filter_id . "__edd_ord" . $keycon;
					$conn_selects .= "<option value='" . esc_attr($keyc) . "'";
					if($value == $keyc)
					{
						$conn_selects .= " selected";
					}
					$conn_selects .= ">" . esc_html($mycon['connection-edd_label']) . " Order</option>";
				}
				if($mycon['connection-edd_product_rel'] == 1){
					$keyc = $entity_filter_id . "__edd_prd" . $keycon;
					$conn_selects .= "<option value='" . esc_attr($keyc) . "'";
					if($value == $keyc)
					{
						$conn_selects .= " selected";
					}
					$conn_selects .= ">" . esc_html($mycon['connection-edd_label']) . " Download </option>";
				}	
			}
		}
		if(!empty($conn_selects))
		{
			$ret_option .="<optgroup label='" . esc_html($myentity['ent-label']) . " Connections'>" . $conn_selects . "<optgroup>";
		}
	}
	return $ret_option;
}
function wpas_get_form_html()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$form_id = isset($_GET['form_id']) ? sanitize_text_field($_GET['form_id']) : '';
	$field_count = isset($_GET['field_count']) ? intval($_GET['field_count']) : '1';
	$count = isset($_GET['count']) ? intval($_GET['count']) : '1';
	$selected = isset($_GET['selected']) ? array_map('sanitize_text_field',$_GET['selected']) : Array();
	$selected_sizes = isset($_GET['selected_size']) ? array_map('sanitize_text_field',$_GET['selected_size']) : Array();
	if(empty($app_id) && $form_id == null)
        {
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
        }
	$app = wpas_get_app($app_id);	
	if($app !== false && !empty($app['form'][$form_id]))
	{
		echo wpas_get_form_layout_select_all($app,$form_id,$count,$field_count,0,$selected,$selected_sizes);
	}
	die();
}
function  wpas_get_form_layout_select_all($app,$form_id,$count,$field_count,$is_hidden=0,$values=Array(),$sizes=Array())
{
	$res = "";
	$value = "";
	$label = "Attach To";
	for($i=1;$i<=$count; $i++)
	{
		$res .= '<div class="emdt-row emdt-form-config"><div class="emdt-row">';
		$res .= '<div class="layout-edit-icons"><div class="pull-right"><a class="delete-element"';
		if($count != $i || $count == 1)
		{
			$res .= ' style="display:none;"';
		}
		$res .= ' id="delete-element' . '-' . $field_count . "-" . ($i-1) . '"><i class="icon-minus-sign"></i></a>';
		$res .= '<a class="add-element"';
	
		//check entitiy field count , tax count and related entity counts
		list($ent_field_count,$rel_count,$tax_count) = wpas_get_ent_tax_rel_count($app,$form_id);
		$total_count = $ent_field_count + $rel_count + $tax_count + 1;


                if($count != $i || $count == 12 || $total_count <= $i || $is_hidden == 1)
		{
			$res .= ' style="display:none;"';
		}
		$res .= ' id="add-element' . '-' . $field_count . "-" . ($i+1) . '"><i class="icon-plus-sign"></i></a></div></div>';
		$res .= '<label class="control-label">' . $label . '</label>
			<div class="controls">';
		$res .= '<select name="form-element-select-' . $field_count . "-" . $i .'" id="form-element-select-' . $field_count . "-" . $i .'" class="form-element-select" style="width:190px;">';
		$res .= '<option value=""> ' . __("Please select","wp-app-studio") . ' </option>';		
		if(!empty($values[$i]))
		{
			$value = $values[$i];
		}
		else
		{
			$value = "";
		}
		$res .= wpas_get_form_layout_select($app,$form_id,$count,$value);
		$res .= wpas_get_form_globals($app,$form_id,$value);
		$res .= '<optgroup label="' . __("Buttons","wp-app-studio") . '">';
		$res .= '<option value="submit"';
		if($value == 'submit')
		{
			$res .= " selected";
		}
		$res .= '> ' . __("Submit Button","wp-app-studio") . ' </option>';
		$res .= '</optgroup>';
		$res .= '</select></div>';
		$res .= '<label class="control-label">Size</label>';
		$res .= '<div class="controls"><select style="width:43px;" class="form-element-size" id="form-element-size-' . $field_count . "-" . $i . '" name="form-element-size-' . $field_count . "-" . $i . '">';
		if(empty($sizes))
		{
			$sizes[$i] = 12;
		}
		for($size=1;$size<=12;$size++)
		{
			$res .= '<option value="' . $size . '"'; 
			if(isset($sizes[$i]) && $sizes[$i] == $size)
			{
				$res .= " selected";
			}
			$res .= '>' . $size . '</option>';
		}
		$res .= '</select></div>';
		$res .= '</div></div>';
	}
	return $res;
}

function wpas_get_form_text_html()
{
	wpas_is_allowed();
	$field_count = isset($_GET['field_count']) ? intval($_GET['field_count']) : '1';
	echo '<div class="control-group row-fluid">
		<label class="control-label">' . esc_html__("Description","wp-app-studio") . '</label>
		<div class="controls">';
	echo '<textarea id="form-text-desc-' . esc_attr($field_count) . '" class="input-xlarge" name="form-text-desc-' . esc_attr($field_count) . '"></textarea>';
	echo '</div></div>';
	die();
}

function wpas_get_form_layout()
{
	wpas_is_allowed();
	$layout = "";
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$form_id = isset($_GET['form_id']) ? sanitize_text_field($_GET['form_id']) : '';
	if(empty($app_id) && $form_id == null)
        {
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
        }
	$app = wpas_get_app($app_id);
	if($app !== false && isset($app['form'][$form_id]['form-layout']))
	{
		$layout = $app['form'][$form_id]['form-layout'];
	}
	echo  wpas_form_container($layout,$app,$form_id);
	die();
}

function wpas_check_entity_has_email($entities,$ent_id,$myrel='',$rel_id='')
{
	$ent_fld_list = Array();
	if(!empty($entities[$ent_id]['field']))
	{
		foreach($entities[$ent_id]['field'] as $keyfld => $myentfld)
		{
			if($myentfld['fld_type'] == 'email' || $myentfld['fld_type'] == 'user')
			{
				$ent_fld['id'] = $ent_id;
				$ent_fld['ent'] = $entities[$ent_id]['ent-label'];
				$ent_fld['fld_id'] = $keyfld;
				$ent_fld['fld'] = $myentfld['fld_label'];
				if(!empty($myrel))
				{
					$ent_fld['rel'] = $myrel;
					$ent_fld['rel_id'] = $rel_id;
				}
				$ent_fld_list[] = $ent_fld;
			}
		}
	}
	return $ent_fld_list;
}	
function wpas_get_email_rel_list($app,$attach_list)
{
	$check_ents = Array();
	foreach($attach_list as $attach_to)
	{
		$rels = wpas_get_dependent_arr($app,$attach_to);
		foreach($rels as $krel => $myrel)
		{
			if($app['relationship'][$krel]['rel-from-name'] == $attach_to)
			{
				$ent_email_fld =  wpas_check_entity_has_email($app['entity'],$app['relationship'][$krel]['rel-to-name'],$myrel,$krel);
				if(!empty($ent_email_fld))
				{
					$check_ents[] = $ent_email_fld;
				}
			}
			elseif($app['relationship'][$krel]['rel-to-name'] == $attach_to)
			{
				$ent_email_fld =  wpas_check_entity_has_email($app['entity'],$app['relationship'][$krel]['rel-from-name'],$myrel,$krel);
				if(!empty($ent_email_fld))
				{
					$check_ents[] = $ent_email_fld;
				}
			}
		}
	}
	return $check_ents;
}
function wpas_get_email_attrs()
{
	$return = ""; 
	$rel_name = "";
	$check_ents = Array();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$level = isset($_GET['level']) ? sanitize_text_field($_GET['level']) : '';
	$attach_to = isset($_GET['attach_to']) ? sanitize_text_field($_GET['attach_to']) : '';
	$values = isset($_GET['values']) ? sanitize_text_field($_GET['values']) : Array();
	$app = wpas_get_app($app_id);
	if(!is_array($values))
        {
                $values= Array("$values");
        }
	if($app !== false && !empty($app['entity']) && $level != '')
	{
		if($level == 'attr')
		{
			$vals = explode("__",$attach_to);
			$attach_to = $vals[1];
		}
		if($level == 'com')
		{
			$return .= "<option value='com_author_email'";
			if(in_array('com_author_email',$values)){
				$return .= " selected";
			}
			$return .= ">" . __('All Commenters except current comment author','wp-app-studio') . "</option>";
		}
		if($level != 'rel')
		{
			//elseif($level != 'rel')
			$ent_email = wpas_check_entity_has_email($app['entity'],$attach_to);
			if(!empty($ent_email))
			{
				foreach($ent_email as $efld)
				{
					$fval = $efld['id'] . "__" . $efld['fld_id'];
					$return .= "<option value='" . $fval . "'";
					if(in_array($fval,$values))
					{
						$return .= " selected";
					}
					$return .= ">" . $efld['fld'] . " --- " . $app['entity'][$attach_to]['ent-label'] . "</option>";
				}
			}
		}
		if($level == 'rel')
		{
			$attach_list = Array($app['relationship'][$attach_to]['rel-to-name'],$app['relationship'][$attach_to]['rel-from-name']);
			$check_ents = wpas_get_email_rel_list($app,$attach_list);
		}
		else
		{
			$check_ents = wpas_get_email_rel_list($app,Array($attach_to));
		}
		if(!empty($check_ents))
		{
			foreach($check_ents as $key => $ent)
			{
				foreach($ent as $efld)
				{
					$fval = $efld['id'] . "__" . $efld['fld_id'] . "__" . $efld['rel_id'];
					$return .= "<option value='" . $fval . "'"; 
					if(in_array($fval,$values))
					{
						$return .= " selected";
					}
					$return .= ">" . $efld['fld'] . "(" . $efld['ent'] . ")";
					//if($level != 'rel'){
					 	$return .= " --- " . $efld['rel'];
					//}
 					$return .= "</option>"; 
				}
			}
		}
	}
	if(empty($return))
	{
		$return = "<option value=''>" . __("First define an email attribute type.","wp-app-studio") . "</option>";
	}
	echo $return;
	die();
}
function wpas_get_roles()
{
//rel-limit_user_relationship_role
	wpas_is_allowed();
	$return = "";
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$value = isset($_GET['value']) ? stripslashes_deep(array_map('sanitize_text_field',$_GET['value'])) : Array();
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	if($type == 'entity')
	{
		$return = "<option value='false'";
		if($value == '' || $value == 'false')
		{
			$return .= " selected";
		}
		$return .= ">" . __("Do not limit") . "</option>";
	}
	if(!is_array($value) && $value != 'false')
	{
		$value= Array("$value");
	}
	$app = wpas_get_app($app_id);
	if($app !== false && !empty($app['role']))
	{
		foreach($app['role'] as $keyrole => $myrole)
		{
			$return .= "<option value='" . $keyrole . "'"; 
			if($value != 'false' && in_array($keyrole,$value))
			{
				$return .= " selected";
			}
			if($type == 'entity')
			{
				$return .= ">" . sprintf(__('Only %s can be related','wp-app-studio'),esc_html($myrole['role-label'])) . "</option>";
			}
			else
			{
				$return .= ">" . esc_html($myrole['role-label']) . "</option>";
			}			
		}
	}
	echo $return;
	die();
}
function wpas_check_status_generate()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_check_status_generate_nonce','nonce');
	$queue_id = isset($_POST['queue_id']) ? sanitize_text_field($_POST['queue_id']) : '';
	$resp = Array();

	$submits = get_option('wpas_apps_submit');
	$no_check = 0;
	//check last submit time and send request to check status
	if(isset($submits) && !empty($submits))
	{
		foreach($submits as $mysubmit)
		{
			if($mysubmit['queue_id'] == $queue_id)
			{
				if(time() < $mysubmit['refresh_time'] + 120)
				{
					$resp[3] = __("Your app is in queue and will be generated soon. Thank you for your patience.","wp-app-studio");
					$no_check =1;
				}
				elseif(!empty($mysubmit['status']))
				{
					if(strpos($mysubmit['status'],'Success') !== false || strpos($mysubmit['status'],'Error') !== false || strpos($mysubmit['status'],'Change') !== false )
					{
						$resp[0] = esc_url($mysubmit['status_link']);
						$resp[1] = esc_html($mysubmit['status']);
						$no_check =1;
					}
				}
			}
		}
	}
	if($no_check == 0 && !empty($queue_id))
	{		
		$postfields = array(
				'method' => 'check_status',
				'queue_id' => $queue_id,
		);

		$xml_status = wpas_remote_request('check_status',$postfields);

		if(!$xml_status)
		{
			$resp[2] = __("System error, please try again later.","wp-app-studio");
		}
		elseif($xml_status->error)
		{
			if((string) $xml_status->error == 'error')
			{
				$resp[0] = esc_url($xml_status->url);
				$resp[1] = '<span style="color:red;">' . __("Error","wp-app-studio") . '</span>';
				$resp[2] = esc_html($xml_status->errormsg);
				$new_submit['status']= $resp[1];
				$new_submit['status_link']= $resp[0];
			}
			else
			{
				//if return is not completed 
				$resp[3] = esc_html($xml_status->errormsg);
			}
		}
		elseif($xml_status->success)
		{
			//if return is success 
			if($xml_status->success == 'duplicate')
			{
				$resp[1] = '<span style="color:green;">' . __("No Change Detected","wp-app-studio") . '</span>';
			}
			else
			{
				$resp[1] = '<span style="color:green;">' . __("Success","wp-app-studio") . '</span>';
			}
			
			$resp[0] = esc_url($xml_status->url);
			$new_submit['status']= $resp[1];
			$new_submit['status_link']= $resp[0];
		}

		$newsubmits = Array();
		foreach($submits as $mysubmit)
		{
			$newsub = Array();
			if($mysubmit['queue_id'] == $queue_id)
			{
				foreach($mysubmit as $key => $value)
				{
					if(isset($new_submit[$key]))
					{
						$newsub[$key] = $new_submit[$key];
					}
					else
					{
						$newsub[$key] = $value;
					}
				}
				$newsubmits[] = $newsub;	
			}
			else
			{
				$newsubmits[] = $mysubmit;	
			}
		}
		update_option('wpas_apps_submit',$newsubmits);
	}
	//send return back
	echo wp_json_encode($resp);
	die();
}


function wpas_edit_role()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$role_id = isset($_GET['role_id']) ? sanitize_text_field($_GET['role_id']) : '';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	wpas_add_role_form($app_id,$role_id);
	die();
}


function wpas_check_help()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$help_id = isset($_GET['help_id']) ? sanitize_text_field($_GET['help_id']) : '';
	$help_type = isset($_GET['help_type']) ? sanitize_text_field($_GET['help_type']) : '';
	$attached_id = isset($_GET['attached_id']) ? sanitize_text_field($_GET['attached_id']) : '';
	$screen_type = isset($_GET['screen_type']) ? sanitize_text_field($_GET['screen_type']) : '';
	$resp = true;
	if(empty($app_id))
	{
		$resp = false;
	}
	else
	{	
		$app = wpas_get_app($app_id);
		if(!empty($app['help']))
		{
			foreach($app['help'] as $key => $myhelp)
			{
				if($myhelp['help-type'] == $help_type && (($help_type == 'ent' && $myhelp['help-entity'] == $attached_id && $myhelp['help-screen_type'] == $screen_type) || ($help_type == 'tax' && $myhelp['help-tax'] == $attached_id)))
				{
					if($help_id == null || $help_id != $key)
					{
						$resp = false;
						break;
					}
				}
			}
		}
	}
	echo $resp;
	die();
}

function wpas_check_unique()
{
	wpas_is_allowed();
	$response = true;
	$name = isset($_GET['value']) ? sanitize_text_field($_GET['value']) : '';
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$comp_id = isset($_GET['comp_id']) ? sanitize_text_field($_GET['comp_id']) : '';
	$par_id = isset($_GET['par_id']) ? sanitize_text_field($_GET['par_id']) : '';
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';

	if($type != 'app' && !empty($app_id))
	{
		$app = wpas_get_app($app_id);
	}
		
	switch ($type) {
		case 'app':
			$apps_unserialized = wpas_get_app_list();
			if(!empty($apps_unserialized) && $app_id != null)
			{
				foreach($apps_unserialized as $key => $myapp)
				{
					if(stripslashes($name) == $myapp['app_name'] && $key != $app_id)
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'ent':
			if(!empty($app['entity']))
			{
				foreach($app['entity'] as $key => $myent)
				{
					if($name == $myent['ent-name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}	
				}
			}
			break;
		case 'ent_field':
			if($par_id != null && !empty($app['entity'][$par_id]['field']))
			{
				foreach($app['entity'][$par_id]['field'] as $key => $myfield)
				{
					if($name == $myfield['fld_name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'rel':
			if(!empty($app['relationship']))
			{
				foreach($app['relationship'] as $key => $myrel)
				{
					if($name == $myrel['rel-name']  && ($comp_id == null || $comp_id != $key))
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'rel_field':
			if($par_id != null && !empty($app['relationship'][$par_id]['field']))
			{
				foreach($app['relationship'][$par_id]['field'] as $key => $myfield)
				{
					if($name == $myfield['rel_fld_name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'txn':
			if(!empty($app['taxonomy']))
			{
				foreach($app['taxonomy'] as $key => $mytxn)
				{
					if($name == $mytxn['txn-name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			if(!empty($app['taxonomy']))
			{
				foreach($app['entity'] as $myent)
				{
					if($name == $myent['ent-name'])
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'help_fld':
			if($par_id != null && !empty($app['help'][$par_id]['field']))
			{
				foreach($app['help'][$par_id]['field'] as $key => $myfield)
				{
					if($name == $myfield['help_fld_name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'widg':
			if(!empty($app['widget']))
			{
				foreach($app['widget'] as $key => $mywidg)
				{
					if($name == $mywidg['widg-name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'form':
			if(!empty($app['form']))
			{
				foreach($app['form'] as $key => $myform)
				{
					if($name == $myform['form-name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'shc':
			if(!empty($app['shortcode']))
			{
				foreach($app['shortcode'] as $key => $myshc)
				{
					if($name == $myshc['shc-label'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'role':
			if(!empty($app['role']))
			{
				foreach($app['role'] as $key => $myrole)
				{
					if($name == $myrole['role-name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			break;
		case 'glob':
			if(!empty($app['glob']))
			{
				foreach($app['glob'] as $key => $myglob)
				{
					if($name == $myglob['glob-name'] && ($comp_id == null || $key != $comp_id))
					{
						$response = false;
						break;
					}
				}
			}
			break;
	}
	echo $response;
	die();
}

function wpas_save_layout()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_save_layout_nonce','nonce');
	$layout = "";
	$all_attrs = Array();
	$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
	$ent_id = isset($_POST['ent_id']) ? sanitize_text_field($_POST['ent_id']) : '';
	if(empty($app_id) && $ent_id == null)
        {
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
        }
	if(isset($_POST['layout']))
	{	
		$layout = wp_kses_post($_POST['layout']);
	}
	if(!empty($_POST['all_attrs']) && is_array($_POST['all_attrs']))
	{	
		$all_attrs = array_map('sanitize_text_field',$_POST['all_attrs']);
	}
	$app = wpas_get_app($app_id);
	if($app !== false && is_array($app['entity'][$ent_id]))
	{
		$all_fields = 0;
		if(!empty($app['entity'][$ent_id]['field']))
		{
			foreach($app['entity'][$ent_id]['field'] as $myfield)
			{
				if(!isset($myfield['fld_builtin']) || $myfield['fld_builtin'] == 0)
				{
					$all_fields++;
				}
			}
		}
		if(count($all_attrs) != count(array_unique($all_attrs)))
		{
			echo 2; //dupe
			die();
		}
		elseif(!empty($all_attrs) && $all_fields != count($all_attrs))
		{
			echo 3; //not all fields added
			die();
		}
		else
		{
			$app['entity'][$ent_id]['layout'] = $layout;
			$app['entity'][$ent_id]['modified_date'] = date("Y-m-d H:i:s");
			wpas_update_app($app,$app_id);
			echo 1;
			die();
		}
	}
	die();
}
function wpas_get_layout()
{
	wpas_is_allowed();
	$layout = "";
	$fields = Array();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$ent_id = isset($_GET['ent_id']) ? sanitize_text_field($_GET['ent_id']) : '';
	if(empty($app_id) && $ent_id == null)
        {
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
        }
	$app = wpas_get_app($app_id);
	if($app !== false && isset($app['entity'][$ent_id]['layout']))
	{
		$layout = $app['entity'][$ent_id]['layout'];
	}
	if(!empty($app['entity'][$ent_id]['field']))
	{
		$fields = $app['entity'][$ent_id]['field'];
	}
	echo  wpas_entity_container($layout,$fields);
	die();
}
function wpas_get_app_options()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$app = wpas_get_app($app_id);
	if($app !== false && !empty($app['option']))
	{
		foreach($app['option'] as $okey => $oval){
			$nkey = str_replace('amp;','',$okey);
			unset($app['option'][$okey]);
			$app['option'][$nkey] = $oval;
		}
		$html_php_fields = Array('ao_left_footer_html','ao_right_footer_html','ao_app_desc');
		if(!empty($app['option']['ao_php']) && base64_decode($app['option']['ao_php'],true) !== false){
			$app['option']['ao_php'] = base64_decode($app['option']['ao_php']);
		}
		foreach($html_php_fields as $hp_field){
			if(!empty($app['option'][$hp_field]) && !empty($app['option']['base64_encoded']) && $app['option']['base64_encoded'] == 1){
				$app['option'][$hp_field] = base64_decode($app['option'][$hp_field]);
			}
		}
		$response = $app['option'];
		echo wp_json_encode($response);
		die();
	}
}
function wpas_entity_types($app_id,$type,$values="",$subtype="",$tax_id="",$chart_ent="",$add_select=0)
{
	$return = "";
	$selected = 0;
	if($values != "" && !is_array($values))
	{
		$values= Array("$values");
	}
	$app = wpas_get_app($app_id);
	if($add_select == 1 && (!in_array($type,Array('taxonomy','inline_tax')) || !empty($chart_ent)))
	{
		if($type != 'auto_tax' && $type != 'autocomplete' && $subtype != 'autocomplete'){
			$return = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
		}
	}
	if($app !== false && !empty($app['entity']) && !in_array($type,Array('tax','cond','auto_tax')))
	{
		if($type == 'relationship_from' || $type == 'relationship_to')
		{
			$return .= "<option value='user'";
			if(in_array('user',$values))
			{
				$return .= " selected";
				$selected = 1;
			}
			$return .= ">" . __("Users","wp-app-studio") . "</option>";
		}		
		foreach($app['entity'] as $keyent => $myent)
		{
			$show_ent = 0;
			if($tax_id != "" && $type == 'shortcode')
			{
				if(in_array($keyent,$app['taxonomy'][$tax_id]['txn-attach']))
				{
					$show_ent =1;
				}
			}
			else if($type == 'inline_tax')
			{
				if(!empty($myent['ent-inline-ent'])){
					$show_ent = 1;
				}
			}
			else
			{
				if(!empty($myent['field']) && empty($myent['ent-inline-ent']))
				{
					$show_ent = 1;
				}
				if($type == 'widget-comment' && $myent['ent-com_type'] == 'wp')
				{
					$show_ent = 0;
				}
				if($type == 'shortcode' && !empty($app['shortcode']))
				{
					foreach($app['shortcode'] as $myshc)
					{
						if($myshc['shc-view_type'] == $subtype && $myshc['shc-attach'] == $keyent && !in_array($keyent,$values))
						{
							$show_ent = 0;
						}
					}
				}
			}		
			if($show_ent == 1)
			{
				$return .= "<option value='" . $keyent . "'"; 
				if($myent['ent-hierarchical'] == 1){
					$return .= " hier=1";
				}
				if($selected == 0 && is_array($values) && in_array($keyent,$values))
				{
					$return .= " selected";
				}
				$return .= ">" . esc_html($myent['ent-label']) . "</option>";
			}
		}
	}
	elseif($app !== false && !empty($app['taxonomy']) && in_array($type,Array('tax','chart','cond','auto_tax')))
	{
		foreach($app['taxonomy'] as $keytxn => $mytxn)
		{
			$show_tax = 1;
			if(!empty($subtype))
			{
				foreach($app['shortcode'] as $myshc)
				{
					//if($myshc['shc-view_type'] == $subtype && $myshc['shc-attach_tax'] == $keytxn && !in_array($keytxn,$values) && (!isset($myshc['shc-attach_taxterm']) && $myshc['shc-attach_taxterm'] == '') && empty($mytxn['txn-values']))
					//{
				//		$show_tax = 0;
					//}
				}
			}
			if(!empty($mytxn['txn-inline'])){
				$show_tax = 0;
			}
			if(!empty($chart_ent))
			{
				if($type == 'auto_tax' && is_array($chart_ent)){
					foreach($chart_ent as $cent){
						if(!in_array($cent,$mytxn['txn-attach'])){
							$show_tax = 0;
						}
					}
				}
				elseif(!in_array($chart_ent,$mytxn['txn-attach']))
				{
					$show_tax = 0;
				}
			}
			if($type == 'cond' && $tax_id != ''){
				if($tax_id == $keytxn){
					$show_tax = 0;
				}
			}
			if($show_tax == 1)
			{
				if(!empty($chart_ent) && $add_select == 0)
				{
					$keytxn = $keytxn . "__tax";
				}
				elseif($type == 'cond'){
					$keytxn = "tax-" . $keytxn;
				}
				$return .= "<option value='" . $keytxn . "'"; 
				if($type == 'cond'){
					$return .= " att-type='tax'";
				}
				if(in_array($keytxn,$values))
				{
					$return .= " selected";
				}
				$return .= ">" . esc_html($mytxn['txn-label']) . "</option>";
				if(!empty($chart_ent) && $add_select == 0)
				{
					$return .= "<option value='" . $keytxn . "__nl'"; 
					$return .= ">" . esc_html($mytxn['txn-label']) . " No Link</option>";
				}
			}
		}
	}
	return $return;
}

function wpas_get_rel_full_name($myrel,$app)
{
	if($myrel['rel-from-name'] == 'user')
	{
		$rel_ent = "Users";
	}
	else
	{
		$rel_ent = $app['entity'][$myrel['rel-from-name']]['ent-label'];
	}
	if(!empty($myrel['rel-from-title']))
	{
		$rel_ent .= " (" . $myrel['rel-from-title'] . ")";
	}
	if($myrel['rel-type'] == 'many-to-many')
	{
		$rel_ent .= " <--> ";
	}
	else
	{
		$rel_ent .= " --> ";
	}
	if($myrel['rel-to-name'] == 'user')
	{
		$rel_ent .= "Users";
	}
	else
	{
		$rel_ent .= $app['entity'][$myrel['rel-to-name']]['ent-label'];
	}
	if(!empty($myrel['rel-to-title']))
	{
		$rel_ent .= " (" . $myrel['rel-to-title'] . ")";
	}
	if(empty($myrel['rel-from-title']) && empty($myrel['rel-to-title']))
	{
		$rel_ent .= " (" . $myrel['rel-name'] . ")";
	}
	return $rel_ent;
}
			
	


function wpas_get_dependent_arr($app,$primary_entity)
{
	$dependent_arr = Array();
	if($app !== false && !empty($app['relationship']))
	{
		foreach($app['relationship'] as $keyrel => $myrel)
		{
			if($primary_entity == $myrel['rel-from-name'] || $primary_entity == $myrel['rel-to-name'])
			{
				$dependent_arr[$keyrel] = wpas_get_rel_full_name($myrel,$app);
			}
		}
	}
	return $dependent_arr;
}

function wpas_dependent_entities($app_id,$primary_entity,$values,$dgrid=0)
{
	$return = "";
	$dependent_arr = Array();
	if(!is_array($values))
	{
		$values= Array("$values");
	}
	$app = wpas_get_app($app_id);
	$dependent_arr = wpas_get_dependent_arr($app,$primary_entity);
	if(!empty($dependent_arr))
	{
		foreach($dependent_arr as $key => $dependent)
		{
			if($dgrid == 1)
			{
				$key = $key . "__rel";
			}
			$return .= "<option value='" . esc_attr($key) . "'"; 
			if(in_array($key,$values))
			{
				$return .= " selected";
			}
			$return .= ">" . esc_html($dependent) . "</option>";
			if($dgrid == 1)
			{
				$return .= "<option value='" . esc_attr($key. "__nl") . "'"; 
				if(in_array($key . "__nl",$values))
				{
					$return .= " selected";
				}
				$return .= ">" . esc_html($dependent) . " No Link</option>";
			}
		}
	}
	return $return;
}
function wpas_get_entities()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$values = isset($_GET['values']) ? stripslashes_deep(array_map('sanitize_text_field',$_GET['values'])) : Array();
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$subtype = isset($_GET['subtype']) ? sanitize_text_field($_GET['subtype']) : '';
	$tax_id = isset($_GET['tax_id']) ? sanitize_text_field($_GET['tax_id']) : '';
	$chart_ent = isset($_GET['chart_ent']) ? sanitize_text_field($_GET['chart_ent']) : '';
	$add_sel = isset($_GET['add_sel']) ? intval($_GET['add_sel']) : 0;
	$return = "";
	if($add_sel == 1)
	{
		$return = "<option value=''>" . __("Please select","wp-app-studio") . "</option>";
	}
	if($app_id == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	if($type == 'form_dependents')
	{
		$primary_entity = isset($_GET['primary_entity']) ? sanitize_text_field($_GET['primary_entity']) : '';
		echo $return . wpas_dependent_entities($app_id,$primary_entity,$values,0);
	}
	else
	{
		echo wpas_entity_types($app_id,$type,$values,$subtype,$tax_id,$chart_ent,$add_sel);
	}
	die();
}

function wpas_edit_field()
{
	wpas_is_allowed();
	$app_id = isset($_GET['app']) ? sanitize_text_field($_GET['app']) : '';
	$comp_id = isset($_GET['comp']) ? sanitize_text_field($_GET['comp']) : '';
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$field_id = isset($_GET['field']) ? sanitize_text_field($_GET['field']) : '';
	if($app_id == null || $comp_id == null || $type == null || $field_id == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}	
	$app = wpas_get_app($app_id);

	if(!empty($app[$type][$comp_id]['field'][$field_id]))
	{
		$html_php_fields = Array('help_fld_content','fld_desc','fld_values');
		foreach($html_php_fields as $hp_field){
			if(!empty($app[$type][$comp_id]['field'][$field_id][$hp_field]) && !empty($app[$type][$comp_id]['field'][$field_id]['base64_encoded']) && $app[$type][$comp_id]['field'][$field_id]['base64_encoded'] == 1){
				$app[$type][$comp_id]['field'][$field_id][$hp_field] = base64_decode($app[$type][$comp_id]['field'][$field_id][$hp_field]);
			}
		}	
		$response[0] = $app[$type][$comp_id]['field'][$field_id];
		echo wp_json_encode($response);
		die();
	}
	wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
}
function wpas_delete_field()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_delete_field_nonce','nonce');
	$app_id = isset($_POST['app']) ? sanitize_text_field($_POST['app']) : '';
	$comp_id = isset($_POST['comp']) ? sanitize_text_field($_POST['comp']) : '';
	$type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$field_id = isset($_POST['field']) ? sanitize_text_field($_POST['field']) : '';
	if($app_id == null || $comp_id == null || $type == null || $field_id == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}	
	$app = wpas_get_app($app_id);

	if(empty($app[$type][$comp_id]['field'][$field_id]))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}

	wpas_delete_field_item($app_id,$comp_id,$type,$field_id,$app);
	$app = wpas_get_app($app_id);
	if($type == 'entity'){
		echo wpas_view_entity($app['entity'][$comp_id],$comp_id);
		echo wpas_list('entity_fields',$app,$app_id,1,$comp_id);
	}
	elseif($type == 'relationship'){
		echo wpas_view_relationship($app[$type][$comp_id],$comp_id,$app);
		echo wpas_list('rel_fields',$app,$app_id,1,$comp_id);
	}
	elseif($type == 'help'){
		echo wpas_view_help($app[$type][$comp_id],$comp_id,$app);
		echo wpas_list('help_fields',$app,$app_id,1,$comp_id);
	}
	die();
}
function wpas_delete_field_item($app_id,$comp_id,$type,$field_id,$app)
{
	if($type == 'entity')
	{       
		//also delete this attr from entity layout
		if(!empty($app[$type][$comp_id]['layout']))
		{
			foreach($app[$type][$comp_id]['layout'] as $lkey => $mylayout)
			{
				if(isset($mylayout['tabs']))
				{
					foreach($mylayout['tabs'] as $tkey => $mytab)
					{
						if(in_array($field_id,$mytab['attr']))
						{
							$my_attr_key = array_search($field_id,$mytab['attr']);
							unset($mylayout['tabs'][$tkey]['attr'][$my_attr_key]);
							if(count($mylayout['tabs'][$tkey]['attr']) == 0)
							{
								unset($mylayout['tabs'][$tkey]);
								if(count($mylayout['tabs']) == 0)
								{
									unset($mylayout['tabs']);
									break;
								}
							}
						}
					}
				}
				if(isset($mylayout['accs']))
				{
					foreach($mylayout['accs'] as $akey => $myacc)
					{
						if(in_array($field_id,$myacc['attr']))
						{
							$my_attr_key = array_search($field_id,$myacc['attr']);
							unset($mylayout['accs'][$akey]['attr'][$my_attr_key]);
							if(count($mylayout['accs'][$akey]['attr']) == 0)
							{
								unset($mylayout['accs'][$akey]);
								if(count($mylayout['accs']) == 0)
								{
									unset($mylayout['accs']);
									break;
								}
							}
						}
					}
				}
				$app[$type][$comp_id]['layout'][$lkey] = $mylayout;
			}
		}
		//delete this field from form layout
		if(!empty($app['form']))
		{
			foreach($app['form'] as $keyform => $myform)
			{
				if($myform['form-attached_entity'] == $comp_id && !empty($myform['form-layout']))
				{
					foreach($myform['form-layout'] as $keylayout => $myform_layout)
					{
						$change = 0;
						foreach($myform_layout as $keyel => $myform_layout_el)
						{
							if(isset($myform_layout_el['entity']) && $myform_layout_el['entity'] == $comp_id && isset($myform_layout_el['attr']) && $myform_layout_el['attr'] == $field_id)
							{
								unset($myform_layout[$keyel]);
								$change =1;
							}
						}
						if($change == 1)
						{
							if(count($myform_layout) >= 1)
							{		
								$app['form'][$keyform]['form-layout'][$keylayout] = array_combine(range(1,count($myform_layout)),array_values($myform_layout));
							}
							elseif(count($myform_layout) == 0)
							{
								unset($app['form'][$keyform]['form-layout'][$keylayout]);
							}
						}
					}
					if(count($app['form'][$keyform]['form-layout']) >= 1)
					{
						$app['form'][$keyform]['form-layout']= array_combine(range(1,count($app['form'][$keyform]['form-layout'])),array_values($app['form'][$keyform]['form-layout']));
					}
					elseif(count($app['form'][$keyform]['form-layout']) == 0)
					{
						$app['form'][$keyform]['form-layout'] = Array();
					}
				}
			}	
		}
		unset($app[$type][$comp_id]['field'][$field_id]);
	}       
	elseif($type == 'relationship')
	{       
		unset($app[$type][$comp_id]['field'][$field_id]);
	}       
	elseif($type == 'help')
	{       
		unset($app[$type][$comp_id]['field'][$field_id]);
	}
	wpas_update_app($app,$app_id);       
	//return $ret;
}
function wpas_save_field()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_save_field_nonce','nonce');
	$type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$field_id = isset($_POST['field_id']) ? sanitize_text_field($_POST['field_id']) : '';
	$search_str = wpas_get_search_string($type . '_fld');
	$field = Array();

	$get_array = explode("&", stripslashes(wp_kses_post($_POST['form'])));
	$field['base64_encoded'] = 0;
	foreach($get_array as $myget)
	{
		$field_form = explode("=",$myget);
		$pos = strpos($field_form[0],$search_str);
		$field_form_value = urldecode(str_replace($field_form[0].'=','',$myget));
		if(in_array($field_form[0], Array('help_fld_content','fld_desc','fld_values')))
		{
			$field_form_value_sanitized = base64_encode($field_form_value);
			$field['base64_encoded'] = 1;
		}
		else
		{
			$field_form_value_sanitized = sanitize_text_field($field_form_value);
			$req_fields = Array('fld_name','fld_label','rel_fld_name','rel_fld_label','rel_fld_values','help_fld_name');
			if(empty($field_form_value_sanitized) && !empty($field_form_value) && in_array($field_form[0],$req_fields))
			{
				wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
			}
		}

		if($field_form[0] == 'app')
		{
			$app_id = $field_form_value_sanitized;
		}
		if(in_array($field_form[0], Array('ent','rel','help')))
		{
			$comp_id = $field_form_value_sanitized;
		}
		if($pos !== false && $field_form_value_sanitized != "")
		{
			if($field_form[0] == 'rel_fld_name' || $field_form[0] == 'fld_name')
			{
				$field[$field_form[0]] = strtolower($field_form_value_sanitized);
			}
			elseif($field_form[0] == 'fld_limit_user_role')
			{
				$field[$field_form[0]][] = $field_form_value_sanitized;
			}
			else
			{
				$field[$field_form[0]] = $field_form_value_sanitized;
			}
		}
	}
	if(empty($app_id) || !isset($comp_id))
        {       
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
        } 
	$app = wpas_get_app($app_id);
	if($field_id == "")
	{
		if(!empty($app[$type][$comp_id]['field']))
		{
			$field_id = max(array_keys($app[$type][$comp_id]['field'])) +1;
		}
		else
		{
			$field_id = 0;
		}
		$field['date'] = date("Y-m-d H:i:s");
		$field['modified_date'] = date("Y-m-d H:i:s");
	}
	else
	{
		$field['modified_date'] = date("Y-m-d H:i:s");
		if(isset($app[$type][$comp_id]['field'][$field_id]['date'])){
			$field['date'] = $app[$type][$comp_id]['field'][$field_id]['date'];
		}
	}

	if(isset($field['fld_builtin']) && $field['fld_builtin'] == 1)
	{
		if($field['fld_name'] == 'blt_title')
		{
			$field['fld_type'] = 'text';
		}
		elseif($field['fld_name'] == 'blt_content')
		{
			$field['fld_type'] = 'wysiwyg';
		}
		elseif($field['fld_name'] == 'blt_excerpt')
		{
			$field['fld_type'] = 'textarea';
		}
	}


	$app[$type][$comp_id]['modified_date'] = date("Y-m-d H:i:s");
	if(isset($app[$type][$comp_id]['field'][$field_id]))
	{
		$old_field = $app[$type][$comp_id]['field'][$field_id];
	}
	$app[$type][$comp_id]['field'][$field_id] = $field;
	if($type == 'entity')
	{
		if(!empty($old_field) && $field['fld_name'] != $old_field['fld_name'])
		{
			$app = wpas_update_all_layout('attr',$old_field['fld_name'],$field['fld_name'],$app,$app_id);
		}
		echo wpas_view_entity($app[$type][$comp_id],$comp_id);
		echo wpas_list('entity_fields',$app,$app_id,1,$comp_id);
	}
	elseif($type == 'relationship')
	{
		if(!empty($old_field) && $field['rel_fld_name'] != $old_field['rel_fld_name'])
		{
			$app = wpas_update_all_layout('rel',$old_field['rel_fld_name'],$field['rel_fld_name'],$app,$app_id);
		}
		echo wpas_view_relationship($app[$type][$comp_id],$comp_id,$app);
		echo wpas_list('rel_fields',$app,$app_id,1,$comp_id);
	}
	elseif($type == 'help')
	{
		echo wpas_view_help($app[$type][$comp_id],$comp_id,$app);
		echo wpas_list('help_fields',$app,$app_id,1,$comp_id);
	}
	wpas_update_app($app,$app_id);
	die();
}

function wpas_list_fields()
{
	wpas_is_allowed();
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$comp_id = isset($_GET['comp_id']) ? sanitize_text_field($_GET['comp_id']) : '';
	if($app_id == null || $comp_id == null || $type == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}	
	$app = wpas_get_app($app_id);
	if($type == 'entity' && !empty($app['entity'][$comp_id]))
	{
		echo wpas_view_entity($app['entity'][$comp_id],$comp_id);
		echo wpas_list('entity_fields',$app,$app_id,1,$comp_id);
	}
	elseif($type == 'relationship' && !empty($app['relationship'][$comp_id]))
	{
		echo wpas_view_relationship($app['relationship'][$comp_id],$comp_id,$app);
		echo wpas_list('rel_fields',$app,$app_id,1,$comp_id);
	}
	elseif($type == 'help' && !empty($app['help'][$comp_id]))
	{
		echo wpas_view_help($app['help'][$comp_id],$comp_id,$app);
		echo wpas_list('help_fields',$app,$app_id,1,$comp_id);
	}
	die();
}
function wpas_edit()
{
	wpas_is_allowed();
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$comp_id = isset($_GET['comp_id']) ? sanitize_text_field($_GET['comp_id']) : '';
	if($app_id == null || $comp_id == null || $type == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}	
	$app = wpas_get_app($app_id);
	if(empty($app[$type][$comp_id]))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$html_php_fields = Array('rel-con_from_header','rel-con_from_footer','rel-con_from_layout','rel-con_to_header','rel-con_to_footer','rel-con_to_layout','rel-rel_from_header','rel-rel_from_footer','rel-rel_from_layout','rel-rel_to_header','rel-rel_to_footer','rel-rel_to_layout','shc-sc_layout','shc-layout_header','shc-layout_footer','widg-layout_header','widg-layout_footer','widg-layout','widg-html','help-screen_sidebar','form-form_desc','form-not_loggedin_msg','notify-confirm_msg','notify-confirm_admin_msg','form-result_msg','form-result_footer_msg','form-confirm_success_txt','form-confirm_error_txt','shc-sc_js','glob-dflt-ta','shc-org_layout','shc-org_tooltip_layout','shc-emd-org_layout','shc-emd-org_tooltip_layout','connection-woo_product_layout','connection-woo_product_header','connection-woo_product_footer','connection-woo_order_layout','connection-woo_order_header','connection-woo_order_footer','connection-woo_my_account_bef_shc','connection-woo_my_account_aft_shc','connection-edd_product_layout','connection-edd_product_header','connection-edd_product_footer','connection-edd_order_layout','connection-edd_order_header','connection-edd_order_footer','connection-edd_my_account_bef_shc','connection-edd_my_account_aft_shc');
	foreach($html_php_fields as $hp_field){
		if(!empty($app[$type][$comp_id][$hp_field]) && !empty($app[$type][$comp_id]['base64_encoded']) && $app[$type][$comp_id]['base64_encoded'] == 1){
			$app[$type][$comp_id][$hp_field] = base64_decode($app[$type][$comp_id][$hp_field]);
		}
	}
	$response[0] = $app[$type][$comp_id];
	$response[1] = $comp_id;
	echo wp_json_encode($response);
	die();  
}
function wpas_delete()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_delete_nonce','nonce');
	$type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	if($type == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	elseif($type == 'app')
	{
		$app_del_keys = isset($_POST['fields']) ? array_map('sanitize_text_field',$_POST['fields']) : Array();
		if(!empty($app_del_keys))
		{
			foreach($app_del_keys as $del_key)
			{
				$app_key_list = wpas_delete_app($del_key);
			}
		}
		$app_list = wpas_get_app_list($app_key_list);
		echo wpas_list('app',$app_list,0,1);
	}
	else
	{
		$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
		$comp_arr = isset($_POST['fields']) ? array_map('sanitize_text_field',$_POST['fields']) : Array();
		$app = wpas_get_app($app_id);
		$roles_to_remove = Array();
		if(!empty($comp_arr) && !empty($app))
		{
		foreach ($comp_arr as $del_key)
		{
			$ent_arr = Array();
			$txn_arr = Array();
			$rel_arr = Array();
			$form_arr = Array();
			if($type == 'entity_fields')
			{
				$comp_id = isset($_POST['comp_id']) ? sanitize_text_field($_POST['comp_id']) : '';
				wpas_delete_field_item($app_id,$comp_id,'entity',$del_key,$app);
				$app = wpas_get_app($app_id);
			}
			elseif($type == 'rel_fields')
			{
				$comp_id = isset($_POST['comp_id']) ? sanitize_text_field($_POST['comp_id']) : '';
				wpas_delete_field_item($app_id,$comp_id,'relationship',$del_key,$app);
				$app = wpas_get_app($app_id);
			}
			elseif($type == 'help_fields')
			{
				$comp_id = isset($_POST['comp_id']) ? sanitize_text_field($_POST['comp_id']) : '';
				wpas_delete_field_item($app_id,$comp_id,'help',$del_key,$app);
				$app = wpas_get_app($app_id);
			}
			elseif($type == 'entity' && !empty($app[$type][$del_key]))
			{
				if(!in_array($app[$type][$del_key]['ent-name'],Array('post','page')))
				{
					unset($app[$type][$del_key]);
					$ent_arr[] = $del_key;
					$roles_to_remove[] = 'ent_' . $del_key;
				}
				//after deleting entity delete all attached objects
				//1- delete the taxonomy
				if(!empty($app['taxonomy']))
				{
					foreach($app['taxonomy'] as $tkey => $mytaxonomy)
					{
						if(count($mytaxonomy['txn-attach']) == 1 && in_array($del_key,$mytaxonomy['txn-attach']))
						{
							$txn_arr[] = $tkey;
							unset($app['taxonomy'][$tkey]);
							$roles_to_remove[] = 'tax_' . $tkey;
						}
						elseif(count($mytaxonomy['txn-attach']) > 1 && in_array($del_key,$mytaxonomy['txn-attach']))
						{
							$txn_attach_key = array_search($del_key,$mytaxonomy['txn-attach']);
							unset($app['taxonomy'][$tkey]['txn-attach'][$txn_attach_key]);
						}
					}
				}
				//2-delete the relationships
				if(!empty($app['relationship']))
				{
					foreach($app['relationship'] as $rkey => $myrelationship)
					{
						if($myrelationship['rel-from-name'] == $del_key)
						{
							unset($app['relationship'][$rkey]);
							$rel_arr[] = $rkey;
							$roles_to_remove[] = 'limitby_rel_' . $rkey;
						}
						if($myrelationship['rel-to-name'] == $del_key)
						{
							unset($app['relationship'][$rkey]);
							$rel_arr[] = $rkey;
							$roles_to_remove[] = 'limitby_rel_' . $rkey;
						}
					}
				}
			}
			elseif($type == 'taxonomy')
			{
				unset($app[$type][$del_key]);
				$txn_arr[] = $del_key;
				$roles_to_remove[] = 'tax_' . $del_key;
			}	
			elseif($type == 'relationship')
			{
				unset($app[$type][$del_key]);
				$rel_arr[] = $del_key;
				$roles_to_remove[] = 'limitby_rel_' . $del_key;
			}
			elseif($type == 'widget')
			{
				if($app[$type][$del_key]['widg-type'] == 'dashboard')
				{ 
					$roles_to_remove[] = 'widg_' . $del_key;
				}
				unset($app[$type][$del_key]);
			}
			elseif($type == 'form')
			{
				if($app[$type][$del_key]['form-form_type'] == 'search')
				{
					$form_arr[] = $del_key;
				}
				unset($app[$type][$del_key]);
				$roles_to_remove[] = 'form_' . $del_key;
			} 
			elseif($type == 'role')
			{
				if(!wpas_is_def_role($app[$type][$del_key]))
				{
					unset($app[$type][$del_key]);
				}
			}
			elseif($type == 'connection')
			{
				$keep_woo_roles = 0;
				$keep_edd_roles = 0;
				foreach($app['connection'] as $kcon => $mycon){
					if($mycon['connection-type'] == 'woocommerce' && $kcon != $del_key){
						$keep_woo_roles = 1;
					}
					if($mycon['connection-type'] == 'edd' && $kcon != $del_key){
						$keep_edd_roles = 1;
					}
				}	
				if($keep_woo_roles == 0){
					$app = wpas_delete_woo_roles($app,$app_id);
				}
				if($keep_edd_roles == 0){
					$app = wpas_delete_edd_roles($app,$app_id);
				}
				unset($app[$type][$del_key]);
			}
			else
			{
				//view , help
				unset($app[$type][$del_key]);
				if($type == 'shortcode')
				{
					$roles_to_remove[] = 'shc_' . $del_key;
				}
			}
			//delete the helps attached to ent and tax
			if(!empty($app['help']) && (!empty($ent_arr) || !empty($txn_arr)))
			{
				foreach($app['help'] as $hkey => $myhelp)
				{
					if(!empty($myhelp['help-entity']) && in_array($myhelp['help-entity'],$ent_arr) && $myhelp['help-type'] == 'ent')
					{
						unset($app['help'][$hkey]);
					}
					if(!empty($myhelp['help-tax']) && in_array($myhelp['help-tax'],$txn_arr))
					{
						unset($app['help'][$hkey]);
					}
				}
			}
			//delete form dependents and forms
			if(!empty($app['form']) && (!empty($rel_arr) || !empty($ent_arr) || !empty($txn_arr)))
			{
				foreach($app['form'] as $keyform => $myform)
				{
					foreach($rel_arr as $del)
					{
						if(!empty($myform['form-dependents']) && in_array($del,$myform['form-dependents']))
						{
							$dep_key = array_search($del,$myform['form-dependents']);
							unset($app['form'][$keyform]['form-dependents'][$dep_key]);
						}
					}
					if(in_array($myform['form-attached_entity'],$ent_arr))
					{
						unset($app['form'][$keyform]);
						$roles_to_remove[] = 'form_' . $keyform;
						$form_arr[] = $keyform;
					}
					elseif(!empty($myform['form-layout']))
					{
						foreach($myform['form-layout'] as $keylayout => $myform_layout)
						{
							$new_layout = $myform_layout;
							$change = 0;
							foreach($myform_layout as $keyel => $myform_layout_el)
							{
								if(isset($myform_layout_el['entity']) && in_array($myform_layout_el['entity'],$ent_arr) || (isset($myform_layout_el['obtype']) && $myform_layout_el['obtype'] == 'relent' && in_array($myform_layout_el['relent'],$rel_arr)) || (isset($myform_layout_el['obtype']) && $myform_layout_el['obtype'] == 'tax' && in_array($myform_layout_el['tax'],$txn_arr)))
								{
									unset($new_layout[$keyel]);
									$change =1;
								}
							}
							if($change == 1)
							{
								if(count($new_layout) >= 1)
								{
									$app['form'][$keyform]['form-layout'][$keylayout] = array_combine(range(1,count($new_layout)),array_values($new_layout));
								}
								elseif(count($new_layout) == 0)
								{
									unset($app['form'][$keyform]['form-layout'][$keylayout]);
								}
							}
						}
						if(count($app['form'][$keyform]['form-layout']) >= 1)
						{
							$app['form'][$keyform]['form-layout']= array_combine(range(1,count($app['form'][$keyform]['form-layout'])),array_values($app['form'][$keyform]['form-layout']));
						}		
						elseif(count($app['form'][$keyform]['form-layout']) == 0)
						{
							$app['form'][$keyform]['form-layout'] = Array();
						}
					}
				}
			}
			//delete widgets
			if(!empty($app['widget']) && !empty($ent_arr))
			{
				foreach($app['widget'] as $keywidg => $mywidg)
				{
					if((isset($mywidg['widg-attach']) && in_array($mywidg['widg-attach'],$ent_arr)))
					{
						unset($app['widget'][$keywidg]);
						$roles_to_remove[] = 'widg_' . $keywidg;
					}
				}
			}
			//delete views
			if(!empty($app['shortcode']) && (!empty($form_arr) || !empty($txn_arr) || !empty($ent_arr)))
			{
				foreach($app['shortcode'] as $skey => $myshortcode)
				{
					if((!empty($myshortcode['shc-attach']) && in_array($myshortcode['shc-attach'],$ent_arr)) ||
					(!empty($myshortcode['shc-attach_form']) && in_array($myshortcode['shc-attach_form'],$form_arr)) ||
					(!empty($myshortcode['shc-attach_tax']) && in_array($myshortcode['shc-attach_tax'],$txn_arr)))
					{
						unset($app['shortcode'][$skey]);
						$roles_to_remove[] = 'shc_' . $skey;
					}
				}
			}
			//delete notifications
			if(!empty($app['notify']) && (!empty($txn_arr) || !empty($ent_arr)))
			{
				foreach($app['notify'] as $nkey => $mynotify)
				{
					if(($mynotify['notify-level'] == 'entity' && !empty($mynotify['notify-attached_to']) && in_array($mynotify['notify-attached_to'],$ent_arr)) ||
					($mynotify['notify-level'] == 'tax' && !empty($mynotify['notify-attached_to']) && in_array($mynotify['notify-attached_to'],$txn_arr)))
					{
						unset($app['notify'][$nkey]);
					}
					elseif($mynotify['notify-level'] == 'attr')
					{
						$notify_att_arr = explode("__",$mynotify['notify-attached_to']);
						if(!empty($mynotify['notify-attached_to']) && in_array($notify_att_arr[1],$ent_arr)){
							unset($app['notify'][$nkey]);
						}
					}	
				}
			}
			//delete the capabilities for each role
			if(!empty($app['role']) && !empty($roles_to_remove))
			{
				foreach($app['role'] as $rkey => $myrole)
				{
					foreach($roles_to_remove as $mycap_remove)
					{
						$pattern = '/' . $mycap_remove . '/';
						foreach($myrole as $role_name => $role_value)
						{
							if(preg_match($pattern,$role_name))
							{
								unset($app['role'][$rkey][$role_name]);
							}
						}
					}
				}
			}
		}  
		if($type == 'entity_fields'){
			$app = wpas_get_app($app_id);
			echo wpas_view_entity($app['entity'][$comp_id],$comp_id);
			echo wpas_list('entity_fields',$app,$app_id,1,$comp_id);
		}
		elseif($type == 'rel_fields'){
			$app = wpas_get_app($app_id);
			echo wpas_view_relationship($app['relationship'][$comp_id],$comp_id,$app);
			echo wpas_list('rel_fields',$app,$app_id,1,$comp_id);
		}
		elseif($type == 'help_fields'){
			$app = wpas_get_app($app_id);
			echo wpas_view_help($app['help'][$comp_id],$comp_id,$app);
			echo wpas_list('help_fields',$app,$app_id,1,$comp_id);
		}
		else {
			echo wpas_list($type,$app,$app_id,1);
			wpas_update_app($app,$app_id);       
		}
		}
	}
	die();
}
function wpas_list_all()
{
	wpas_is_allowed();
	$type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';
	$app_id = isset($_GET['app_id']) ? sanitize_text_field($_GET['app_id']) : '';
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
	if($type == null || ($type != 'app' && $app_id == null))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$list = Array();
	if($type == 'app'){	
		$apps_unserialized = Array();
		echo wpas_list("app",$apps_unserialized,0,1,'',$search);
	}
	else {
		$app = wpas_get_app($app_id);
		echo wpas_list($type,$app,$app_id,$page,'',$search);
	}
	die();
}
function wpas_save_option_form()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_save_option_form_nonce','nonce');
	$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
	if(empty($app_id))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}	
	$app = wpas_get_app($app_id);
	$search_str = "ao_";
	$comp = Array();
	$comp['base64_encoded'] = 0;
	if(empty($app))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	parse_str(stripslashes(html_entity_decode(wp_kses_post($_POST['form']))),$post_array);
	foreach($post_array as $pkey => $comp_form_value){
		$pos = strpos($pkey,$search_str);
		if(in_array($pkey,Array('ao_change_log'))){
			$comp_form_value = implode("\n",array_map('sanitize_text_field',explode("\n",$comp_form_value)));
		}
		elseif(in_array($pkey, Array('ao_php', 'ao_left_footer_html','ao_right_footer_html','ao_app_desc'))){
			$comp_form_value = base64_encode(stripslashes($comp_form_value));
			$comp['base64_encoded'] = 1;
		}	
		else {
			$comp_form_value = wp_kses_post($comp_form_value);
		}

		if($pos !== false && $comp_form_value != "")
		{
			$comp[$pkey] = $comp_form_value;
		}
	}
	if(empty($post_array['ao_php'])){
		unset($comp['ao_php']);
	}
	
	if(!isset($comp['ao_blog_name']))
	{
		$comp['ao_blog_name'] = sprintf(__('My %s Site','wp-app-studio'),$comp['ao_domain']);
	}
	if(!isset($comp['ao_app_version']))
	{
		$comp['ao_app_version'] = "1.0.0";
	}
	if(!isset($comp['ao_author']))
	{
		$comp['ao_author'] = $comp['ao_domain'] . " " . __("Owner","wp-app-studio");
	}
	if(!isset($comp['ao_author_url']))
	{
		$comp['ao_author_url'] = "http://" . $comp['ao_domain'] ;
	}
	$comp['date'] = date("Y-m-d H:i:s");
	$comp['modified_date'] = date("Y-m-d H:i:s");
	$app['option'] = $comp;
	wpas_update_app($app,$app_id);
	echo wp_json_encode($comp);
	die();
}
function wpas_save_form()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_save_form_nonce','nonce');
	$comp_type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$subtype = isset($_POST['subtype']) ? sanitize_text_field($_POST['subtype']) : '';
	$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
	if(empty($app_id) || $comp_type == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	parse_str(stripslashes(html_entity_decode(wp_kses_post($_POST['form']))),$post_array);

	$app = wpas_get_app($app_id);
	if(empty($app))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$search_str = wpas_get_search_string($comp_type);
	if($comp_type == 'connection' && $subtype != ''){
		$search_str = $subtype . "_";
	}
	$comp = Array();
	$comp['base64_encoded'] = 0;
	foreach($post_array as $pkey => $comp_form_value)
	{
		if($comp_type == 'connection' && in_array($pkey,Array('connection-name','connection-type','connection-entity'))){
			$pos = 0;
		}
		else {
			$pos = strpos($pkey,$search_str);
		}
		if(in_array($pkey, Array('rel-con_from_header','rel-con_from_footer','rel-con_from_layout','rel-con_to_header','rel-con_to_footer','rel-con_to_layout','rel-rel_from_header','rel-rel_from_footer','rel-rel_from_layout','rel-rel_to_header','rel-rel_to_footer','rel-rel_to_layout','shc-sc_layout','shc-layout_header','shc-layout_footer','widg-layout_header','widg-layout_footer','widg-layout','widg-html','help-screen_sidebar','form-form_desc','form-not_loggedin_msg','notify-confirm_msg','notify-confirm_admin_msg','form-result_msg','form-result_footer_msg','form-confirm_success_txt','form-confirm_error_txt','shc-sc_js','glob-dflt-ta','shc-org_layout','shc-org_tooltip_layout','shc-emd-org_layout','shc-emd-org_tooltip_layout','connection-woo_product_layout','connection-woo_product_header','connection-woo_product_footer','connection-woo_order_layout','connection-woo_order_header','connection-woo_order_footer','connection-woo_my_account_bef_shc','connection-woo_my_account_aft_shc','connection-edd_product_layout','connection-edd_product_header','connection-edd_product_footer','connection-edd_order_layout','connection-edd_order_header','connection-edd_order_footer','connection-edd_my_account_bef_shc','connection-edd_my_account_aft_shc')))
		{
			$comp_form_value_sanitized = base64_encode(stripslashes($comp_form_value));
			$comp['base64_encoded'] = 1;
		}
		elseif(!is_array($comp_form_value))
		{
			$comp_form_value_sanitized = sanitize_text_field($comp_form_value);
		}
		else
		{
			$comp_form_value_sanitized = $comp_form_value;
		}
		$req_fields = Array('ent-name','ent-label','ent-singular-label','txn-name','txn-label','txn-singular-label','rel-name','shc-label','widg-name','widg-title','role-name','role-label','form-name','notify-name');
		if(empty($comp_form_value_sanitized) && !empty($comp_form_value) && in_array($pkey,$req_fields))
		{
			wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
		}
		if($pos !== false && $comp_form_value_sanitized != '')
		{
			if(in_array($pkey, Array('ent-name','txn-name','rel-name','widg-name','role-name','shc-label','form-name','notify-name')))
			{
				$comp[$pkey] = strtolower($comp_form_value_sanitized);
			}
			elseif(in_array($pkey,Array('ent-label','ent-singular-label')))
			{
				$comp[$pkey] = ucwords(strtolower($comp_form_value_sanitized));
			}
			else
			{
				$comp[$pkey] = $comp_form_value_sanitized;
			}
		}
	}
	if($comp_type == 'help' && empty($comp['help-screen_type']))
	{
		$comp['help-screen_type'] = 'edit';
	}
	$comp['date'] = date("Y-m-d H:i:s");
	$comp['modified_date'] = date("Y-m-d H:i:s");
	if(!empty($app[$comp_type]))
	{
		$comp_id = max(array_keys($app[$comp_type])) +1;
	}
	else
	{
		$comp_id = 0;
	}
	if($comp_type == 'entity')
	{
		if($comp['ent-capability_type'] != 'post')
		{
			$admin_new_entity_arr = wpas_admin_entity('ent_' .$comp_id, $comp);
			$app['role'][0] = array_merge($admin_new_entity_arr,$app['role'][0]);
		}
		if(isset($comp['ent-inline-ent']) && $comp['ent-inline-ent'] == 1)
		{
			$comp['field'][] = Array('fld_name' => 'blt_title','fld_label'=>'Title','fld_type'=>'text','fld_builtin' => 1,'fld_required' => 1, 'fld_uniq_id' => 1);
			$comp['field'][] = Array('fld_name' => 'blt_content','fld_label'=>'Content','fld_type'=>'wysiwyg','fld_builtin' => 1);
		}
		else {	
			if(isset($comp['ent-supports_title']) && $comp['ent-supports_title'] == 1)
			{
				$comp['field'][] = Array('fld_name' => 'blt_title','fld_label'=>'Title','fld_type'=>'text','fld_builtin' => 1,'fld_required' => 1);
			}
			if(isset($comp['ent-supports_editor']) && $comp['ent-supports_editor'] == 1)
			{
				$comp['field'][] = Array('fld_name' => 'blt_content','fld_label'=>'Content','fld_type'=>'wysiwyg','fld_builtin' => 1);
			}
			if(isset($comp['ent-supports_excerpt']) && $comp['ent-supports_excerpt'] == 1)
			{
				$comp['field'][] = Array('fld_name' => 'blt_excerpt','fld_label'=>'Excerpt','fld_type'=>'textarea','fld_builtin' => 1);
			}
		}
	}
	if($comp_type == 'taxonomy')
	{
		$admin_new_tax_arr = wpas_admin_taxonomy('tax_' . $comp_id);
		$app['role'][0] = array_merge($admin_new_tax_arr,$app['role'][0]);
	}
	if($comp_type == 'widget' && $comp['widg-type'] == 'dashboard')
	{
		$admin_new_widg_arr = wpas_admin_widget('widg_' . $comp_id);
		$app['role'][0] = array_merge($admin_new_widg_arr,$app['role'][0]);
	}
	$app[$comp_type][$comp_id] = $comp;
	echo wpas_list($comp_type,$app,$app_id,1);
	wpas_update_app($app,$app_id);
	if($comp_type == 'connection'){
		if($comp['connection-type'] == 'woocommerce'){
			wpas_set_woo_roles($app,$app_id);
		}
		elseif($comp['connection-type'] == 'edd'){
			wpas_set_edd_roles($app,$app_id);
		}
	}
	die();
}
function wpas_update_form()
{
	wpas_is_allowed();
	check_ajax_referer('wpas_update_form_nonce','nonce');
	$type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
	$subtype = isset($_POST['subtype']) ? sanitize_text_field($_POST['subtype']) : '';
	$app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
	if(empty($app_id) || $type == null)
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	parse_str(stripslashes(html_entity_decode(wp_kses_post($_POST['form']))),$post_array);
	$app = wpas_get_app($app_id);
	if(empty($app))
	{
		wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
	}
	$search_str = wpas_get_search_string($type);
	if($type == 'connection' && $subtype != ''){
		$search_str = $subtype . "_";
	}
	$comp_type = $type;
	$comp = Array();
	$types = Array('ent','txn','rel','help','shc','widget','role','form','notify','connection','glob');
	$comp['base64_encoded'] = 0;
	foreach($post_array as $pkey => $comp_form_value)
	{
		if(in_array($pkey,$types))
		{
			$comp_id = $comp_form_value;
		}
		if($type == 'connection' && in_array($pkey,Array('connection-name','connection-type','connection-entity'))){
			$pos = 0;
		}
		else {
			$pos = strpos($pkey,$search_str);
		}

		if(in_array($pkey, Array('rel-con_from_header','rel-con_from_footer','rel-con_from_layout','rel-con_to_header','rel-con_to_footer','rel-con_to_layout','rel-rel_from_header','rel-rel_from_footer','rel-rel_from_layout','rel-rel_to_header','rel-rel_to_footer','rel-rel_to_layout','shc-sc_layout','shc-layout_header','shc-layout_footer','widg-layout','widg-layout_header','widg-layout_footer','widg-html','help-screen_sidebar','form-form_desc','form-not_loggedin_msg','notify-confirm_msg','notify-confirm_admin_msg','form-result_msg','form-result_footer_msg','form-confirm_success_txt','form-confirm_error_txt','shc-sc_js','glob-dflt-ta','shc-org_layout','shc-org_tooltip_layout','shc-emd-org_layout','shc-emd-org_tooltip_layout','connection-woo_product_layout','connection-woo_product_header','connection-woo_product_footer','connection-woo_order_layout','connection-woo_order_header','connection-woo_order_footer','connection-woo_my_account_bef_shc','connection-woo_my_account_aft_shc','connection-edd_product_layout','connection-edd_product_header','connection-edd_product_footer','connection-edd_order_layout','connection-edd_order_header','connection-edd_order_footer','connection-edd_my_account_bef_shc','connection-edd_my_account_aft_shc')))
		{
			$comp_form_value_sanitized = base64_encode(stripslashes($comp_form_value));
			$comp['base64_encoded'] = 1;
		}
		elseif(!is_array($comp_form_value))
		{
			$comp_form_value_sanitized = sanitize_text_field($comp_form_value);
		}
		else
		{
			$comp_form_value_sanitized = $comp_form_value;
		}
		$req_fields = Array('ent-name','ent-label','ent-singular-label','txn-name','txn-label','txn-singular-label','shc-label','widg-name','widg-title','role-name','role-label','form-name');
		if(empty($comp_form_value_sanitized) && !empty($comp_form_value) && in_array($pkey,$req_fields))
		{
			wp_die(__('Action failed. Please refresh your page and try again.','wp-app-studio'));
		}
		if($pos !== false && $comp_form_value_sanitized != "")
		{
			if(in_array($pkey, Array('ent-name','txn-name','role-name','shc-label','form-name','widg-name')))
			{
				$comp[$pkey] = strtolower($comp_form_value_sanitized);
			}
			elseif(in_array($pkey, Array('ent-label','ent-singular-label')))
			{
				$comp[$pkey] = ucwords(strtolower($comp_form_value_sanitized));
			}
			else
			{
				if(($comp_type == 'role' && !empty($comp_form_value_sanitized)) || $comp_type != 'role')
				{
					$comp[$pkey] = $comp_form_value_sanitized;
				}
			}
		}
	}
	$comp['date'] = $app[$comp_type][$comp_id]['date'];
	if(empty($comp['date']))
	{
		$comp['date'] = date("Y-m-d H:i:s");
	}
	$comp['modified_date'] = date("Y-m-d H:i:s");
	if(isset($app[$comp_type][$comp_id]['field']))
	{
		$fields = $app[$comp_type][$comp_id]['field'];
		$comp['field'] = $fields;
	}
	if($comp_type == 'entity')
	{
		if(isset($app[$comp_type][$comp_id]['layout']))
		{	
			$layout = $app[$comp_type][$comp_id]['layout'];
			if(is_array($layout))
			{
				$comp['layout'] = $layout;
			}
		}
		$set_builtin = Array();
		$unset_builtin = Array();
		$dont_set = Array();
		if(isset($comp['ent-supports_title']) && $comp['ent-supports_title'] == 1)
                {
			$set_builtin['blt_title'] = Array('fld_name' => 'blt_title','fld_label'=>'Title','fld_type'=>'text', 'fld_builtin'=>1, 'fld_required' => 1);
                }
		elseif(empty($comp['ent-inline-ent']))
		{
			$unset_builtin[] = 'blt_title';
		}
		if(isset($comp['ent-supports_editor']) && $comp['ent-supports_editor'] == 1)
		{
			$set_builtin['blt_content'] = Array('fld_name' => 'blt_content','fld_label'=>'Content','fld_type'=>'wysiwyg','fld_builtin' => 1);
		}
		elseif(empty($comp['ent-inline-ent']))
		{
			$unset_builtin[] = 'blt_content';
		}
		if(isset($comp['ent-supports_excerpt']) && $comp['ent-supports_excerpt'] == 1)
		{
			$set_builtin['blt_excerpt'] = Array('fld_name' => 'blt_excerpt','fld_label'=>'Excerpt','fld_type'=>'textarea','fld_builtin' => 1);
		}
		elseif(empty($comp['ent-inline-ent']))
		{
			$unset_builtin[] = 'blt_excerpt';
		}
		if(isset($comp['ent-inline-ent']) && $comp['ent-inline-ent'] == 1)
		{
			unset($comp['field']);
			$comp['field'][] = Array('fld_name' => 'blt_title','fld_label'=>'Title','fld_type'=>'text','fld_builtin' => 1,'fld_required' => 1, 'fld_uniq_id' => 1);
			$comp['field'][] = Array('fld_name' => 'blt_content','fld_label'=>'Content','fld_type'=>'wysiwyg','fld_builtin' => 1);
		}
		if(!empty($comp['field']))
		{
			foreach($comp['field'] as $keyfield => $myfield)
			{
				if(in_array($myfield['fld_name'],array_keys($set_builtin)))
				{
					$dont_set[] = $myfield['fld_name'];
				}
				elseif(in_array($myfield['fld_name'],$unset_builtin))
				{
					unset($comp['field'][$keyfield]);
				}
			}
		}
		foreach($set_builtin as $setkey => $setval)
		{
			if(empty($dont_set) || (!empty($dont_set) && !in_array($setkey,$dont_set)))
			{
				$comp['field'][] = $set_builtin[$setkey];
			}
		}
		if((isset($comp['ent-supports_comments']) && $comp['ent-supports_comments'] == 1 
		&& !empty($comp['ent-com_type']) && $comp['ent-com_type'] == 'wp') || empty($comp['ent-supports_comments'])){
			foreach($app['widget']	as $kwidg => $mywidget){
				if($mywidget['widg-attach'] == $comp_id && 
				((!empty($mywidget['widg-side_subtype']) && $mywidget['widg-side_subtype'] == 'comment')
				|| (!empty($mywidget['widg-dash_subtype']) && $mywidget['widg-dash_subtype'] == 'comment'))){
					unset($app['widget'][$kwidg]);
				}
			}
		}	
	}
	elseif($comp_type == 'role')
	{
		if(!isset($comp['role-name']))
		{
			$comp['role-name'] = $app[$comp_type][$comp_id]['role-name'];
		}
		if(!isset($comp['role-label']))
		{
			$comp['role-label'] = $app[$comp_type][$comp_id]['role-label'];
		}
	}
	elseif($comp_type == 'form' && !empty($app[$comp_type][$comp_id]['form-layout']))
	{
		$comp['form-layout'] = $app[$comp_type][$comp_id]['form-layout'];
	}

	if($comp_type == 'entity')
	{
		if($comp['ent-capability_type'] != 'post')
		{
			$admin_new_entity_arr = wpas_admin_entity('ent_' . $comp_id,$comp);
			$app['role'][0] = array_merge($admin_new_entity_arr,$app['role'][0]);
		}
		elseif($comp['ent-capability_type'] == 'post' && $app[$comp_type][$comp_id]['ent-capability_type'] != 'post')
		{
			$new_entity_arr = wpas_admin_entity('ent_' . $comp_id,$comp);
			foreach($app['role'] as $keyrole => $myrole)
			{
				$app['role'][$keyrole] = array_diff_key($app['role'][$keyrole],$new_entity_arr);
			}
		}
	}
	elseif($comp_type == 'taxonomy')
	{
		$old_tax = $app[$comp_type][$comp_id];
		if(!empty($old_tax) && $comp['txn-name'] != $old_tax['txn-name'])
                {
                        $app = wpas_update_all_layout('tax',$old_tax['txn-name'],$comp['txn-name'],$app,$app_id);
                        $app = wpas_update_all_layout('taxnl',$old_tax['txn-name'],$comp['txn-name'],$app,$app_id);
                        $app = wpas_update_all_layout('taxsl',$old_tax['txn-name'],$comp['txn-name'],$app,$app_id);
                }
	}
	$app[$comp_type][$comp_id] = $comp;
	wpas_update_app($app,$app_id);
	echo wpas_list($type,$app,$app_id,1);
	if($comp_type == 'connection'){
		if($comp['connection-type'] == 'woocommerce'){
			wpas_set_woo_roles($app,$app_id);
		}
		elseif($comp['connection-type'] == 'edd'){
			wpas_set_edd_roles($app,$app_id);
		}
	}
	die();
}
function wpas_get_search_string($type)
{
	switch($type) {
		case 'entity':	
			$search_str = "ent-";
			break;
		case 'taxonomy':
			$search_str = "txn-";
			break;
		case 'option':
			$search_str = "ao_";
			break;
		case 'relationship':
			$search_str = "rel-";
			break;
		case 'help':
			$search_str = "help-";
			break;
		case 'shortcode':
			$search_str = "shc-";
			break;
		case 'widget':
			$search_str = "widg-";
			break;
		case 'role':
			$search_str = "role-";
			break;
		case 'form':
			$search_str = "form-";
			break;
		case 'entity_fld':
			$search_str = "fld_";
			break;
		case 'relationship_fld':
			$search_str = "rel_fld_";
			break;
		case 'help_fld':
			$search_str = "help_fld_";
			break;
		case 'notify':
			$search_str = 'notify-';
			break;
		case 'connection':
			$search_str = 'connection-';
			break;
		case 'glob':
			$search_str = 'glob-';
			break;
		default:
			$search_str = "ent-";
			break;
	}
	return $search_str;
}
function wpas_update_all_layout($ftype,$fold,$fnew,$app,$app_id)
{
	if($ftype == 'attr')
	{
		$check = "!#ent_" . $fold . "#";
		$new = "!#ent_" . $fnew . "#";
	}
	elseif($ftype == 'rel')
	{
		$check = "!#rel_" . $fold . "#";
		$new = "!#rel_" . $fnew . "#";
	}
	elseif($ftype == 'tax')
	{
		$check = "!#tax_" . $fold . "#";
		$new = "!#tax_" . $fnew . "#";
	}
	elseif($ftype == 'taxnl')
	{
		$check = "!#tax_" . $fold . "_NL#";
		$new = "!#tax_" . $fnew . "_NL#";
	}
	elseif($ftype == 'taxsl')
	{
		$check = "!#tax_" . $fold . "_SL#";
		$new = "!#tax_" . $fnew . "_SL#";
	}
	if(in_array($ftype,Array('attr','tax','taxnl','taxsl')))
	{
		if(!empty($app['shortcode']))
		{
			foreach($app['shortcode'] as $kshc => $myshc)
			{
				if(!empty($myshc['shc-sc_layout'])){
					if($myshc['base64_encoded'] == 1){
						$encoded_layout = base64_decode($myshc['shc-sc_layout']);
					}
					else {
						$encoded_layout = $myshc['shc-sc_layout'];
					}	
					if(preg_match('/'.$check.'/', $encoded_layout)){
						$encoded_layout = str_replace($check,$new,$encoded_layout);
					}
					if($myshc['base64_encoded'] == 1){
						$app['shortcode'][$kshc]['shc-sc_layout'] = base64_encode($encoded_layout);
					}
					else {
						$app['shortcode'][$kshc]['shc-sc_layout'] = $encoded_layout;
					}
				}
			}
		}
	}
	if(in_array($ftype,Array('attr','rel','tax','taxnl','taxsl')))
	{
		if(!empty($app['widget']))
		{
			foreach($app['widget'] as $kwidg => $mywidg)
			{
				if(!empty($mywidg['widg-layout'])){
					if($mywidg['base64_encoded'] == 1){
						$encoded_widg_layout = base64_decode($mywidg['widg-layout']);
					}
					else {
						$encoded_widg_layout = $mywidg['widg-layout'];
					}
					if(preg_match('/'.$check.'/', $encoded_widg_layout)){
						$encoded_widg_layout = str_replace($check,$new,$encoded_widg_layout);
					}
					if($mywidg['base64_encoded'] == 1){
						$app['widget'][$kwidg]['widg-layout'] = base64_encode($encoded_widg_layout);
					}
					else {
						$app['widget'][$kwidg]['widg-layout'] = $encoded_widg_layout;
					}
				}
			}
		}
	}
	return $app;
}		
