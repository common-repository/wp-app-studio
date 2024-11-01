<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//functions to get and update applist and a specific app
function wpas_get_app_list($app_key_list = "")
{
	$app_list = Array();
	if(empty($app_key_list))
	{	
		$app_key_list = get_option('wpas_app_key_list');
	}
	if($app_key_list !== false && !empty($app_key_list))
	{
		foreach($app_key_list as $app_key)
		{
			if(get_option('wpas_app_' . $app_key) !== false)
			{
				$app_list[$app_key] = unserialize(base64_decode(get_option('wpas_app_' . $app_key)));
			}
		}
	}
	return $app_list;
}
function wpas_get_app($app_key)
{
	if(get_option('wpas_app_' . $app_key) !== false)
	{
		return unserialize(base64_decode(get_option('wpas_app_' . $app_key)));
	}
	return false;
}
function wpas_update_app($app,$app_key,$type='')
{
	if(empty($type))
	{
		$app['modified_date']= date('Y-m-d H:i:s');
		$app['ver']= WPAS_DATA_VERSION;
	}
	if($type == 'new_with_date' && !empty($app['app_name']))
	{
		$app_date = str_replace(":","-",$app['modified_date']);
		$app_date = str_replace(" ","-",$app_date);
		$app['app_name'] = sanitize_text_field($app['app_name'] . "-" . $app_date);
	}
	if(is_array($app) && !empty($app))
	{
		$app_serialized = base64_encode(serialize($app));
		update_option('wpas_app_' . $app_key ,$app_serialized);
		if($type == 'new' || $type == 'new_with_date')
		{
			wpas_update_app_key_list($app_key,'add');
		}
	}
}
function wpas_update_app_key_list($app_key,$type)
{
	$app_key = sanitize_text_field($app_key);
	$app_key_list = get_option('wpas_app_key_list');
	if($app_key_list === false)
	{
		$app_key_list = Array();
	}
	if($type == 'add')
	{
		if(!in_array($app_key,$app_key_list))
		{
			$app_key_list[] = $app_key;
		}
	}
	elseif($type == 'delete')
	{
		foreach($app_key_list as $mykey => $myapp_key)
		{
			if($myapp_key == $app_key)
			{
				unset($app_key_list[$mykey]);
				break;
			}
		}
	}
	update_option('wpas_app_key_list',$app_key_list);
	return $app_key_list;
}
function wpas_delete_app($app_key)
{
	$app_key = sanitize_text_field($app_key);
	delete_option('wpas_app_' . $app_key);
	return wpas_update_app_key_list($app_key,'delete');
}
function wpas_add_app_form($button,$app_id,$app_title,$style)
{
        ?>
                <div class="emdt-row">
                <div id="app-save" style="display: <?php echo $style; ?>">
                <form action="" method="post" id="app_form" class="form-inline">
                <fieldset>
                <input id="app_title" type="text" class="input-xlarge" placeholder="<?php esc_html_e("Enter application name","wp-app-studio");?>" value="<?php  echo esc_attr($app_title); ?>" name="app_title">
                <input type="hidden" name="app" value="<?php echo esc_attr($app_id); ?>" id="app">
                <input type="hidden" name="type" value="app" id="type">
		<?php wp_nonce_field("wpas_" . strtolower($button) . "_app_nonce"); ?>
		<input class="btn btn-inverse" id="save-app" type="submit" name="Save" value="<?php echo $button; ?>">
                </fieldset>
                </form>
                </div></div>
                <?php
}
function wpas_nav($app_name,$option="")
{
	if(is_array($option))
	{
                $option_link = '<p id="update-option"><a href="#' .esc_attr($app_name) .'"><i class="icon-building"></i>' . __("Update","wp-app-studio") . '</a></p>';
	}
	else
	{
                $option_link = '<p id="add-option"><a href="#' .esc_attr($app_name) .'"><i class="icon-building"></i>' . __("Add New","wp-app-studio") . '</a></p>';
	}
        ?>
                <div class="row-fluid"><div id="was-nav" class="span2">
                <div class="accordion-group">
                <div class="accordion-heading open">
                <a class="accordion-toggle" href="#collapse1" data-parent="#was-nav" data-toggle="collapse"><i class="icon-table icon-large"></i><?php esc_html_e("Entities","wp-app-studio");?></a>
                </div>
                <div id="collapse1" class="accordion-body in collapse">
                <div class="accordion-inner">
                <p id="add-entity"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-table"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="entity"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse2" data-parent="#was-nav" data-toggle="collapse"><i class="icon-tag icon-large"></i><?php esc_html_e("Taxonomies","wp-app-studio");?></a>
                </div>
                <div id="collapse2" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-taxonomy"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-tag"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="taxonomy"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse3" data-parent="#was-nav" data-toggle="collapse"><i class="icon-link icon-large"></i><?php esc_html_e("Relationships","wp-app-studio");?></a>
  </div>
                <div id="collapse3" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-relationship"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-link"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="relationship"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse4" data-parent="#was-nav" data-toggle="collapse"><i class="icon-cog icon-large"></i><?php esc_html_e("Widgets","wp-app-studio");?></a>
  </div>
                <div id="collapse4" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-widget"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-cog"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="widget"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse5" data-parent="#was-nav" data-toggle="collapse"><i class="icon-info-sign icon-large"></i><?php esc_html_e("Help Screens","wp-app-studio");?></a>
  </div>
                <div id="collapse5" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-help"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-info-sign"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="help"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse6" data-parent="#was-nav" data-toggle="collapse"><i class="icon-list-alt icon-large"></i><?php esc_html_e("Forms","wp-app-studio");?></a>
  </div>
                <div id="collapse6" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-form"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-list-alt"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="form"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse7" data-parent="#was-nav" data-toggle="collapse"><i class="icon-eye-open icon-large"></i><?php esc_html_e("Views","wp-app-studio");?></a>
  </div>
                <div id="collapse7" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-shortcode"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-eye-open"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="shortcode"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse8" data-parent="#was-nav" data-toggle="collapse"><i class="icon-volume-up icon-large"></i><?php esc_html_e("Notifications","wp-app-studio");?></a>
  </div>
                <div id="collapse8" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-notify"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-volume-up"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="notify"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse9" data-parent="#was-nav" data-toggle="collapse"><i class="icon-external-link icon-large"></i><?php esc_html_e("Connections","wp-app-studio");?></a>
  </div>
                <div id="collapse9" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-connection"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-external-link"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="connection"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
		<div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse10" data-parent="#was-nav" data-toggle="collapse"><i class="icon-key icon-large"></i><?php esc_html_e("Permissions","wp-app-studio");?></a>
  </div>
                <div id="collapse10" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-role"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-key"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="role"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse11" data-parent="#was-nav" data-toggle="collapse"><i class="icon-globe icon-large"></i><?php esc_html_e("Globals","wp-app-studio");?></a>
                </div>
                <div id="collapse11" class="accordion-body collapse">
                <div class="accordion-inner">
                <p id="add-glob"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-globe"></i><?php esc_html_e("Add New","wp-app-studio");?></a></p>
                <p id="glob"><a href="#<?php echo esc_attr($app_name); ?>"><i class="icon-reorder"></i><?php esc_html_e("List All","wp-app-studio");?></a></p>
                </div>
                </div>
                </div>                
                <div class="accordion-group">
                <div class="accordion-heading">
                <a class="accordion-toggle" href="#collapse12" data-parent="#was-nav" data-toggle="collapse"><i class="icon-building icon-large"></i><?php esc_html_e("Settings","wp-app-studio");?></a>
                </div>
                <div id="collapse12" class="accordion-body collapse">
                <div class="accordion-inner">
		<?php echo $option_link; ?>
                </div>
                </div>
                </div>                
                </div>
                <?php
}
function wpas_list_html($list_values,$part,$search='')
{
	if($part == 'pre'){
		$ret =  '<form action="" method="post"><div id="title-bar">
			<div class="emdt-row">
			<h4 class="title-bar-title"><i class="' . $list_values['icon'] . '"></i>' .  $list_values['title'] . '</h4>';
		if($list_values['type'] == 'app' || $list_values['type'] == 'entity')
		{
			$ret .= '<div class="add-new-btn ' . $list_values['type'] . '" id="add-new">
				<a class="btn btn-inverse" href="' .  wp_nonce_url($list_values['import'],'wpas_import') . '" class="import">
				<i class="icon-signin"></i>' . __("Import","wp-app-studio") . '</a>
				<a class="btn btn-inverse add-new" href="' . esc_url($list_values['add_new_url'])  . '">
				<i class="icon-plus-sign"></i>' . __("Add New","wp-app-studio") . '</a>';
		}
		elseif($list_values['type'] == 'shortcode')
		{
			$ret .= '<div class="title-bar-btn ' . $list_values['type'] . '" id="add-new">
				<a class="btn btn-inverse" href="#" id="create-def-views">
				<i class="icon-signin"></i>' . __("Create Default Views","wp-app-studio") . '</a>
				<a class="btn btn-inverse add-new" href="' . esc_url($list_values['add_new_url']) . '">
				<i class="icon-plus-sign"></i>' . __("Add New","wp-app-studio") . '</a>';
		}
		else
		{
			$ret .= '<div class="title-bar-btn ' . $list_values['type'] . '" id="add-new">
				<a class="btn btn-inverse add-new" href="' . esc_url($list_values['add_new_url']) . '">
				<i class="icon-plus-sign"></i>' . __("Add New","wp-app-studio") . '</a>';
		}
		$ret .= '</div>
			</div>
			</div>';
		if(isset($list_values['app_name']))
		{
			$ret .= '<input type="hidden" name="app-name" id="app-name" value="' . esc_attr($list_values['app_name']). '">';
		}
		$ret .= '<div style="padding-bottom:5px;">';
		$ret .= '<div class="emdt-row wpas-search">';
		$ret .= '<input id="wpas-search-' . $list_values['type'] . '" type="text" placeholder="' . __("Search...","wp-app-studio") . '" style="margin-right:10px;margin-bottom:0;"';
		if(!empty($search)){
			$ret .= 'value="' . $search . '"';
		}
		$ret .= '>';
		$ret .= '<button type="reset" id="wpas-search-reset-' . $list_values['type'] . '"';
		if(empty($search)){
			$ret .= ' style="display:none;"';
		}
		$ret .= ' title="' . __('Clear the search query.','wp-app-studio') . '">';
		$ret .= '<svg class="wpas-search-reset-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="10" height="10"><path d="M8.114 10L.944 2.83 0 1.885 1.886 0l.943.943L10 8.113l7.17-7.17.944-.943L20 1.886l-.943.943-7.17 7.17 7.17 7.17.943.944L18.114 20l-.943-.943-7.17-7.17-7.17 7.17-.944.943L0 18.114l.943-.943L8.113 10z"></path></svg>';
		$ret .= '</button>';
		$ret .= '</div>';
		$ret .= '<input id="wpas-search-rows-' . $list_values['type'] . '" class="btn btn-inverse" type="submit" value="' . __("Search","wp-app-studio") . '">';
		$ret .= '</div>';
	}
	else {
		$ret = '<div class="tablenav top">
			<div class="alignleft actions ' . $list_values['type'] . '">
				<select name="action" class="' . $list_values['type'] . '">
				<option selected="selected" value="-1">' . __("Bulk Actions","wp-app-studio") . '</option>
				<option value="delete">' . __("Delete","wp-app-studio") . '</option>
				</select>
				<input id="doaction" class="btn btn-inverse" type="submit" value="' . __("Apply","wp-app-studio") . '">
			</div>
			<div class="pagination pagination-right"> ';
	}
	return $ret;
}
function wpas_list_table($labels,$list_type,$builtin=0)
{
	$others = "";
	foreach($labels as $mylabel)
	{
		$others .= '<th class="manage-column column-name"><span>' . $mylabel . '</span></th>';
	}
	$bl = '';
	if($builtin == 1){
		$bl = '-bl';
	}
	$ret =  '<table class="table table-striped table-condensed table-bordered ' . $list_type . $bl . '" cellspacing="0">
	<thead><tr class="theader">';
	if($builtin == 0){
		$ret .= '<th id="cb" class="manage-column column-cb check-column" scope="col">
		<input type="checkbox"></th>';
	}
	else {
		$ret .= '<th></th>';
	}
	$ret .= $others;
	$ret .='</thead>';
	$ret .= '<tbody id="the-list"';
	if(in_array($list_type,Array('glob','entity_fields','rel_fields','help_fields')) && $builtin == 0 ){
		$ret .= '  class="ui-sortable"';
	}
	$ret .= '>';
	return $ret;
}
function wpas_list_row($url,$key_list,$mylist,$field_name,$alt,$type,$other_fields,$builtin=0)
{
	$view = "";
	$others = "";
	$view_url = $url['view'];
	$url_title = "View";
	$edit_id = "edit";
	$delete_id = "delete";
	switch ($type) {
		case 'entity':
			$view = '<span id="view" class="' . $type . '"><a href="' . $url['view'] . '" title="' . __("View","wp-app-studio") . '">' . __("View","wp-app-studio") . '</a> | </span>';
			if(empty($mylist['ent-inline-ent'])){
				$view .= '<span id="add_field" class="' . $type . '"><a href="' . $url['add_field'] . '" title="' . __("Add Attribute","wp-app-studio") . '">' . __("Add Attribute","wp-app-studio") . '</a> | </span>';
				$view .= '<span id="edit_layout" class="' . $type . '"><a href="' . $url['edit_layout'] . '" title="' . __("Edit Admin Layout","wp-app-studio") . '">' . __("Edit Admin Layout","wp-app-studio") . '</a></span>
                                | <span id="export" class="' . $type . '"><a href="' . wp_nonce_url($url['export'],'wpas_export') . '" title="' . __("Export","wp-app-studio") . '">' . __("Export","wp-app-studio") . '</a>';
			}
			break;
		case 'form':
			$view = '<span id="duplicate" class="' . $type . '"><a href="' . $url['duplicate'] .'" title="' . __("Duplicate","wp-app-studio") . '">' . __("Duplicate","wp-app-studio") . '</a></span> | <span id="edit_layout" class="' . $type . '"><a href="' . $url['edit_layout'] . '" title="' . __("Edit Layout","wp-app-studio") . '">' . __("Edit Layout","wp-app-studio") . '</a>';
			break;
		case 'widget':
			$view = '<span id="duplicate" class="' . $type . '"><a href="' . $url['duplicate'] .'" title="' . __("Duplicate","wp-app-studio") . '">' . __("Duplicate","wp-app-studio") . '</a></span>';
			break;	
		case 'shortcode':
			$view = '<span id="duplicate" class="' . $type . '"><a href="' . $url['duplicate'] .'" title="' . __("Duplicate","wp-app-studio") . '">' . __("Duplicate","wp-app-studio") . '</a></span>';
			break;
		case 'relationship':
			$view = '<span id="view" class="' . $type . '"><a href="' . $url['view'] . '" title="' . __("View","wp-app-studio") . '">' . __("View","wp-app-studio") . '</a> </span>
			<span id="add_field" class="' . $type . '">'; 
			$view .= '| <a href="' . $url['add_field'] . '" title="' . __("Add Attribute","wp-app-studio") . '">' . __("Add Attribute","wp-app-studio") . '</a>';
			break;
		case 'help':
			$view = '<span id="view" class="' . $type . '"><a href="' . $url['view'] . '" title="' . __("View","wp-app-studio") . '">' . __("View","wp-app-studio") . '</a> | </span>
			<span id="add_field" class="' . $type . '"><a href="' . $url['add_field'] . '" title="' . __("Add Tab","wp-app-studio") . '">' . __("Add Tab","wp-app-studio") . '</a>';
			break;
		case 'app':
			$view = '<span id="duplicate" class="' . $type . '"><a href="' . wp_nonce_url($url['duplicate'],'wpas_duplicate') . '" title="' . __("Duplicate","wp-app-studio") . '">' . __("Duplicate","wp-app-studio") . '</a></span>
				| <span id="export" class="' . $type . '"><a href="' . wp_nonce_url($url['export'],'wpas_export') . '" title="' . __("Export","wp-app-studio") . '">' . __("Export","wp-app-studio") . '</a>';
			$view_url = $url['edit_url'];
			$url_title = "Edit";
			break;
		case 'entity_fields':
			$edit_id = "edit-field";
			$delete_id = "delete-field";
			break;
		case 'rel_fields':
			$edit_id = "edit-rel-field";
			$delete_id = "delete-rel-field";
			break;
		case 'help_fields':
			$edit_id = "edit-help-field";
			$delete_id = "delete-help-field";
			break;
	}
	foreach($other_fields as $myfield)
	{
		if(isset($mylist[$myfield]))
		{
			if($mylist[$myfield] == '0')
			{
				$field_val = __("False","wp-app-studio");
			}
			elseif($mylist[$myfield] == '1')
			{
				$field_val = __("True","wp-app-studio");
			}
			else if($mylist[$myfield] == '')
			{
				$field_val = __("None defined.","wp-app-studio");
			}
			else
			{
				$field_val = $mylist[$myfield];
			}
		}
		else
		{
			if($myfield == 'date' && isset($mylist['modified_date']) && $mylist['modified_date'] != ''){
				$field_val = $mylist['modified_date'];
			}
                        elseif($myfield == 'modified_date' && isset($mylist['date']) && $mylist['date'] != ''){
				$field_val = $mylist['date'];
			}
			else {	
				$field_val = __("None defined.","wp-app-studio");
			}
		}
		if(isset($field_val))
		{	
			$others .= '<td>' . $field_val . '</td>';
		}
	}
	if($field_name == 'help-entity' && !isset($mylist[$field_name]) && isset($mylist['help-tax']))
	{
		$mylist[$field_name] = $mylist['help-tax'];
	}
	$ret = '<tr valign="top" class="'. $alt . '" id="' . $type . '_' . $key_list . '">';
	if($builtin == 0){
		$ret .= '<th class="check-column" scope="row">
		<input type="checkbox" value="' .$key_list .'" name="checkbox[]">
		</th>';
	}
	else {
		$ret .= '<th></th>';
	}
	$ret .= '<td class="post-title page-title column-title" id="edit_td"><strong>
	<a class="row-title" id="' . $field_name . '" title="' . $url_title . '" href="' .  $view_url . '">' . esc_html($mylist[$field_name]) . '</a></strong>
	<div class="row-actions">';
	if($type == 'entity' && in_array($mylist['ent-name'],Array("post","page")))
	{
	}
	elseif($type == 'role' && in_array($mylist['role-name'],Array("administrator","contributor","editor","author","subscriber","shop_manager","customer","edd_shop_manager","shop_vendor","shop_worker","shop_accountant")))
	{
	$ret .='<span id="edit" class="' . $type . '"><a title="' . __("Edit","wp-app-studio") . '" href="' . $url['edit_url'] . '">' . __("Edit","wp-app-studio") . '</a></span>';
	}
	else
	{
		$ret .='<span id="' . $edit_id . '" class="' . $type . '"><a title="' . __("Edit","wp-app-studio") . '" href="' . $url['edit_url'] . '">' . __("Edit","wp-app-studio") . '</a> | </span>';
		if($builtin == 0){
			$ret .= '<span id="' . $delete_id . '" class="' . $type . '"><a href="' . $url['delete_url'] . '" title="' . __("Delete","wp-app-studio") . '">' . __("Delete","wp-app-studio") . '</a>  | </span>';
		}
	}
	$ret .= $view . '
	</span></div></td>' . $others; 
	$ret .='</tr>';
	return $ret;
}
function wpas_list($list_type,$app,$app_id=0,$page=1,$comp_id='',$search='')
{
	$list_array = Array();
	if($list_type == 'entity_fields' && !empty($app['entity'][$comp_id]['field'])){
		$list_array = $app['entity'][$comp_id]['field'];
		$app_name = $app['app_name'];
	}
	elseif($list_type == 'rel_fields' && !empty($app['relationship'][$comp_id]['field'])){
		$list_array = $app['relationship'][$comp_id]['field'];
		$app_name = $app['app_name'];
	}
	elseif($list_type == 'help_fields' && !empty($app['help'][$comp_id]['field'])){
		$list_array = $app['help'][$comp_id]['field'];
		$app_name = $app['app_name'];
	}
	elseif($list_type != 'app' && !empty($app))
	{
		if(!empty($app[$list_type]))
		{
			$list_array = $app[$list_type];
		}
		$app_name = $app['app_name'];
	}
	else
	{
		$list_array = $app;
		$app_name = "";
	}
	$has_builtin = 0;
        $return_list = "";
        $paging = Array();
        $paging_html  = "";
	$div_table = "";
	$builtin_table = "";
	$edit_url = "#";
        $list_values = Array();
        $list_values['count'] = 0;
	if(isset($app_name))
	{
        	$list_values['app_name'] = $app_name;
	}
	if(!isset($page))
	{
		$page =1;
	}
	$list_array = wpas_search_lists($list_array,$list_type,$search);
        if(!empty($list_array))
        {
                $list_values['count'] = count($list_array);
        }
        if(isset($_REQUEST[$list_type . 'page']))
        {
                $page = intval ($_REQUEST[$list_type . 'page']);
        }
        $list_values['type'] = $list_type;
        $list_values['add_new_url'] = "#" . esc_attr($app_name);
	if($list_type == 'app')
        {
                $base = admin_url('admin.php?page=wpas_app_list');
                $list_values['title'] = __("Applications","wp-app-studio");
                $edit_url = wp_nonce_url(admin_url('admin.php?page=wpas_add_new_app&edit'),'wpas_edit_app_nonce') . '&app=';
                $duplicate_url = admin_url('admin.php?page=wpas_app_list&duplicate=1&app=');
                $export_url = admin_url('admin.php?page=wpas_app_list&export=1&app=');
                $list_values['import'] = admin_url('admin.php?page=wpas_app_list&import=1');
                $format = "apppage";
                $field_name = "app_name";
                $other_fields = Array('version','generate','entities','taxonomies','date','modified_date');
                $other_labels = Array(__("Name","wp-app-studio"),__("Version","wp-app-studio"),__("Generate","wp-app-studio"),__("Entities","wp-app-studio"),__("Taxonomies","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['add_new_url'] = admin_url('admin.php?page=wpas_add_new_app');
                $list_values['icon'] = "icon-cogs";
        }
	elseif($list_type == 'entity')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=entity&app='. $app_id);
                $list_values['title'] = __("Entities","wp-app-studio");
                $list_values['import'] = admin_url('admin.php?page=wpas_app_list&import=1&type=entity&app=' . $app_id);
                $export_url = admin_url('admin.php?page=wpas_app_list&export=1&type=entity&app=' . $app_id . '&entity=');
                $format = "entitypage";
                $field_name = "ent-name";
                $other_fields = Array("ent-label","ent-singular-label","ent-hierarchical","ent_fields","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Plural","wp-app-studio"),__("Singular","wp-app-studio"),__("Hierarchical","wp-app-studio"),__("Attributes","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-table";
                $add_field_tag = "#ent";
        }
	elseif($list_type == 'taxonomy')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=taxonomy&app=' . $app_id);
                $list_values['title'] = __("Taxonomies","wp-app-studio");
                $format = "taxonomypage";
                $field_name = "txn-name";
                $other_fields = Array("txn-label","txn-singular-label","txn-hierarchical","txn-attaches","txn-display_type","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Plural","wp-app-studio"),__("Singular","wp-app-studio"),__("Hierarchical","wp-app-studio"),__("Attached To","wp-app-studio"),__("Display","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-tag";
        }
        elseif($list_type == 'relationship')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=relationship&app=' . $app_id);
                $list_values['title'] = __("Relationships","wp-app-studio");
                $format = "relationshippage";
                $field_name = "rel-name";
                $other_fields = Array("rel-from-name","rel-to-name","rel-type","rel_fields","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("From","wp-app-studio"),__("To","wp-app-studio"),__("Type","wp-app-studio"),__("Attributes","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-link";
                $add_field_tag = "#rel";
        }
	elseif($list_type == 'help')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=help&app=' . $app_id);
                $list_values['title'] = __("Help Screens","wp-app-studio");
                $format = "helppage";
                $field_name = "help-entity";
                $other_fields = Array("help-screen_type","sidebar_on_off","help_tabs","date","modified_date");
                $other_labels = Array(__("Attached To","wp-app-studio"),__("Screen Type","wp-app-studio"),__("SideBar","wp-app-studio"),__("Tabs","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-info-sign";
                $add_field_tag = "#help";
        }
        elseif($list_type == 'role')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=role&app=' . $app_id);
                $list_values['title'] = __("Permissions","wp-app-studio");
                $format = "rolepage";
                $field_name = "role-name";
                $other_fields = Array("role-label","role_permissions","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Label","wp-app-studio"),__("Capabilities","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-key";
                $add_field_tag = "#role";
        }
	elseif($list_type == 'shortcode')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=shortcode&app=' . $app_id);
                $list_values['title'] = __("Views","wp-app-studio");
                $format = "shortcodepage";
                $field_name = "shc-label";
                $other_fields = Array("shc-attach","shc-view_type","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Attached To","wp-app-studio"),__("Type","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-eye-open";
                $add_field_tag = "#shortcode";
                $duplicate_url = "#";
        }
	elseif($list_type == 'notify')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=notify&app=' . $app_id);
                $list_values['title'] = __("Notifications","wp-app-studio");
                $format = "notifypage";
                $field_name = "notify-name";
                $other_fields = Array("notify-level","notify-attached_to","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Level","wp-app-studio"),__("Attached To","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-volume-up";
                $add_field_tag = "#notify";
        }
	elseif($list_type == 'connection')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=connection&app=' . $app_id);
                $list_values['title'] = __("Connections","wp-app-studio");
                $format = "connectionpage";
                $field_name = "connection-name";
                $other_fields = Array("connection-type","connection-entity","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Type","wp-app-studio"),__("Attached To","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-external-link";
                $add_field_tag = "#connection";
        }
	elseif($list_type == 'widget')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=widg&app=' . $app_id);
                $list_values['title'] = __("Widgets","wp-app-studio");
                $format = "widgpage";
                $field_name = "widg-name";
                $other_fields = Array("widg-type","widg-subtype","widg-attach","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Type","wp-app-studio"),__("Subtype","wp-app-studio"),__("Attached To","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['type'] = 'widg';
                $list_values['icon'] = "icon-cog";
                $add_field_tag = "#widg";
                $duplicate_url = "#";
        }
	elseif($list_type == 'form')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=form&app=' . $app_id);
                $list_values['title'] = __("Forms","wp-app-studio");
                $format = "formpage";
                $field_name = "form-name";
                $other_fields = Array("form-form_type","form-attached_entity","form-temp_type","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Type","wp-app-studio"),__("Attached To","wp-app-studio"),__("Template","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['type'] = 'form';
                $list_values['icon'] = "icon-list-alt";
                $add_field_tag = "#form";
                $duplicate_url = "#";
        }
	elseif($list_type == 'glob')
        {
                $base = admin_url('admin.php?page=wpas_add_new_app&view=glob&app=' . $app_id);
                $list_values['title'] = __("Globals","wp-app-studio");
                $format = "globpage";
                $field_name = "glob-name";
                $other_fields = Array("glob-label","glob-type","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Label","wp-app-studio"),__("Type","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-globe";
                $add_field_tag = "#glob";
        }
	elseif($list_type == 'entity_fields')
        {
                $list_values['title'] = __("Attributes","wp-app-studio");
                $field_name = "fld_name";
                $other_fields = Array("fld_label","fld_type","fld_required","fld_uniq_id","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Label","wp-app-studio"),__("Type","wp-app-studio"),__("Req","wp-app-studio"),__("Unique","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-columns";
                $add_field_tag = "#ent_fields";
        	$list_values['add_new_url'] = "#ent" . esc_attr($app['entity'][$comp_id]['ent-name']);
        }
	elseif($list_type == 'rel_fields')
        {
                $list_values['title'] = __("Attributes","wp-app-studio");
                $field_name = "rel_fld_name";
                $other_fields = Array("rel_fld_label","rel_fld_type","rel_fld_required","date","modified_date");
                $other_labels = Array(__("Name","wp-app-studio"),__("Label","wp-app-studio"),__("Type","wp-app-studio"),__("Req","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-columns";
                $add_field_tag = "#rel_fields";
        	$list_values['add_new_url'] = "#rel" . esc_attr($app['relationship'][$comp_id]['rel-name']);
        }
	elseif($list_type == 'help_fields')
        {
                $list_values['title'] = __("Tabs","wp-app-studio");
                $field_name = "help_fld_name";
                $other_fields = Array("date","modified_date");
                $other_labels = Array(__("Title","wp-app-studio"),__("Created","wp-app-studio"),__("Modified","wp-app-studio"));
                $list_values['icon'] = "icon-columns";
                $add_field_tag = "#help_fields";
		if(isset($app['help'][$comp_id]['help-entity'])){
        		$list_values['add_new_url'] = "#help" . esc_attr($app['entity'][$app['help'][$comp_id]['help-entity']]['ent-label']);
		}
		elseif(isset($app['help'][$comp_id]['help-tax'])){
        		$list_values['add_new_url'] = "#help" . esc_attr($app['taxonomy'][$app['help'][$comp_id]['help-tax']]['txn-label']);
		}
        }
        if($list_values['count'] == 0)
        {
		$col_count = count($other_labels) + 1;
                $div_table = '<tr class="no-items"><td colspan="' . $col_count . '">';
		$div_table .= sprintf(__('No %s found.','wp-app-studio'),strtolower($list_values['title'])) . '</td></tr>';
        }
        else
        {
                $count = 0;
                foreach($list_array as $key_list => $mylist)
                {
                        if($list_type == 'app')
                        {
				$mylist['entities'] = "";
				$mylist['taxonomies'] = "";
				if(isset($mylist['option']['ao_app_version'])){
					$mylist['version'] = $mylist['option']['ao_app_version'];
				}
				$mylist['generate'] = "<div id=\"generate\"><a class=\"btn btn-success\" href=\"". admin_url('admin.php?page=wpas_generate_page&app=') . $mylist['app_id'] . "\">Generate</a></div>";
				if(isset($mylist['entity']))
				{
					foreach($mylist['entity'] as $myentity)
					{
						if(!empty($myentity['field']))
						{
							$mylist['entities'] .= $myentity['ent-label'] . ", ";
						}
					}
					$mylist['entities'] = rtrim($mylist['entities'],', ');
				}
				if(isset($mylist['taxonomy']))
				{
					foreach($mylist['taxonomy'] as $mytax)
					{
						$mylist['taxonomies'] .= $mytax['txn-label'] . ", ";
					}
					$mylist['taxonomies'] = rtrim($mylist['taxonomies'],', ');
				}
                        }
			elseif($list_type == 'entity')
                        {
                                $count_ent_fields = 0;
				if(isset($mylist['field']))
				{
					$mylist['ent_fields'] = "";
					foreach($mylist['field'] as $myfield)
					{
						if($count_ent_fields == 3)
						{
							$more_link = "#" . $key_list;
							$mylist['ent_fields'] .= "<a id=\"ent-name\" href=\"" . $more_link . "\"> " . __("More","wp-app-studio") . " >></a>";
							break;
						}
						$mylist['ent_fields'] .= $myfield['fld_label'] . ", ";
						$count_ent_fields ++;
					}
					$mylist['ent_fields'] = rtrim($mylist['ent_fields'],', ');
				}
                        }
                        elseif($list_type == 'relationship')
                        {
                                $count_rel_fields = 0;
				if(isset($mylist['field']))
				{
					$mylist['rel_fields'] ="";
					foreach($mylist['field'] as $myfield)
					{
						if($count_rel_fields == 3)
						{
							$more_link = "#" . $key_list;
							$mylist['rel_fields'] .= "<a id=\"rel-name\" href=\"" . $more_link . "\"> " . __("More","wp-app-studio") . " >></a>";
							break;
						}
						$mylist['rel_fields'] .= $myfield['rel_fld_label'] . ", ";
						$count_rel_fields++;
					}
					$mylist['rel_fields'] = rtrim($mylist['rel_fields'],', ');
				}
				if($mylist['rel-from-name'] != 'user')
				{
					$mylist['rel-from-name'] = $app['entity'][$mylist['rel-from-name']]['ent-label'];
				}
				else
				{
					$mylist['rel-from-name'] = ucfirst($mylist['rel-from-name']);
				}
				if($mylist['rel-to-name'] != 'user')
				{
					$mylist['rel-to-name'] = $app['entity'][$mylist['rel-to-name']]['ent-label'];
				}
				else
				{
					$mylist['rel-to-name'] = ucfirst($mylist['rel-to-name']);
				}
                        }
                        elseif($list_type == 'taxonomy')
                        {
				$mylist['txn-attaches'] = "";
				foreach($mylist['txn-attach'] as $txn_att)
				{
					$mylist['txn-attaches'] .= $app['entity'][$txn_att]['ent-label'] . ",";
				}
				$mylist['txn-attaches'] = rtrim($mylist['txn-attaches'],",");
				$mylist['txn-display_type'] = ucfirst($mylist['txn-display_type']);
                        }
			elseif($list_type == 'help')
                        {
                                if(isset($mylist['help-screen_sidebar']))
                                {
                                        $mylist['sidebar_on_off'] = __("Yes","wp-app-studio");
                                }
                                else
                                {
                                        $mylist['sidebar_on_off'] = __("No","wp-app-studio");
                                }
                                $count_help_tabs = 0;
				$mylist['help_tabs'] = "";
				if(isset($mylist['field']))
				{
					foreach($mylist['field'] as $myfield)
					{
						if($count_help_tabs == 3)
						{
							$more_link = "#" . $key_list;
							$mylist['help_tabs'] .= "<a id=\"help-entity\" href=\"" . $more_link . "\"> " . __("More","wp-app-studio") . " >></a>";
							break;
						}
						$mylist['help_tabs'] .= $myfield['help_fld_name'] . ", ";
						$count_help_tabs ++;
					}
                                	$mylist['help_tabs'] = rtrim($mylist['help_tabs'],', ');
				}
				if(isset($mylist['help-entity']))
				{
					$mylist['help-entity'] = $app['entity'][$mylist['help-entity']]['ent-label'];
				}
				elseif(isset($mylist['help-tax']))
				{
					$mylist['help-entity'] = $app['taxonomy'][$mylist['help-tax']]['txn-singular-label'];
				}
                        }
			elseif($list_type == 'role')
			{	
				$count_cap = 0;
				foreach($mylist as $kcap => $rcap){
					if($rcap == 1){
						$count_cap++;
					}
				}
				$permission_count = $count_cap;  //count only caps
				$mylist['role_permissions'] = sprintf(__('%d capabilities set','wp-app-studio'),$permission_count);
			}
			elseif($list_type == 'widget')
			{	
				if($mylist['widg-type'] == 'sidebar')
				{
					$subtype = "widg-side_subtype";
				}
				elseif($mylist['widg-type'] == 'dashboard')
				{
					$subtype = "widg-dash_subtype";
				}
				if(isset($mylist['widg-attach']) && ((isset($mylist['widg-side_subtype']) && in_array($mylist['widg-side_subtype'], Array('entity','comment'))) || (isset($mylist['widg-dash_subtype']) && in_array($mylist['widg-dash_subtype'],Array('entity','comment')))))
				{
					$mylist['widg-attach'] = $app['entity'][$mylist['widg-attach']]['ent-label'];
				}
				elseif(isset($mylist['widg-dash_subtype']) && $mylist['widg-dash_subtype'] == 'admin')
				{
					$mylist['widg-attach']  = "";
				}
				$other_fields[1] = $subtype;
			}
			elseif($list_type == 'form')
			{
				if(isset($mylist['form-attached_entity']) && $mylist['form-attached_entity'] != "")
				{
					$mylist['form-attached_entity'] = $app['entity'][$mylist['form-attached_entity']]['ent-label'];
				}
			}
			elseif($list_type == 'connection')
			{
				switch($mylist['connection-type']){
					case 'inc_email':
						$mylist['connection-type'] = __('Incoming Email','wp-app-studio');
						break;
					case 'inline_entity':
						$mylist['connection-type'] = __('Inline Entity','wp-app-studio');
						break;
					case 'woocommerce':
						$mylist['connection-type'] = __('WooCommerce','wp-app-studio');
						break;
					case 'mailchimp':
						$mylist['connection-type'] = __('MailChimp','wp-app-studio');
						break;
					case 'edd':
						$mylist['connection-type'] = __('Easy Digital Downloads','wp-app-studio');
						break;
				}
				if(isset($mylist['connection-entity']) && $mylist['connection-entity'] != "")
				{
					$mylist['connection-entity']= $app['entity'][$mylist['connection-entity']]['ent-label'];
				}
			}
			elseif($list_type == 'shortcode')
			{
				switch ($mylist['shc-view_type']) {
					case 'std':	
						$mylist['shc-view_type'] = __("Standard","wp-app-studio");
						$mylist['shc-attach'] = $app['entity'][$mylist['shc-attach']]['ent-label'];
						break;
					case 'autocomplete':	
						$mylist['shc-view_type'] = __("Autocomplete","wp-app-studio");
						if(is_array($mylist['shc-attach'])){
							$attach = '';
							foreach($mylist['shc-attach'] as $att){
								$attach .= $app['entity'][$att]['ent-label'] . ', ';
							}
							$attach = rtrim($attach,", ");
						}
						else {
							$attach = $app['entity'][$mylist['shc-attach']]['ent-label'];
						}
						$mylist['shc-attach'] = $attach;
						break;
					case 'search':
						$mylist['shc-view_type'] = __("Search","wp-app-studio");
						if(empty($app['form'][$mylist['shc-attach_form']])){
							$mylist['shc-attach'] = "None defined";
						}
						else {
							$mylist['shc-attach'] = $app['form'][$mylist['shc-attach_form']]['form-name'];
						}
						break;
					case 'single':
						$mylist['shc-view_type'] = __("Single","wp-app-studio");
						$mylist['shc-attach'] = $app['entity'][$mylist['shc-attach']]['ent-label'];
						break;
					case 'archive':
						$mylist['shc-view_type'] = __("Archive","wp-app-studio");
						$mylist['shc-attach'] = $app['entity'][$mylist['shc-attach']]['ent-label'];
						break;
					case 'tax':
						$mylist['shc-view_type'] = __("Taxonomy","wp-app-studio");
						$ent = $app['entity'][$mylist['shc-attach']]['ent-label'];
						$mylist['shc-attach'] = $app['taxonomy'][$mylist['shc-attach_tax']]['txn-label'];
						$mylist['shc-attach'] .= " (";
						if(!empty($mylist['shc-attach_taxterm']))
						{
						 	$mylist['shc-attach'] .= $mylist['shc-attach_taxterm'] . "-";
						}
						$mylist['shc-attach'] .= $ent . ")";
						break;
					case 'chart':
					case 'emd_chart':
						$mylist['shc-view_type'] = __("Chart","wp-app-studio");	
						$mylist['shc-attach'] = $app['entity'][$mylist['shc-attach']]['ent-label'];
						break;
					case 'datagrid':
						$mylist['shc-view_type'] = __("Data Grid","wp-app-studio");	
						$mylist['shc-attach'] = $app['entity'][$mylist['shc-attach']]['ent-label'];
						break;
				}
			}
			elseif($list_type == 'notify')
			{
				switch($mylist['notify-level']) {
					case 'entity':
						$mylist['notify-level'] = "Entity";
						$mylist['notify-attached_to'] = $app['entity'][$mylist['notify-attached_to']]['ent-label'];
						break;
					case 'tax':
						$mylist['notify-level'] = "Taxonomy";
						$mylist['notify-attached_to'] = $app['taxonomy'][$mylist['notify-attached_to']]['txn-label'];
						break;
					case 'attr':
						$fids = explode("__",$mylist['notify-attached_to']);
						$mylist['notify-level'] = "Attribute";
						$mylist['notify-attached_to'] = $app['entity'][$fids[1]]['field'][$fids[0]]['fld_label'];
						break;
					case 'rel':
						$mylist['notify-level'] = "Relationship";
						$mylist['notify-attached_to'] = $app['relationship'][$mylist['notify-attached_to']]['rel-name'];
						break;
					case 'com':
						$mylist['notify-level'] = "Comment";
						$mylist['notify-attached_to'] = $app['entity'][$mylist['notify-attached_to']]['ent-label'];
						break;
				}
			}
			elseif($list_type == 'entity_fields')
			{
				if(isset($mylist['fld_required']) && $mylist['fld_required'] == 1)
				{
					$mylist['fld_required'] = 'Y';
				}
				else {
					$mylist['fld_required'] = 'N';
				}
				if(isset($mylist['fld_uniq_id']) && $mylist['fld_uniq_id'] == 1 || ($mylist['fld_type'] == 'hidden_function' && in_array($mylist['fld_hidden_func'],Array('unique_id','autoinc'))))
				{
					$mylist['fld_uniq_id'] = 'Y';
					$mylist['fld_required'] = 'Y';
				}
				else
				{
					$mylist['fld_uniq_id'] = 'N';
				}
			}
			elseif($list_type == 'rel_fields')
			{
				if(isset($mylist['rel_fld_required']) && $mylist['rel_fld_required'] == 1)
				{
					$mylist['rel_fld_required'] = 'Y';
				}
				else {
					$mylist['rel_fld_required'] = 'N';
				}
			}
                        $url['edit_url'] = $edit_url . $key_list;
                        $url['delete_url'] = "#" . $key_list;
                        $url['view'] = "#" . $key_list;
			if(isset($add_field_tag))
			{
                        	$url['add_field'] = $add_field_tag . $key_list;
                        	$url['edit_layout'] =  $add_field_tag .  $key_list;
			}
			if(isset($duplicate_url))
			{
                        	$url['duplicate'] = $duplicate_url . $key_list;
			}
			if(isset($export_url))
			{
                        	$url['export'] = $export_url . $key_list;
			}
                        if(in_array($list_type,Array('glob','entity_fields','rel_fields','help_fields')) || (!in_array($list_type,Array('glob','entity_fields','rel_fields','help_fields')) && $count < ($page * 15) && $count >= ($page-1)*15))
                        {
                                $alt = "";
                                if($count %2)
                                {
                                        $alt = "alternate";
                                }
				if($list_type == 'entity_fields' && isset($mylist['fld_builtin']) && $mylist['fld_builtin'] == 1){
					$has_builtin = 1;
                                	$builtin_table .= wpas_list_row($url,$key_list,$mylist,$field_name,$alt,$list_type,$other_fields,1);
				}
				else {
                                	$div_table .= wpas_list_row($url,$key_list,$mylist,$field_name,$alt,$list_type,$other_fields,0);
				}
                        }
                        $count ++;
                }
		if(!in_array($list_type , Array('glob','entity_fields','rel_fields','help_fields'))){
			$paging = paginate_links( array(
						'total' => ceil($list_values['count']/15),
						'current' => $page,
						'base' => $base . '&' . $format . '=%#%',
						'format' => '%#%',
						'type' => 'array',
						'add_args' => true,
						) );
			if(!empty($paging))
			{
				$paging_html = "<ul>";
				foreach($paging as $key_paging => $my_paging)
				{
					$paging_html .= "<li";
					if(($page == 1 && $key_paging == 0) || ($page > 1 && $page == $key_paging))
					{
						$paging_html .= " class='active'";
					}
					$paging_html .= ">" . $my_paging . "</li>";
				}
				$paging_html .= "</ul>";
			}
		}
                //$div_table .= "</tbody></table>";
        }
        $return_list = wpas_list_html($list_values,'pre',$search);
	if($has_builtin == 1){
		$return_list .= wpas_list_table($other_labels,$list_type,1); //builtin table
		$return_list .= $builtin_table . "</tbody></table>";
	}
        $return_list .= wpas_list_html($list_values,'end');
        $return_list .= $paging_html . "</div><br class=\"clear\"></div>";
        $return_list .= wpas_list_table($other_labels,$list_type);
        $return_list .= $div_table . "</tbody></table></form>";
	$return_list .= '<ul class="subsubsub">
			<li class="all">All<span class="count">(' . intval ($list_values['count']) . ')</span></li>
			</ul>';
        return $return_list;
}
function wpas_breadcrumb($page,$app_id)
{
	$home = admin_url('admin.php?page=wpas_app_list');
	echo '<div class="wpas">';
	wpas_branding_header();
	echo '<div id="was-container" class="container-fluid">';
	echo '<div class="emdt-row">';
	echo '<ul class="breadcrumb">
                <li id="first">
                <a href="'. $home . '"><i class="icon-home"></i> ' . esc_html__("Home","wp-app-studio") . '</a> <span class="divider">/</span>
                </li>';
        if($page == "add_new_app")
        {
                echo '<li id="second" class="active">' . esc_html__("Add New Application","wp-app-studio") . '</li>
                        </li>
                        </ul>';
        }
        elseif($page == "edit_app")
        {
                echo '<li id="second" class="active">' . esc_html__("Edit Application","wp-app-studio") . '</li>
                        </ul>';
        }
	echo '<div id="generate" class="genbtn"><a class="btn btn-large btn-success" href="'. admin_url('admin.php?page=wpas_generate_page&app=') .$app_id . '">' . esc_html__("Generate","wp-app-studio") .'</a></div>';
	echo '</div>';
}
function wpas_search_lists($list_array,$list_type,$search){
	if(!empty($search)){
		switch($list_type){
			case 'app':
				$list_array = wpas_get_app_list();
				$keys = Array('app_name');
				break;
			case 'shortcode':
				$keys = Array('shc-label','shc-view_type');
				break;
			case 'entity':
				$keys = Array('ent-label','ent-name');
				break;
			case 'taxonomy':
				$keys = Array('txn-label','txn-name','txn-display_type');
				break;
			case 'relationship':
				$keys = Array('rel-name','rel-from-title','rel-to-title','rel-type');
				break;
			case 'widget':
				$keys = Array('widg-label','widg-name','widg-title','widg-type','widg-side_subtype');
				break;
			case 'help':
				$keys = Array('help-screen_type');
				break;
			case 'form':
				$keys = Array('form-name','form-form_type');
				break;
			case 'notify':
				$keys = Array('notify-label','notify-name','notify-level');
				break;
			case 'connection':
				$keys = Array('connection-type','connection-name');
				break;
			case 'role':
				$keys = Array('role-label','role-name');
				break;
			case 'glob':
				$keys = Array('glob-label','glob-name','glob-type');
				break;
		}
		foreach($list_array as $krow => $myrow){
			$found = 0;
			foreach($keys as $mykey){
				if(preg_match('/' . $search . '/',strtolower($myrow[$mykey]))){
					$found = 1;
					break;
				}
			}
			if($list_type == 'app' && $found == 0){
				foreach($myrow['entity'] as $myent){
					if(preg_match('/' . $search . '/',strtolower($myent['ent-label']))){
						$found = 1;
						break;
					}
				}
				if($found == 0 && !empty($myrow['taxonomy'])){
					foreach($myrow['taxonomy'] as $mytax){
						if(preg_match('/' . $search . '/',strtolower($mytax['txn-label']))){
							$found = 1;
							break;
						}
					}
				}
			}
			if($found == 0){
				unset($list_array[$krow]);
			}
		}
	}
	return $list_array;
}
?>
