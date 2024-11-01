<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wpas_is_def_role($myrole)
{
	$def_roles = Array('administrator','subscriber','editor','contributor','author','shop_manager','customer','edd_shop_manager','shop_vendor','shop_worker','shop_accountant');
	if(in_array($myrole['role-name'],$def_roles))
	{
		return true;
	}
	return false;
}
function wpas_admin_entity($label,$entity)
{
	$admin_role = Array('role-edit_' . $label => 1,
			'role-delete_' . $label => 1,
			'role-edit_others_' . $label => 1,
			'role-publish_' . $label => 1,
			'role-read_private_' . $label => 1,
			'role-delete_private_' . $label => 1,
			'role-delete_published_' . $label => 1,
			'role-delete_others_' . $label => 1,
			'role-edit_private_' . $label => 1,
			'role-edit_published_' . $label => 1,
			'role-manage_operations_' .$label => 1);
	if(!empty($entity['ent-com_name']) && $entity['ent-com_type'] == 'custom')
	{
		$admin_role['role-manage_' . $entity['ent-com_name'] . "_" . $label] = 1;
	}
	if(isset($entity['ent-supports_author']) && $entity['ent-supports_author'] == 1){
		$admin_role['role-set_author_' . $label] = 1;
	}
	return $admin_role;				
}
function wpas_admin_taxonomy($label)
{
	$admin_role = Array('role-manage_' . $label => 1,
			'role-edit_' . $label => 1,
			'role-delete_' . $label => 1,
			'role-assign_' .$label => 1);
	return $admin_role;				
}
function wpas_admin_widget($label)
{
	$admin_role = Array('role-view_' . $label => 1,
			'role-configure_' .$label => 1);
	return $admin_role;				
}
function wpas_default_capabilities($myrole,$add_woo_caps=0,$add_edd_caps=0)
{
$html = "";
if(empty($myrole))
{
	$myrole['role-read'] = 1;
}
$def_caps = array(
                'activate_plugins',
                'add_users',
                'create_users',
                'delete_plugins',
                'delete_users',
                'edit_files',
                'edit_plugins',
                'edit_theme_options',
                'edit_themes',
                'edit_users',
                'import',
                'install_plugins',
                'install_themes',
                'list_users',
		'manage_categories',
                'manage_links',
                'manage_options',
                'moderate_comments',
                'promote_users',
                'read',
                'remove_users',
                'switch_themes',
                'unfiltered_html',
                'unfiltered_upload',
                'update_core',
                'update_plugins',
                'update_themes',
                'upload_files',
		'edit_dashboard',
		'view_app_dashboard',
		'edit_comment',
		'export',
		'delete_themes',
		);
if($add_woo_caps == 1){
	$def_caps[] = 'manage_woocommerce';
	$def_caps[] = 'view_woocommerce_reports';
}
if($add_edd_caps == 1){
	$def_caps[] = 'view_shop_reports';
	$def_caps[] = 'view_shop_sensitive_data';
	$def_caps[] = 'export_shop_reports';
	$def_caps[] = 'manage_shop_settings';
	$def_caps[] = 'manage_shop_discounts';
}
$count = 1;
$html .= '<label class="checkbox inline"><b>' . __("Check All","wp-app-studio") . '</b>
	<input id="def-all" class="checkall" type="checkbox" value="1" name="def-all" /></label><div id="def" class="well-white">';
foreach($def_caps as $mycap)
{
	if($count == 1)
	{
		$html .= '<div class="control-group">';
	}
	$html .= '<label class="checkbox inline span3">' . $mycap;
	$html .= '<input name="role-' . $mycap . '" id="role-' . $mycap . '" type="checkbox" value="1"';
	if(isset($myrole['role-'.$mycap]) && $myrole['role-'.$mycap] == 1)
	{
		$html .= ' checked';
	}	
	if($add_woo_caps == 1 && in_array($myrole['role-name'],Array('shop_manager','customer','administrator'))){
		//check woocommerce caps
		$woo_caps = get_option('wpas_woocommerce_caps');
		if(in_array($mycap,$woo_caps)){
			$html .= ' disabled readonly';
		}
		$woo_def_caps = get_option('wpas_woocommerce_def_caps');
		if(in_array($mycap,$woo_def_caps) && in_array($myrole['role-name'],Array('shop_manager','customer'))){
			$html .= ' disabled readonly';
		}
	}	
	if($add_edd_caps == 1 && in_array($myrole['role-name'],Array('edd_shop_manager','shop_vendor','shop_worker','shop_accountant','administrator'))){
		//check woocommerce caps
		$edd_caps = get_option('wpas_edd_caps');
		if(in_array($mycap,$edd_caps)){
			$html .= ' disabled readonly';
		}
		$edd_def_caps = get_option('wpas_edd_def_caps');
		if(in_array($mycap,$edd_def_caps) && in_array($myrole['role-name'],Array('edd_shop_manager','shop_vendor','shop_worker','shop_accountant'))){
			$html .= ' disabled readonly';
		}
		$edd_caps_admin = Array('view_shop_reports','view_shop_sensitive_data','export_shop_reports','manage_shop_settings','manage_shop_discounts');
		if(in_array($mycap,$edd_caps_admin) && in_array($myrole['role-name'],Array('edd_shop_manager','shop_vendor','shop_worker','shop_accountant','administrator'))){
			$html .= ' disabled readonly';
		}
	}	
	$html .= '/></label>';
	$count ++;
	if($count  == 5)
	{
		$html .= "</div>";
		$count = 1;
	}
}
if($count != 1){
	$html .= "</div>";
}
$html .= "</div>";
return $html;
}
function wpas_entity_capabilities($app_id,$entities,$myrole,$add_woo_caps,$add_edd_caps)
{
	$html ="";
	$entcount = 0;
	$ent_caps = Array();
	$user_rels= Array();
	$app = wpas_get_app($app_id);
	if(!empty($app['relationship']))
	{
		foreach($app['relationship'] as $keyrel => $myrel)
		{
			if($myrel['rel-from-name'] == 'user')
			{
				$user_rels[$myrel['rel-to-name']][$keyrel] = $myrel['rel-name'];
			}
			elseif($myrel['rel-to-name'] == 'user')
			{
				$user_rels[$myrel['rel-from-name']][$keyrel] = $myrel['rel-name'];
			}
			else
			{
				foreach($entities[$myrel['rel-from-name']]['field'] as $mfield)
				{
					if($mfield['fld_type'] == 'user')
					{
						$user_rels[$myrel['rel-to-name']][$keyrel] = $myrel['rel-name'];
						break;
					}
				}
				foreach($entities[$myrel['rel-to-name']]['field'] as $mfield)
				{
					if($mfield['fld_type'] == 'user')
					{
						$user_rels[$myrel['rel-from-name']][$keyrel] = $myrel['rel-name'];
						break;
					}
				}
			}
		}
	}
	foreach($entities as $keyent => $myentity)
	{
		$show_cap = 0;
		$label = 'ent_' . $keyent;
		if(isset($myentity['ent-capability_type']) && $myentity['ent-capability_type'] != 'post')
		{
			if(!in_array($myentity['ent-name'],Array('posts','pages')))
			{	
				$label = 'ent_' . $keyent;
				$show_cap = 1;
			}
		}
		elseif(isset($myentity['ent-inline-ent']) && $myentity['ent-inline-ent'] == 1)
		{
			$label = 'ent_' . $keyent;
			$show_cap = 1;
		}
		if($myentity['ent-name'] == 'page' || $myentity['ent-name'] == 'post')
		{
			$label = $myentity['ent-name'] ."s";
			$show_cap = 1;
		}
		if($show_cap == 1)
		{
			$ent_caps[$entcount]['edit'] = "edit_" . $label;
			$ent_caps[$entcount]['delete'] = "delete_" . $label;
			$ent_caps[$entcount]['edit_others'] = "edit_others_" . $label;
			$ent_caps[$entcount]['publish'] = "publish_" . $label;
			$ent_caps[$entcount]['read_private'] = "read_private_" . $label;
			$ent_caps[$entcount]['delete_private'] = "delete_private_" . $label;
			$ent_caps[$entcount]['delete_published'] = "delete_published_" . $label;
			$ent_caps[$entcount]['delete_others'] = "delete_others_" . $label;
			$ent_caps[$entcount]['edit_private'] = "edit_private_" . $label;
			$ent_caps[$entcount]['edit_published'] = "edit_published_" . $label;
			$ent_caps[$entcount]['manage_operations'] = "manage_operations_" . $label;
			if(!empty($myentity['ent-com_name']) && $myentity['ent-com_type'] == 'custom')
			{
				$ent_caps[$entcount]['manage_' . $myentity['ent-com_name']] = "manage_" . $myentity['ent-com_name'] . "_" . $label;
			}
			$ent_caps[$entcount]['name'] = $myentity['ent-name'];
			$ent_caps[$entcount]['limitby_author_backend'] = "limitby_author_backend_" . $label;
			$ent_caps[$entcount]['limitby_author_frontend'] = "limitby_author_frontend_" . $label;
			//$ent_caps[$entcount]['limitby_author'] = "limitby_author_" . $label;
			if(isset($myentity['ent-supports_author']) && $myentity['ent-supports_author'] == 1){
				$ent_caps[$entcount]['set_author'] = "set_author_" . $label;
			}
			if(!empty($user_rels[$keyent]))
			{
				foreach($user_rels[$keyent] as $keyrel => $myuser_rel)
				{
					$ent_caps[$entcount]['limitby_' . $myuser_rel] = "limitby_rel_" . $keyrel;
				}
			}
			$entcount++;
		}
	}
	if($add_woo_caps == 1){
		$woo_ents = Array('product', 'shop_order', 'shop_coupon');
		foreach($woo_ents as $mywoo){
			$ent_caps[$entcount]['edit'] = "edit_" . $mywoo;
			$ent_caps[$entcount]['delete'] = "delete_" . $mywoo;
			$ent_caps[$entcount]['edit_others'] = "edit_others_" . $mywoo;
			$ent_caps[$entcount]['publish'] = "publish_" . $mywoo;
			$ent_caps[$entcount]['read_private'] = "read_private_" . $mywoo;
			$ent_caps[$entcount]['delete_private'] = "delete_private_" . $mywoo;
			$ent_caps[$entcount]['delete_published'] = "delete_published_" . $mywoo;
			$ent_caps[$entcount]['delete_others'] = "delete_others_" . $mywoo;
			$ent_caps[$entcount]['edit_private'] = "edit_private_" . $mywoo;
			$ent_caps[$entcount]['edit_published'] = "edit_published_" . $mywoo;
			$ent_caps[$entcount]['manage_' . $mywoo . '_terms'] = "manage_" . $mywoo . "_terms";
			$ent_caps[$entcount]['edit_' . $mywoo . '_terms'] = "edit_" . $mywoo . "_terms";
			$ent_caps[$entcount]['delete_' . $mywoo . '_terms'] = "delete_" . $mywoo . "_terms";
			$ent_caps[$entcount]['assign_' . $mywoo . '_terms'] = "assign_" . $mywoo . "_terms";
			$ent_caps[$entcount]['read'] = "read_" . $mywoo;
			$ent_caps[$entcount]['name'] = $mywoo;
			$entcount++;
		}
	}
	if($add_edd_caps == 1){
		$edd_ents = Array('download', 'shop_payment', 'shop_discount');
		foreach($edd_ents as $myedd){
			$ent_caps[$entcount]['edit'] = "edit_" . $myedd;
			$ent_caps[$entcount]['delete'] = "delete_" . $myedd;
			$ent_caps[$entcount]['edit_others'] = "edit_others_" . $myedd;
			$ent_caps[$entcount]['publish'] = "publish_" . $myedd;
			$ent_caps[$entcount]['read_private'] = "read_private_" . $myedd;
			$ent_caps[$entcount]['delete_private'] = "delete_private_" . $myedd;
			$ent_caps[$entcount]['delete_published'] = "delete_published_" . $myedd;
			$ent_caps[$entcount]['delete_others'] = "delete_others_" . $myedd;
			$ent_caps[$entcount]['edit_private'] = "edit_private_" . $myedd;
			$ent_caps[$entcount]['edit_published'] = "edit_published_" . $myedd;
			$ent_caps[$entcount]['manage_' . $myedd . '_terms'] = "manage_" . $myedd . "_terms";
			$ent_caps[$entcount]['edit_' . $myedd . '_terms'] = "edit_" . $myedd . "_terms";
			$ent_caps[$entcount]['delete_' . $myedd . '_terms'] = "delete_" . $myedd . "_terms";
			$ent_caps[$entcount]['assign_' . $myedd . '_terms'] = "assign_" . $myedd . "_terms";
			$ent_caps[$entcount]['view_' . $myedd . '_stats'] = "view_" . $myedd . "_stats";
			$ent_caps[$entcount]['read'] = "read_" . $myedd;
			$ent_caps[$entcount]['name'] = $myedd;
			$entcount++;
		}
	}
	$html = wpas_display_caps($ent_caps,'edit','entity',5, $myrole,$add_woo_caps,$add_edd_caps);
	return $html;
}
function wpas_tax_capabilities($app_id,$taxonomies,$myrole)
{
	$html ="";
	$taxcount = 0;
	foreach($taxonomies as $keytax => $mytax)
	{
		$label = "tax_" . $keytax;
		$tax_caps[$taxcount]['manage'] = "manage_" . $label;
		$tax_caps[$taxcount]['edit'] = "edit_" . $label;
		$tax_caps[$taxcount]['delete'] = "delete_" . $label;
		$tax_caps[$taxcount]['assign'] = "assign_" . $label;
		$tax_caps[$taxcount]['name'] = $mytax['txn-name'];
		$taxcount++;
	}
	if(empty($tax_caps))
	{
		$html = __("No taxonomies defined yet.","wp-app-studio");
	}
	else
	{
		$html = wpas_display_caps($tax_caps,'manage','taxonomy',5, $myrole);
	}
	return $html;
}
function wpas_widg_capabilities($app_id,$widgets,$myrole)
{
	$html ="";
	$widgcount = 0;
	foreach($widgets as $keywidg => $mywidg)
	{
		$label = 'widg_' . $keywidg;
		$widg_caps[$widgcount]['view'] = "view_" . $label;
		if($mywidg['widg-type'] == 'dashboard' && $mywidg['widg-wp_dash'] == 1)
		{
			$widg_caps[$widgcount]['configure'] = "configure_" . $label;
		}
		$widg_caps[$widgcount]['name'] = $mywidg['widg-name'];
		$widgcount++;
	}
	if(empty($widg_caps))
	{
		$html = __("No widgets defined yet.","wp-app-studio");
	}
	else
	{
		$html = wpas_display_caps_noacc($widg_caps,'widget',$myrole);
	}
	return $html;
}
function wpas_form_capabilities($app_id,$forms,$myrole)
{
	$html ="";
	$formcount = 0;
	foreach($forms as $keyform => $myform)
	{
		$form_caps[$formcount]['view'] = "view_form_" . $keyform;
		$form_caps[$formcount]['name'] = $myform['form-name'];
		$formcount++;
	}
	if(empty($form_caps))
	{
		$html = __("No forms defined yet.","wp-app-studio");
	}
	else
	{
		$html = wpas_display_caps_noacc($form_caps,'form',$myrole);
	}
	return $html;
}
function wpas_view_capabilities($app_id,$views,$myrole)
{
	$html ="";
	$viewcount = 0;
	foreach($views as $keyview => $myview)
	{
		$view_caps[$viewcount]['view'] = "view_shc_" . $keyview;
		$view_caps[$viewcount]['name'] = $myview['shc-label'];
		$viewcount++;
	}
	if(empty($view_caps))
	{
		$html = __("No views defined yet.","wp-app-studio");
	}
	else
	{
		$html = wpas_display_caps_noacc($view_caps,'view',$myrole);
	}
	return $html;
}
function wpas_display_caps_noacc($type_caps,$type_key,$myrole)
{
	$html = "";
	$count = 1;
	$html .= '<label class="checkbox inline"><b>' . __("Check All","wp-app-studio") . '</b><input name="' . esc_attr($type_key) . '-all" id="' . esc_attr($type_key) . '-all" class="checkall" type="checkbox" value="1" /></label><div id="' . $type_key . '" class="well-white">';
	foreach($type_caps as $mytype_cap)
	{
		foreach($mytype_cap as $key => $mycap)
		{
			if($key != 'name' && $count == 1)
			{
				$html .= '<div class="control-group">';
			}
			if($key != 'name')
			{
				$html .= '<label class="checkbox inline span4">' . $key . " " . $mytype_cap['name'];
				$html .= '<input name="role-' . $mycap . '" id="role-' . esc_attr($mycap) . '" type="checkbox" value="1"';
				if(isset($myrole['role-'.$mycap]) && $myrole['role-'.$mycap] != 0)
				{
					$html .= ' checked';
				}	
				$html .= '/> </label>';
				$count ++;
			}
			if($key != 'name' && $count == 4)
			{
				$html .= "</div>";
				$count = 1;
			}
		}
	}
	if($count < 4 && $count != 1)
	{
		$html .= "</div>";
	}
	$html .= "</div>";
	return $html;
}
function wpas_display_caps($type_caps,$type_key,$type,$pnum,$myrole,$add_woo_caps=0,$add_edd_caps=0)
{
	$navcount = 0;
	$html = "";
	$count = 1;
	foreach($type_caps as $mytype_cap)
	{
		foreach($mytype_cap as $key => $mycap)
		{
			$nav_in = "";
			if($key == $type_key)
			{
				if($navcount == 0)
				{
					$nav_in = "in";
					$navcount ++;
				}
				$html.= '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle" href="#collapse_' . esc_attr($mycap) . '" data-toggle="collapse" data-parent="#tab-' . $type . '">' . ucfirst($type) . ': ' . esc_html($mytype_cap['name']) . '</a></div><div id="collapse_'. esc_attr($mycap) . '" class="accordion-body ' . $nav_in . ' collapse"><div class="accordion-inner">';
				if(in_array($type, Array('widget','taxonomy','entity')))
				{
					$html .= '<label class="checkbox inline"><b>' . __("Check All","wp-app-studio") . '</b><input name="' . esc_attr($mytype_cap['name']) . '-all" id="' . esc_attr($mytype_cap['name']) . '-all" class="checkall" type="checkbox" value="1" /></label>';
				}
			}
			if($count == 1 && $pnum > 2)
			{
				$html .= '<div class="row-fluid" id="' . esc_attr($mytype_cap['name']) . '">';
			}
			if($key != 'name')
			{
				$html .= '<label class="checkbox inline span3">' . $key;
				$html .= '<input name="role-' . $mycap . '" id="role-' . esc_attr($mycap) . '" type="checkbox" value="1"';
				if(isset($myrole['role-'.$mycap]) && $myrole['role-'.$mycap] != 0)
				{
					$html .= ' checked';
				}
				if($add_woo_caps == 1 && in_array($myrole['role-name'],Array('shop_manager','customer','administrator'))){
					//check woocommerce caps
					$woo_caps = get_option('wpas_woocommerce_caps');
					if(in_array($mycap,$woo_caps)){
						$html .= ' disabled readonly';
					}
					$woo_def_caps = get_option('wpas_woocommerce_def_caps');
					if(in_array($mycap,$woo_def_caps) && in_array($myrole['role-name'],Array('shop_manager','customer'))){
						$html .= ' disabled readonly';
					}
				}	
				if($add_edd_caps == 1 && in_array($myrole['role-name'],Array('edd_shop_manager','shop_vendor','shop_worker','shop_accountant','administrator'))){
					//check edd caps
					$edd_caps = get_option('wpas_edd_caps');
					if(in_array($mycap,$edd_caps)){
						$html .= ' disabled readonly';
					}
					$edd_def_caps = get_option('wpas_edd_def_caps');
					if(in_array($mycap,$edd_def_caps) && in_array($myrole['role-name'],Array('edd_shop_manager','shop_accountant','shop_worker','shop_vendor'))){
						$html .= ' disabled readonly';
					}
				}	
				$html .= '/> </label>';
			}
			$count ++;
			if($count  == $pnum && $pnum >2)
			{
				$html .= "</div>";
				$count = 1;
			}
		}
		if($count < $pnum && $count != 1)
		{
			$html .= "</div>";
		}
		$html .= "</div></div></div>";
		$count = 1;
	}
	return $html;
}
function wpas_add_role_form($app_id,$role_id)
{
	$app = wpas_get_app($app_id);
        $entities = $app['entity'];
	$taxonomies = Array();
	$widgets = Array();
	$forms = Array();
	$views = Array();
	$add_woo_caps = 0;
	$add_edd_caps = 0;
	if(!empty($app['connection'])){
		foreach($app['connection'] as $myconn){
			if($myconn['connection-type'] == 'woocommerce'){
				$add_woo_caps = 1;
			}
			if($myconn['connection-type'] == 'edd'){
				$add_edd_caps = 1;
			}
		}
	}
	if(isset($app['taxonomy']))
	{
		$taxonomies = $app['taxonomy'];
	}
	if(isset($app['widget']))
	{
		$widgets = $app['widget'];
	}
	if(isset($app['form']))
	{
		$forms = $app['form'];
	}
	if(isset($app['shortcode']))
	{
		$views = $app['shortcode'];
	}
	$myrole = Array();
	$def_roles = Array('administrator','subscriber','editor','contributor','author','shop_manager','customer','edd_shop_manager','shop_vendor','shop_worker','shop_accountant');
	$disable = "";
	if($role_id != '')
	{
		$myrole = $app['role'][$role_id];
		$role_name = $myrole['role-name'];
		$role_label = $myrole['role-label'];
		if(in_array($role_name,$def_roles))
		{
			$disable = "disabled";
		}
	}
	?>
		<div class="modal hide" id="errorRoleModal">
  <div class="modal-header">
        <button id="error-close" type="button" class="close" data-dismiss="errorRoleModal" aria-hidden="true">x</button>
    <h3><i class="icon-flag icon-red"></i><?php esc_html_e("Error","wp-app-studio"); ?></h3>
  </div>
  <div class="modal-body" style="clear:both"><?php esc_html_e("There must be at least one capability enabled.","wp-app-studio");?>
  </div>
  <div class="modal-footer">
<button id="error-ok" data-dismiss="errorRoleModal" aria-hidden="true" class="btn btn-primary"><?php esc_html_e("OK","wp-app-studio"); ?></button>
  </div>
</div>
		<form action="" method="post" id="role-form" name="role-form" class="form-horizontal">
		<input type="hidden" id="app" name="app" value="<?php echo esc_attr($app_id); ?>" />
		<input type="hidden" value="<?php echo esc_attr($role_id); ?>" name="role" id="role" />  
		<fieldset>
		<div class="well">
	<div class="emdt-alert emdt-row"><div class="alert alert-info"><a data-placement="bottom" href="#" title="<?php esc_html_e("A role is a collection of capabilities which enable or disable access to your application's data.","wp-app-studio");?>"><i class="icon-info-sign"></i></a><a title="Go to Permissions Component page" rel="tooltip" href="<?php echo WPAS_URL . '/components/permissions/?pk_campaign=wpas&pk_source=plugin&pk_medium=link&pk_content=learnmore'; ?>" target="_blank"><?php esc_html_e("LEARN MORE","wp-app-studio"); ?></a></div></div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Name","wp-app-studio");?></label>
		<div class="controls">
		<input class="input-xlarge" name="role-name" id="role-name" type="text" placeholder="<?php esc_html_e("e.g. product_owner","wp-app-studio");?>"
		<?php 
		 if(isset($myrole['role-name']))
		 {
			 echo ' value="' . esc_attr($myrole['role-name']) . '" ' . $disable;
		 }
		?>
	 ><a href="#" title="<?php esc_html_e("Sets a unique name containing only alphanumeric characters and underscores.","wp-app-studio");?>" >
		<i class="icon-info-sign"></i></a>
		</div>
		</div>
		<div class="control-group row-fluid">
		<label class="control-label req"><?php esc_html_e("Label","wp-app-studio"); ?></label>
		<div class="controls">
		<input class="input-xlarge" name="role-label" id="role-label" type="text" placeholder="<?php esc_html_e("e.g. Product Owner","wp-app-studio"); ?>"
		<?php 
		 if(isset($myrole['role-label']))
		 {
			 echo ' value="' . esc_attr($myrole['role-label']) . '" ' . $disable ;
		 }
		?>
		/><a href="#" title="<?php esc_html_e("Sets a role label to represent your role.","wp-app-studio");?>" >
		<i class="icon-info-sign"></i></a>
		</div>
		</div> 
		<div class="tabbable">
		<ul class="nav nav-tabs">
		<li>
		<a data-toggle="tab" href="#tab-def"><?php esc_html_e("Default Capabilities","wp-app-studio");?></a>
		</li>
		<li class="active">
		<a data-toggle="tab" href="#tab-ent"><?php esc_html_e("Entities","wp-app-studio");?></a>
		</li>
		<li>
		<a data-toggle="tab" href="#tab-tax"><?php esc_html_e("Taxonomies","wp-app-studio");?></a>
		</li>
		<li>
		<a data-toggle="tab" href="#tab-widg"><?php esc_html_e("Widgets","wp-app-studio");?></a>
		</li>
		<li>
		<a data-toggle="tab" href="#tab-form"><?php esc_html_e("Forms","wp-app-studio");?></a>
		</li>
		<li>
		<a data-toggle="tab" href="#tab-view"><?php esc_html_e("Views","wp-app-studio");?></a>
		</li>
		</ul>	
		<div id="role-tabs" class="tab-content">
		<div id="tab-def" class="tab-pane">
		<?php 
		echo wpas_default_capabilities($myrole,$add_woo_caps,$add_edd_caps); ?>	
		</div>
		<div id="tab-ent" class="tab-pane active">
		<?php 
		//<div class="control-group span12" id="role-cap-list">
		//</div>
		echo wpas_entity_capabilities($app_id,$entities,$myrole,$add_woo_caps,$add_edd_caps); ?>	
		</div>
		<div id="tab-tax" class="tab-pane">
		<?php echo wpas_tax_capabilities($app_id,$taxonomies,$myrole); ?>
		</div>
		<div id="tab-widg" class="tab-pane">
		<?php echo wpas_widg_capabilities($app_id,$widgets,$myrole); ?>
		</div>
		<div id="tab-form" class="tab-pane">
		<?php echo wpas_form_capabilities($app_id,$forms,$myrole); ?>
		</div>
		<div id="tab-view" class="tab-pane">
		<?php echo wpas_view_capabilities($app_id,$views,$myrole); ?>
		</div>
		</div> <!-- end of role-tabs -->
		</div> <!-- end of tabbable -->
		</div> <!-- end of well -->
		<div class="control-group emdt-row">
		<button class="btn btn-inverse layout-buttons" id="cancel" name="cancel" type="button">
		<i class="icon-ban-circle"></i><?php esc_html_e("Cancel","wp-app-studio");?></button>
		<button class="btn btn-inverse layout-buttons" id="save-role" type="submit" value="Save">
		<i class="icon-save"></i><?php esc_html_e("Save","wp-app-studio");?></button>
		</div>
		</fieldset>
		</form>
<?php
}
function wpas_set_edd_roles($app,$app_id){
	$now = date('Y-m-d H:i:s');
	$app['date']= $now;
	$app['modified_date']= $now;
	$edd_cap_types = array('download', 'shop_payment', 'shop_discount');
	foreach($edd_cap_types as $edd_cap_type)
	{
		// Post type
		$edd_caps[] = "edit_{$edd_cap_type}";
		$edd_caps[] = "read_{$edd_cap_type}";
		$edd_caps[] = "delete_{$edd_cap_type}";
		$edd_caps[] = "edit_others_{$edd_cap_type}";
		$edd_caps[] = "publish_{$edd_cap_type}";
		$edd_caps[] = "read_private_{$edd_cap_type}";
		$edd_caps[] = "delete_private_{$edd_cap_type}";
		$edd_caps[] = "delete_published_{$edd_cap_type}";
		$edd_caps[] = "delete_others_{$edd_cap_type}";
		$edd_caps[] = "edit_private_{$edd_cap_type}";
		$edd_caps[] = "edit_published_{$edd_cap_type}";
		// Terms
		$edd_caps[] = "manage_{$edd_cap_type}_terms";
		$edd_caps[] = "edit_{$edd_cap_type}_terms";
		$edd_caps[] = "delete_{$edd_cap_type}_terms";
		$edd_caps[] = "assign_{$edd_cap_type}_terms";
		//Stats	
		$edd_caps[] = "view_{$edd_cap_type}_stats";
	}
	update_option('wpas_edd_caps',$edd_caps);
	$edd_def_caps = Array("read","edit_posts", "delete_posts", "unfiltered_html","upload_files", "export","import", "delete_others_pages", "delete_others_posts", "delete_pages", "delete_private_pages", "delete_private_posts", "delete_published_pages", "delete_published_posts", "edit_others_pages", "edit_others_posts", "edit_pages", "edit_private_pages", "edit_private_posts", "edit_published_pages", "edit_published_posts", "manage_categories","manage_links","moderate_comments", "publish_posts","publish_pages","read_private_pages","read_private_posts");
	update_option('wpas_edd_def_caps',$edd_def_caps);
	$edd_roles[0]['role-name'] = "administrator";
	$edd_roles[0]['role-label'] = "Administrator";
	foreach($edd_caps as $myedd_cap){
		$edd_roles[0]['role-'.$myedd_cap] = 1;
	}
	$edd_roles[0]['role-view_shop_reports'] = 1;
	$edd_roles[0]['role-view_shop_sensitive_data'] = 1;
	$edd_roles[0]['role-export_shop_reports'] = 1;
	$edd_roles[0]['role-manage_shop_settings'] = 1;
	$edd_roles[0]['role-manage_shop_discounts'] = 1;
	$edd_roles[1]['role-name'] = "edd_shop_manager";
	$edd_roles[1]['role-label'] = "Shop Manager";
	foreach($edd_def_caps as $my_def_cap){
		$edd_roles[1]['role-' . $my_def_cap] = 1;
	}
	foreach($edd_caps as $myedd_cap){
		$edd_roles[1]['role-'.$myedd_cap] = 1;
	}
	$edd_roles[1]['role-view_shop_reports'] = 1;
	$edd_roles[1]['role-view_shop_sensitive_data'] = 1;
	$edd_roles[1]['role-export_shop_reports'] = 1;
	$edd_roles[1]['role-manage_shop_settings'] = 1;
	$edd_roles[1]['role-manage_shop_discounts'] = 1;
	$edd_roles[2]['role-name'] = "shop_worker";
	$edd_roles[2]['role-label'] = "Shop Worker";
	$edd_roles[2]['role-read'] = 1;
	$edd_roles[2]['role-edit_posts'] = 0;
	$edd_roles[2]['role-upload_files'] = 1;
	$edd_roles[2]['role-delete_posts'] = 0;
	foreach($edd_caps as $myedd_cap){
		$edd_roles[2]['role-'.$myedd_cap] = 1;
	}
	$edd_roles[3]['role-name'] = "shop_accountant";
	$edd_roles[3]['role-label'] = "Shop Accountant";
	$edd_roles[3]['role-read'] = 1;
	$edd_roles[3]['role-edit_posts'] = 0;
	$edd_roles[3]['role-delete_posts'] = 0;
	$edd_roles[3]['role-edit_download'] = 1;
	$edd_roles[3]['role-read_private_download'] = 1;
	$edd_roles[3]['role-view_shop_reports'] = 1;
	$edd_roles[3]['role-export_shop_reports'] = 1;
	$edd_roles[3]['role-edit_shop_payment'] = 1;
	$edd_roles[4]['role-name'] = "shop_vendor";
	$edd_roles[4]['role-label'] = "Shop Vendor";
	$edd_roles[4]['role-read'] = 1;
	$edd_roles[4]['role-edit_posts'] = 0;
	$edd_roles[4]['role-upload_files'] = 1;
	$edd_roles[4]['role-delete_posts'] = 0;
	$edd_roles[4]['role-edit_download'] = 1;
	$edd_roles[4]['role-delete_download'] = 1;
	$edd_roles[4]['role-publish_download'] = 1;
	$edd_roles[4]['role-edit_published_download'] = 1;
	$edd_roles[4]['role-assign_download_terms'] = 1;
	foreach($edd_roles as $myrole)
	{
		$no_insert_role = 0;
		if(!empty($app['role']))
		{
			foreach($app['role'] as $krole => $role_created)
			{
				if($myrole['role-name'] == $role_created['role-name'])
				{
					if($role_created['role-name'] == 'administrator'){
						unset($app['role'][$krole]['administrator']);
						unset($app['role'][$krole]['Administrator']);
						foreach($myrole as $mycap => $mycapval){
							if(empty($app['role'][$krole][$mycap])){
								$app['role'][$krole][$mycap] = 1;
							}
						}		
						$app['role'][$krole]['modified_date'] = $now;
						$app['role'][$krole]['date'] = $now;
					}
					$no_insert_role = 1;
				}
			}
		}
		if($no_insert_role == 0)
		{
			$myrole['modified_date'] = $now;
			$myrole['date'] = $now;
			$app['role'][] = $myrole;
		}
	}
	wpas_update_app($app,$app_id);
}
function wpas_set_woo_roles($app,$app_id){
	$now = date('Y-m-d H:i:s');
	$app['date']= $now;
	$app['modified_date']= $now;
	$woo_caps[] ="manage_woocommerce";
	$woo_caps[] ="view_woocommerce_reports";
	$woo_cap_types = array('product', 'shop_order', 'shop_coupon');
	foreach($woo_cap_types as $woo_cap_type)
	{
		// Post type
		$woo_caps[] = "edit_{$woo_cap_type}";
		$woo_caps[] = "read_{$woo_cap_type}";
		$woo_caps[] = "delete_{$woo_cap_type}";
		$woo_caps[] = "edit_others_{$woo_cap_type}";
		$woo_caps[] = "publish_{$woo_cap_type}";
		$woo_caps[] = "read_private_{$woo_cap_type}";
		$woo_caps[] = "delete_private_{$woo_cap_type}";
		$woo_caps[] = "delete_published_{$woo_cap_type}";
		$woo_caps[] = "delete_others_{$woo_cap_type}";
		$woo_caps[] = "edit_private_{$woo_cap_type}";
		$woo_caps[] = "edit_published_{$woo_cap_type}";
		// Terms
		$woo_caps[] = "manage_{$woo_cap_type}_terms";
		$woo_caps[] = "edit_{$woo_cap_type}_terms";
		$woo_caps[] = "delete_{$woo_cap_type}_terms";
		$woo_caps[] = "assign_{$woo_cap_type}_terms";
	}
	update_option('wpas_woocommerce_caps',$woo_caps);
	$woo_def_caps = Array("read","read_private_pages","read_private_posts","edit_users","edit_posts","edit_pages",
				"edit_published_posts","edit_published_pages","edit_private_pages","edit_private_posts",
				"edit_others_posts","edit_others_pages","publish_posts","publish_pages",
				"delete_posts","delete_pages","delete_private_pages","delete_private_posts","delete_published_pages",
				"delete_published_posts","delete_others_posts","delete_others_pages",
				"manage_categories","manage_links","moderate_comments","unfiltered_html",
				"upload_files","export","import","list_users");
	update_option('wpas_woocommerce_def_caps',$woo_def_caps);
	$woo_roles[0]['role-name'] = "administrator";
	$woo_roles[0]['role-label'] = "Administrator";
	foreach($woo_caps as $mywoo_cap){
		$woo_roles[0]['role-'.$mywoo_cap] = 1;
	}
	$woo_roles[0]['role-export'] = 1;
	$woo_roles[1]['role-name'] = "shop_manager";
	$woo_roles[1]['role-label'] = "Shop Manager";
	foreach($woo_def_caps as $my_def_cap){
		$woo_roles[1]['role-' . $my_def_cap] = 1;
	}
	foreach($woo_caps as $mywoo_cap){
		$woo_roles[1]['role-'.$mywoo_cap] = 1;
	}
	$woo_roles[2] = Array('role-name'=> 'customer',
			'role-label' => 'Customer',
			'role-read' => 1,
			);
	foreach($woo_roles as $myrole)
	{
		$no_insert_role = 0;
		if(!empty($app['role']))
		{
			foreach($app['role'] as $krole => $role_created)
			{
				if($myrole['role-name'] == $role_created['role-name'])
				{
					if($role_created['role-name'] == 'administrator'){
						unset($app['role'][$krole]['administrator']);
						unset($app['role'][$krole]['Administrator']);
						foreach($myrole as $mycap => $mycapval){
							if(empty($app['role'][$krole][$mycap])){
								$app['role'][$krole][$mycap] = 1;
							}
						}		
						$app['role'][$krole]['modified_date'] = $now;
						$app['role'][$krole]['date'] = $now;
					}
					$no_insert_role = 1;
				}
			}
		}
		if($no_insert_role == 0)
		{
			$myrole['modified_date'] = $now;
			$myrole['date'] = $now;
			$app['role'][] = $myrole;
		}
	}
	wpas_update_app($app,$app_id);
}
function wpas_delete_woo_roles($app,$app_id){
	foreach($app['role'] as $krole => $vrole)
	{
		if(in_array($vrole['role-name'],Array('shop_manager','customer')))
		{
			unset($app['role'][$krole]);
		}
		elseif($vrole['role-name'] == 'administrator')
		{
			$woo_caps = get_option('wpas_woocommerce_caps');
			if(!empty($woo_caps)){
				foreach($woo_caps as $wcap){
					unset($app['role'][$krole]['role-' .$wcap]);
				}
			}
		}
	}
	return $app;
}
function wpas_delete_edd_roles($app,$app_id){
	foreach($app['role'] as $krole => $vrole)
	{
		if(in_array($vrole['role-name'],Array('edd_shop_manager','shop_vendor','shop_accountant','shop_worker')))
		{
			unset($app['role'][$krole]);
		}
		elseif($vrole['role-name'] == 'administrator')
		{
			$edd_caps_admin = Array('view_shop_reports','view_shop_sensitive_data','export_shop_reports','manage_shop_settings','manage_shop_discounts');
			$edd_caps = get_option('wpas_edd_caps');
			$edd_caps = array_merge($edd_caps_admin,$edd_caps);
			if(!empty($edd_caps)){
				foreach($edd_caps as $ecap){
					unset($app['role'][$krole]['role-' .$ecap]);
				}
			}
		}
	}
	return $app;
}
